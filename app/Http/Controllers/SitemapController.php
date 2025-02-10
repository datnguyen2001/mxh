<?php

namespace App\Http\Controllers;


use App\Repositories\NewsRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\UserInterfaceHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use App\Repositories\RedisPipeLineRepository;
use Illuminate\Support\Facades\File;
use Laravelium\Sitemap\Sitemap;

class SitemapController extends BaseController
{
    protected $news;
    protected $zone;
    protected $redisPipeLine;

    public function __construct(
        NewsRepository $news,
        ZoneRepository $zone,
        RedisPipeLineRepository $redisPipeLine)
    {
        $this->news = $news;
        $this->zone= $zone;
        $this->redisPipeLine = $redisPipeLine;
    }

    public function index()
    {
        if (empty(env('zoneid'))) {
            $zoneId = 0;
        } else {
            $zoneSite = $this->zone->getZoneObject();
            $zoneId = $zoneSite->Id;
        }
        $sitemap = App::make("sitemap");
        $datenow = new Carbon();
        $startDate = new Carbon('01/01/2016');
//        $endDate = new Carbon('07/01/2022');
        $minmonth = 1;
//        $maxmonth = 12;

        $sitemap->addSitemap(config('siteInfo.site_path') . '/sitemaps/category.rss', $datenow);
        $sitemap->addSitemap(config('siteInfo.site_path') . '/google-news-sitemap.xml', $datenow);
        $sitemap->addSitemap(config('siteInfo.site_path') . '/latest-news-sitemap.xml', $datenow);

        $totalNews=self::getListKey($datenow,$startDate);
        for ($year = $datenow->year; $year >= $startDate->year; $year--) {

            if ($year != $datenow->year) {
                $maxmonth = 12;
            } else {
                //continue;
                $maxmonth = $datenow->month;
            }
            if ($year == $startDate->year) {
                $minmonth = $startDate->month;
            } else
                $minMonth = 1;
            for ($month = $maxmonth; $month >= $minmonth; $month--) {
                for ($day = 1; $day < 31; $day += 5) {
                    //Lấy khoảng thời gian cần gen sitemap
                    $rangeTime = $this->getRangeTime($day, $month, $year);

                    $from=$rangeTime[0];
                    $to=$rangeTime[1];
                    $dayTo=$to->day;
                    $dayForm=$from->day;

//                    $from = Carbon::create($year, $month, 1, 0, 0, 0, 'Asia/Ho_Chi_Minh');
//                    $to = Carbon::create($year, $month, 1, 0, 0, 0, 'Asia/Ho_Chi_Minh')->endOfMonth();

                    if ($from > $datenow)
                        break;
                    $timeExprire = 900;
                    $fileName = "/sitemaps/sitemaps-$year-$month-$dayForm-$dayTo.xml";

                    //Nếu thời gian kết thúc lớn hơn hiện tại thì gắn bằng thời gian hiện tại
                    if ($to > $datenow) {
                        $to = $datenow;
                    }
                    if ($to == $datenow) {
                        $timeExprire = 900; //Thời điểm hiện tại thì cache check số lượng tin để 15p
                    }

                    if (!empty($totalNews["newsCount$year$month$dayForm$dayTo"])){
                        //Nếu thời gian kết thúc là hiện tại thì render sitemap, nếu render từ đầu thì bỏ check đk này đi.
                        if ($to == $datenow) {
                            $from=$rangeTime[0];
                            $to=$rangeTime[1];
                            $fileName = "/sitemaps/sitemaps-$year-$month-$dayForm-$dayTo.xml";
                            File::delete(public_path($fileName));
                            $this->renderSitemapDetailAsync($from, $to);
                            $sitemap->addSitemap(config('siteInfo.site_path') . $fileName, $datenow);
                        }
                        else{
                            $sitemap->addSitemap(config('siteInfo.site_path') . $fileName, $to->toDateTimeString());

                        }
                    }

                }
            }
        }
        $sitemap->setCache('sitemap-index'.config('siteInfo.site_name'), $timeExprire);
        return $sitemap->render('sitemapindex');
    }

    public function rendertoDate(Request $request)
    {
        $date = $request->date;
        $form = $request->form;
        $to = $request->to;
        if (empty(env('zoneid'))) {
            $zoneId = 0;
        } else {
            $zoneSite = $this->zone->getZoneObject();
            $zoneId = $zoneSite->Id;
        }
        $sitemap = App::make("sitemap");
//        $datenow = new Carbon();
        $startDate = Carbon::create($date, $form, 1, 0, 0, 0, 'Asia/Ho_Chi_Minh');
        $datenow = Carbon::create($date, $to, 1, 0, 0, 0, 'Asia/Ho_Chi_Minh')->endOfMonth();
        $minmonth = 1;
        $maxmonth = 12;
        $totalNews=self::getListKey($datenow,$startDate);
        for ($year = $datenow->year; $year >= $startDate->year; $year--) {

            if ($year != $datenow->year) {
                $maxmonth = 12;
            } else {
                //continue;
                $maxmonth = $datenow->month;
            }
            if ($year == $startDate->year) {
                $minmonth = $startDate->month;
            } else
                $minMonth = 1;
            for ($month = $maxmonth; $month >= $minmonth; $month--) {
                for ($day = 1; $day < 31; $day += 5) {
                    //Lấy khoảng thời gian cần gen sitemap
                    $rangeTime = $this->getRangeTime($day, $month, $year);
                    $from = $rangeTime[0];
                    $to = $rangeTime[1];
                    $dayTo = $to->day;
                    $dayForm = $from->day;

                    if ($from > $datenow)
                        break;
                    $timeExprire = 900;
                    $fileName = "/sitemaps/sitemaps-$year-$month-$dayForm-$dayTo.xml";

                    //Nếu thời gian kết thúc lớn hơn hiện tại thì gắn bằng thời gian hiện tại
                    if ($to > $datenow) {
                        $to = $datenow;
                    }
                    File::delete(public_path($fileName));
                    $this->renderSitemapDetailAsync($from, $to);
                    if ($to == $datenow) {
                        $sitemap->addSitemap(config('siteInfo.site_path') . $fileName, $datenow);
                    } else {
                        $sitemap->addSitemap(config('siteInfo.site_path') . $fileName, $to->nextWeekday()->subMonth()->endOfMonth()->toDateTimeString());
                    }
                }
            }
        }
        return $sitemap->render('sitemapindex');
    }

    public function renderSitemapDetailAsync($from, $to)
    {
        $startDate = new Carbon($from);
        $endDate = new Carbon($to);
        $year = $startDate->year;
        $month = $startDate->month;
        $dayTo=$endDate->day;
        $dayForm=$startDate->day;
        if (empty(env('zoneid'))) {
            $zoneId = 0;
        } else {
            $zoneSite = $this->zone->getZoneObject();
            $zoneId = $zoneSite->Id;
        }
        $sitemap = App::make("sitemap");
        $start=!empty($page)?($page-1)*3000:0;
        $listKey["boxData"] = [
            'cmd' => 'zrevrangeByScore',
            'key' => sprintf(config('keyredis.KeySortedNewsInZone'), $zoneId ?? ''),
            'start' => $start,
            'lenght' => 2999,
            'startDate' => $from->timestamp,
            'endDate' => $to->timestamp
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $listKey = $pipeLineData["boxData"] ?? [];
        if (!empty($listKey)) {
            $listNews = array_splice($listKey, 0, 3000);
            $priority = 1.0;
            $freq = 'daily';
            foreach ($listNews as $value) {
                if (empty(config("originalSites.site.".($value->OriginalId??'') ))) {
                    $value->Title = str_replace(['/\b', ''], '', self::utf8_string($value->Title));
                    $value->AvatarDesc = str_replace(['/\b', ''], '', self::utf8_string($value->AvatarDesc));
                    $value->Title = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', !empty($value->MetaTitle) ? $value->MetaTitle : $value->Title));
                    $images = [
                        ['url' => !empty($value->Avatar) ? UserInterfaceHelper::formatThumbDomain($value->Avatar) : config('siteInfo.default_share'), 'title' => "<![CDATA[" . ((!empty($value->AvatarDesc)) ? $value->AvatarDesc : $value->Title) . "]]>", 'caption' => "<![CDATA[" . ((!empty($value->AvatarDesc)) ? $value->AvatarDesc : $value->Title) . "]]>"]
                    ];
                    if (!str_starts_with($value->Url, 'https') && !str_starts_with($value->Url, 'http')) {
                        $url = config('siteInfo.site_path') . $value->Url;
                    }
                    $sitemap->add($url, $value->LastModifiedDate ?? $value->DistributionDate, $priority, $freq, $images);
                }
            }

            $sitemap->store('xml', "/sitemaps/sitemaps-$year-$month-$dayForm-$dayTo");

        }
    }

    public function sitemapDetail(Request $request,Sitemap $sitemap)
    {
        if (empty(env('zoneid'))) {
            $zoneId = 0;
        } else {
            $zoneSite = $this->zone->getZoneObject();
            $zoneId = $zoneSite->Id;
        }
        $year = $request->year;
        $month = $request->month;
        $dayTo= $request->dayTo??'';
        $dayForm= $request->dayForm??'';
        $pageIndex=$request->pageIndex;
        $sitemap->setCache(config('siteInfo.site_path').env('VERSION_LANGUAGE','VI').'sitemapDetail'.$request->month.$request->year.$dayForm.$dayTo, 300);
        if ($sitemap->isCached()) {
            return $sitemap->render('xml');
        }

        $start=!empty($pageIndex)?($pageIndex-1)*3000:0;
        $from = Carbon::create($year, $month, $dayForm, 0, 0, 0, 'Asia/Ho_Chi_Minh');
        $to=Carbon::create($year, $month, $dayTo, 23, 59, 59, 'Asia/Ho_Chi_Minh');
        $listKey['boxData'] = [
            'cmd' => 'zrevrangeByScore',
            'key' => sprintf(config('keyredis.KeySortedNewsInZone'), $zoneId ?? ''),
            'start' => $start,
            'lenght' => 2999,
            'startDate' => $from->timestamp,
            'endDate' => $to->timestamp
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);

        $listNews = $pipeLineData['boxData'] ?? [];
        $priority = 1.0;
        $freq = 'daily';
        if (!empty($listNews)) {
            foreach ($listNews as $value) {
                if (empty(config("originalSites.site.".($value->OriginalId??'') ))) {
                    $value->Title=str_replace(['/\b',''],'',self::utf8_string(  $value->Title ));
                    $value->AvatarDesc=str_replace(['/\b',''],'',self::utf8_string( $value->AvatarDesc));
                    $value->Title = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', !empty($value->MetaTitle) ? $value->MetaTitle : $value->Title));

                    $images = [
                        ['url' => !empty($value->Avatar)?UserInterfaceHelper::formatThumbDomain($value->Avatar):config('siteInfo.default_share'), 'title' => "<![CDATA[" . ((!empty($value->AvatarDesc)) ? $value->AvatarDesc : $value->Title) . "]]>", 'caption' => "<![CDATA[" . ((!empty($value->AvatarDesc)) ? $value->AvatarDesc : $value->Title) . "]]>"]
                    ];
                    if (!str_starts_with($value->Url, 'https') && !str_starts_with($value->Url, 'http')){
                        $url= config('siteInfo.site_path') . $value->Url;
                    }
                    $sitemap->add($url, $value->LastModifiedDate ?? $value->DistributionDate, $priority, $freq, $images);
                }
            }
        }

        return $sitemap->render('xml');
    }

    public function sitemapCategory(Sitemap $sitemap){
        $ZoneKeyLits=$this->zone->getZoneByKey();
        if (!empty(env('ZONEID'))){
            $listCategory=$this->zone->getZoneMenu();
        }else{
            $listCategory=$this->zone->GetAllZoneGroupByParentId();
        }
        $sitemap->setCache(config('siteInfo.site_name').'sitemapCategory',900);
        if ($sitemap->isCached()) {
            return $sitemap->render('xml');
        }
        $priority=0.4;
        $freq='monthly';
        $datenow = new Carbon();
        foreach ($listCategory as $item){
            $sitemap->add(config('siteInfo.site_path').$item->ZoneUrl, $datenow,$priority, $freq);
        }
        foreach ($listCategory as $item){
            $getSubZone=$this->zone->GetListZoneByParentId($item->Id,$ZoneKeyLits);
            if (!empty($getSubZone)){
                foreach ($getSubZone as $value){
                    $sitemap->add(config('siteInfo.site_path').$value->ZoneUrl, $datenow,$priority, $freq);
                }
            }

        }
        return $sitemap->render('xml');
    }

    public function sitemapGoogleNews(Sitemap $sitemap){

        if (empty(env('zoneid'))){
            $zoneId = 0;
        }else{
            $zoneSite=$this->zone->getZoneObject();
            $zoneId=$zoneSite->Id;
        }
        $sitemap->setCache(config('siteInfo.site_name').'sitemapGoogleNews',300);
        if ($sitemap->isCached()) {
            return $sitemap->render('google-news');
        }
        $listKey['boxData'] = [
            'cmd' => 'zrevrange',
            'key' =>  sprintf(config('keyredis.KeySortedNewsInZone'),$zoneId ?? ''),
            'start' => 0,
            'stop' => 199,
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $listNews=$pipeLineData['boxData']??[];
        $listNews=$this->news->formatNewsDefault($listNews,600,315);
        if (empty($listNews)){
            return abort(404);
        }
        foreach ($listNews as $value)
        {
            if (empty(config("originalSites.site.".($value->OriginalId??'') ))) {
                $images = [
                    ['url' => UserInterfaceHelper::formatThumbDomain($value->Avatar)]
                ];
                $value->Title = str_replace(['/\b', ''], '', self::utf8_string($value->Title));
                $value->Title = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', !empty($value->MetaTitle) ? $value->MetaTitle : $value->Title));
                if (!empty($value->MetaNewsKeyword)) {
                    $value->MetaNewsKeyword = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $value->MetaNewsKeyword));
                }

                if (!empty($value->TagItem)) {
                    $value->TagItem = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $value->TagItem));
                }
                $googleNews = [
                    'sitename' => env('SITE_NAME'),
                    'language' => 'vi',
                    'publication_date' => $value->DistributionDate,
                    'access' => 'Subscription',
                    'keywords' => [(!empty($value->MetaNewsKeyword) ? $value->MetaNewsKeyword : $value->TagItem)],
                    'genres' => ['PressRelease'],
                    'images' => UserInterfaceHelper::formatThumbDomain($value->ThumbImage ? $value->ThumbImage : $value->Avatar),
                ];

                $url = $value->Url;
                if (!str_starts_with($value->Url, 'https') && !str_starts_with($value->Url, 'http')) {
                    $url = config('siteInfo.site_path') . $value->Url;
                }
                $sitemap->add($url, $lastmod = null, $priority = null, $freq = null, $images, $value->Title, $translations = [], $videos = [], $googleNews, $alternates = []);
            }
        }
        return $sitemap->render('google-news');
    }

    public function sitemapVideoNews(Sitemap $sitemap){

        $sitemap->setCache(config('siteInfo.site_name').'sitemapVideoNews',300);
        if ($sitemap->isCached()) {
            return $sitemap->render('xml');
        }
        $listKey['boxData'] = [
            'cmd' => 'zrevrange',
            'key' =>  sprintf(config('keyredis.KeyNewsByType'),13),
            'start' => 0,
            'stop' => 199,
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $listNews=$pipeLineData['boxData']??[];

        if (empty($listNews)){
            return abort(404);
        }else{
            $listNews=$this->news->formatNewsDefault($listNews,600,315);
            $listNews=$this->news->arrayMapAuthor($listNews);
        }
        foreach ($listNews as $value)
        {

            $images=[
                ['url' => UserInterfaceHelper::formatThumbDomain($value->Avatar)]
            ];
            $value->Title=str_replace(['/\b',''],'',self::utf8_string(  $value->Title ));
            $value->Title=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;',preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', !empty($value->MetaTitle)?$value->MetaTitle:$value->Title));
            if (!empty($value->MetaNewsKeyword)){
                $value->MetaNewsKeyword=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;',preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $value->MetaNewsKeyword));
            }

            if (!empty($value->TagItem)){
                $value->TagItem=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;',  preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $value->TagItem));
            }
            $videos = [[
//                'publication_date' => $value->DistributionDate,
                'content_loc'           => !empty($value->VideoMedia->FileName)?UserInterfaceHelper::formatAddDomainVid($value->VideoMedia->FileName):$value->linkVideoYoutobe??'',
                'description'    => $value->Sapo??'',
                'title'    =>   $value->Title??'',
                'thumbnail_loc' => UserInterfaceHelper::formatThumbDomain($value->ThumbImage?$value->ThumbImage:$value->Avatar),
                'live' => 'no',
                'uploader' => ['info'=>!empty($value->AuthorAll[0]->Url)?config('siteInfo.site_path').$value->AuthorAll[0]->Url:'',
                    'uploader'=>!empty($value->AuthorAll[0]->AuthorTitle) ? $value->AuthorAll[0]->AuthorTitle : $value->AuthorAll[0]->AuthorName ?? ''],
            ]];
            $url=$value->Url;
            if (!str_starts_with($value->Url, 'https') && !str_starts_with($value->Url, 'http')){
                $url= config('siteInfo.site_path') . $value->Url;
            }

            $sitemap->add($url, $lastmod = null, $priority = null, $freq = null,$images,$value->Title, $translations=[],$videos,$googleNews=[],$alternates=[]);
        }
        return $sitemap->render('xml');
    }

    public function latestnewsNews(Sitemap $sitemap){
        if (empty(env('zoneid'))){
            $zoneId = 0;
        }else{
            $zoneSite=$this->zone->getZoneObject();
            $zoneId=$zoneSite->Id;
        }
        $sitemap->setCache(config('siteInfo.site_path').'latestnewsNews',300);
        if ($sitemap->isCached()) {
            return $sitemap->render('xml');
        }
        $to=Carbon::now()->timestamp;
        $from = Carbon::parse('Now -5 days')->timestamp;
        $listKey['boxData'] = [
            'cmd' => 'zrevrangeByScore',
            'key' => sprintf(config('keyredis.KeySortedNewsInZone'), $zoneId ?? ''),
            'start' => 0,
            'lenght' => 200,
            'startDate' => $from,
            'endDate' => $to
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $listNews=$pipeLineData['boxData']??[];
        $listNews=$this->news->formatNewsDefault($listNews,600,315);
        if (empty($listNews)){
            return abort(404);
        }
        $priority=1.0;
        $freq='daily';
        foreach ($listNews as $value)
        {
            if (empty(config("originalSites.site.".($value->OriginalId??'') ))) {
            $value->Title=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;',preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', !empty($value->MetaTitle)?$value->MetaTitle:$value->Title));
            $images=[
                ['url' => !empty($value->Avatar)? UserInterfaceHelper::formatThumbDomain($value->Avatar):config('siteInfo.default_share'), 'title'=>"<![CDATA[".((!empty($value->AvatarDesc))?$value->AvatarDesc:$value->Title). "]]>", 'caption' => "<![CDATA[".((!empty($value->AvatarDesc))?$value->AvatarDesc:$value->Title). "]]>"]
            ];
            $url=$value->Url;
            if (!str_starts_with($value->Url, 'https') && !str_starts_with($value->Url, 'http')){
                $url= config('siteInfo.site_path') . $value->Url;
            }
            $sitemap->add($url, $value->LastModifiedDate?? $value->DistributionDate,$priority, $freq,$images);
            }
        }
        return $sitemap->render('xml');
    }

    public function sitemapTags(Sitemap $sitemap){
        $sitemap->setCache(config('siteInfo.site_name').'sitemapTags',1800);
        if ($sitemap->isCached()) {
            return $sitemap->render('xml');
        }
        $listKey['boxData'] = [
            'cmd' => 'zrevrange',
            'key' =>  config('keyredis.KeyTagAll'),
            'start' => 0,
            'stop' => 100,
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $listNews=$pipeLineData['boxData']??[];
        $listNews=$this->news->formatNewsDefault($listNews,600,315);
        if (empty($listNews)){
            return abort(404);
        }
        $priority=0.8;
        $freq='daily';
        foreach ($listNews as $value)
        {
            $value->Title=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;',preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', !empty($value->TagContent)?$value->TagContent:$value->Name));
            $images=[
                ['url' =>!empty($value->Avatar)? UserInterfaceHelper::formatThumbDomain($value->Avatar):config('siteInfo.default_share'), 'title'=>"<![CDATA[".((!empty($value->AvatarDesc))?$value->AvatarDesc:$value->Title). "]]>", 'caption' => "<![CDATA[".((!empty($value->AvatarDesc))?$value->AvatarDesc:$value->Name). "]]>"]
            ];
            $sitemap->add(config('siteInfo.site_path').UserInterfaceHelper::showUrlTag($value->Url), $value->CreatedDate?? $value->CreatedDate,$priority, $freq,$images);
        }
        return $sitemap->render('xml');
    }

    public function sitemapThread(Sitemap $sitemap){
        $sitemap->setCache(config('siteInfo.site_name').'sitemapThread',1800);
        if ($sitemap->isCached()) {
            return $sitemap->render('xml');
        }
        $listKey['boxData'] = [
            'cmd' => 'zrevrange',
            'key' =>  config('keyredis.KeyThreadAll'),
            'start' => 0,
            'stop' => 100,
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $listNews=$pipeLineData['boxData']??[];
        $listNews=$this->news->formatNewsDefault($listNews,600,315);
        if (empty($listNews)){
            return abort(404);
        }
        $priority=0.8;
        $freq='daily';
        foreach ($listNews as $value)
        {
            $value->Title=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;',preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', !empty($value->TagContent)?$value->TagContent:$value->Name));
            $images=[
                ['url' => !empty($value->Avatar)? UserInterfaceHelper::formatThumbDomain($value->Avatar):config('siteInfo.default_share'), 'title'=>"<![CDATA[".((!empty($value->AvatarDesc))?$value->AvatarDesc:$value->Title). "]]>", 'caption' => "<![CDATA[".((!empty($value->AvatarDesc))?$value->AvatarDesc:$value->Name). "]]>"]
            ];
            $sitemap->add(config('siteInfo.site_path').UserInterfaceHelper::showUrlDsk($value->Url,$value->Id), $value->CreatedDate?? $value->CreatedDate,$priority, $freq,$images);
        }
        return $sitemap->render('xml');
    }

    public function getRangeTime(int $day, int $month, int $year)
    {
        $result = [];
        $startDate = new Carbon();
        $endDate = new Carbon();
        if (1 <= $day && $day <= 5) {
            $startDate = Carbon::create($year, $month, 1, 0, 0, 0, 'Asia/Ho_Chi_Minh');
            $endDate = Carbon::create($year, $month, 5, 23, 59, 59, 'Asia/Ho_Chi_Minh');
        } else if (5 < $day && $day <= 10) {
            $startDate = Carbon::create($year, $month, 6, 0, 0, 0, 'Asia/Ho_Chi_Minh');
            $endDate = Carbon::create($year, $month, 10, 23, 59, 59, 'Asia/Ho_Chi_Minh');
        } else if (10 < $day && $day <= 15) {
            $startDate = Carbon::create($year, $month, 11, 0, 0, 0, 'Asia/Ho_Chi_Minh');
            $endDate = Carbon::create($year, $month, 15, 23, 59, 59, 'Asia/Ho_Chi_Minh');
        } else if (15 < $day && $day <= 20) {
            $startDate = Carbon::create($year, $month, 16, 0, 0, 0, 'Asia/Ho_Chi_Minh');
            $endDate = Carbon::create($year, $month, 20, 23, 59, 59, 'Asia/Ho_Chi_Minh');
        } else if (20 < $day && $day <= 25) {
            $startDate = Carbon::create($year, $month, 21, 0, 0, 0, 'Asia/Ho_Chi_Minh');
            $endDate = Carbon::create($year, $month, 25, 23, 59, 59, 'Asia/Ho_Chi_Minh');
        } else if (25 < $day) {
            $startDate = Carbon::create($year, $month, 26, 0, 0, 0, 'Asia/Ho_Chi_Minh');
            $endDate = Carbon::create($year, $month, 1, 0, 0, 0, 'Asia/Ho_Chi_Minh')->endOfMonth();
        }
        $result = [$startDate, $endDate];
        return $result;
    }

    public function getListKey($datenow,$startDate){
        try {
            $zoneId=0;
            $minmonth = 1;
            $maxmonth = 12;
            for ($year = $datenow->year; $year >= $startDate->year; $year--) {

                if ($year != $datenow->year) {
                    $maxmonth = 12;
                } else {
                    //continue;
                    $maxmonth = $datenow->month;
                }
                if ($year == $startDate->year) {
                    $minmonth = $startDate->month;
                } else
                    $minMonth = 1;
                for ($month = $maxmonth; $month >= $minmonth; $month--) {
                    for ($day = 1; $day < 31; $day += 5) {
                        //Lấy khoảng thời gian cần gen sitemap
                        $rangeTime = $this->getRangeTime($day, $month, $year);

                        $from=$rangeTime[0];
                        $to=$rangeTime[1];
                        $dayTo=$to->day??0;
                        $dayFrom=$from->day??0;

                        if ($to > $datenow) {
                            $to = $datenow;
                        }

                        $listKey[ "newsCount$year$month$dayFrom$dayTo" ]= [
                            'cmd' => 'zCount',
                            'key' => sprintf(config('keyredis.KeySortedNewsInZone'), $zoneId ?? ''),
                            'startDate' => $from->timestamp,
                            'endDate' => $to->timestamp
                        ];
                    }
                }
            }
            if (!empty($listKey)){
                $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
            }
            return $pipeLineData??[];
        }catch (\Throwable $th){
            return [];
        }

    }

    public function utf8_string($string){
        $string = mb_convert_encoding($string, "UTF-8");
        return preg_replace(
            array(
                '/\x00/', '/\x01/', '/\x02/', '/\x03/', '/\x04/',
                '/\x05/', '/\x06/', '/\x07/', '/\x08/', '/\x09/', '/\x0A/',
                '/\x0B/','/\x0C/','/\x0D/', '/\x0E/', '/\x0F/', '/\x10/', '/\x11/',
                '/\x12/','/\x13/','/\x14/','/\x15/', '/\x16/', '/\x17/', '/\x18/',
                '/\x19/','/\x1A/','/\x1B/','/\x1C/','/\x1D/', '/\x1E/', '/\x1F/'
            ),
            array(
                "\u0000", "\u0001", "\u0002", "\u0003", "\u0004",
                "\u0005", "\u0006", "\u0007", "\u0008", "\u0009", "\u000A",
                "\u000B", "\u000C", "\u000D", "\u000E", "\u000F", "\u0010", "\u0011",
                "\u0012", "\u0013", "\u0014", "\u0015", "\u0016", "\u0017", "\u0018",
                "\u0019", "\u001A", "\u001B", "\u001C", "\u001D", "\u001E", "\u001F"
            ),
            $string
        );
    }

}
