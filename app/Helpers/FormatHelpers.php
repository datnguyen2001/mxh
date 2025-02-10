<?php

namespace App\Helpers;
use Carbon\Carbon;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class FormatHelpers
{
    public static function formatNews(array $arrayNews, string $imgW, string $imgH)
    {
        if (!empty($arrayNews)) {
            $arrayNews = array_filter($arrayNews);
        }
        foreach ($arrayNews as $value) {
            if (empty($value)) continue;

            // Xử lý Avatar và ảnh đại diện
            if (!empty($value->Avatar) && $value->Avatar != " " && !is_null($value->Avatar) ) {
                $value->ThumbImage = UserInterfaceHelper::formatThumbZoom($value->Avatar, $imgW, $imgH);
                $value->AvatarVertical = !empty($value->Avatar2) ? UserInterfaceHelper::formatThumbZoom($value->Avatar2, $imgW, $imgH) : '';
                $value->AvatarSquare = !empty($value->Avatar5) ? UserInterfaceHelper::formatThumbZoom($value->Avatar5, $imgW, $imgH) : '';

                // Ảnh với video
                if (!empty($value->FileNamePlay)) {
                    $value->ThumbImage = UserInterfaceHelper::formatThumbZoomVideo($value->Avatar, $imgW, $imgH);
                }
            } else {
                $value->ThumbImage = config('siteInfo.default_no_thumb');
            }

            // Xử lý ngày phân phối
            if (!empty($value->DistributionDate)) {
                if (preg_match('/Date.*/', $value->DistributionDate)) {
                    $value->DateTime = '';
                } else {
                    $value->DateTime = self::formatDistributionDate(str_replace(['/Date(', ')/'], '', $value->DistributionDate) ?? '');
                }
            }

            // Cập nhật các thuộc tính nếu chúng không tồn tại
            $value->DateTime = $value->DateTime ?? '';
            $value->Title = $value->Title ?? '';
            $value->Description = $value->Description ?? '';
            $value->NewsId = $value->NewsId ?? '';
            $value->Url = $value->Url ?? '';
            $value->Sapo = $value->Sapo ?? '';
            $value->Name = $value->Name ?? '';
            $value->HtmlCode = $value->HtmlCode ?? '';
            $value->KeyVideo = $value->KeyVideo ?? '';
            $value->FileNamePlay = $value->FileNamePlay ?? '';
            $value->DistributionDate = $value->DistributionDate ?? '';
            $value->Id = $value->Id ?? '';
            $value->Duration = $value->Duration ?? '';
            $value->ZoneId = $value->ZoneId ?? '';
            $value->ZoneName = $value->ZoneName ?? '';
            $value->ZoneUrl = $value->ZoneUrl ?? '';
            $value->NewsType = $value->NewsType ?? '';
            $value->Type = $value->Type ?? '';
            $value->BrandName = $value->BrandName ?? '';
            $value->BrandId = $value->BrandId ?? '';
            $value->BrandUrl = $value->BrandUrl ?? '';
            $value->BrandLogoStream = $value->BrandLogoStream ?? '';
        }

        return $arrayNews;
    }



    public static function formatNewsElasticsearch(array $arrayNews, string $imgW, string $imgH)
    {
        if (empty($arrayNews)) return [];

        $array = array_filter($arrayNews);

        return array_map(function ($value) use ($imgW, $imgH) {
            $value = (object)$value;

            if (!empty($value)) {
                // Format các thuộc tính cần thiết
                $value->ThumbImage = UserInterfaceHelper::formatThumbZoom($value->Avatar, $imgW, $imgH);
                $value->DateTime = self::formatDistributionDate($value->DistributionDate ?? '');

                // Các thuộc tính khác
                $value->Title = $value->Title ?? '';
                $value->Description = $value->Description ?? '';
                $value->NewsId = $value->NewsId ?? '';
                $value->Url = $value->Url ?? '';
                $value->Sapo = $value->Sapo ?? '';
                $value->Name = $value->Name ?? '';
                $value->HtmlCode = $value->HtmlCode ?? '';
                $value->KeyVideo = $value->KeyVideo ?? '';
                $value->FileNamePlay = $value->FileNamePlay ?? '';
                $value->DistributionDate = $value->DistributionDate ?? '';
                $value->Id = $value->Id ?? '';
                $value->Duration = $value->Duration ?? '';
                $value->ZoneId = $value->ZoneId ?? '';
                $value->ZoneName = $value->ZoneName ?? '';
                $value->ZoneUrl = $value->ZoneUrl ?? '';
                $value->NewsType = $value->NewsType ?? '';
                $value->Type = $value->Type ?? '';
                $value->BrandName = $value->BrandName ?? '';
                $value->BrandId = $value->BrandId ?? '';
                $value->BrandUrl = $value->BrandUrl ?? '';
                $value->BrandLogoStream = $value->BrandLogoStream ?? '';
            }

            return $value;
        }, $array);
    }

    public static function formatGetExtentionValue($newsContent, $KeyExtentionType)
    {
        $keyValue = null;
        $valueExtentionValue = '';
        if (!empty($newsContent->ExtentionType)) {
            foreach ($newsContent->ExtentionType as $key => $value) {
                if ($value == $KeyExtentionType) {
                    $keyValue = $key;
                }
            }
            if (!is_null($keyValue)) {
                $valueExtentionValue = $newsContent->ExtentionValue[$keyValue];
            }
        }
        return $valueExtentionValue;
    }

    public static function getSearchOrgUrl(int $originalId, string $title)
    {
        switch ($originalId)
        {
            //Nhịp sống Việt
            case 21:
                return "http://nhipsongviet.toquoc.vn/tim-kiem.htm?keywords=" .$title;
            //Tổ quốc
            case 19:
                return "http://toquoc.vn/tim-kiem.htm?keywords=" .$title;
            //Helino
            case 17:
                return "http://helino.ttvn.vn/search_news.htm?keyword=" .$title;
            //Trí Thức Trẻ
            case 7:
                return "http://ttvn.toquoc.vn/search.htm?keyword=" . $title;
            //Báo dân sinh
            case 18:
                return "http://baodansinh.vn/tim-kiem.htm?search=" .$title;
            //Thế giới trẻ
            case 15:
                return "https://thegioitre.vn/search?q=" . $title;
            //Nhịp sống kinh tế
            case 16:
                return "http://nhipsongkinhte.toquoc.vn/search.htm?keyword=" .$title;
            //Taichinhplus.vn
            case 13:
                return "http://taichinhplus.vn/search?q=" .$title;
            //pháp luật và bạn đọc
            case 26:
                return "https://phapluat.suckhoedoisong.vn/tim-kiem.htm?keyword=" .$title;
            //kinh doanh và phát triển
            case 27:
                return "https://kinhdoanhvaphattrien.vn/?s=".$title;
            case 28:
                return "https://doanhnghieptiepthi.vn/tim-kiem.htm?keyword=" .$title;
            case 33:
                return "https://phunumoi.net.vn/tim-kiem.html?q=" .$title;
            default:
                return "";
        }
    }

    public static function formatDistributionDateDetail($distributionDate)
    {
        Carbon::setLocale('vi');
        $distributionDate = new Carbon($distributionDate);
        $getWeekday = self::getWeekdayVn($distributionDate->format('l'));
        return $getWeekday . ', ' . $distributionDate->format('d/m/Y H:i').' (GMT+7)';
    }

    public static function formatDistributionDate($distributionDate)
    {
        Carbon::setLocale('vi');
        $distributionDate = new Carbon($distributionDate);
        return $distributionDate->format('d/m/Y');
    }

    public static function getWeekdayVn($weekday)
    {
        $weekday = strtolower($weekday);
        switch ($weekday) {
            case 'monday':
                $weekday = 'Thứ hai';
                break;
            case 'tuesday':
                $weekday = 'Thứ ba';
                break;
            case 'wednesday':
                $weekday = 'Thứ tư';
                break;
            case 'thursday':
                $weekday = 'Thứ năm';
                break;
            case 'friday':
                $weekday = 'Thứ sáu';
                break;
            case 'saturday':
                $weekday = 'Thứ bảy';
                break;
            default:
                $weekday = 'Chủ nhật';
                break;
        }
        return $weekday;
    }

    public static function formatGetBigStoryInfoById($array)
    {
        $arrayNews = array_map(function ($item) {
            $string = '';
            foreach ($item->labels as $key => $value) {
                if ($key > 0) {
                    $string .= ',' . $value->code;
                } else {
                    $string .= $value->code;
                }
            }

            $itemNews = (object)null;
            if (!empty($item)) {
                $itemNews->Id = $item->id;
                $itemNews->Title = $item->title;
                $itemNews->Url = $item->url;
                $itemNews->Body = $item->body;
                $itemNews->PublishedDate = date('H:i:s d-m-Y', strtotime($item->published_date));
                $itemNews->IsHighlight = $item->is_highlight;
                $itemNews->Status = $item->status;
                $itemNews->CreatedDate = $item->created_date;
                $itemNews->CreatedBy = $item->created_by;
                $itemNews->TabId = $item->tab_id;
                $itemNews->IsFocus = $item->is_focus;
                $itemNews->Avatar = $item->avatar;
                $itemNews->IsHot = $item->is_hot;
                // $item->LabelId=$item->id;
                $itemNews->ListLabels = $string;

            }
            return $itemNews;
        }, $array);


        return $arrayNews;
    }


    public static function formatNewsContent(object $newsContent)
    {
        $newsContent = (object) $newsContent;

        // Format Title
        if (!empty($newsContent->Title)) {
            $newsContent->Title = preg_replace('~[\r\n]+~', '', $newsContent->Title);
        }

        // Format Body content
        if (!empty($newsContent->Body)) {
            $newsContent->Body = str_replace(['.vcmedia.vn'], ['.mediacdn.vn'], $newsContent->Body);
        }

        // Decode Tag if present
        if (!empty($newsContent->Tag)) {
            $newsContent->Tag = json_decode($newsContent->Tag);
        }

        // Format Distribution DateTime
        if (!empty($newsContent->DistributionDate)) {
            $newsContent->DateTime = self::formatDistributionDateDetail($newsContent->DistributionDate);
        }

        // Format Avatar, Social Share, and OG Image
        $newsContent = self::formatAvatarAttributes($newsContent);

        // Check ads and exclusivity status
        $newsContent = self::checkAdsAndExclusivity($newsContent);

        // Format Source and Origin URL
        $newsContent = self::formatSource($newsContent);

        // Set Meta Title for Facebook
        $newsContent = self::formatMetaFacebook($newsContent);

        // Special content types handling (e.g., Magazine, Video)
        $newsContent = self::formatPostType($newsContent);

        // SEO attributes for follow and index
        $newsContent = self::formatSEO($newsContent);

        // Update images in Body for lazy loading and resizing
        $newsContent->Body = self::updateBodyImages($newsContent->Body);

        return $newsContent;
    }

    private static function formatAvatarAttributes($newsContent)
    {
        // Avatar setup with default handling
        $newsContent->jframeAvartar = self::formatGetExtentionValue($newsContent, 47);
        $AvatarSocial = self::formatGetExtentionValue($newsContent, 48);
        $newsContent->AvatarSocial = !empty($AvatarSocial) ? $AvatarSocial : $newsContent->Avatar;

        // Custom link avatar with gif handling
        $newsContent->OgImage = !empty($newsContent->AvatarSocial) ? $newsContent->AvatarSocial : $newsContent->Avatar;
        $ext = strtolower(pathinfo($newsContent->OgImage, PATHINFO_EXTENSION));
        if ($ext === 'gif') {
            $newsContent->OgImage .= '.png';
        }

        // Check avatar visibility in content
        $newsContent->showAvatar = filter_var(self::formatGetExtentionValue($newsContent, 2410), FILTER_VALIDATE_BOOLEAN);
        return $newsContent;
    }

    private static function checkAdsAndExclusivity($newsContent)
    {
        // Ads and exclusivity handling
        $newsContent->allowAds = FormatHelpers::formatGetExtentionValue($newsContent, 49) != 1;
        $newsContent->exclusivePostOtherSite = self::formatGetExtentionValue($newsContent, 79);
        if (FormatHelpers::formatGetExtentionValue($newsContent, 78) == 1) {
            $newsContent->exclusivePostOther = config('siteInfo.site_path') . $newsContent->Url;
        } else {
            $newsContent->exclusivePostOther = '';
        }
        return $newsContent;
    }

    private static function formatSource($newsContent)
    {
        // Source setup and URL handling
        if ((empty($newsContent->Source) || $newsContent->Source == ' ') && !empty($newsContent->OriginalId)) {
            $Source = config('originalSites.site.' . $newsContent->OriginalId);
            if (!empty($Source)) {
                $newsContent->Source = $Source['name'];
                $newsContent->SourceUrlOrigin = $Source['url'];
            }
            $newsContent->SearchOrgUrl = self::getSearchOrgUrl($newsContent->OriginalId, urlencode(str_replace('&#39;', '', $newsContent->Title)));
        }
        return $newsContent;
    }

    private static function formatMetaFacebook($newsContent)
    {
        // Set Meta title for Facebook
        $metaTitleFacebook = self::formatGetExtentionValue($newsContent, 11003);
        $newsContent->MetaTitleFaceBook = !empty($metaTitleFacebook) ? $metaTitleFacebook : $newsContent->MetaTitle;
        return $newsContent;
    }

    private static function formatPostType($newsContent)
    {
        // Handle different post types (Video, Magazine, Interview, etc.)
        switch ($newsContent->Type) {
            case 13: // Video
                if (is_object(json_decode($newsContent->Avatar3))) {
                    $newsContent->VideoMedia = json_decode($newsContent->Avatar3);
                } else {
                    $newsContent->VideoYoutobe = str_replace('[object Object]', '', $newsContent->Avatar3);
                }
                break;

            case 27: // Magazine
                $newsContent = self::formatMagazinePost($newsContent);
                break;

            case 9: // Interview
                $newsContent->InterviewId = self::formatGetExtentionValue($newsContent, 1);
                break;

            case 11: // LiveMatch
                $newsContent->LiveMatchId = self::formatGetExtentionValue($newsContent, 3);
                break;

            case 10: // RollingNews
                $newsContent->RollingNewsId = self::formatGetExtentionValue($newsContent, 2);
                break;

            case 38: // Audio
                $newsContent->audioIframe = self::formatGetExtentionValue($newsContent, 93);
                break;
        }

        return $newsContent;
    }

    private static function formatMagazinePost($newsContent)
    {
        // Handle Magazine post formatting
        if (!env('SITE_MOBILE')) {
            $newsContent->Avatar = $newsContent->Avatar3 ?? $newsContent->Avatar;
            $newsContent->linkMagazine = self::formatGetExtentionValue($newsContent, 3001) ?? '';
        } else {
            $newsContent->Avatar = $newsContent->Avatar4 ?? $newsContent->Avatar3;
            $newsContent->Body = self::formatGetExtentionValue($newsContent, 3010) ?? $newsContent->Body;
            $newsContent->linkMagazine = self::formatGetExtentionValue($newsContent, 3002) ?? '';
        }

        $newsContent->bgColor = self::formatGetExtentionValue($newsContent, 3006);
        $newsContent->textColor = self::formatGetExtentionValue($newsContent, 3007);
        $newsContent->bgImage = self::formatGetExtentionValue($newsContent, 3008);

        if (!empty(self::formatGetExtentionValue($newsContent, 21061))) {
            $newsContent->VideoCover = json_decode(self::formatGetExtentionValue($newsContent, 21061));
        }

        $newsContent->VideoCoverText = self::formatGetExtentionValue($newsContent, 21062);
        $newsContent->isMagzineZip = self::formatGetExtentionValue($newsContent, 300) ?? 1;

        return $newsContent;
    }

    private static function formatSEO($newsContent)
    {
        // Format SEO attributes for follow and noindex
        $newsContent->allowFollow = filter_var(self::formatGetExtentionValue($newsContent, 105), FILTER_VALIDATE_BOOLEAN);
        $newsContent->allowNoIndex = filter_var(self::formatGetExtentionValue($newsContent, 83), FILTER_VALIDATE_BOOLEAN);
        return $newsContent;
    }

    private static function updateBodyImages($body)
    {
        try {
            $page = HtmlPageCrawler::create($body);
            if ($page->filter('img')) {
                $listImg = $page->filter('img');
                foreach ($listImg as $img) {
                    $img->setAttribute('loading', 'lazy');
                    $alt = $img->getAttribute('alt');
                    if (empty($alt)) {
                        $img->setAttribute('alt', 'img');
                    }

                    $src = $img->getAttribute('src');
                    $width = $img->getAttribute('w');
                    $height = $img->getAttribute('h');
                    if (!empty($width)) {
                        $img->setAttribute('width', $width);
                    }
                    if (!empty($height)) {
                        $img->setAttribute('height', $height);
                    }

                    if (env('SITE_MOBILE') && !empty($src)) {
                        $src = UserInterfaceHelper::formatThumbWidth($src, 480);
                        $img->setAttribute('src', $src);
                    }
                }
            }

            if ($page->filter('iframe')) {
                $listIframe = $page->filter('iframe');
                foreach ($listIframe as $iframe) {
                    $iframe->setAttribute('data-src',$iframe->getAttribute('src'));
                    $iframe->removeAttribute('src'); // Remove the src attribute
                    $existingClass = $iframe->getAttribute('class');
                    $newClass = $existingClass ? $existingClass . ' lozad-iframe' : 'lozad-iframe';
                    $iframe->setAttribute('class', $newClass);
                }
            }

            return $page->saveHTML();
        } catch (\Throwable $th) {
            return $body;
        }
    }



}
