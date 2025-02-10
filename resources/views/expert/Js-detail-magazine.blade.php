

{{--    Check ads không xóa--}}
@if(!empty($newsContent))
    <script>
        var _chkPrLink = {{$newsContent->allowAds==false?'true':'false'}};
    </script>
@endif
<script>
    if (!isNotAllow3rd) {
        loadJsAsync("{{asset('/web_js/20240521/thanhnienviet.base.min.js?').config('siteInfo.ver_css_js')}}", function () { //k doi ver base
            loadJsAsync("{{asset('/web_js/20240521/thanhnienviet.detail.min.js?').config('siteInfo.ver_css_js')}}",function (){

                //Chạy khi resize || js fix lỗi ảnh bị lêch khi crawl
                var timeoutReload = null;
                $(window).on('resize', function (event) {
                    fullWidthPhoto();
                    deflector();
                    clearTimeout(timeoutReload);
                    timeoutReload = setTimeout(function () {
                        $('.VCSortableInPreviewMode[type="LayoutAlbum"]').addClass('LastestLayoutAlbum');
                        SmartAlbumLayout();
                    }, 300);
                });
                $(window).on('load', function (event) {
                    fullWidthPhoto();
                    deflector();
                    clearTimeout(timeoutReload);
                    timeoutReload = setTimeout(function () {
                        $('.VCSortableInPreviewMode[type="LayoutAlbum"]').addClass('LastestLayoutAlbum');
                        SmartAlbumLayout();
                    }, 300);
                });
                //Ảnh có caption lệch 1 bên
                function deflector() {
                    var ww = $(window).width();
                    if (ww < 1640) {
                        $('.VCSortableInPreviewMode .PhotoCMS_Caption.deflector').each(function () {
                            $(this).attr('data-deflector', 'deflector');
                            $(this).removeClass('deflector');
                        });
                    } else {
                        $('.VCSortableInPreviewMode [data-deflector]').each(function () {
                            $(this).addClass('deflector');
                        });
                    }
                }
                function SmartAlbumLayout() {
                    var $obj = $('.LastestLayoutAlbum .LayoutAlbumRow');
                    $obj.each(function () {
                        var $pi = $('.LayoutAlbumItem', $(this));
                        var cWidth = $(this).parents('.VCSortableInPreviewMode').width();

                        //Tạo 1 mảng chứa toàn bộ ratio của ảnh
                        var ratios = $pi.map(function () {
                            return ($(this).find('img').attr('w') || $(this).find('img').width()) / ($(this).find('img').attr('h') || $(this).find('img').height());
                        }).get();

                        //Lấy tổng width
                        var sumRatios = 0, sumMargins = 0,
                            minRatio = Math.min.apply(Math, ratios);
                        for (var i = 0; i < $pi.length; i++) {
                            sumRatios += ratios[i] / minRatio;
                        };

                        $pi.each(function () {
                            sumMargins += parseInt($(this).css('margin-left')) + parseInt($(this).css('margin-right'));
                        });

                        //Tính toán width/ height cần thiết
                        $pi.each(function (i) {
                            var minWidth = (cWidth - sumMargins) / sumRatios;
                            var h = Math.floor(minWidth / minRatio);
                            var w = Math.floor(minWidth / minRatio) * ratios[i];

                            $('img', $(this)).height(h).width(w);
                            $('img', $(this)).css({
                                width: w,
                                height: h
                            });
                        });
                    });
                    $('.LastestLayoutAlbum').removeClass('LastestLayoutAlbum');
                }

                //object full
                function fullWidthPhoto() {
                    var d;
                    var _timgfz = $('body').width() + 'px';
                    $('.VCSortableInPreviewMode.alignJustifyFull').css("width", _timgfz);
                    d = '-' + ($('body').width() - $('.sp-detail').width()) / 2 + 'px';
                    $('.VCSortableInPreviewMode.alignJustifyFull').css("margin-left", d);
                    //console.log(d);
                }

                (runinit = window.runinit || []).push(function () {
                    videoHD.init('.video-cover .videobg-content', {
                        type: videoHD.videoType.videoDetail
                    });
                })
            });


            @if(env('APP_ENV')=='production')
            loadJsAsync("{{asset('https://ims.mediacdn.vn/micro/quiz/sdk/dist/play.js')}}");
            @else
            loadJsAsync("{{asset('https://mic21.cnnd.vn/statics/quiz-sdk/dist/play.js')}}");
            @endif
            loadJsAsync("{{asset('https://sp.zalo.me/plugins/sdk.js')}}");
        });
    }
</script>

