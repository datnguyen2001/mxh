$(function () {
    Detail.init();
    try {
        var iframeObserver = lozad('.lozad-iframe', {
            threshold: 0.1,
            loaded: function (el) {}
        });
        iframeObserver.observe();
    }catch (e) {

    }

    social.init(); //mạng xã hội


    if ($('.refresh-captcha').length > 0) {
        $('.refresh-captcha').on('click', function () {
            $('#imgcaptchaapi').attr('src', pageSettings.DomainUtils + '/get-captcha.htm?v=' + new Date().getTime());
        });
    }

    //popup-comment source
    (runinit = window.runinit || []).push(function () {

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

        spnBeforeAfter.init();
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


        //timeLine.checkPage = 'detail';
        //timeLine.init();
        //timeLine.loadManual();

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
            // afterClose: function () {
            //     parent.location.reload(false);
            // },
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
var DetailPopup = {
    placeholder: '#ajaxDetailBoxCate',
    init: function () {
        var me = this;

        //init videoautoplay
        if ($('.container_detail_popup .detail-frame-video .video').length > 0) {
            videoHD.isAd = true;
            videoHD.init(".detail-frame-video .video", {
                type: videoHD.videoType.newsDetail
            });
        }

        //init audio
        initAudioPlayer('.container_detail_popup #audioplayer .audioplayer', false);


        //them mới

        $('.container_detail_popup .VCSortableInPreviewMode[type=Audio]').each(function (index,value) {
            initAudioPlayerTransparent(value, false);
        });

        fbClient.init();

        // Twitter
        $('.container_detail_popup .twitter-share:not(.inited)').tweet({
            lang: 'vi',
            url: $('.container_detail_popup .twitter-share:not(.inited)').attr('data-href'),
            text: $('.container_detail_popup .twitter-share:not(.inited)').attr('data-title')
        }).addClass('inited');

        // Zalo
        $('.container_detail_popup .zalo-share:not(.inited)').share({
            appId: "4480473846126001397",
            layout:$('.zalo-share').attr('data-layout'),
            color: "blue",
            customize: "false",
            customize_html: "",
            href: $('.container_detail_popup .zalo-share:not(.inited)').attr('data-href')
        }).addClass('inited');

        $('.container_detail_popup .btnZalo:not(.inited)').share({
            appId: "4480473846126001397",
            layout:$(this).attr('data-layout'),
            color: "blue",
            customize: 'true',
            customZaloCom:null,
            customize_html: "<a title=\"Zalo\"><span class=\"ti-zalo\"></span><span></span></a>",
            href: $('.container_detail_popup .btnZalo:not(.inited)').attr('data-href')
        }).addClass('inited');

        videoHD.isAd = true;
        videoHD.init(".container_detail_popup .detail-content", {
            type: videoHD.videoType.newsDetail
        });
        spnBeforeAfter.init();
        me.initMagazineObj();
        $('.container_detail_popup .VCSortableInPreviewMode[type="LayoutAlbum"]').addClass('LastestLayoutAlbum');
        SmartAlbumLayout();
        //Chạy khi resize
        var timeoutReload = null;
        $(window).on('resize', function (event) {
            $('.container_detail_popup .VCSortableInPreviewMode[type=Photo]').attr('style', '');
            $('.container_detail_popup .VCSortableInPreviewMode[type=LayoutAlbum]').attr('style', '');

            clearTimeout(timeoutReload);
            timeoutReload = setTimeout(function () {
                $('.container_detail_popup .VCSortableInPreviewMode[type="LayoutAlbum"]').addClass('LastestLayoutAlbum');
                SmartAlbumLayout();
            }, 300);
        });
        me.initLightBox();
        me.initScroll();


        //timeLine.checkPage = 'detail';
        //timeLine.init();
        //timeLine.loadManual();

        me.initQuiz();

        $('.container_detail_popup .detail-content').waitForImages(function () {
            ContentGif.init(500);
        });


        $('.container_detail_popup .VCSortableInPreviewMode[type="360photoemagazine"]').each(function () {
            $(this).removeAttr('style');
            var ifrm = $(this).find('iframe');
            var ratio = 9 / 16;
            $(ifrm).css('height', ($(this).width() * ratio) + 'px');
        });

        //box360
        $('.container_detail_popup .VCSortableInPreviewMode[type="360photoemagazine"]').each(function () {
            $(this).removeAttr('style');
            var ratio = 9 / 16;
            var ifrm = $(this).find('iframe');

            $(ifrm).css('height', ($(this).width() * ratio) + 'px');
        });

        $(".container_detail_popup .VCSortableInPreviewMode[type=content]").each(function () {
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
        $('.container_detail_popup .VCSortableInPreviewMode[type=SimpleQuote]').each(function () {
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

        if ($(".container_detail_popup .VCSortableInPreviewMode[type=quizv2]").length > 0) {
            $(function () {
                loadQuizIms_v2();
            });
        }

        if ($(".container_detail_popup .VCSortableInPreviewMode")) {
            loadJsAsync("https://adminplayer.sohatv.vn/resource/init-script/playerInitScript.js", function () {
                videoHD.isAd = true;
                videoHD.init(".video", {
                    type: videoHD.videoType.newsDetail
                });
            });
        }

    },
    initLightBox: function () {
        var formatLink = '<a href="{0}" data-fancybox="img-lightbox" title="{1}" target="_blank" class="detail-img-lightbox"></a>';

        $('.container_detail_popup .lightbox-content').each(function (index,value){
            var me = $(this);
            me.parent('a').addClass('detail-img-lightbox');
        });

        $('.container_detail_popup .VCSortableInPreviewMode[type="photo"] img:not(.lightbox-content),.container_detail_popup .VCSortableInPreviewMode[type="photo-grid-album"] img:not(.lightbox-content)').each(function (index, value) {
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

        $('.container_detail_popup .detail-img-lightbox:not([data-fancybox="img-lightbox"])').each(function (index,value){
            var me = $(this);
            me.attr("data-fancybox","img-lightbox");
        });


        $('.container_detail_popup .desc_image.slide_content img:not(.lightbox-content)').each(function (index, value) {
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

        $(".container_detail_popup .detail-img-lightbox").fancybox({

            padding: 0,

            showNavArrows: true,

            locked: false,

            beforeShow: function () {

                $(".container_detail_popup .fancybox-overlay").addClass("fancybox-opening");
            },
            onUpdate: function () {
                $(window).scroll(function () {
                    try {
                        $.fancybox.close().transitions();
                    } catch (e) {

                    }
                });
                $(".container_detail_popup .fancybox-image").on('click', function () {

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
            beforeClose: function () {

                $(".container_detail_popup .fancybox-overlay").addClass("fancybox-closing");

            },
            nextEffect: 'none',
            prevEffect: 'none'
        });
    },
    initMagazineObj: function () {
        /*script cho magazine object*/
        $('.container_detail_popup .VCSortableInPreviewMode[type="LayoutAlbum"] a').addClass('sp-img-zoom');
        $('.container_detail_popup .VCSortableInPreviewMode[type="photo"] a[target="_blank"]').not('.link-callout').removeAttr('target');
        $(".sp-img-zoom").fancybox({
            padding: 0,
            showNavArrows: true,
            locked: false,
            beforeShow: function () {

                $(".container_detail_popup .fancybox-overlay").addClass("fancybox-opening");
            },
            onUpdate: function () {
                $(window).scroll(function () {
                    try {
                        $.fancybox.close().transitions();
                    } catch (e) {

                    }
                });
                $(".container_detail_popup .fancybox-image").on('click', function () {

                    try {
                        $.fancybox.close().transitions();
                    } catch (e) {

                    }

                });

            },
            beforeClose: function () {

                $(".container_detail_popup .fancybox-overlay").addClass("fancybox-closing");

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
        if ($(".container_detail_popup .IMSInteractiveItem").length > 0) {
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
                    if ($(pageHtml).find('.container_detail_popup .detail__article').length > 0) {
                        var checkdata = $(pageHtml).find('.container_detail_popup .detail__article').html().replace(/^(?=\n)$|^\s*|\s*$|\n\n+/gm, "");
                        if (checkdata !== '' && checkdata.length > 50) {
                            $('.container_detail_popup #detailOther').append(checkdata);
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

var spnBeforeAfter = {
    init: function () {
        $('.before-after').each(function () {
            var $thisImg = $(this).find('img');
            if (parseInt($(this).attr('w')) > parseInt($(this).closest('[data-role="content"]').width())) {
                var wWrapper = $(this).closest('[data-role="content"]').width();
            } else {
                var wWrapper = $(this).attr('w');
            }

            let wHeight = wWrapper * 10/16;

            /* if ($thisImg[0].complete) {*/

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

            var beforeAfterImg = $(this);
            if (beforeAfterImg && beforeAfterImg.length > 0) {

                if (beforeAfterImg.hasClass("skin2")) {

                    w = $('[data-role="content"]').width() ;
                    h = w*10/16;

                    var imgw = w;
                    var imgh =(h + 'px');;

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
                } else {
                    $(this).beforeAfter({
                        animateIntro: true,
                        introDuration: 100,
                        linkDisplaySpeed: 500,
                        introPosition: parseFloat($(this).attr('position-percent')),
                        showFullLinks: true,
                        title: decodeURIComponent($(this).attr('title')),
                        cursor: 'e-resize',
                        enableKeyboard: true,
                        beforeDate: $(this).attr('before-date'),
                        afterDate: $(this).attr('after-date'),
                        imageWidth: wWrapper,
                        imageHeight: wHeight
                    });
                }
                $(this).removeClass('before-after').addClass('before-after-done');
            }

            //}
        });
    }
};

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


// chia sẽ mạng xã hội
var social = (function () {
    function init() {
        $(".sendsocial").click(function (e) {
            e.preventDefault();
            var t = "";
            switch ($(this).attr("rel")) {
                case "facebook":
                    t = "https://www.facebook.com/sharer.php?u=" + $(this).attr("data-href") + "&[title]=" + encodeURI($(this).attr("data-title"));
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


