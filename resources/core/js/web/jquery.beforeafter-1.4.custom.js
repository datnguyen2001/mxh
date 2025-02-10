function formatBeforeAfterDate(sDate) {
    if (sDate == null || sDate == '') return '';
    var date = new Date(sDate);
    return 'Tháng ' + (date.getMonth() + 1) + ', ' + date.getFullYear();
}

/*
* Before after light box
* Author: ThanhDT
* CreateDate: 2014-02-15
*/
var beforeAfterLightBox = {
    popupElement: '#beforeAfterLightBox',
    showLightBox: function (options) {
        var defaults =
            {
                title: '',
                introPosition: .5,
                beforeDate: '2014-01-01',
                afterDate: '2014-01-01',
                beforeImg: '',
                afterImg: '',
                width: 800,
                height: 600
            };
        var options = $.extend(defaults, options);

        var me = this;

        $('#before-img', me.popupElement).attr('src', me.getFullImgPath(options.beforeImg));
        $('#after-img', me.popupElement).attr('src', me.getFullImgPath(options.afterImg));

        // Before after navigator
        if (options.beforeDate != null && options.beforeDate != '') {
            $('.nav-date-left', me.popupElement).html(formatBeforeAfterDate(options.beforeDate));
        }
        if (options.afterDate != null && options.afterDate != '') {
            $('.nav-date-right', me.popupElement).html(formatBeforeAfterDate(options.afterDate));
        }
        if (options.beforeDate != null && options.beforeDate != '' && options.afterDate != null && options.afterDate != '') {
            $('.before-after-nav', me.popupElement).show();
        }
        else {
            $('.before-after-nav', me.popupElement).hide();
        }

        $('.before-after-title', me.popupElement).html(options.title);
        me.resize(options.width, options.height);
        $('.before-after-close').click(function () {
            me.closePopup();
        });
        $('#before-after-wrap').click(function () { return false; });
        $(me.popupElement).click(function () { me.closePopup(); });
        //        $(window).resize(function () {
        //            me.resize(me.width, me.height);
        //        });
        $('#before-after-panel').beforeAfter({
            animateIntro: true,
            //imagePath: 'jquery/',
            introDuration: 100,
            linkDisplaySpeed: 500,
            introPosition: options.introPosition,
            showFullLinks: false,
            //title: decodeURIComponent($(this).attr('title')),
            cursor: 'e-resize',
            enableKeyboard: true,
            beforeButton: '.before-after-nav-left',
            afterButton: '.before-after-nav-right',
            //dividerColor: '#947e3c',
            //beforeDate: $(this).attr('before-date'),
            //afterDate: $(this).attr('after-date'),
            imageWidth: options.width,
            imageHeight: options.height
        });
        me.openPopup();
    },
    getFullImgPath: function (imgSrc) {
        var imgSource = imgSrc.replace(/thumb_w\/([0-9]+)\//, '').replace(/thumb_in\/[0-9]+_[0-9]+\//, '').replace(/zoom\/[0-9]+_[0-9]+\//, '');
        return imgSource;
    },
    openPopup: function () {
        $(this.popupElement).fadeIn('slow');
        $('body').addClass('no-scroll');
        //$('#scroll_top').hide();

        $(document).keyup(this.keyUp);
    },
    closePopup: function () {
        $(this.popupElement).fadeOut('slow');
        $('body').removeClass('no-scroll');
        $(document).off('keyup');
        this.reset();
    },
    resize: function (width, height) {
        var minImageWidth = 320;
        var minPhotoContainer = 320;
        var minWindowWidth = 700;
        var minWindowHieght = 400;
        var boxOther = 90;
        var box_album = 70;

        var windowWidth = window.innerWidth - 100;
        var windowHeight = window.innerHeight - 75;

        //windowWidth = (windowWidth < minWindowWidth) ? minWindowWidth : windowWidth;
        //windowHeight = (windowHeight < minWindowHieght) ? minWindowHieght : windowHeight;

        //        var commentWidth = 320;
        //        var marginLeft = 15;
        //        var boxfix = 30;

        //var photoContainerWidth = windowWidth;
        //photoContainerWidth = (photoContainerWidth < minPhotoContainer) ? minPhotoContainer : photoContainerWidth;

        //var imageWidth = photoContainerWidth;
        var imageWidth;
        if (width <= windowWidth) {
            imageWidth = width;
            imageHeight = height;
        }
        else {
            imageWidth = windowWidth;
            imageHeight = parseInt(windowWidth * height / width);
        }

        //        var imageHeight; //= parseInt(imageWidth * height / width);
        //        if (height > windowHeight) {
        //            imageHeight = windowHeight;
        //            imageWidth = parseInt(width * imageHeight / height);
        //        }
        //        else {
        //            imageHeight = parseInt(imageWidth * height / width);
        //        }

        //        if (imageWidth < minImageWidth) {
        //            imageWidth = minImageWidth;
        //            imageHeight = parseInt(imageWidth * height / width);
        //        }

        //        while (imageHeight > windowHeight) {
        //            imageWidth = imageWidth - 10;
        //            imageHeight = parseInt(imageWidth * height / width);
        //        }

        $('.before-after-nav, .before-after-title', this.popupElement).css({ 'width': imageWidth });
        //$('#before-after-wrap').css({ 'width': windowWidth });
        //$('#popup-comment-detail-left .move').hide();
        //$('#before-after-wrap').css('width', photoContainerWidth);

        //        if ($('#popup-comment-detail-left ul').html() != '') {
        //            $('#popup-comment-detail-left, .popup-comment-detail-content').css('height', windowHeight - box_album);
        //        }
        //        else {
        //            $('#popup-comment-detail-left, .popup-comment-detail-content').css('height', windowHeight);
        //        }

        //        $('#popup-comment-detail-left .move').hide();
        //        $('#popup-comment-detail-right').css('height', windowHeight);

        var wWidth = document.documentElement.clientWidth;
        var wHeight = document.documentElement.clientHeight;

        //var popupWidth = $('#before-after-wrap').width();
        //var popupHeight = $('#before-after-wrap').height();

        var _left = (wWidth / 2 - imageWidth / 2 - 10) > 0 ? wWidth / 2 - imageWidth / 2 - 10 : 0;
        $('#before-after-wrap').css({ 'left': _left });
        var _top;
        if (imageHeight < windowHeight) {
            _top = (windowHeight - imageHeight) / 2;
        }
        else {
            _top = 80;
        }
        $('#before-after-wrap').css({ 'top': _top });
        //this.flag = true;

        //$('.popup-comment-detail-content > img').attr('width', imageWidth).attr('height', imageHeight);
        $('#before-img', this.popupElement).attr("width", imageWidth).attr("height", imageHeight);
        $('#after-img', this.popupElement).attr("width", imageWidth).attr("height", imageHeight);
    },
    keyUp: function (e) {
        e.preventDefault();
        if (e.keyCode == 27) { beforeAfterLightBox.closePopup(); }
        if (e.keyCode == 37) { $('#popup-comment-detail-left .prev').click(); }
        if (e.keyCode == 39) { $('#popup-comment-detail-left .next').click(); }
    },
    getImgSize: function (src) {
        var newImg = new Image();
        newImg.src = src;
        p = $(newImg).ready(function () {
            return { width: newImg.width, height: newImg.height };
        });
        return p[0]['width'] + '|' + p[0]['height'];
    },
    reset: function () {
        //$('#before-img', this.popupElement).attr('src', '');
        //$('#after-img', this.popupElement).attr('src', '');
        $("#before-after-panel", this.popupElement).remove();
        $('.before-after-title', this.popupElement).before(
            '<div id="before-after-panel">'
            + '<div class="panel-before"><img id="before-img" class="before-after-img" src=""/></div>'
            + '<div class="panel-after"><img id="after-img" class="before-after-img" src=""/></div>'
            + '</div>');
        $('.nav-date-left', this.popupElement).html('');
        $('.nav-date-right', this.popupElement).html('');
        $('.before-after-title', this.popupElement).html('');
    }
};

(function ($) {
    $.fn.extend({
        beforeAfter: function (options) {
            return this.each(function () {
                var obj = $(this);

                var position_percent = obj.attr('position-percent');
                position_percent = position_percent / 100;

                var beforeImage = obj.find('.panel-before .before-after-img');
                var afterImage = obj.find('.panel-after .before-after-img');

                //console.log(beforeImage);
                var w = $('[data-role="content"]').width();
                var h = w*10/16;
                if (typeof (options.imageWidth) != "undefined") w = options.imageWidth;
                if (typeof (options.imageHeight) != "undefined") h = options.imageHeight;

                //Set full body width
                w=$('[data-role="content"]').width();
                if (typeof (w) == "undefined")  w = obj.attr('w');
                h= w*10/16;
                obj.css('width', '100%');
                var widthBeforeImage = w;
                obj.attr('w',w);
                var heightBeforeImage = h;
                obj.attr('h',h);
                obj.find('.panel-before').hide();
                obj.find('.panel-after').hide();
                //Set full body width

                var html = "<div class='spdc-img-wrapper normal text-center' style='width: " + widthBeforeImage + "px; margin: 0 auto;'>";
                html += "<div class='twentytwenty-container'>";
                html += "       <div>";
                html += "           <img alt='before' style='width: " + widthBeforeImage + "px; height: " + heightBeforeImage + "px' src='" + obj.find('.panel-before .before-after-img').attr('src') + "' />";
                html += "       </div>";
                html += "       <div>";
                html += "           <img alt='after' style='width: " + widthBeforeImage + "px; height: " + heightBeforeImage + "px' src='" + obj.find('.panel-after .before-after-img').attr('src') + "' />";
                html += "       </div>";
                html += "</div></div>";

                obj.prepend(html);

                obj.find('.twentytwenty-container').twentytwenty({ default_offset_pct: position_percent, move_slider_on_hover: true });
            });
        }
    });
})(jQuery);
