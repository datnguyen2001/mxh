<?php

namespace Modules\Mobile\Http\Controllers;

use App\Helpers\LoggerHelpers;
use App\Repositories\NewsRepository;
use App\Repositories\VideoRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class VideoController extends BaseController
{
    protected $news;
    protected $zone;
    protected $video;

    public function __construct(NewsRepository $news, ZoneRepository $zone, VideoRepository $video)
    {
        $this->news = $news;
        $this->zone= $zone;
        $this->video = $video;
    }
    public function index(Request $request){
        //Tất cả Zone Video
        $zoneVideo = $this->video->getAllZoneVideo();
        $zoneVideoParent = [];
        foreach($zoneVideo as $key => $value){
            if($value->ParentId == 0 && $value->Url != 'truyen-hinh'  && $value->Url != 'phat-thanh'){
                $zoneVideoParent[$key] = $value;
            }
        }

        // video focus
        $videoFocus = $this->news->zrevrangeKeyObjectEmbedBox(0,1,1, 750,469);
        // video mới nhất
        $videoNewsList = $this->video->zrevrangeKeySortedVideoGetAll(0, 9, 686,429, $videoFocus);
        $ZoneInfoClientScript = $this->video->getInputHiddenVideo(0, $videoFocus[0]);

        $data = [
            'ZoneId' => '',
            'videoFocus' => !empty($videoFocus) ? $videoFocus : [],
            'zoneVideo' => !empty($zoneVideoParent)?$zoneVideoParent:'',
            'videoNewsList' => !empty($videoNewsList)?$videoNewsList:'',
            'ZoneInfoClientScript'=>!empty($ZoneInfoClientScript)?$ZoneInfoClientScript:'',
        ];
        return view('mobile::video.index' ,$data);
    }
    public function list(Request $request){

        $slug_video=$request->slug_video;
        //Tất cả Zone Video
        $zoneVideo=$this->video->getAllZoneVideo();

        foreach ($zoneVideo as $value) {
            if ($value->Url == $slug_video && $value->ParentId == 0) {
                $ZoneVideoInfo = $value;
            }
        }
        if (empty($ZoneVideoInfo)){
            LoggerHelpers::CallApiSetLog('url='.$request->url(),'404');
            return abort(404);
        }
        $ZoneId = $ZoneVideoInfo->Id;

        $zoneVideoParent = [];
        foreach($zoneVideo as $key => $value){
            if($value->ParentId == 0 && $value->Url != 'truyen-hinh'  && $value->Url != 'phat-thanh'){
                $zoneVideoParent[$key] = $value;
            }
        }

        // video focus
        $videoFocus = $this->news->zrevrangeKeyObjectEmbedBox($ZoneVideoInfo->Id,1,1,750,469);
        $videoRemove = [];
        if(!empty($videoFocus)){
            $videoRemove = $videoFocus;
        }

        // video mới nhất
        $videoNewsList = $this->video->zrevrangeKeySortedVideoInZone($ZoneVideoInfo->Id, 0,9, 686,429,$videoRemove);

        $ZoneInfoClientScript = $this->video->getInputHiddenVideo($ZoneVideoInfo->Id, $videoFocus[0]);

        $data = [
            'ZoneId' => $ZoneId,
            'ZoneVideoInfo' => !empty($ZoneVideoInfo)?$ZoneVideoInfo:[],
            'zoneVideo' => !empty($zoneVideoParent)?$zoneVideoParent:[],
            'videoFocus' => !empty($videoFocus)?$videoFocus:[],
            'videoNewsList' => !empty($videoNewsList)?$videoNewsList:[],
            'ZoneInfoClientScript' => !empty($ZoneInfoClientScript)?$ZoneInfoClientScript:[],
        ];

        return view('mobile::video.index', $data);
    }
    public function detail(Request $request)
    {
        //Video chi tiết
        $videoId = $request->video_id;
        $videoFocus = $this->video->getKeyVideo($videoId);
        if (empty($videoFocus)) {
            LoggerHelpers::CallApiSetLog('url=' . $request->url(), '404');
            return abort(404);
        } else if ($request->path() != preg_replace('/\//', '', $videoFocus->Url, 1)) {
            return redirect($videoFocus->Url);
        }
        $listVideoRemove = [];
        $zoneId = $videoFocus->ZoneId;

        // video cùng chuyên mục
        $videoNewsList = $this->video->zrevrangeKeySortedVideoInZone($zoneId,0,9,686,429,$listVideoRemove);
        //Tất cả Zone Video
        $zoneVideo = $this->video->getAllZoneVideo();
        $zoneVideoParent = [];
        foreach($zoneVideo as $key => $value){
            if($value->Id == $zoneId){
                $zoneVideoParent = $value;
            }
        }
        $zoneVideoParent = [];
        foreach($zoneVideo as $key => $value){
            if($value->ParentId == 0 && $value->Url != 'truyen-hinh'  && $value->Url != 'phat-thanh'){
                $zoneVideoParent[$key] = $value;
            }
        }

        $ZoneInfoClientScript = $this->video->getInputHiddenVideo($zoneId, $videoFocus);

        $data = [
            'zoneId' => $zoneId,
            'videoId' => $videoId,
            'zoneVideo' => !empty($zoneVideoParent) ? $zoneVideoParent : [],
            'videoFocus' => !empty($videoFocus) ? $videoFocus : [],
            'videoNewsList' => !empty($videoNewsList) ? $videoNewsList : [],
            'ZoneInfoClientScript' => !empty($ZoneInfoClientScript) ? $ZoneInfoClientScript : '',
        ];
        return view('mobile::video.detail',$data );
    }


    public function loadMorePaging(Request $request)
    {
        $options = [
            'videoW' => 686,
            'videoH' => 429,
        ];
        $list = $this->video->loadMorePaging($request, $options);
        if (!empty($list)){
            $data = ['listVideos'=>$list];
            return view('mobile::components.template.boxlayout14',$data);
        }
        return null;
    }




}
