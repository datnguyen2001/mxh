<?php

namespace App\Repositories;

use App\Helpers\RedisClientHelper;
use App\Helpers\SqlsrvDataHelper;
use App\Helpers\UserInterfaceHelper;
use App\Helpers\FormatHelpers;
use Illuminate\Support\Str;


class NewsRepository
{
    protected $zone;
    public function __construct(ZoneRepository $zone)
    {
        $this->zone = $zone;
        $this->storedProcedures=new SqlsrvDataHelper();
    }
    // Hàm xử lý thông tin zone
    private function assignZoneInfo(&$item, $zoneInfo)
    {
        if ($zoneInfo) {
            $item->ZoneName = $zoneInfo->Name ?? '';
            $item->ZoneUrl = UserInterfaceHelper::showUrlCategory(
                (!empty($zoneInfo->ParentShortUrl) ? $zoneInfo->ParentShortUrl . '/' : '') . $zoneInfo->ShortURL
            );
        } else {
            $item->ZoneName = '';
            $item->ZoneUrl = '';
        }
    }

    // Hàm xử lý thông tin thương hiệu
    private function assignBrandInfo(&$item)
    {
        $brandInfo = is_array($item->BrandContent) ? (object)$item->BrandContent : $item->BrandContent;

        $item->BrandId = $brandInfo->BrandId ?? '';
        $item->BrandName = $brandInfo->BrandName ?? '';
        $item->BrandUrl = $this->getBrandUrl($brandInfo);
        $item->BrandLogoStream = UserInterfaceHelper::formatThumbDomain($brandInfo->LogoStream ?? '');
        $item->BrandLogo = UserInterfaceHelper::formatThumbDomain($brandInfo->Logo ?? '');
        $item->BrandIcon = UserInterfaceHelper::formatThumbDomain($brandInfo->Icon ?? '');
    }

    // Hàm tạo Brand URL
    private function getBrandUrl($brandInfo)
    {
        return !empty($brandInfo->BrandUrl) && (str_starts_with($brandInfo->BrandUrl, 'https') || str_starts_with($brandInfo->BrandUrl, 'http'))
            ? $brandInfo->BrandUrl
            : (!empty($brandInfo->BrandName) ? "/" . Str::slug($brandInfo->BrandName) . "." . env('TAG_FILENAME') : '');
    }

    // Hàm xử lý map tin với zone mục
    public function ArrayMapNews($arr)
    {
        $zoneAll = $this->zone->getZoneByKey();

        // Xử lý mảng dữ liệu với mapping function
        return array_filter(collect($arr)->map(function ($item) use ($zoneAll) {
            $item = is_object($item) ? $item : json_decode($item);
            if (empty($item)) return null;

            // Cập nhật thông tin tiêu đề và loại tin nếu là video
            if (!empty($item->KeyVideo)) {
                $item->Title = $item->Name;
                $item->NewsType = $item->Type;
            }

            // Lấy và gán thông tin zone
            $this->assignZoneInfo($item, $zoneAll[$item->ZoneId] ?? null);

            // Kiểm tra và gán thông tin thương hiệu
            if (!empty($item->BrandId) && $item->BrandId > 0 && !empty($item->BrandContent)) {
                $this->assignBrandInfo($item);
            }
            return $item;
        })->all());
    }

    // Hàm xử lý map tin với zone mục video
    public function ArrayMapVideo($arr)
    {
        return array_filter(collect($arr)->map(function ($item) {
            $item = is_object($item) ? $item : json_decode($item);
            if (empty($item)) return null;

            // Lấy thông tin zone
            $zoneInfo = $this->zone->getZoneByKey($item->ZoneId);
            $item->ZoneName = $zoneInfo->Name ?? '';
            $item->ZoneUrl = !empty($zoneInfo) && !empty($zoneInfo->Url)
                ? UserInterfaceHelper::showUrlCategory('video/' . $zoneInfo->Url)
                : '';

            // Gán Name từ Title nếu Name không tồn tại
            $item->Name = $item->Name ?? $item->Title;

            return $item;
        })->all());
    }

    // Hàm xử lý map tin với zone mục audio
    public function ArrayMapAudio($arr)
    {
        return array_filter(collect($arr)->map(function ($item) {
            $item = is_object($item) ? $item : json_decode($item);
            if (empty($item)) return null;

            // Lấy thông tin zone
            $zoneInfo = self::getZone($item->ZoneId);
            $item->ZoneName = $zoneInfo->Name ?? '';
            $item->ZoneUrl = $zoneInfo->ZoneUrl ?? '';

            // Tạo URL cho audio
            $item->Url = '/' . Str::slug($item->Name, '-') . '-' . $item->Id . '.' . env('DETAIL_FILENAME');

            return $item;
        })->all());
    }

    public function getKeyNewsPublish($newsId)
    {
        return json_decode(RedisClientHelper::get(sprintf(config('keyredis.KeyNewsPublish'), $newsId)));
    }

    public function getKeyNewsDetailBomb($newsId)
    {
        $newsContent = RedisClientHelper::get(sprintf(config('keyredis.KeyNewsDetailBomb'), $newsId));
        return json_decode($newsContent);
    }

    public function hgetMultiKeyNewsContentPage( $newsRelation, $imgW, $imgH)
    {
        if (!empty($newsRelation)) {
            foreach ($newsRelation as $key) {
                $listKey[]=sprintf(config('keyredis.KeyNewsPublish'), $key);
            }
            $listContent = RedisClientHelper::mGet($listKey);
            $listNews = array_map(function ($item) {
                if (!empty($item)) {
                    return json_decode($item);
                }
            }, $listContent);
        }
        return FormatHelpers::formatNews($listNews ??[], $imgW, $imgH);
    }

    public function getNewsContent($newsId)
    {
        $isNewsPublish= RedisClientHelper::exists(sprintf(config('keyredis.KeyNewsPublish'), $newsId));
        if ($isNewsPublish)
        {
            $pageId =  RedisClientHelper::hgetNewsContentInpage( $newsId);

            $newsContentBody = RedisClientHelper::hgetNewsContentPage($pageId, $newsId);//get body Redis

            if (!empty($newsContentBody)){
                $newsContent=json_decode($newsContentBody);
            }else{
                $newsContentBody=$this->storedProcedures->getBodyContent($newsId);
                if (!empty($newsContentBody[0]->Body)){
                    $newsContent=json_decode($newsContentBody[0]->Body);
                }
            }

            //format bandcontent
            try {
                if (!empty($newsContent)) {
                    //Check BrandContent
                    if (!empty($newsContent->BrandId) && $newsContent->BrandId > 0 && !empty($newsContent->BrandContent)) {
                        $this->assignBrandInfo($newsContent);
                    }
                    return FormatHelpers::formatNewsContent($newsContent);
                }
            }catch (\Throwable $th){

            }
            return !empty($newsContent) ? FormatHelpers::formatNewsContent($newsContent) : null;
        }
        return null;
    }

    public function getNewsRelation($arrNewsRelation,$newsId,$imgW,$imgH){

        if (!is_array(json_decode($arrNewsRelation))) {
            $newsRelation = preg_split('/(,|;)/', $arrNewsRelation);
            $relationNewsList = self::hgetMultiKeyNewsContentPage($newsRelation, $imgW, $imgH);
        } else {
            $relationNewsList = json_decode($arrNewsRelation);
            $relationNewsList=FormatHelpers::formatNews($relationNewsList, $imgW, $imgH);
        }
        return !empty($relationNewsList)?$relationNewsList:[];
    }

    public function getTagByNewsId($TagItem)
    {
        if (empty($TagItem) || !is_string($TagItem)) {
            return [];
        }
        return array_filter(array_map(function ($value) {
            $url = trim($value);
            if (empty($url)) return null;

            return (object)[
                'Name' => $value,
                'Url' => UserInterfaceHelper::showUrlTag(Str::slug(str_replace('/', '-', $value), '-'))
            ];
        }, explode(';', trim($TagItem))));
    }

    /**
     * Format Danh sách dòng sự kiện
     * @param array $arr danh sách dòng sự kiện
     * @param int $imgW Width of ThumbImage
     * @param int $imgH Height of ThumbImage
     * @return array
     */
    public function formatBoxThread(array $arr, int $imgW, int $imgH): array
    {
        $listThreadEmbed = array_map(function ($item) {
            $item->Url = '/su-kien/' . Str::slug(str_replace('/', ' ', $item->Name), '-') . '-' . $item->Id . '.' . env('CAT_FILENAME');
            return $item;
        }, $arr);
        return FormatHelpers::formatNews($listThreadEmbed, $imgW, $imgH);
    } //End formatBoxThread

    /**
     * Format Danh sách Chủ để - Topic
     * @param array $arrayKey Danh sách tin
     * @param int $imgW Width of ThumbImage
     * @param int $imgH Height of ThumbImage
     * @return array
     */
    public function formatBoxTopic(array $arrayKey, int $imgW, int $imgH): array
    {
        $listTopicEmbed = array_map(function ($item) {
            $item->Url = '/chu-de/' . Str::slug(str_replace('/', ' ', $item->Title), '-') . '-' . $item->Id . '.' . env('CAT_FILENAME');
            return $item;
        }, $arrayKey);
        return FormatHelpers::formatNews($listTopicEmbed, $imgW, $imgH);
    } //End formatBoxTopic

    /**
     * Format Data từ Key ObjectEmbeded
     * @param array $arrayKey
     * @return array
     */
    public function formatDataByEmbedbox(array $arr): array
    {
        return array_map(function ($item) {
            if (!empty($item)) {
                $sluggedTitle = Str::slug($item->Title);
                switch ($item->ObjectType) {
                    case 0:
                        $item->Url = UserInterfaceHelper::showUrlNews($sluggedTitle, $item->ObjectId);
                        break;
                    case 1:
                        $item->Url = UserInterfaceHelper::showUrlDsk($sluggedTitle, $item->ObjectId);
                        break;
                    case 2:
                        $item->Url = '/video' . UserInterfaceHelper::showUrlNews($sluggedTitle, $item->ObjectId);
                        break;
                    case 4:
                        $item->Url = UserInterfaceHelper::showUrlTopic($sluggedTitle, $item->ObjectId);
                        break;
                    case 6:
                        $item->Url = UserInterfaceHelper::showUrlAuthor($sluggedTitle, $item->ObjectId);
                        break;
                    default:
                        $item->Url = UserInterfaceHelper::showUrlTag($sluggedTitle);
                        break;
                }
            }
            return $item;
        }, $arr);
    }
    /**
     * Format Tin mới
     * @param array $arrNews Danh sách tin mới
     * @param int $imgW Width of ThumbImage
     * @param int $imgH Height of ThumbImage
     * @param array $listItemRemove Danh sách tin check trùng
     * @param int $lenghtFormatThumb Số tin format ThumbImage theo $imgW và $imgH
     * @param int $s_imgW Width of smaller ThumbImage
     * @param int $s_imgH Height of smaller ThumbImage
     * @param int $lenght Số lương tin cần lấy
     * @return array
     */
    public function formatNewsDefault(array $arrNews, int $imgW, int $imgH, array $listItemRemove = [], int $lenghtFormatThumb = 0, int $s_imgW = 0, int $s_imgH = 0, int $lenght = 0)
    {


        if (!empty($listItemRemove)) {
            $removeIds =  collect($listItemRemove)->pluck('NewsId')->all();
            $arrNews = collect($arrNews)->whereNotIn('NewsId', $removeIds)->values()->all();
        }

        if (!empty($arrNews)) {
            // Format theo kích thước ảnh chính hoặc phụ
            if (!empty($s_imgW)) {
                $listNewsFocus = FormatHelpers::formatNews(array_splice($arrNews, 0, $lenghtFormatThumb), $imgW, $imgH);
                $listNewsItem = FormatHelpers::formatNews($arrNews, $s_imgW, $s_imgH);
                $listNews = array_merge($listNewsFocus, $listNewsItem);
            } else {
                $listNews = FormatHelpers::formatNews($arrNews, $imgW, $imgH);
            }

            // Map dữ liệu với hàm ArrayMapNews
            $listNews = self::ArrayMapNews($listNews);

            // Giới hạn số lượng kết quả trả về nếu cần thiết
            if (!empty($lenght)) {
                $listNews = array_slice($listNews, 0, $lenght);
            }
        }
        return $listNews ?? [];
    } //End formatNewsDefault

    public function formatVideoDefault(array $arrVideo , int $imgW, int $imgH, array $listItemRemove = [], int $lenghtFormatThumb = 0, int $s_imgW = 0, int $s_imgH = 0, int $lenght = 0)
    {
        if (!empty($arrVideo)) {
            if (!empty($s_imgW)) {
                $listFocus = FormatHelpers::formatNews(array_splice($arrVideo, 0, $lenghtFormatThumb), $imgW, $imgH);
                $listItem = FormatHelpers::formatNews($arrVideo, $s_imgW, $s_imgH);
                $listVideo = array_merge($listFocus, $listItem);
            } else {
                $listVideo = FormatHelpers::formatNews($arrVideo, $imgW, $imgH);
            }
            $listVideo = self::ArrayMapVideo($listVideo);

            if (!empty($lenght)) {
                $listVideo = array_splice($listVideo, 0, $lenght);
            }

            if (!empty($listItemRemove)) {
                $collection = collect($listVideo);
                foreach ($listItemRemove as $item) {
                    $filtered = $collection->whereNotIn('Id', $item->Id);
                    $collection = collect($filtered);
                }
                $listVideo = $filtered->values()->all();
            }


        }
        return  $listVideo ?? [];
    }

    public function formatRadioDefault(array $arrNews , int $imgW, int $imgH, array $listItemRemove = [], int $lenghtFormatThumb = 0, int $s_imgW = 0, int $s_imgH = 0, int $lenght = 0)
    {
        if (empty($arrNews)) {
            return [];
        }
        // Định dạng ảnh theo kích thước chính và phụ nếu có
        if (!empty($s_imgW)) {
            $listNewsFocus = FormatHelpers::formatNews(array_splice($arrNews, 0, $lenghtFormatThumb), $imgW, $imgH);
            $listNewsItem = FormatHelpers::formatNews($arrNews, $s_imgW, $s_imgH);
            $listNews = array_merge($listNewsFocus, $listNewsItem);
        } else {
            $listNews = FormatHelpers::formatNews($arrNews, $imgW, $imgH);
        }

        // Loại bỏ các phần tử trong listItemRemove nếu có
        if (!empty($listItemRemove)) {
            $removeIds =  collect($listItemRemove)->pluck('NewsId')->all();
            $listNews = collect($listNews)->whereNotIn('NewsId', $removeIds)->values()->all();
        }

        // Định dạng ảnh đại diện và URL
        $listNews = array_map(function ($item) {
            $item->ThumbImage = $item->Avartar ?? asset('image/Live.png');
            $item->Url = '/phat-thanh/' . Str::slug($item->Name) . '-' . $item->Id . '.htm';
            return $item;
        }, $listNews);

        // Giới hạn số lượng kết quả trả về nếu cần
        if (!empty($lenght)) {
            $listNews = array_slice($listNews, 0, $lenght);
        }

        $listNews = self::ArrayMapNews($listNews);
        return  $listNews ?? [];
    }

    public function formatBoxPosition(array $arrPosition, array $arrNews, int $lenght, int $imgW, int $imgH, int $lenghtFormatThumb = 0, int $s_imgW = null, int $s_imgH = null): array
    {
        // Kết hợp và loại bỏ phần tử trùng lặp dựa trên NewsId
        $listNews = collect(array_merge($arrPosition, $arrNews))
            ->unique('NewsId')
            ->take($lenght)
            ->values()
            ->all();

        if (!empty($listNews)) {
            // Xử lý theo kích thước hình ảnh chính và phụ nếu có
            if (!empty($s_imgW)) {
                $listNewsFocus = FormatHelpers::formatNews(array_splice($listNews, 0, $lenghtFormatThumb), $imgW, $imgH);
                $listNewsItem = FormatHelpers::formatNews($listNews, $s_imgW, $s_imgH);
                $listNews = array_merge($listNewsFocus, $listNewsItem);
            } else {
                $listNews = FormatHelpers::formatNews($listNews, $imgW, $imgH);
            }

            // Gọi ArrayMapNews sau khi đã xử lý hình ảnh
            $listNews = self::ArrayMapNews($listNews);
        }

        return $listNews ?? [];
    }


    //Project custom
    public function arrayMapAuthor($arrayNews)
    {
        try {
            // Thu thập tất cả ID của tác giả từ $arrayNews để thực hiện một lần truy vấn Redis
            $arrayKey = array_filter(array_map(function ($value) {
                return !empty($value->AuthorAll[0]->Id) ? env("SITE_ID") . "newsauthor:id" . $value->AuthorAll[0]->Id : null;
            }, $arrayNews));

            // Nếu không có ID tác giả nào, trả về ngay $arrayNews
            if (empty($arrayKey)) {
                return $arrayNews;
            }

            // Lấy thông tin tác giả từ Redis theo các khóa đã chuẩn bị
            $listAuthor = RedisClientHelper::mGet($arrayKey);

            // Xử lý thông tin của từng tác giả và đưa vào bảng tra cứu với ID làm khóa
            $authorsData = [];
            foreach ($listAuthor as $item) {
                $item = json_decode($item); // Giải mã JSON thành đối tượng
                // Thiết lập ảnh đại diện mặc định nếu không có Avatar, nếu có thì định dạng lại
                $item->Avatar = empty($item->Avatar) ? config('siteInfo.default_no_thumb') : UserInterfaceHelper::formatThumbZoom($item->Avatar, 100, 100);

                // Tạo URL dựa trên loại tác giả (AuthorType), nếu không hợp lệ thì để là javascript:;
                $item->Url = (!empty($item->AuthorType) && $item->AuthorType != 0) ? '/author/' . Str::slug($item->AuthorTitle ?? $item->OriginalName) . '-' . $item->Id . '.htm' : 'javascript:;';

                // Thêm thông tin tác giả vào bảng tra cứu với ID làm khóa
                $authorsData[$item->Id] = $item;
            }

            // Gán thông tin tác giả từ bảng tra cứu vào $arrayNews dựa trên AuthorAll[0]->Id
            foreach ($arrayNews as &$newsItem) {
                $authorId = $newsItem->AuthorAll[0]->Id ?? null;
                if (isset($authorsData[$authorId])) {
                    $newsItem->AuthorAll = [$authorsData[$authorId]];
                }
            }

            return $arrayNews;
        } catch (\Throwable $th) {
            // Nếu xảy ra lỗi, trả về $arrayNews ban đầu mà không thay đổi gì
            return $arrayNews;
        }
    }


    public function getNewsTopHotAll($stringNews, int $lenght = 0)
    {
        try {
            $newsTopHot = json_decode($stringNews);
            $listNews = $newsTopHot->block1 ?? [];
            $newsStream = array_splice($listNews, 0, $lenght);

            return $newsStream;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function getNewsTopHotByBoxName($stringNews, string $boxname, int $length)
    {
        try {
            // Giải mã chuỗi JSON thành đối tượng PHP
            $newsTopHot = json_decode($stringNews);

            // Kiểm tra và trả về tin tức theo tên box (news hoặc stream)
            switch ($boxname) {
                case 'news':
                    // Lấy danh sách tin tức từ block1, nếu không có thì trả về mảng rỗng
                    $listNews = $newsTopHot->block1 ?? [];
                    // Cắt mảng $listNews để lấy $length phần tử đầu tiên
                    return array_splice($listNews, 0, $length);

                case 'stream':
                    // Lấy danh sách tin tức từ block2, nếu không có thì trả về mảng rỗng
                    $listNews = $newsTopHot->block2 ?? [];
                    // Cắt mảng $listNews để lấy $length phần tử đầu tiên
                    return array_splice($listNews, 0, $length);

                default:
                    // Nếu tên box không phải 'news' hoặc 'stream', trả về mảng rỗng
                    return [];
            }
        } catch (\Throwable $th) {
            // Nếu có lỗi xảy ra (ví dụ: JSON không hợp lệ), trả về mảng rỗng
            return [];
        }
    }

    public function getNewsRelationByList($listNews, $imgW, $imgH)
    {
        // Kiểm tra nếu danh sách tin tức không rỗng
        if (!empty($listNews)) {
            // Sử dụng array_map để duyệt qua từng tin tức trong danh sách
            $listNews = array_map(function ($item) use ($imgW, $imgH) {
                // Lấy danh sách tin tức liên quan với thông số chiều rộng và chiều cao của ảnh
                $relationNewsList = self::getNewsRelation($item->NewsRelation, $item->NewsId, $imgW, $imgH);

                // Nếu có tin tức liên quan, chỉ lấy tin tức liên quan đầu tiên
                if (!empty($relationNewsList)) {
                    $relationNewsList = array_splice($relationNewsList, 0, 1);
                }

                // Gán tin tức liên quan vào thuộc tính NewsRelation của item
                $item->NewsRelation = $relationNewsList;
                return $item;  // Trả về item đã được cập nhật
            }, $listNews);
        }

        // Trả về danh sách tin tức đã được xử lý
        return $listNews;
    }

    public function binKeyPipeline($arrkey = [])
    {
        // Khởi tạo mảng lưu trữ các khóa Redis
        $keyRedis = [];

        // Kiểm tra nếu $arrkey không rỗng
        if (!empty($arrkey)) {
            // Duyệt qua từng phần tử trong mảng $arrkey
            foreach ($arrkey as $key => $value) {
                // Kiểm tra nếu thuộc tính boxkey không rỗng
                if (!empty($value->boxkey)) {
                    // Duyệt qua từng phần tử trong boxkey
                    foreach ($value->boxkey as $key2 => $item) {
                        // Nếu phần tử không rỗng, thêm vào mảng $keyRedis với khóa là kết hợp của $key và $key2
                        if (!empty($item)) {
                            $keyRedis[$key . ':' . $key2] = $item;
                        }
                    }
                }
            }
        }

        // Trả về mảng các khóa Redis
        return $keyRedis;
    }

    public function formatNewsByArrThumb(array $listNews, array $listItemRemove = [], array $thumbNews = [], int $lenght = 0, bool $noCateNews = false) {
        // Lọc tin tức theo 'NewsId' duy nhất
        $arrNews = collect($listNews)->unique('NewsId')->values()->all();

        // Nếu có các tin tức cần loại bỏ, lọc chúng
        if (!empty($listItemRemove)) {
            $removeIds = collect($listItemRemove)->pluck('NewsId')->all();
            $arrNews = collect($arrNews)->whereNotIn('NewsId', $removeIds)->values()->all();
        }

        // Nếu có tham số $lenght, cắt mảng tin tức lại theo độ dài yêu cầu
        if ($lenght > 0) {
            $arrNews = array_splice($arrNews, 0, $lenght);
        }

        // Nếu không có tin tức, trả về mảng rỗng
        if (empty($arrNews)) {
            return [];
        }

        // Xử lý ảnh thu nhỏ nếu có
        $listFomat = [];
        if (!empty($thumbNews)) {
            // Kiểm tra nhóm cuối cùng và cắt tin tức theo chiều dài ảnh
            foreach ($thumbNews as $key => $value) {
                $newsChunk = array_splice($arrNews, 0, $value->length);

                // Định dạng tin tức với ảnh thu nhỏ nếu có
                if (!empty($value->imgW)) {
                    $listFomat[] = FormatHelpers::formatNews($newsChunk, $value->imgW, $value->imgH);
                } else {
                    // Nếu không có thông tin về ảnh, chỉ lấy tin tức
                    $listFomat[] = $newsChunk;
                }
            }

            // Kết hợp các phần tử đã định dạng lại thành một mảng duy nhất
            $listFomat = collect($listFomat)->collapse()->all();
        } else {
            // Nếu không có ảnh thu nhỏ, chỉ xử lý danh mục tin tức
            $listFomat = $arrNews;
        }

        // Nếu không cần map mục tin tức, trả về danh sách tin tức đã định dạng
        if ($noCateNews) {
            return self::ArrayMapNews($listFomat);
        }

        return $listFomat;
    }

    public function formatNewsWithUrls($newsData,$preUrl,$imgW, $imgH)
    {
        return array_map(function ($item) use ($preUrl,$imgW, $imgH) {
            $item->Url = $preUrl . Str::slug($item->Title ?? '', '-') . '-' . ($item->Id ?? '') . '.htm';
            return $item;
        }, self::formatNewsDefault($newsData, $imgW, $imgW));
    }

    public function prepareDataByZone($zoneConfig, $pipeLineData, $zoneALL, $keyByZone,$listRemove = [])
    {
        $dataByZone = [];
        foreach ($zoneConfig as $key => $value) {
            $isMerge = $value->isMerge ?? false;
            $newsZone = self::formatNewsByArrThumb($isMerge ? array_merge($pipeLineData[$key . ":focus"] ?? [], $pipeLineData[$key . ":onhome"] ?? [])
                    : (!empty($pipeLineData[$key . ":focus"]) ? $pipeLineData[$key . ":focus"] : ($pipeLineData[$key . ":onhome"] ?? [])),
                $listRemove,
                $value->thumb ?? '',
                $value->length ?? 0,
                $value->noCateNews ?? false
            );
            $dataByZone[$key] = [
                'data' => $newsZone,
                'info' => $zoneALL[$key] ?? '',
                'cdKey' => ($keyByZone[$key . ":focus"]['key'] ?? '') . ";" . ($keyByZone[$key . ":onhome"]['key'] ?? ''),
                'cdTop' => $value->length ?? 0,
            ];
        }
        return $dataByZone;
    }

    public function formatBoxData(array $boxData, int $imgW, int $imgH, array $listItemRemove = [], int $lenghtFormatThumb = 0, int $s_imgW = 0, int $s_imgH = 0, int $lenght = 0)
    {
        $box = self::formatDataByEmbedbox($boxData);
        return self::formatNewsDefault($box ?? [], $imgW, $imgH, $listItemRemove, $lenghtFormatThumb, $s_imgW, $s_imgH, $lenght);
    }

    // Parse tag info from Redis data
    public function parseTagInfo($tagData)
    {
        $tagInfo = $tagData ? json_decode($tagData) : null;
        if ($tagInfo && !empty($tagInfo->Cover) && is_string($tagInfo->Cover)) {
            $tagInfo->Cover = json_decode($tagInfo->Cover)->desktop ?? '';
        }
        return $tagInfo;
    }

    // Fetch tag info by slug if Redis data is missing
    public function fetchTagInfoBySlug($tagItemId, $slug)
    {
        $tagsList = self::getTagByNewsId($tagItemId);
        foreach ($tagsList as $item) {
            if (!empty($item->Name) && Str::slug($item->Name, '-') === $slug) {
                return (object)[
                    'Name' => $item->Name,
                    'Url' => $item->Url,
                ];
            }
        }
        return null;
    }
}
