<?php


namespace App\Http\Controllers;


use App\Helpers\UserInterfaceHelper;

use App\Repositories\NewsRepository;
use App\Repositories\ZoneRepository;
use App\Repositories\RedisPipeLineRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class RssController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
        $ZoneKeyLits = $this->zone->getZoneByKey();
        if (!empty(env('ZONEID'))) {
            $listCategory = $this->zone->getZoneMenu();
        } else {
            $listCategory = $this->zone->GetAllZoneGroupByParentId();
        }

        foreach ($listCategory as $key => $item) {

            if ($item->ShortURL == 'multimedia') {
                $item->URL = config('siteInfo.site_path') . '/rss/' . $item->ShortURL . '.rss';
                $item->subZone = [(object)['URL' => config('siteInfo.site_path') . '/rss/video.rss', 'Name' => 'Video'],
                    (object)['URL' => config('siteInfo.site_path') . '/rss/photo.rss', 'Name' => 'Ảnh'],
                    (object)['URL' => config('siteInfo.site_path') . '/rss/emagazine.rss', 'Name' => 'Emagazine'],
                    (object)['URL' => config('siteInfo.site_path') . '/rss/infographic.rss', 'Name' => 'Infographic'],
                ];
            } else {
                $item->URL = config('siteInfo.site_path') . '/rss/' . $item->ShortURL . '.rss';
                $getSubZone = $this->zone->GetListZoneByParentId($item->Id, $ZoneKeyLits);
                foreach ($getSubZone as $value) {
                    if (!empty($value->ParentShortUrl)) {
                        $value->ZoneUrl = UserInterfaceHelper::showUrlCategory($value->ParentShortUrl . '/' . $value->ShortURL);
                    }
                    $value->URL = config('siteInfo.site_path') . '/rss' .str_replace('.htm','.rss',$value->ZoneUrl);
                    if (str_contains($value->ZoneUrl,'https:')){
                        $value->URL=  $value->ZoneUrl;
                    }
                }
                $item->subZone = $getSubZone;
            }
        }
        $data = [
            'listCategory' => $listCategory,
        ];

        if (env('SITE_MOBILE')){
            return view('mobile::rss.index', $data);
        }
        return view('rss.index', $data);
    }


    public function home()
    {
        if (empty(env('zoneid'))) {
            $zoneId = 0;
        } else {
            $zoneSite = $this->zone->getZoneObject();
            $zoneId = $zoneSite->Id;
        }
        $listKey['boxData'] = [
            'cmd' => 'zrevrange',
            'key' =>  sprintf(config('keyredis.KeySortedNewsInZone'),$zoneId ),
            'start' => 0,
            'stop' => 59,
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $posts=$pipeLineData['boxData']??[];
        $posts=$this->news->formatNewsDefault($posts,600,315);
        if (empty($posts)) {
            return abort(404);
        }
        $datenow = new Carbon();
        $site = [
            'url' => config('siteInfo.site_path'),
            'name' => config('siteInfo.site_name'),
            'description' => config('metapage.Home.description'),
            'copyright' => config('siteInfo.site_path'),
            'generator' => config('siteInfo.site_path'),
            'language' => 'vi-vn',
            'pubDate' => date("D, d M Y H:i:s T"),
            'lastBuildDate' => $datenow,
            'image' => [
                'url' => config('siteInfo.logo'),
                'title' => config('siteInfo.site_name'),
                'link' => config('siteInfo.site_path'),
            ]

        ];

        foreach ($posts as $value) {
            $value->title = $value->Title;
            $url=$value->Url;
            if (!str_starts_with($value->Url, 'https')){
                $url= config('siteInfo.site_path') . $value->Url;
            }
            $value->link = $url;
            $value->Date = date("D, d M Y H:i:s T", strtotime($value->DistributionDate));
            $value->description = '<a href="' . config('siteInfo.site_path') . $value->Url . '"><img src="' . $value->ThumbImage . '"></a> ' . $value->Sapo;

        }
        return response()->view('rss.rss', compact(array('site', 'posts')))->header('Content-Type', 'text/xml');
    }


    public function category(Request $request)
    {
        $catId = $request->catId;
        $slug_cat = (!empty($request->slug_child)) ? $request->slug_child : $request->slug_cat;
        $shortURLParrent = (!empty($request->slug_child)) ? $request->slug_cat : null;
        $zone = '';
        $zone=$this->zone->getZoneByShortUrlParentShortUrl($slug_cat, $shortURLParrent);
        if ($slug_cat == 'video') {
            $listKey['boxData'] = [
                'cmd' => 'zrevrange',
                'key' =>    sprintf(config('keyredis.KeyNewsByTypeFullType'), 13),
                'start' => 0,
                'stop' => 59,
            ];
        } elseif ($slug_cat == 'photo') {
            $listKey['boxData'] = [
                'cmd' => 'zrevrange',
                'key' =>    sprintf(config('keyredis.KeyNewsByTypeFullType'), 29),
                'start' => 0,
                'stop' => 59,
            ];
        } elseif ($slug_cat == 'emagazine') {
            $listKey['boxData'] = [
                'cmd' => 'zrevrange',
                'key' =>    sprintf(config('keyredis.KeyNewsByTypeFullType'), 27),
                'start' => 0,
                'stop' => 59,
            ];

        } elseif ($slug_cat == 'infographic') {
            $listKey['boxData'] = [
                'cmd' => 'zrevrange',
                'key' =>    sprintf(config('keyredis.KeyNewsByTypeFullType'), 20),
                'start' => 0,
                'stop' => 59,
            ];
        } elseif (!empty($zone)) {
            $listKey['boxData'] = [
                'cmd' => 'zrevrange',
                'key' =>    sprintf(config('keyredis.KeySortedNewsInZone'), $zone->Id ?? ''),
                'start' => 0,
                'stop' => 499,
            ];
        }
        if (empty(env('zoneid'))) {
            $zoneSite = 0;
        } else {
            $zoneSite = $this->zone->getZoneObject();
            $zoneSite = $zoneSite->Id;
        }
        $datenow = new Carbon();
        if (!empty($zone) && $zone->ParentId != $zoneSite) {
            $zone->URL = $zoneUrl = $zone->ParentShortUrl . '/' . $zone->ShortURL;
            $zoneName = $zone->Name;
        } elseif ($slug_cat == 'video') {
            $zoneUrl = 'video';
            $zoneName = 'Video';
        } elseif ($slug_cat == 'photo') {
            $zoneUrl = 'photo';
            $zoneName = 'Photo';
        } elseif ($slug_cat == 'infographic') {
            $zoneUrl = 'infographic';
            $zoneName = 'Infographic';
        } elseif ($slug_cat == 'emagazine') {
            $zoneUrl = 'emagazine';
            $zoneName = 'Emagazine';
        } elseif (!empty($zone)) {
            $zone->URL = $zoneUrl = $zone->ShortURL;
            $zoneName = $zone->Name;
        }
        if (empty($zoneUrl) || empty($zoneName)) {
            return abort(404);
        }
        if (!empty($listKey)){
            $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
            $posts=$pipeLineData['boxData']??[];
        }

        $site = [
            'url' => config('siteInfo.site_path') . UserInterfaceHelper::showUrlCategory($zoneUrl),
            'urlRss' => config('siteInfo.site_path') .'/rss'. str_replace('.htm','.rss',UserInterfaceHelper::showUrlCategory($zoneUrl)),
            'name' => $zoneName . ' | ' . config('siteInfo.site_name'),
            'description' => config('metapage.Home.description'),
            'copyright' => config('siteInfo.site_path'),
            'generator' => config('siteInfo.site_path'),
            'language' => 'vi-vn',
            'pubDate' => date("D, d M Y H:i:s T"),
            'lastBuildDate' => $datenow,
            'image' => [
                'url' => config('siteInfo.logo'),
                'title' => $zoneName . ' | ' . config('siteInfo.site_name'),
                'link' => config('siteInfo.site_path') . UserInterfaceHelper::showUrlCategory($zoneUrl),
            ]

        ];
        if (!empty($posts)) {
            $posts=$this->news->formatNewsDefault($posts,600,315);
            foreach ($posts as $value) {
                if (empty($value->Sapo)) {
                    $value->Sapo = $value->Description;
                }
                $value->title = !empty($value->Title) ? $value->Title : $value->Name;
                $url=$value->Url;
                if (!str_starts_with($value->Url, 'https')){
                    $url= config('siteInfo.site_path') . $value->Url;
                }
                $value->link = $url;
                $value->Date = date("D, d M Y H:i:s T", strtotime($value->DistributionDate));
                $value->description = '<a href="' . config('siteInfo.site_path') . $value->Url . '"><img src="' .$value->ThumbImage . '"></a> ' . $value->Sapo;
            }
        }
        return response()->view('rss.rss', compact(array('site', 'posts')))->header('Content-Type', 'text/xml');
    }

    public function cococ()
    {
        if (empty(env('zoneid'))) {
            $zoneId = 0;
        } else {
            $zoneSite = $this->zone->getZoneObject();
            $zoneId = $zoneSite->Id;
        }
        $listKey['boxData'] = [
            'cmd' => 'zrevrange',
            'key' =>  sprintf(config('keyredis.KeySortedNewsInZone'),$zoneId??'' ),
            'start' => 0,
            'stop' => 499,
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $posts=$pipeLineData['boxData']??[];
        $posts=$this->news->formatNewsDefault($posts,600,315);
        if (empty($posts)) {
            return abort(404);
        }
        $datenow = new Carbon();
        $site = [
            'url' => config('siteInfo.site_path'),
            'name' => config('siteInfo.site_name'),
            'description' => config('metapage.Home.description'),
            'copyright' => config('siteInfo.site_path'),
            'generator' => config('siteInfo.site_path'),
            'language' => 'vi-vn',
            'pubDate' => date("D, d M Y H:i:s T"),
            'lastBuildDate' => $datenow,
            'image' => [
                'url' => config('siteInfo.logo'),
                'title' => config('siteInfo.site_name'),
                'link' => config('siteInfo.site_path'),
            ]

        ];
        foreach ($posts as $value) {
            $value->title = $value->Title;
            $url=$value->Url;
            if (!str_starts_with($value->Url, 'https')){
                $url= config('siteInfo.site_path') . $value->Url;
            }
            $value->link = $url;
            $value->Date = date("D, d M Y H:i:s T", strtotime($value->DistributionDate));
            $value->description = $value->Sapo;
            $value->Body = $this->news->getNewsContent($value->NewsId)->Body;
        }
        return response()->view('rss.cococ', compact(array('site', 'posts')))->header('Content-Type', 'text/xml');
    }

    public function facebook_article()
    {
        if (empty(env('zoneid'))) {
            $zoneId = 0;
        } else {
            $zoneSite = $this->zone->getZoneObject();
            $zoneId = $zoneSite->Id;
        }
        $listKey['boxData'] = [
            'cmd' => 'zrevrange',
            'key' =>  sprintf(config('keyredis.KeySortedNewsInZone'),$zoneId??'' ),
            'start' => 0,
            'stop' => 499,
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $posts=$pipeLineData['boxData']??[];
        $posts=$this->news->formatNewsDefault($posts,600,315);
        if (empty($posts)) {
            return abort(404);
        }
        $datenow = new Carbon();
        $site = [
            'url' => config('siteInfo.site_path'),
            'name' => config('siteInfo.site_name'),
            'description' => config('metapage.Home.description'),
            'copyright' => config('siteInfo.site_path'),
            'generator' => config('siteInfo.site_path'),
            'language' => 'vi-vn',
            'pubDate' => date(DATE_RFC822),
            'lastBuildDate' => date(DATE_RFC822, strtotime($datenow)),
            'image' => [
                'url' => config('siteInfo.logo'),
                'title' => config('siteInfo.site_name'),
                'link' => config('siteInfo.site_path'),
            ]

        ];
        foreach ($posts as $value) {
            $value->title=str_replace(['/\b',''],'',self::utf8_string(  $value->Title ));
            $value->link = config('siteInfo.site_path') . $value->Url;
            $value->Date = date("D, d M Y H:i:s T", strtotime($value->DistributionDate));
            $value->description = $value->Sapo;
            $value->Body = $this->news->getNewsContent($value->NewsId)->Body;
            $value->Body =htmlspecialchars($value->Body , ENT_QUOTES, 'UTF-8');
        }
        return response()->view('rss.facebook-article', compact(array('site', 'posts')))->header('Content-Type', 'text/xml');
    }


    public function link4proxy(){
        $listKey['boxData'] = [
            'cmd' => 'zrevrange',
            'key' =>  sprintf(config('keyredis.KeySortedNewsInZone'),$zoneId??'' ),
            'start' => 0,
            'stop' => 99,
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $posts=$pipeLineData['boxData']??[];
        $arr_link= array_map(function ($item) {
            $url=(Object)null;
            $link=$item->Url;
            if (!str_starts_with($item->Url, 'https')){
                $link= config('siteInfo.site_path') . $item->Url;
            }
            $url->Url=$link;
            return $url;
        }, $posts);
        return str_replace('\/','/',json_encode($arr_link));
    }

}
