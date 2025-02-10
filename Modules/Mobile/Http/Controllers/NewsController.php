<?php

namespace Modules\Mobile\Http\Controllers;

use App\Helpers\LoggerHelpers;
use App\Repositories\NewsDetailRepository;
use App\Repositories\RedisPipeLineRepository;
use App\Repositories\NewsRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class NewsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $news;
    protected $zone;
    protected $redisPipeLine;
    protected $newsDetail;

    public function __construct(NewsRepository $news,
                                ZoneRepository $zone,
                                RedisPipeLineRepository $redisPipeLine,
                                NewsDetailRepository $newsDetail)
    {
        $this->news = $news;
        $this->zone= $zone;
        $this->redisPipeLine = $redisPipeLine;
        $this->newsDetail = $newsDetail;
    }
    public function detail(Request $request)
    {
        $newsId = $request->newsid;
        $newsContent = $this->news->getNewsContent($newsId);

        //301 Redirect Url
        $response = $this->newsDetail->handleNewsContentRedirect($newsContent, $request, $newsId);
        if ($response) {
            return $response; // Trả về redirect hoặc lỗi 404 từ hàm
        }

        //ZoneDetail & zoneParentInfo
        list($zoneDetail, $zoneParentInfo) = $this->newsDetail->getZoneDetailAndZoneParentInfo($newsContent);

        //Tin liên quan chi tiết
        if (!empty($newsContent->NewsRelation)) {
            $relationNewsList = $this->news->getNewsRelation($newsContent->NewsRelation, $newsContent->NewsId, 205, 128);
        }

        //Tags bài chi tiết
        $tagsList = $this->news->getTagByNewsId($newsContent->TagItem);

        //Update sitemap nếu update bài
        $this->newsDetail->updateSiteMapIfUpdateNews($request);

        //*Input ẩn dùng cho js
        $zoneInfoClientScript = $this->newsDetail->getInputHiddenNewsDetail($newsContent, $zoneDetail);

        $data = [
            'zoneDetail' => $zoneDetail ?? '',
            'categoryParentInfo' => (!empty($zoneParentInfo)) ? $zoneParentInfo : '',
            'zoneParentInfo' => (!empty($zoneParentInfo)) ? $zoneParentInfo : '',
            'newsContent' => $newsContent,
            'relationNewsList' => !empty($relationNewsList) ? $relationNewsList : [],
            'tagsList' => !empty($tagsList) ? $tagsList : [],
            'ZoneInfoClientScript' => !empty($zoneInfoClientScript) ? $zoneInfoClientScript : '',
        ];

        //Bài Magazine
        if ($newsContent->Type == 27) {
            $linkMagazine=$newsContent->linkMagazine;
            if ($newsContent->isMagzineZip==2){ //Magazine Zip
                if (!empty($linkMagazine)){
                    $html=$this->newsDetail->getContentHtml($linkMagazine);
                    if (!empty($html)){
                        $html= str_replace(["\n"], '', $html);
                        $page = HtmlPageCrawler::create($html);
                        $head = $page->filter('head');
                        $styleHeader = $head->filter('style');
                        $linkCss = $head->filter('link');
                        $linkCss = $linkCss->saveHTML();
                        $jsHead = $head->filter('script');
                        $body = $page->filter('body');
                        if (!empty($body)){
                            $body = $body->saveHTML();
                            $body = str_replace('</body>', '', $body);
                            $body = html_entity_decode($body, ENT_NOQUOTES, 'UTF-8');
                        }
                        $newsContent->Body = $body;
                        $data['newsContent'] = $newsContent;
                        $data['arrayStyle'] = $arrayStyle ?? [];
                        $data['styleHeader'] = html_entity_decode($styleHeader, ENT_NOQUOTES, 'UTF-8');
                        $data['linkCss'] = $linkCss;
                        $data['jsHead'] =html_entity_decode($jsHead, ENT_NOQUOTES, 'UTF-8'); ;
                    }
                }else{
                    return abort(404);
                }
                return  view('mobile::news.detail-magazine-zip', $data);
            }else{//Magazine Thường
                if (!empty($linkMagazine)){
                    $newsContent->Body= $this->newsDetail->getContentHtml($linkMagazine);
                    $data['newsContent']=$newsContent;
                }
                $data['ZoneInfoClientScriptNewtype'] = "<input type='hidden' name='hdNewsByType' id='hdNewsByType' value='27' />";
                return  view('mobile::news.detail-magazine', $data);
            }

        } else if ($newsContent->Type == 29) {
            $data['ZoneInfoClientScriptNewtype'] = "<input type='hidden' name='hdNewsByType' id='hdNewsByType' value='$newsContent->Type' />";
            return view('mobile::news.detail-photostory', $data);
        }else if ($newsContent->Type == 13) {
            $data['ZoneInfoClientScriptNewtype'] = "<input type='hidden' name='hdNewsByType' id='hdNewsByType' value='$newsContent->Type' />";
            return view('mobile::news.detail-video', $data);
        }
        return view('mobile::news.detail', $data);
    }

    public function loadRelated(Request $request)
    {
        $options = [
            'listNewsImgW' => 195,
            'listNewsImgH' => 122,
            'listNewsStop' => 3,
        ];
        $data = $this->newsDetail->loadRelated($request, $options, true);

        return view('mobile::news.components.box-detail-related', $data);
    }

    public function loadDetailMagazineBottom()
    {
        $options = [
            'imgW' => 195,
            'imgH' => 122
        ];
        $data = $this->newsDetail->loadDetailMagazineBottom(3, $options);

        return view('mobile::news.components.box-detail-related', $data);
    }

    public function loadDetailVideoBottom(){
        $options = [
            'imgW' => 554,
            'imgH' => 346
        ];
        $data = $this->newsDetail->loadDetailVideoBottom($options);

        return view('mobile::news.components.detail-video-bottom', $data);
    }


    public function loadDetailBottom()
    {
        $options = [
            'imgW' => 195,
            'imgH' => 122
        ];
        $data = $this->newsDetail->loadDetailBottom($options);
        return view('mobile::news.components.box-detail-bottom', $data);
    }

    public function loadMorePaging(Request $request)
    {
        $currentPage = $request->pageIndex;
        $zoneId = $request->zoneId;
        if ($zoneId == 0){
            $limit = 8;
            $start = ($currentPage - 1) * $limit;
            $key = [
                'listNews' => [
                    'cmd' => 'zrevrange',
                    'key' => sprintf(config('keyredis.KeySortedNewsInZone') ?? '', 0),
                    'start' => $start,
                    'stop' => $limit * $currentPage - 1,
                ],
            ];
            $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
            $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], 195, 122);
            $data = [
                'listNews' => $listNews ?? [],
            ];
            return view('mobile::components.template.itemcate', $data);
        }elseif ($zoneId == 13){
            $limit = 15;
            $start = ($currentPage - 1) * $limit;
            $key = [
                'listNews' => [
                    'cmd' => 'zrevrange',
                    'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 13),
                    'start' => $start,
                    'stop' => $limit * $currentPage - 1,
                ],
            ];
            $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
            $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], 554, 346);
            $data = [
                'listNews' => $listNews ?? [],
            ];
            return view('components.template.item-video', $data);
        }

    }

    public function detailBomb(Request $request)
    {
        $newsId = $request->newsid;
        $newsContent = $this->news->getKeyNewsPublish($newsId);
        $userAgent = $request->header('user-agent');
        if ($userAgent === 'TelegramBot (like TwitterBot)') {
            //Check TelegramBot
            if (empty($newsContent->NewsId)) {
                $newsContent = $this->news->getKeyNewsDetailBomb($newsId);
                LoggerHelpers::CallApiSetLog('Redirect, Get Bomb From Redis url=' . $request->url() . '?NewsId=' . $newsId, 'Telegram');
            }
            if (!empty($newsContent)) {
                //Custom link avt chia sẻ social
                $OgImage = !empty($newsContent->AvatarSocial) ? $newsContent->AvatarSocial : $newsContent->Avatar;
                $array = explode('.', $OgImage);
                $ext = strtolower(end($array));
                switch ($ext) {
                    case 'gif':
                        $OgImage = $OgImage . '.png';
                        break;
                }
            } else {
                LoggerHelpers::CallApiSetLog('url=' . $request->url(), '404Detail');
                if ($userAgent === 'TelegramBot (like TwitterBot)') {
                    LoggerHelpers::CallApiSetLog('url=' . $request->url(), '404DetailTelegramBot');
                }
                return abort(404);
            }
            $data = ['newsContent' => $newsContent, 'OgImage' => $OgImage ?? ''];
            return view('news.detail-bomb', $data);
        } else {
            if (empty($newsContent)) {
                LoggerHelpers::CallApiSetLog('url=' . $request->url(), '404Detail');
                if ($userAgent === 'TelegramBot (like TwitterBot)') {
                    LoggerHelpers::CallApiSetLog('url=' . $request->url(), '404DetailTelegramBot');
                }
                return abort(404);
            }
            return redirect(config('siteInfo.site_path') . $newsContent->Url, 301);
        }
    }

    public function detailBaoGiay(Request $request){
        $data = $this->newsDetail->detailBaoGiay($request);
        return view('news.bao-giay',$data);
    }
}
