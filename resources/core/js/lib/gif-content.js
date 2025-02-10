var ContentGif = {
    divElement: '.detail__content',
    imgSr: 'cnnd.mediacdn.vn',
    isload: false,
    init: function (width) {
        var me = this;
        var cnt = 1;

        /* anh GIF voi IMS mới*/
        var $imgClick = $(me.divElement).find('div.GifPhoto img[src*="' + me.imgSr + '"]:not(.before-after-img):not(.gif-content):not(.gif-animated)');
        $imgClick.each(function (index, value) {
            var srcImg = $(value).attr('src');
            var srcgif = $(value).attr('src');
            if (typeof srcgif != 'undefined') {
                $(value).addClass('gif-content');

                var extension = srcImg.substr((srcImg.lastIndexOf('.') + 1));
                if ((extension == 'gif' || extension == 'GIF')) {
                    $(this).wrap('<div class="wrapt-gif" id="wrapt-gif-' + cnt + '" showgif="0" style="width:100%;"></div>');
                    $(this).attr("src", $(this).attr('src') + ".png").attr('width', '100%');
                    //if (me.isload) {/*ky-edit*/
                    $(value).after('<img src="' + srcgif + '" style="display:none;width:100%;" class="gif-animated" loop="infinite" />');
                    //}
                    $(value).after('<div class="gif-notify pause"><span class="icon-for-gif"></span></div>');
                    cnt++;
                }
            }
        });

        if (cnt == 1) {
            /* anh GIF định dạng cũ*/
            var $imgClickOld = $(me.divElement).find('img[src*="' + me.imgSr + '"]:not(.before-after-img):not(.gif-content):not(.gif-animated)');
            $imgClickOld.each(function (index, value) {
                var srcImg = $(value).attr('src');
                var srcgif = $(value).attr('srcgif');
                if (typeof srcgif != 'undefined') {
                    $(value).addClass('gif-content');

                    var extension = srcImg.substr((srcImg.lastIndexOf('.') + 1));
                    if ((extension == 'gif' || extension == 'GIF')) {
                        $(this).wrap('<div class="wrapt-gif" id="wrapt-gif-' + cnt + '" showgif="0" style="width:' + width + 'px;"></div>');
                        $(value).after('<img src="' + srcgif + '" style="display:none;width:' + width + 'px;" class="gif-animated" loop="infinite" />');
                        $(value).after('<div class="gif-notify pause"><span class="icon-for-gif"></span></div>');
                        cnt++;
                    }
                }
            });
        }

        //// AnhDP: set lại width cho caption
        //$('.GifPhoto p').each(function (index, value) {
        //    $(this).width(width-20);
        //});

        /* them tinh nang scroll show hide cho anh GIF*/
        var $animation_elements_in = $('.wrapt-gif');
        var $window = $(window);
        function check_if_in_view() {
            var window_height = $window.height();
            var window_top_position = $window.scrollTop();
            var window_bottom_position = (window_top_position + window_height);

            $.each($animation_elements_in, function () {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var limitTop = element_top_position + (element_height / 3);
                var limitBottom = (element_top_position + (element_height / 3 * 2)) + 50;

                var srcjpg = $element.find('img[class*="gif-content"]');
                var srcgif = $element.find('img[class*="gif-animated"]');

                //check to see if this current container is within viewport
                if ((limitBottom >= window_top_position + 100) && (limitTop <= window_bottom_position)) {
                    //play
                    $(srcjpg).css('width', '100%');

                    if (srcgif.length === 0) {
                        $element.append('<img src="' + $element.find('img[class*="gif-content"]').attr('rel') + '" style="display:block;width:100%;" class="gif-animated" loop="infinite" />');
                        srcjpg = $element.find('img[class*="gif-content"]');
                    }

                    if ($element.attr('showgif') == 0) {
                        $(srcgif).css('display', 'block');
                        $(srcjpg).css('display', 'none');
                        $element.attr('showgif', 1);
                        $element.parent().find('div.gif-notify').removeClass('pause').addClass('play');
                        $element.parent().find('div.gif-notify').html('GIF');
                    }
                }
                else {
                    //pause
                    if ($element.attr('showgif') == 1) {
                        $(srcgif).css('display', 'none');
                        $(srcjpg).css('display', 'block');
                        $element.attr('showgif', 0);
                        $element.parent().find('div.gif-notify').removeClass('play').addClass('pause');
                        $element.parent().find('div.gif-notify').html('<span class="icon-for-gif"></span>');
                    }
                }
            });
        }
        $window.on('scroll resize', check_if_in_view);
        $window.trigger('scroll');

        ////check có gif light box không?
        //var $divs1 = $('.light-box-content').find(me.divElement + ' div[class*="wrapt-gif"]');
        //if ($divs1.length > 0) {
        //    $('.light-box-content').scroll(function () {
        //        var scroll = $(this).scrollTop();
        //        $divs1.each(function (index, value) {
        //            if (index == 3 || index == 0) {
        //            var top = $(value).offset().top;

        //            var srcjpg = $(value).find('img[class*="gif-content"]');
        //            var srcgif = $(value).find('img[class*="gif-animated"]');
        //            var imgH = $(value).height();
        //            var limitTop = (scroll + $('.light-box-content').height() - (imgH / 3));
        //            var litmitBottom = top + ((imgH / 3) * 2);

        //            if ((top < limitTop) && (litmitBottom > scroll)) {                        
        //                $(srcjpg).css('width', width + 'px');

        //                if (srcgif.length === 0) {
        //                    $(value).append('<img src="' + $(value).find('img[class*="gif-content"]').attr('rel') + '" style="display:block;width:' + width + 'px;" class="gif-animated" loop="infinite" />');
        //                    srcjpg = $(value).find('img[class*="gif-content"]');
        //                }

        //                if ($(value).attr('showgif') == 0) {
        //                    $(srcgif).css('display', 'block');
        //                    $(srcjpg).css('display', 'none');
        //                    $(value).attr('showgif', 1);
        //                    $(value).parent().find('div.gif-notify').removeClass('pause').addClass('play');
        //                    $(value).parent().find('div.gif-notify').html('GIF');
        //                }
        //            }
        //            else {
        //                if ($(value).attr('showgif') == 1) {
        //                    $(srcgif).css('display', 'none');
        //                    $(srcjpg).css('display', 'block');
        //                    $(value).attr('showgif', 0);
        //                    $(value).parent().find('div.gif-notify').removeClass('play').addClass('pause');
        //                    $(value).parent().find('div.gif-notify').html('<span class="icon-for-gif"></span>');
        //                }
        //            }
        //            }
        //        });
        //    });
        //}
    }
};