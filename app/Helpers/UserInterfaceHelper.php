<?php

namespace App\Helpers;

use  Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Exception;

class UserInterfaceHelper
{

    public static function formatThumbZoom($imgPath, $imgW, $imgH)
    {
        if (empty($imgPath) || $imgPath == " " || is_null($imgPath)) {
            return config('siteInfo.default_no_thumb');
        }

        // Check if URL pattern matches
        if (preg_match('%^(http(s)?://.[^\/]+)(.*$)%', $imgPath, $regs)) {
            // Define list of valid domains
            $validDomains = [
                'https://videothumbs.mediacdn.vn',
                'http://videothumbs.mediacdn.vn',
                'https://video-thumbs.vcmedia.vn',
                'http://video-thumbs.mediacdn.vn',
                'http://video-thumbs.vcmedia.vn'
            ];

            // Handle specific video thumbnail domains
            if (in_array($regs[1], $validDomains)) {
                $url = str_replace( $validDomains , 'https://videothumbs.mediacdn.vn', $regs[1]) . '/zoom/' . $imgW . '_' . $imgH . $regs[3];
            }
            // Handle the channel.mediacdn.vn domain
            elseif ($regs[1] == 'https://channel.mediacdn.vn') {
                $url = $imgPath;
            }
            // Handle other URLs
            else {
                $url = env('THUMB_DOMAIN') . '/zoom/' . $imgW . '_' . $imgH . $regs[3];
                if (preg_match('%thumb_w/([0-9]+)/(.*$)%', $imgPath, $regs)) {
                    $url = env('THUMB_DOMAIN') . '/zoom/' . $imgW . '_' . $imgH . '/' . $regs[2];
                }
            }
        } else {
            // Handle non-URL paths
            $url = env('THUMB_DOMAIN') . '/zoom/' . $imgW . '_' . $imgH . '/' . $imgPath;
            if (preg_match('%^thumb_w/([0-9]+)/(.*$)%', $imgPath, $regs)) {
                $url = env('THUMB_DOMAIN') . '/zoom/' . $imgW . '_' . $imgH . '/' . $regs[2];
            }
        }

        return $url;
    }

    public static function formatThumbZoomVideo($imgPath, $imgW, $imgH)
    {
        if (empty($imgPath) || $imgPath == " " || is_null($imgPath)) {
            return config('siteInfo.default_no_thumb');
        }

        // Define valid video thumbnail domains
        $validDomains = [
            'https://videothumbs.mediacdn.vn',
            'http://videothumbs.mediacdn.vn',
            'https://video-thumbs.vcmedia.vn',
            'http://video-thumbs.mediacdn.vn',
            'http://video-thumbs.vcmedia.vn'
        ];

        // Check if the path matches a URL
        if (preg_match('%^(http(s)?://.[^\/]+)(.*$)%', $imgPath, $regs)) {
            // Handle specific video thumbnail domains
            if (in_array($regs[1], $validDomains)) {
                $url = str_replace(
                        $validDomains,
                        'https://videothumbs.mediacdn.vn',
                        $regs[1]
                    ) . '/zoom/' . $imgW . '_' . $imgH . $regs[3];
            } else {
                // Default case for other URLs
                $url = env('THUMB_DOMAIN') . '/zoom/' . $imgW . '_' . $imgH . $regs[3];
            }
        } else {
            // Handle non-URL paths
            $url = env('THUMB_DOMAIN') . '/zoom/' . $imgW . '_' . $imgH . $imgPath;
        }

        return $url;
    }

    public static function formatThumbWidth($imgPath, $imgW)
    {
        // Return default thumb if path is empty
        if (empty($imgPath)) {
            return config('siteInfo.default_no_thumb');
        }

        // Ensure the image path doesn't start with a '/'
        $imgPath = ltrim($imgPath, '/');

        // Check if the path is a valid URL
        if (preg_match('%^(http(s)?://.[^\/]+)(.*$)%', $imgPath, $regs)) {
            // Handle URLs with a specific thumb path
            if (preg_match('%thumb_w/([0-9]+)/(.*$)%', $regs[3], $regs2)) {
                $url = env('THUMB_DOMAIN') . '/thumb_w/' . $imgW  . '/' . $regs2[2];
            } else {
                $url = env('THUMB_DOMAIN') . '/thumb_w/' . $imgW . '/' . $regs[3];
            }
        } else {
            // Handle non-URL paths
            if (preg_match('%thumb_w/([0-9]+)/(.*$)%', $imgPath, $regs2)) {
                $url = env('THUMB_DOMAIN') . '/thumb_w/' . $imgW  . '/' . $regs2[2];
            } else {
                $url = env('THUMB_DOMAIN') . '/thumb_w/' . $imgW . '/' . $imgPath;
            }
        }

        return $url;
    }


    public static function formatThumbDomain($imgPath)
    {
        // Check if imgPath is a valid URL starting with http(s)
        if (preg_match('%^(http(s)?://[^/]+)(/.*)?$%', $imgPath, $regs)) {
            // Convert http to https if needed
            $url = str_replace('http://', 'https://', $regs[1]) . ($regs[3] ?? '');
        } else {
            // If it's not a valid URL, prepend the base thumb domain
            $url = env('THUMB_DOMAIN') . '/' . ltrim($imgPath, '/');
        }
        return $url;
    }

    public static function formatThumbMagazine($path, $size, $nocrop)
    {
        // Get the base thumb domain once
        $thumbDomain = env('THUMB_DOMAIN');

        // Check if the path is a full URL
        if (preg_match('%^(http(s)?://[^/]+)(.*$)%', $path, $regs)) {
            // If 'nocrop' is set to 1, return the path without cropping
            if ($nocrop == 1) {
                $url = ($regs[1] == 'https://channel.mediacdn.vn') ? $path : $thumbDomain . '/' . $regs[3];
            } else {
                // Apply zoom with size if 'nocrop' is not set
                $url = $thumbDomain . '/zoom/' . $size . '/' . $regs[3];
            }
        } else {
            // Handle non-URL paths
            if ($nocrop == 1) {
                $url = $thumbDomain . '/' . $path;
            } else {
                $url = $thumbDomain . '/zoom/' . $size . '/' . $path;
            }
        }

        return $url;
    }

    public static function formatAddDomainVid($fileName)
    {
        if (preg_match('%^(http(s)?://.*/)(.*$)%', $fileName, $regs)) {
            return $regs[1] . $regs[3];
        }
        return env('NAME_SPACE') . '/' . $fileName;
    }

    public static function sprintfmailto($domain, $title, $url, $sapo)
    {
        // Mã hóa các tham số để tránh lỗi trong URL
        $encodedTitle = urlencode($title);
        $encodedUrl = urlencode($url);
        $encodedSapo = urlencode($sapo);

        // Sử dụng sprintf với các tham số đã mã hóa
        $string = "mailto:?&subject=['" . $domain . "']%s&body=%s0D0A%s";
        return sprintf($string, $encodedTitle, $encodedUrl, $encodedSapo);
    }


    public static function showUrlCategory($shortUrl)
    {
        return '/' . $shortUrl . '.' . env('CAT_FILENAME','htm');
    }

    public static function showUrlTag($short_url)
    {
        return '/' . $short_url . '.' . env('TAG_FILENAME','html');
    }

    public static function showUrlNews($slug,$NewsId){

        return "/$slug-$NewsId." . env('DETAIL_FILENAME','htm');
    }

    public static function showUrlDsk($short_url,$threadId)
    {
        return '/su-kien/' . $short_url . '-' . $threadId . '.' . env('CAT_FILENAME','htm');
    }

    public static function showUrlAuthor($authorName, $authorId){

        return "/author/$authorName-$authorId." . env('CAT_FILENAME','htm');
    }
    public static function showUrlTopic($topicName, $topicId){

        return "/chu-de/$topicName-$topicId." . env('CAT_FILENAME','htm');
    }

    public static function mb_ucfirst($string, $encoding)
    {
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }

    public static function getPagination($currentPage, $totalPage, $shortUrlCategory, $param = null, $fileName = null)
    {
        $pagination = [$currentPage];
        $paginationHtml = ['<a href="#" class="number active">' . $currentPage . '</a>'];

        // Tạo các trang xung quanh trang hiện tại
        while (count($pagination) < 5) {
            $left = $pagination[0] - 1;
            $right = $pagination[count($pagination) - 1] + 1;
            $added = false;

            if ($left > 0) {
                array_unshift($pagination, $left);
                $shortUrl = $shortUrlCategory . '/trang-' . $left . '.' . $fileName . $param;
                $html = '<a class="number" href="/' . $shortUrl . '">' . $left . '</a>';
                array_unshift($paginationHtml, $html);
                $added = true;
            }

            if ($right <= $totalPage) {
                array_push($pagination, $right);
                $shortUrl = $shortUrlCategory . '/trang-' . $right . '.' . $fileName . $param;
                $Html = '<a class="number" href="/' . $shortUrl . '">' . $right . '</a>';
                array_push($paginationHtml, $Html);
                $added = true;
            }

            if (!$added) {
                break;
            }
        }

        // Nút Previous
        if ($pagination[0] != $currentPage) {
            if ($currentPage > 1 && $totalPage > 1) {
                $shortUrl = $shortUrlCategory . '/trang-' . ($currentPage - 1) . '.' . $fileName . $param;
                $prev = '<a href="/' . $shortUrl . '" class="pagination-arrow pagination-back click-prev">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.41 16.09L10.83 11.5L15.41 6.91L14 5.5L8 11.5L14 17.5L15.41 16.09Z" fill="#3D4043"></path>
                        </svg>
                    </a>';
            }
            // Đặt vào đúng vị trí
            array_unshift($paginationHtml, '<div class="list-action">' . $prev);
        } else {
            $prev = '<a href="javascript:;" class="pagination-arrow pagination-back click-prev disabled">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.41 16.09L10.83 11.5L15.41 6.91L14 5.5L8 11.5L14 17.5L15.41 16.09Z" fill="#3D4043"></path>
                    </svg>
                 </a>';
            array_unshift($paginationHtml, '<div class="list-action">' . $prev);
        }

        // Nút Next
        if ($pagination[count($pagination) - 1] != $currentPage) {
            if ($currentPage < $totalPage && $totalPage > 1) {
                $next = '</div> <a href="/' . $shortUrlCategory . '/trang-' . ($currentPage + 1) . '.' . $fileName . $param . '" class="pagination-arrow pagination-next click-next">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.59 16.09L13.17 11.5L8.59 6.91L10 5.5L16 11.5L10 17.5L8.59 16.09Z" fill="#3D4043"></path>
                        </svg>
                    </a>';
                array_push($paginationHtml, $next);
            }
        } else {
            $next = '</div> <a href="javascript:;" class="pagination-arrow pagination-next click-next disabled">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.59 16.09L13.17 11.5L8.59 6.91L10 5.5L16 11.5L10 17.5L8.59 16.09Z" fill="#3D4043"></path>
                    </svg>
                 </a>';
            array_push($paginationHtml, $next);
        }

        // Kết nối lại tất cả phần tử của paginationHtml thành một chuỗi HTML duy nhất
        $html = '';
        foreach ($paginationHtml as $value) {
            $html .= $value;
        }

        return $html;
    }

    public static function getLastModifiedDate($string)
    {
        // Kiểm tra xem chuỗi có chứa phần tử 'hidLastModifiedDate' không
        $isLastModifiedDate = preg_match("%(.*)(<input type='hidden' name='hidLastModifiedDate' id='hidLastModifiedDate' value='(.*)' /><input type='hidden' name='hdCommentDomain' id='hdCommentDomain' value='' />)(.*)%", $string, $regs);

        // Mặc định, ngày sửa đổi là ngày hiện tại
        $lastModifiedDate = date('d/m/Y H:i:s');
        $dayAgo = Carbon::parse('now -1 day')->timestamp;  // Thời gian 1 ngày trước
        $dayAgo4 = Carbon::parse('now -4 days')->timestamp;  // Thời gian 4 ngày trước
        $expire = 900;  // Mặc định expire là 900 giây (15 phút)
        $lastModifiedDateNews = 0;  // Biến lưu trữ thời gian sửa đổi

        // Nếu tìm thấy ngày sửa đổi từ input hidden
        if ($isLastModifiedDate) {
            try {
                // Nếu chuỗi ngày tháng không rỗng
                if (!empty($regs[3])) {
                    // Thử chuyển đổi chuỗi ngày tháng thành timestamp
                    $parsedDate = strtotime($regs[3]);
                    if ($parsedDate !== false) {
                        // Nếu chuyển đổi thành công, cập nhật ngày sửa đổi
                        $lastModifiedDateNews = $parsedDate;
                        $lastModifiedDate = date('d/m/Y H:i:s', $lastModifiedDateNews);
                    } else {
                        // Nếu không chuyển đổi được, giữ giá trị mặc định cho ngày sửa đổi
                        $lastModifiedDateNews = 0;
                    }
                }
            } catch (\Throwable $th) {
                // Trong trường hợp gặp lỗi, giữ giá trị mặc định
                $lastModifiedDateNews = 0;
                $lastModifiedDate = date('d/m/Y H:i:s');
            }
        }

        // Kiểm tra xem ngày sửa đổi có thuộc 1 ngày trước không để xác định expire
        if ($dayAgo < $lastModifiedDateNews) {
            $expire = 86400;  // Nếu ngày sửa đổi mới hơn 1 ngày, thiết lập expire thành 86400 giây (24 giờ)
        }

        // Kiểm tra cache Redis, nếu ngày sửa đổi cũ hơn 4 ngày thì không lưu vào Redis
        $isCacheRedis = true;
        if ($dayAgo4 > $lastModifiedDateNews) {
            $isCacheRedis = false;
        }

        return [
            'lastModifiedDate' => $lastModifiedDate,
            'expire' => $expire,
            'isCacheRedis' => $isCacheRedis
        ];
    }


}
