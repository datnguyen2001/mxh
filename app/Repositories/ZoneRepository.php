<?php

namespace App\Repositories;

use App\Helpers\FormatHelpers;
use App\Helpers\UserInterfaceHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ZoneRepository
{

    private static $ZoneAll;
    private static $ZoneAllUrl;
    private static $ZoneAllVideo;
    private static $ZoneAllAudio;

    public function __construct()
    {
        self::setAllZones();
        self::setZoneVideo();
        // self::setZoneAudio();
    }

    private function generateZoneUrl($item, $zoneSiteId, $collection)
    {
        if (!empty($zoneSiteId)) {
            return !empty($item->ParentShortUrl) && $zoneSiteId != $item->ParentId
                ? UserInterfaceHelper::showUrlCategory($item->ParentShortUrl . '/' . $item->ShortURL)
                : UserInterfaceHelper::showUrlCategory($item->ShortURL);
        } else {
            if (!empty($item->ParentShortUrl)) {
                $zoneUrl = UserInterfaceHelper::showUrlCategory($item->ParentShortUrl . '/' . $item->ShortURL);
                $categoryParent = $collection->firstWhere('Id', $item->ParentId);
                if (!empty($categoryParent) && $categoryParent->ParentId != 0) {
                    $zoneUrl = UserInterfaceHelper::showUrlCategory($categoryParent->ParentShortUrl . '/' . $item->ParentShortUrl . '/' . $item->ShortURL);
                }
                return $zoneUrl;
            }
            return UserInterfaceHelper::showUrlCategory($item->ShortURL);
        }
    }
    private function setAllZones()
    {
        // Kiểm tra cache trước khi xử lý để giảm số lần truy cập Redis
        self::$ZoneAllUrl = Cache::store('zoneUrl')->get('zoneAllUrl' . env('SITE_NAME'));
        self::$ZoneAll = Cache::store('zone')->get('zoneAll' . env('SITE_NAME'));

        if (is_null(self::$ZoneAll) && is_null(self::$ZoneAllUrl)) {
            // Lấy dữ liệu từ Redis nếu cache không có
            $allZoneData = Redis::connection()->get(env('SITE_ID') . 'Zone');
            $zoneSiteId = str_replace('zone:id', '', env('ZONEID'));
            $allZones = json_decode($allZoneData);

            if (!empty($allZones)) {
                $collection = collect($allZones);

                $zoneList = array_map(function ($item) use ($zoneSiteId, $collection) {
                    // Xử lý URL của zone
                    $item->ZoneUrl = $this->generateZoneUrl($item, $zoneSiteId, $collection);

                    // Xử lý domain nếu có
                    if (!empty($item->Domain) && $item->Domain != '/') {
                        $item->ZoneUrl = $item->Domain;
                    }

                    // Giải mã MetaAvatar nếu tồn tại
                    if (!empty($item->MetaAvatar)) {
                        $metaAvatar = json_decode($item->MetaAvatar);
                        $item->avatarShareFacebook = $metaAvatar->avatarShareFacebook ?? '';
                        $item->squareAvatar = $metaAvatar->squareAvatar ?? '';
                    }

                    return $item;
                }, $allZones);

                // Xây dựng các mảng cache với vòng lặp foreach
                $zoneAllId = [];
                $allZoneUrls = [];
                foreach ($zoneList as $item) {
                    $zoneAllId[$item->Id] = $item;
                    $zoneKey = $item->ParentShortUrl . (!empty($item->ParentShortUrl) ? '/' : '') . $item->ShortURL;
                    $allZoneUrls[$zoneKey] = $item;
                }

                // Lưu cache để dùng lại
                Cache::store('zone')->forever('zoneAll' . env('SITE_NAME'), $zoneAllId);
                Cache::store('zoneUrl')->forever('zoneAllUrl' . env('SITE_NAME'), $allZoneUrls);
                self::$ZoneAllUrl = $allZoneUrls;
                self::$ZoneAll = $zoneList;
            }
        }
    }

    private function generateVideoZoneUrl($item)
    {
        return !empty($item->ParentUrl)
            ? UserInterfaceHelper::showUrlCategory($item->ParentUrl . '/' . $item->Url)
            : UserInterfaceHelper::showUrlCategory('video/' . $item->Url);
    }
    private function setZoneVideo()
    {
        // Kiểm tra cache để tránh truy xuất Redis nếu đã có dữ liệu
        self::$ZoneAllVideo = Cache::store('zone')->get('zoneAllVideo' . env('SITE_NAME'));

        if (is_null(self::$ZoneAllVideo)) {
            // Lấy dữ liệu từ Redis nếu cache không có
            $allZoneData = Redis::connection()->get(env('SITE_ID') . 'zonevideo');
            $allZones = json_decode($allZoneData);

            // Dùng map để xử lý từng item và tạo URL
            $listZoneVideo = collect($allZones)->map(function ($item) {
                if (!empty($item)) {
                    $item->ZoneUrl = $this->generateVideoZoneUrl($item);
                }
                return $item;
            })->values()->all();

            // Lưu kết quả vào cache
            Cache::store('zone')->forever('zoneAllVideo' . env('SITE_NAME'), $listZoneVideo);
            self::$ZoneAllVideo = $listZoneVideo;
        }
    }

    private function setZoneAudio()
    {
        // Kiểm tra xem dữ liệu đã có trong cache chưa để tránh truy xuất Redis không cần thiết
        self::$ZoneAllAudio = Cache::get('zoneAudio' . env('SITE_NAME'));

        if (is_null(self::$ZoneAllAudio)) {
            // Lấy dữ liệu từ Redis nếu cache không có
            $allZoneData = Redis::connection()->get(env('SITE_ID') . 'zoneaudio:all');
            $allZones = json_decode($allZoneData);

            // Sử dụng array_map để xử lý từng phần tử và tạo URL cho mỗi audio zone
            $listZoneAudio = array_map(function ($item) {
                $item->ZoneUrl = UserInterfaceHelper::showUrlCategory($item->Url);
                return $item;
            }, $allZones ?? []); // Bảo vệ nếu $allZones là null

            // Lưu dữ liệu đã xử lý vào cache để dùng lại
            Cache::forever('zoneAudio' . env('SITE_NAME'), $listZoneAudio);
            self::$ZoneAllAudio = $listZoneAudio;
        }
    }

    public function getUrlCategoryByParentId($parentId)
    {
        if ($parentId == 0) {
            return 0; // Không có danh mục nào với ParentId là 0
        }
        $zoneMenu = self::$ZoneAll;
        $listCategoryUrl = [];
        foreach ($zoneMenu as $value) {
            if ($value->ParentId == $parentId) {
                $url = $value->ParentShortUrl ? $value->ParentShortUrl . '/' . $value->ShortURL : $value->ShortURL;
                $listCategoryUrl[] = UserInterfaceHelper::showUrlCategory($url);
            }
        }
        return !empty($listCategoryUrl) ? $listCategoryUrl : 0;
    }

    public function getZoneByShortUrlParentShortUrl($shortUrl, $parentShortUrl)
    {
        $zoneSiteId = env('ZONEID') ? str_replace('zone:id', '', env('ZONEID')) : 0;
        $filtered = collect(self::$ZoneAll)->first(function ($item) use ($shortUrl, $parentShortUrl, $zoneSiteId) {
            if ($zoneSiteId) {
                // Trường hợp có zoneSiteId và ParentId khác 0
                return $item->ParentId != 0 && $item->ShortURL == $shortUrl;
            }
            // Trường hợp không có zoneSiteId
            return $item->ShortURL == $shortUrl && (
                    (!empty($parentShortUrl) && $item->ParentShortUrl == $parentShortUrl) ||
                    (empty($parentShortUrl) && $item->ParentId == 0)
                );
        });
        return $filtered ?: [];
    }

    public function getAllZoneGroupByParentId()
    {
        // Lọc và sắp xếp danh sách
        $zoneMenu = collect(self::$ZoneAll)->where('Invisibled', false)->where('ParentId', 0)->sortBy('SortOrder', SORT_NATURAL)
            ->map(function ($item) {
                $item->ZoneUrl = UserInterfaceHelper::showUrlCategory($item->ShortURL);
                return $item;
            })->values()->all();
        return $zoneMenu;
    }

    public function getListZoneByParentId($zoneId)
    {
        return collect(self::$ZoneAll)->where('Invisibled', false)->where('ParentId', $zoneId)->sortBy('SortOrder', SORT_NATURAL)->values()->all();
    }

    public function getZoneObject()
    {
        $zoneSiteId = str_replace('zone:id', '', env('ZONEID'));
        return self::getZoneByKey($zoneSiteId);
    }

    public function getZoneMenu()
    {
        $zoneSiteId = str_replace('zone:id', '', env('ZONEID'));
        return self::getListZoneByParentId($zoneSiteId);
    }

    //Start Zone Video
    //
    public function getAllZoneVideo()
    {
        return self::$ZoneAllVideo;
    }

    public function getZoneVideo($ZoneId){
        $collection = collect(self::$ZoneAllVideo);
        $filtered = $collection->filter(function ($value, $key) use ($ZoneId) {
            if ($value->Id==$ZoneId){
                return $value ;
            }
        });
        $Zone=$filtered->values()->all();
        if (!empty($Zone)){
            $Zone=$Zone[0];
        }
        return $Zone;
    }

    public function getZoneVideoByShortURL($ShortURL, $parentUrl = null)
    {
        $data = collect(self::$ZoneAllVideo)->first(function ($value) use ($ShortURL, $parentUrl) {
            if (!empty($parentUrl)) {
                return data_get($value, 'Url') === $ShortURL && data_get($value, 'ParentUrl') === $parentUrl;
            }
            return data_get($value, 'Url') === $ShortURL;
        });

        return $data ?: [];
    }

    public function getVideoCategoryChildByIdParent($parentId)
    {
        return collect(self::$ZoneAllVideo)->filter(function ($value) use ($parentId) {
                return !$value->Invisibled && data_get($value, 'ParentId') == $parentId;
            })->values()->all();
    }

    public function GetAllZoneVideoGroupByParentId()
    {
        return collect(self::$ZoneAllVideo)
            ->where('Invisibled', false)
            ->where('ParentId', 0)
            ->sortBy('SortOrder', SORT_NATURAL)
            ->values()
            ->all();
    }
    //End Zone Video

    // Start Zone Audio
    public function getAudioZone($zoneId, $imgW = null, $imgH = null)
    {
        $zone = collect(self::$ZoneAll)->first(function ($value) use ($zoneId) {
                return $value->Id == $zoneId;
            });

        if ($zone && !empty($imgW)) {
            $zone = FormatHelpers::formatAudio([$zone], $imgW, $imgH)[0];
        }

        return $zone ?: [];
    }

    public function getAudioZoneByUrl($SortUrl, $imgW, $imgH)
    {
        $zone = collect(self::$ZoneAll)->first(function ($value) use ($SortUrl) {
                return $value->Url == $SortUrl;
            });

        if ($zone && !empty($imgW)) {
            $zone = FormatHelpers::formatAudio([$zone], $imgW, $imgH)[0];
        }

        return $zone ?: [];
    }

    public function getZoneByKey($key = '')
    {
        if ($key) {
            return self::$ZoneAllUrl[$key] ?? self::$ZoneAll[$key] ?? '';
        }

        return self::$ZoneAllUrl;
    }
}
