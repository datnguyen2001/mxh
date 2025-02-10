$(function () {
    Detail.init();

    social.init(); //mạng xã hội
    try {
        var iframeObserver = lozad('.lozad-iframe', {
            threshold: 0.1,
            loaded: function (el) {}
        });
        iframeObserver.observe();
    }catch (e) {

    }

    if ($('.refresh-captcha').length > 0) {
        $('.refresh-captcha').on('click', function () {
            $('#imgcaptchaapi').attr('src', pageSettings.DomainUtils + '/get-captcha.htm?v=' + new Date().getTime());
        });
    }
    //popup-comment source
    (runinit = window.runinit || []).push(function () {

        var formatDetail = {
            imgMobile: function (ele) {
                if (ele != null) {
                    var $img = $(ele).find("img");
                    $img.each(function () {
                        if ($(this).attr("data-mobile-url") != null && $(this).attr("src") != $(this).attr("data-mobile-url")) {
                            $(this).attr("src", $(this).attr("data-mobile-url"));
                            $(this).parent('a').attr('href', $(this).attr("data-mobile-url"));
                        }
                    });
                }
            }
        }
        formatDetail.imgMobile('[data-role="content"]');



        customAlert.init();// thay arlert


        $('body').on('click', '.link-source-wrapper .open-pop', function (e) {
            e.preventDefault();
            var $this = $(this);
            if ($this.closest(".link-source-wrapper").find(".link-source-detail").css("display") == "block") {

                $this.closest(".link-source-wrapper").find(".link-source-detail").css("display", "none");
            } else {

                $this.closest(".link-source-wrapper").find(".link-source-detail").css("display", "block");
            }
        });
        $("body").on("click", ".link-source-full", function () {
            var $target = $(this).closest(".link-source-detail").find(".btn-copy-link-source");
            if ($target.hasClass("disable")) {
                $target.removeClass("disable");
                $(this).addClass("active");
                $target.css("opacity", "1");
            } else {
                $target.addClass("disable");
                $(this).removeClass("active");
                $target.css("opacity", "0.2");
            }
        });
        $('body').on('click', '.btn-copy-link-source', function (e) {
            e.preventDefault();
            if ($(this).hasClass("disable")) {
                return false;
            }
            var $this = $(this);
            if (e.target.className == 'btn-copy-link-source' || $(e.target).parent('.btn-copy-link-source').length == 1) {
                var $this = $(this);
                var url = $this.closest('.link-source-wrapper').find('.link-source-full').attr('href');
                $(".link-source-full").html(url);
                if (url != '' && url != 'javascript:;') {
                    copyStringToClipboard(url);
                    $('body').addClass('show-org-link');
                    $this.find('span').text('Link đã copy!');
                    setTimeout(function () {
                        $('body').removeClass('show-org-link');
                        $this.find('span').text('Copy link!');
                    }, 1800);
                }
            } else {
                var url = $(this).attr('href');
                if (url != '' && url != 'javascript:;') {
                    window.open(url, '_blank');
                }
            }
        });
    });
})

var Detail = {
    placeholder: '#ajaxDetailBoxCate',
    init: function () {
        var me = this;

        //init videoautoplay
        if ($('.detail-frame-video .video').length > 0) {
            videoHD.isAd = true;
            videoHD.init(".detail-frame-video .video", {
                type: videoHD.videoType.newsDetail
            });
        }
        //init audio
        initAudioPlayer('#audioplayer .audioplayer', false);


        $('.VCSortableInPreviewMode[type=Audio]').each(function (index,value) {
            initAudioPlayerTransparent(value, false);
        });

        videoHD.isAd = true;
        videoHD.init(".detail-content", {
            type: videoHD.videoType.newsDetail
        });

        if (typeof detailVideo != "undefined"){
            (runinit = window.runinit || []).push(function () {
                var videoHDFocus = videoHD;
                videoHDFocus.init(".vPlayer", {
                    type: videoHD.videoType.zoneVideo,
                });
            });
        }

        if (typeof playeridAudioDetail != "undefined"){
            (runinit = window.runinit || []).push(function () {
                playerInitScript(playeridAudioDetail, {
                    params: paramsAudioDetail,
                    secure: secureTokenAudioDetail,
                });
            });
        }


        fbClient.init();

        // Twitter
        $('.twitter-share:not(.inited)').tweet({
            lang: 'vi',
            url: $('.twitter-share:not(.inited)').attr('data-href'),
            text: $('.twitter-share:not(.inited)').attr('data-title')
        }).addClass('inited');

        // Zalo
        $('.zalo-share:not(.inited)').share({
            appId: "4480473846126001397",
            layout:$('.zalo-share').attr('data-layout'),
            color: "blue",
            customize: "false",
            customize_html: "",
            href: $('.zalo-share:not(.inited)').attr('data-href')
        }).addClass('inited');

        $('.btnZalo:not(.inited)').share({
            appId: "4480473846126001397",
            layout:$(this).attr('data-layout'),
            color: "blue",
            customize: 'true',
            customZaloCom:null,
            customize_html: "<a title=\"Zalo\"><span class=\"ti-zalo\"></span><span></span></a>",
            href: $('.btnZalo:not(.inited)').attr('data-href')
        }).addClass('inited');


        me.initMagazineObj();
        $('.VCSortableInPreviewMode[type="LayoutAlbum"]').addClass('LastestLayoutAlbum');
        SmartAlbumLayout();
        //Chạy khi resize
        var timeoutReload = null;
        $(window).on('resize', function (event) {
            $('.VCSortableInPreviewMode[type=Photo]').attr('style', '');
            $('.VCSortableInPreviewMode[type=LayoutAlbum]').attr('style', '');

            clearTimeout(timeoutReload);
            timeoutReload = setTimeout(function () {
                $('.VCSortableInPreviewMode[type="LayoutAlbum"]').addClass('LastestLayoutAlbum');
                SmartAlbumLayout();
            }, 300);
        });
        me.initLightBox();
        me.initScroll();

        me.initQuiz();

        $('.detail-content').waitForImages(function () {
            ContentGif.init(500);
        });


        $('.VCSortableInPreviewMode[type="360photoemagazine"]').each(function () {
            $(this).removeAttr('style');
            var ifrm = $(this).find('iframe');
            var ratio = 9 / 16;
            $(ifrm).css('height', ($(this).width() * ratio) + 'px');
        });

        //box360
        $('.VCSortableInPreviewMode[type="360photoemagazine"]').each(function () {
            $(this).removeAttr('style');
            var ratio = 9 / 16;
            var ifrm = $(this).find('iframe');

            $(ifrm).css('height', ($(this).width() * ratio) + 'px');
        });

        $(".VCSortableInPreviewMode[type=content]").each(function () {
            var bgColor = $(this).data("back")
                , borderColor = $(this).data("border")
                , textColor = $(this).data("text-color");
            $(this).css({
                'background-color': bgColor,
                'border-color': borderColor,
                'color': textColor
            });
        });

        //set màu viền simplequote
        $('.VCSortableInPreviewMode[type=SimpleQuote]').each(function () {
            var $this = $(this);
            var BorderBottomColor = $this.attr('border-bottom-color');
            var BorderTopColor = $this.attr('border-top-color');
            var BorderLeftColor = $this.attr('border-left-color');
            var BorderRightColor = $this.attr('border-right-color');
            $('.quote', $this).css({
                'border-left-color': BorderLeftColor,
                'border-right-color': BorderRightColor
            });

            $('.custom-border', $this).css({
                'border-top-color': BorderTopColor,
                'border-bottom-color': BorderBottomColor
            });
        });

        if ($(".VCSortableInPreviewMode[type=quizv2]").length > 0) {
            $(function () {
                loadQuizIms_v2();
            });
        }

        //Set jframe yt
        $.each($('.VCSortableInPreviewMode[type="insertembedcode"] iframe[src*="https://www.youtube.com"]'), function (key, val) {
            var $this = $(this);
            $this.height($this.width() * 9 / 16);
        });
    },
    initLightBox: function () {
        var formatLink = '<a href="{0}" data-fancybox="img-lightbox" title="{1}" target="_blank" class="detail-img-lightbox"></a>';

        $('.lightbox-content').each(function (index,value){
            var me = $(this);
            me.parent('a').addClass('detail-img-lightbox');
        });

        $('.VCSortableInPreviewMode[type="photo"] img:not(.lightbox-content)').each(function (index, value) {
            var me = $(this);
            var url = me.attr("data-original");
            var title = me.parents('.VCSortableInPreviewMode').find('.PhotoCMS_Caption').text();
            if (title == null)
                title = '';

            if (typeof (url) == 'undefined') {
                url = me.attr("src");
            }

            var link = String.format(formatLink, url, encodeReplace(title));

            if (me.parent('a:not(.link-callout)').length > 0) {
                me.parent('a:not(.link-callout)').addClass('detail-img-lightbox');
            } else {
                if (me.parent('figure').length > 0) {
                    var parentDiv = me.parent('figure').prepend(link);
                } else {
                    var parentDiv = me.parent('div').prepend(link);
                }
                $(parentDiv).find('a.detail-img-lightbox').append(me);
            }
            me.addClass('lightbox-content');
        });
        $('.VCSortableInPreviewMode[type="photo-grid-album"] img:not(.lightbox-content)').each(function (index, value) {
            var me = $(this);
            var url = me.attr("data-original");
            var title = me.parents('.VCSortableInPreviewMode').find('.PhotoCMS_Caption').text();
            if (title == null)
                title = '';

            if (typeof (url) == 'undefined') {
                url = me.attr("src");
            }

            var link = String.format(formatLink, url, encodeReplace(title));

            if (me.parent('a:not(.link-callout)').length > 0) {
                me.parent('a:not(.link-callout)').addClass('detail-img-lightbox');
            } else {
                if (me.parent('figure').length > 0) {
                    var parentDiv = me.parent('figure').prepend(link);
                } else {
                    var parentDiv = me.parent('div').prepend(link);
                }
                $(parentDiv).find('a.detail-img-lightbox').append(me);
            }
            me.addClass('lightbox-content');
        });

        $('.detail-img-lightbox:not([data-fancybox="img-lightbox"])').each(function (index,value){
            var me = $(this);
            me.attr("data-fancybox","img-lightbox");
        });


        $('.desc_image.slide_content img:not(.lightbox-content)').each(function (index, value) {
            var me = $(this);

            var parent = me.parents('.desc_image.slide_content');

            var url = parent.attr("href");
            var title = parent.find(".ck_legend.caption").html();
            if (title == null)
                title = '';

            if (typeof (url) == 'undefined') {
                url = me.attr("src");
            }

            var link = String.format(formatLink, url, htmlEncode(title));
            var parentDiv = me.parent('td').prepend(link);

            $(parentDiv).find('a').append(me);
            me.addClass('lightbox-content');
        });

        $(".detail-img-lightbox").fancybox({

            padding: 0,

            showNavArrows: true,

            locked: false,

            beforeShow: function () {

                $(".fancybox-overlay").addClass("fancybox-opening");
            },
            onUpdate: function () {
                $(window).scroll(function () {
                    try {
                        $.fancybox.close().transitions();
                    } catch (e) {

                    }
                });
                $(".fancybox-image").on('click', function () {

                    try {
                        $.fancybox.close().transitions();
                    } catch (e) {

                    }

                });

            },
            caption: function (instance, item) {
                var caption = "";
                var description = $(this).next();
                if (typeof description != "undefined" && description.hasClass("des-photo")) {
                    caption = description.html();
                } else {
                    caption = $(this).attr('title') || '';
                }
                return (caption.length ? caption + '<br />' : '');
            },
            // beforeClose: function () {
            //
            //     $(".fancybox-overlay").addClass("fancybox-closing");
            //
            // },
            // afterClose: function () {
            //     parent.location.reload(false);
            // },
            nextEffect: 'none',
            prevEffect: 'none'
        });
    },
    initMagazineObj: function () {
        /*script cho magazine object*/
        $('.VCSortableInPreviewMode[type="LayoutAlbum"] a').addClass('sp-img-zoom');
        $('.VCSortableInPreviewMode[type="photo"] a[target="_blank"]').not('.link-callout').removeAttr('target');
        $(".sp-img-zoom").fancybox({
            padding: 0,
            showNavArrows: true,
            locked: false,
            beforeShow: function () {

                $(".fancybox-overlay").addClass("fancybox-opening");
            },
            onUpdate: function () {
                $(window).scroll(function () {
                    try {
                        $.fancybox.close().transitions();
                    } catch (e) {

                    }
                });
                $(".fancybox-image").on('click', function () {

                    try {
                        $.fancybox.close().transitions();
                    } catch (e) {

                    }

                });

            },
            beforeClose: function () {

                $(".fancybox-overlay").addClass("fancybox-closing");

            },
            caption: function (instance, item) {
                var caption = $(this).attr('title') || '';

                return (caption.length ? caption + '<br />' : '');
            },
            afterClose: function () {
                parent.location.reload(false);
            },
            nextEffect: 'none',
            prevEffect: 'none'
        });
        /*end script cho magazine object*/
    },
    isLoadedStream: false,
    isLoaded: false,
    countpagedetail: 0,
    detailUrl: '',
    initScroll: function () {

    },
    initQuiz: function () {
        if ($(".IMSInteractiveItem").length > 0) {
            var ims = document.createElement("script");
            var s = document.getElementsByTagName("script")[0];
            ims.type = "text/javascript";
            ims.async = true;
            ims.onreadystatechange = ims.onload = function () {
                IMSQuizEmbed.init({
                    nameSpace: appSettings.quizApiNamespace,
                    userName: appSettings.quizApiUserName,
                    getTokenFunction: function (callback) {
                        $.ajax({
                            type: 'POST',
                            url: appSettings.DomainUtils + '/Handlers/Quiz.ashx',
                            dataType: "json",timeout: 5000,
                            success: function (res) {
                                var data = res;
                                if (typeof (data) == 'string') data = JSON.parse(data);
                                callback(data.message.token);
                            }
                        });
                    }
                });
            },
                ims.src = "https://ims.mediacdn.vn/micro/widget/dist/plugins/quiz-embed.js";
            s.parentNode.insertBefore(ims, s);
        }
    },
    loadDetail: function () {
        var me = this;
        if (typeof relatedNewsIds != "undefined" && relatedNewsIds.length > 0) {
            if (me.countpagedetail >= relatedNewsIds.length)
                return;

            //var newsId = relatedNewsIds[me.countpagedetail];
            //if (newsId == '0')
            //    newsId = '164201017090543987'
            var newsUrl = relatedNewsIds[me.countpagedetail];

            //$.get("/news-" + newsId + ".htm", function (data) {
            $.ajax({
                type: "GET",
                dataType: "html",
                url: newsUrl,timeout: 5000,
                data: {
                    isAjax: true
                },
                success: function (data) {
                    var pageHtml = $.parseHTML(data);
                    if ($(pageHtml).find('.detail__article').length > 0) {
                        var checkdata = $(pageHtml).find('.detail__article').html().replace(/^(?=\n)$|^\s*|\s*$|\n\n+/gm, "");
                        if (checkdata !== '' && checkdata.length > 50) {
                            $('#detailOther').append(checkdata);
                            me.detailUrl = newsUrl;
                        }
                    } else {
                        me.loadDetail();
                    }

                    me.countpagedetail++;

                    //me.initScroll();
                    me.isLoaded = false;
                    me.init();
                },
                error: function () {
                    me.loadDetail();
                    me.countpagedetail++;
                }
            });
            //$.get(newsUrl, function (data) {
            //    var pageHtml = $.parseHTML(data);
            //    if ($(pageHtml).find('.detail__article').length > 0) {
            //        var checkdata = $(pageHtml).find('.detail__article').html().replace(/^(?=\n)$|^\s*|\s*$|\n\n+/gm, "");
            //        if (checkdata !== '' && checkdata.length > 50) {
            //            $('#detailOther').append(checkdata);
            //            me.detailUrl = newsUrl;
            //        }
            //    } else {
            //        me.loadDetail();
            //    }

            //    me.countpagedetail++;

            //    //me.initScroll();
            //    me.isLoaded = false;
            //    me.init();
            //});
        }
    }
}




function beforeAfter(ele) {

    if ($(ele).length > 0) {
        function imgCallBack(ele, src, width, height) {
            $(ele).beforeAfter({
                imageWidth: width,
                imageHeight: height
            });
        }

        function imgFlipCallBack(ele, src, width, height) {
            var $flip = $(ele).find(".flipper");
            $flip.height(Math.floor((screen.width * height) / width)).on("click", function () {
                if ($(this).parent().hasClass('rotate'))
                    $(this).parent().removeClass('rotate');
                else
                    $(this).parent().addClass('rotate');

                if (!$(this).parent().find('.tips').hasClass('hide')) {
                    $(this).parent().find('.tips').addClass('hide');
                }
            });
            $(ele).find(".icon").on("click", function () {
                $flip.trigger("click");
            });
        }

        var w, h, container, flipper;
        var $imgBeforeAfter = $(ele);
        $imgBeforeAfter.each(function () {
            if ($(this).hasClass("skin2")) { //skin dạng lật ảnh
                 w = $('[data-role="content"]').width() ;

                h = w*10/16;
                var imgw = w;
                 var imgh = (h + 'px');

                container = $(this);
                container.addClass('flip-container');
                flipper = $(`<div class="flipper" style="height:` + imgh + `"></div>`);
                container.prepend(flipper)
                    .append('<span class="icon"><img src="https://sohanews.sohacdn.com/web_images/full_4_lightDark_30X30.png" /></span>')
                flipper
                    .append(container.find('.front,.back'));

                var h1 = container.find('.front').attr('class', '').addClass('front').height();
                var h2 = container.find('.back').attr('class', '').addClass('back').height();

                //container.height(Math.max(h1, h2)).fadeIn(250);
                GetImageSize(container, container.find(".before-after-img").first().attr("src"), imgFlipCallBack);

                //$(container).on('click',
                //    function() {
                //        if (container.hasClass('rotate'))
                //            container.removeClass('rotate');
                //        else
                //            container.addClass('rotate');

                //        if (!container.find('.tips').hasClass('hide')) {
                //            container.find('.tips').addClass('hide');
                //        }
                //    });
            } else {

                //w = $(this).attr("w");
                w = $('[data-role="content"]')[0].offsetWidth;
                h =w *10/16;
                if (!isNaN(w) || !isNaN(h)) {
                    GetImageSize($(this), $(this).find(".before-after-img").first().attr("src"), imgCallBack);
                } else {
                    $(this).beforeAfter({
                        imageWidth: w,
                        imageHeight: h
                    });
                }
            }
        });
    }
}
function getWidthHeight(url, item, callback) {
    var img = new Image();
    if (url != null && url != "") {
        img.src = url;
        img.onload = function () { callback(this.width, this.height, url, item); }
    }

}
$(document).ready(function () {
    beforeAfter(".before-after");
});
var quickAnswer = {
    siteId: 185,
    pageIndex: 1,
    init: function () {
        me = this;
        me.getlistQA();

        $('#btnSendQA:not(.sending)').on('click', function () {
            me.insertQA();
        });
    },
    getlistQA: function () {
        var me = this;
        var newsid = $('#hdNewsId').val();

        var data = {
            from: me.pageIndex,
            to: 10,
            newsid: newsid,
            siteid: me.siteId,
            status: 1
        }
        $.ajax({
            type: "GET",
            contentType: 'text/plain',
            url: pageSettings.DomainUtils + '/api-getlistqa',
            data: data,timeout: 5000,
            beforeSend: function () {
                $('.detailmaincontent .layout__loading').css("visibility", 'visible');
            },
            success: function (data) {
                if (data.Success) {
                    if (data.Data != null && data.Data.length > 0) {
                        $('#loadlistQA').append(me.buildContentQA(data.Data));
                        if ($("div[data-role=content] .detail-question .detail-a ").length > 0) {
                            videoHD.isAd = true;
                            videoHD.init("div[data-role=content] .detail-question .detail-a ", {
                                type: videoHD.videoType.newsDetail
                            });
                        }
                    } else {
                        $('.detailmaincontent .detail-viewmore').remove();
                    }
                } else {
                    $('.detailmaincontent .detail-viewmore').remove();
                }

                //$('#loadlistQA')
                me.pageIndex++;
                $('.detailmaincontent .layout__loading').css("visibility", 'hidden');
            },
            error: function () {
                $('#btnSendQA').removeClass('sending');
            }
        });
    },
    buildContentQA: function (data) {
        var htmlTemp = '<div class="detail-question">\
                                    <div class="detail-quser">\
                                        <span class="user-name">Câu hỏi</span>\
                                    </div>\
                                    <div class="detail-q">{1}</div>\
                                    <span class="user">\{0}\</span>\{2}\
                          </div>';
        var htmlAswer = '<div class="detail-a">\
                                        <p class="user-name">Trả lời</p>\
                                        <p class="a-content">{1}</p>\
                                    </div>';
        var html = ''
        for (var i = 0; i < data.length; i++) {
            var htmlAs = '';
            var r = data[i];
            if (typeof r.AnsweredBy == "undefined" || r.AnsweredBy == null)
                r.AnsweredBy = '';
            if (r.AnswerContent != null && r.AnswerContent != '') {
                htmlAs = String.format(htmlAswer, r.AnsweredBy, r.AnswerContent)
            }

            html += String.format(htmlTemp, r.FullName, r.QuestContent, htmlAs)
        }

        return html;
    },
    insertQA: function () {
        var me = this;
        var name = $('#txtNameQA').val();
        var email = $('#txtEmailQA').val();
        var content = $('#txtContentQA').val();
        var newsid = $('#hdNewsId').val();
        var captcha = $('#txtcapcha').val();

        if (typeof newsid == 'undefined' || newsid == '') {
            return false;
        }
        if (typeof name == 'undefined' || name == '') {
            customAlert.alert('Bạn chưa nhập họ tên!');
            return false;
        }
        if (typeof email == 'undefined' || email == '') {
            customAlert.alert('Bạn chưa nhập email!')
            return false;
        }
        if (!validateEmail(email)) {
            customAlert.alert('Email sai định dạng!')
            return false;
        }
        if (typeof content == 'undefined' || content == '') {
            customAlert.alert('Bạn chưa nhập nội dung!')
            return false;
        }
        if (typeof captcha == 'undefined' || captcha == '') {
            customAlert.alert('Bạn chưa nhập mã captcha!')
            return false;
        }
        var data = {
            siteid: me.siteId,
            name: name,
            address: '',
            email: email,
            phone: '',
            title: '',
            file: '',
            status: 0,
            content: content,
            newsid: newsid,
            captcha: captcha
        }
        $.ajax({
            type: "POST",
            url: pageSettings.DOMAIN_API_ANSWER + '/api-insertqa',
            data: data,timeout: 5000,
            xhrFields: {
                withCredentials: true
            },
            beforeSend: function () {
                $('#btnSendQA').addClass('sending');
            },
            success: function (res) {
                $('#btnSendQA').removeClass('sending');
                if (res == "True") {
                    customAlert.alert('Câu hỏi của bạn đã được gửi!');
                    $('#txtNameQA').val('');
                    $('#txtEmailQA').val('');
                    $('#txtContentQA').val('');
                    $('.modal').removeClass('show');
                    $('body').removeClass('open-modal');
                    $('#imgcaptchaapi').attr('src', pageSettings.DOMAIN_API_ANSWER + '/get-captcha.htm?v=' + new Date().getTime());
                    $('#txtcapcha').val('');
                } else {
                    if (res == 'Sai captcha') {
                        customAlert.alert('Sai mã captcha!');
                    } else
                        customAlert.alert('Câu hỏi của bạn chưa gửi được, vui lòng thử lại sau!');
                }
            },
            error: function () {
                $('#btnSendQA').removeClass('sending');
            }
        });
    }
}

function SmartAlbumLayout() {
    var $obj = $('.LastestLayoutAlbum .LayoutAlbumRow');
    $obj.each(function () {
        var $pi = $('.LayoutAlbumItem', $(this)),
            cWidth = $(this).parents('.VCSortableInPreviewMode').width() - 10;
        //Tạo 1 mảng chứa toàn bộ ratio của ảnh
        var ratios = $pi.map(function () {
            return $(this).find('img').attr('w') / $(this).find('img').attr('h');
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

function getFbData(from, type, ishide, isformat) {
    var lstSortUrl = '';
    var cnt = 0;
    $(from).find('.item-fb').each(function () {
        var sortUrl = ($(this).attr('rel'));
        if (cnt == 0)
            lstSortUrl += appSettings.domain + sortUrl;
        else
            lstSortUrl += ',' + appSettings.domain + sortUrl;
        cnt++;

    });
    if (cnt < 1) return;
    $.ajax({
        type: "GET",
        dataType: "json",timeout: 5000,
        url: pageSettings.sharefbApiDomain + '/?urls=' + lstSortUrl,
        success: function (msg) {
            $.each(msg, function (index, value) {
                var shortUrl = value.url.replace(appSettings.domain, "");
                ///console.log(shortUrl + " ---- " + value.like_count);
                var o = $(from).find(".item-fb[rel*='" + shortUrl + "']");

                var count = 0;
                switch (type) {
                    case 'like':
                        count = value.like_count;
                        break;
                    case 'share':
                        count = value.share_count;
                        break;
                    case 'total':
                        count = value.total_count;
                        break;
                }

                if (count > 0) {
                    var formatText = (count >= 1000000) ? "0.0a" : "0,0a";
                    var txtCount = (isformat) ? numeral(count).format(formatText).replace(',', '.') : numeral(count).format('0,0').replace(',', '.');
                    o.html(txtCount);
                    o.show();
                }
                else if (ishide) {
                    o.hide();
                }
                o.removeClass('item-fb');
                o.addClass("item-fb-loaded");
            });
        }
    });
}

function loadQuizIms_v2() {
    if (typeof pageSettings.DomainUtils == "undefined")
        pageSettings.DomainUtils = "https://utils3.cnnd.vn";
    var ns=pageSettings.commentSiteName
    var getTokenFunction = function (callback) {
        $.ajax({
            type: 'POST',
            url: pageSettings.DomainUtils + '/quiztk.chn?ns='+ns,
            dataType: "json",timeout: 5000,
            success: function (res) {
                if (typeof (res) == 'string') res = JSON.parse(res);
                var data = res.message;
                if (typeof (data) == 'string') data = JSON.parse(data);
                callback(data.token);
            }
        });
    };
    if ($(".quizplatform-embed").length > 0) {
        QuizPlatform.initPlay({
            getTokenFunction: getTokenFunction
        });
    }
}

function GetImageSize(ele, img, callback) {
    var width, height;
    var imgSrc = img;

    var updateDetail = function () {
        eval(callback(ele, width, height));
    };
    if (img.naturalWidth) {
        width = img.naturalWidth;
        height = img.naturalHeight;
        updateDetail();
    } else {
        // Using an Image Object
        i = new Image();
        i.onload = function () {
            width = this.width;
            height = this.height;
            updateDetail();
        };
        i.src = imgSrc;
    }
}

// chia sẽ mạng xã hội
var social = (function () {
    function init() {
        $(".sendsocial").click(function (e) {
            e.preventDefault();
            var t = "";
            switch ($(this).attr("rel")) {
                case "facebook":
                    t = "https://www.facebook.com/sharer.php?u=" + $(this).attr("data-href") + "&[title]=";
                    break;
                case "fbhome":
                    t = "https://www.facebook.com/sharer.php?u=https://" + window.location.host;
                    break;
                case "twitter":
                    t = "https://twitter.com/share?url=" + $(this).attr("data-href") + "&title=" + encodeURI($(this).attr("data-title"));
                    break;
                case "gplus":
                    t = "https://plus.google.com/share?url=" + $(this).attr("data-href")
            }
            return "" === t || window.open(t, "", "_blank,resizable=yes,width=800,height=450").focus(),
                !1
        }),

            $(".sendmail").attr("href", "mailto:email@domain.com?subject=" + window.encodeURIComponent(document.title) + "&body=" + window.encodeURIComponent(window.location.toString())),
            $(".sendprint").click(function (e) {
                var url = $(this).attr("data-href");
                e.preventDefault(),
                    window.open(url, "_blank", "height=500,width=800,status=yes,location=no,menubar=no,resizable=yes,scrollbars=yes,titlebar=yes,top=50,left=100", !0)
            });
    };
    return {
        init
    }
})(jQuery);
