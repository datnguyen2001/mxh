﻿var detectmob = function () {
    if (navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/iPad/i)
        || navigator.userAgent.match(/iPod/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i)
    ) {
        return true;
    }
    else {
        return false;
    }
}

function isElementVisible(el) {
    if (el == null)
        return;
    var rect = el.getBoundingClientRect(),
        vWidth = window.innerWidth || doc.documentElement.clientWidth,
        vHeight = window.innerHeight || doc.documentElement.clientHeight;

    var isTop = (rect.top >= 0 && rect.top <= vHeight);
    var isBottom = (rect.bottom >= 0 && rect.bottom <= vHeight);

    var isLeft = (rect.left >= 0 && rect.left <= vWidth);
    var isRight = (rect.right >= 0 && rect.right <= vWidth);

    var isBottomNew = (rect.bottom - (el.clientHeight - (el.clientHeight / 2)) >= 0 && rect.bottom <= vHeight);
    //console.log('isLeft: ', isLeft);
    //console.log('isRight: ', isRight);

    if (isTop && isBottomNew && isLeft && isRight) {
        return 'play';
    }
    else if (!isTop && !isBottomNew && isLeft && isRight) {
        return 'pause';
    }
    return '';
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var videoStorage = 'https://videothumbs.mediacdn.vn';

var videoHD = {
    typeAppend: 1,
    isMute: false,
    isSuggest: true,
    isAd: true,
    isHideControlbar: false,
    originDomain: '*',
    suggsetDomain: pageSettings.DomainUtils + '/Handler/Video/ListVideoXML.ashx?watch=',
    divVideoFormat: '<div class="VCSortableInPreviewMode" type="VideoStream"></div>',
    divIfrWrapperFormat: '<div class="iframe-wraper"></div>',
    videoFormat: '<div class="iframe-wraper">{4}<iframe width="{0}" height="{1}" src="{2}" id="ifVideo-{3}" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen="" oallowfullscreen="" msallowfullscreen="" oallowfullscreen="" scrolling="no"></iframe></div>',
    bgFormat: '<div class="bg-wraper" style="background-image: url({0});"><div class="loading-vid-icon"><div class="lvc-label">{1}</div><div class="lvc-play-icon"></div></div><div class="loading-vid-countdown" style="display: none"><div class="lvc-label">{1}</div><div class="lvc-circle"></div><div class="lvc-line-mask"><div class="lvc-line"></div></div><span style="display: none;"class="lvc-number">3</span></div></div>',
    bgText: 'Video tự động phát',
    bgPauseNotify: '<div class="pause-vd-notify" style="display: none;"><span class="clearfix"><svg width="9" height="12"><path d="M0,0V12H3V0ZM6,0V12H9V0Z"></path></svg>Video tạm dừng</span></div>',
    host: pageSettings.videoplayer + '/?_site=bcp.cdnchinhphu.vn&vid=bcp.cdnchinhphu.vn/',
    useBg: true,
    videoStorage_ext: "https://videothumbs-ext.mediacdn.vn",
    videoStorage: "https://videothumbs.mediacdn.vn",
    init: function (wrap, settings) {
        var me = this;
        if (typeof (settings) == 'undefined')
            settings = {};

        if (typeof (settings.useBg) != 'undefined')
            me.useBg = settings.useBg;

        var vtype;
        if (settings.type) {
            vtype = me.getVideoType(settings.type);

            if (vtype.playType == me.playType.clickToPlay || vtype.playType == me.playType.autoplay) {
                me.useBg = false;
            }
        }

        if (settings.isAd)
            me.isAd = settings.isAd;

        if (settings.isHideControlbar)
            me.isHideControlbar = settings.isHideControlbar;

        if (detectmob() || !me.useBg)
            me.bgPauseNotify = "";

        //Check những iframe có sẵn, InsertEmbed
        var listVideo = $(wrap).find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]');
        listVideo.each(function (key, value) {
            //if (!detectmob()) {
            var currentVideo = $(this);

            if (currentVideo.is(":visible")) {
                if (typeof (currentVideo.attr('id')) == 'undefined') {
                    var videoId = key;
                    var ifVideoId = 'ifVideo-' + videoId;
                    while ($('iframe[id="' + ifVideoId + '"]').length > 0) {
                        videoId = Math.floor((Math.random() * 1000) + 1);
                        ifVideoId = 'ifVideo-' + videoId;
                    }

                    currentVideo.attr('id', ifVideoId);
                    var src = currentVideo.attr('src');
                    src = me.genVideoSource(src, videoId, vtype);

                    if (src != '') {
                        currentVideo.attr('src', src.replace("https://", "http://"));
                        currentVideo.attr('playType', getParameterByName('playType', src));

                        if (me.useBg && !detectmob()) {
                            var divVideo = currentVideo.parent();
                            if (!currentVideo.parent().hasClass('VCSortableInPreviewMode')) {
                                divVideo = $(me.divVideoFormat);
                                currentVideo.after(divVideo);
                            } else if (divVideo.hasClass('VCSortableInPreviewMode') && divVideo.attr('type') == 'insertembedcode') {
                                divVideo.attr('type', 'VideoStream');
                            }

                            var ifrWraper = $(me.divIfrWrapperFormat);
                            divVideo.append(ifrWraper);
                            divVideo.addClass('pos-rlt');
                            divVideo.find('.iframe-wraper').append(me.bgPauseNotify);
                            divVideo.find('.iframe-wraper').append(currentVideo);

                            //var bgUrl = Constants.videoStorage + '/thumb_w/650/' + getParameterByName('vid', src).toLowerCase().replace(".mp4", ".jpg").replace(".flv", ".jpg");
                            var vid = getParameterByName('vid', src);
                            var bgUrl = me.videoStorage + '/thumb_w/650/' + vid.toLowerCase().substring(0, vid.lastIndexOf('.')) + '.jpg';
                            var bgPoster = String.format(me.bgFormat, bgUrl, me.bgText);

                            divVideo.append(bgPoster);
                            divVideo.find('.bg-wraper').height(divVideo.find('iframe').height());
                        }
                    }
                }
            }
            //}
        });
        //Check VideoStream
        if (listVideo.length == 0) {
            $(wrap).find('.VCSortableInPreviewMode[type=VideoStream]').each(function () {
                var $this = $(this);
                //if (!detectmob()) {
                //Nếu đã có player v2 rồi thì thôi k cần init lại
                if ($this.find('.videoNewsPlayer').length > 0)
                    return;

                //if ($this.attr("embed-type") == "4") {
                var videoIda = $this.attr('videoid');
                $this.find('>div[videoid="' + videoIda + '"]').remove();
                $this.find('video').remove();
                $this.find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]').remove();

                setTimeout(function () {
                    me.initnew($this, vtype, settings);
                }, 300);
            });
        }
        //Click play luôn
        $(wrap).find('.VCSortableInPreviewMode[type=VideoStream] .bg-wraper').each(function () {
            var $me = $(this);
            $me.click(function () {
                var $wrap = $me.parents('.VCSortableInPreviewMode');
                admPlayNow($wrap);
            });
        });
    },
    // 21/04/2018 Manhlv thêm videoplayer mới
    initnew: function (wrap, vtype, settings) {
        var me = this;
        var $this = $(wrap);
        var width = $this.attr('data-width');
        var height = $this.attr('data-height');
        var vidAttr = $this.attr('data-vid');
        var fileAttr = $this.attr('data-file');
        var locationAttr = $this.attr('data-location');
        var infoAttr = $this.attr('data-info');
        var autoplayAttr = $this.attr('data-autoplay') == 'true';
        var avatarAttr = $this.attr('data-thumb');
        var dataAds = $this.attr('data-ads');
        var dataReplay = $this.attr('data-replay');
        var shareUrlVideo = $this.attr('data-share');
        var dataPostroll = $this.attr('data-postroll');
        var dataIsTrailer = $this.attr('data-is-trailer');
        var dataCover = $this.attr('data-cover');
        avatarAttr = me.image_thumb_w(avatarAttr, 650);

        if (typeof shareUrlVideo == "undefined" || shareUrlVideo == '') {
            shareUrlVideo = window.location.href;
        }

        if (shareUrlVideo.indexOf('?') != -1) {
            shareUrlVideo = shareUrlVideo.substr(0, shareUrlVideo.indexOf('?'));
        }

        var muteAttr = "";
        var vtypeAttr = "";
        var playTypeAttr = "";
        var datacontentId = $this.attr("data-contentId");

        var dataNamespace = $this.attr("data-namespace");

        if (vtype) {
            muteAttr = vtype.isMute;
            vtypeAttr = vtype.vtype;
            playTypeAttr = vtype.playType;

            if (vtype.playType == me.playType.autoplay) {
                autoplayAttr = true;
            }

            if (vtype.vtype == me.videoType.newsDetail) {
                width = height = "100%";
            }
        }

        //check video cũ
        if ($this.attr("embed-type") != "4") {
            var src = $this.attr('data-src');
            if (typeof (src) != "undefined") {
                vidAttr = getParameterByName('vid', src);
                $this.attr('data-vid', vidAttr);

                var au = getParameterByName('autoplay', src);
                if (au != null) autoplayAttr = au == "true";
            }
            infoAttr = $this.attr('videoid');

            avatarAttr = getParameterByName('poster', src);
            if (typeof avatarAttr != "undefined" && avatarAttr != "" && avatarAttr != null)
                avatarAttr = me.image_thumb_w(avatarAttr, 620);

            if (typeof (locationAttr) == "undefined") locationAttr = "";
        }

        //Check trùng thì gen thêm ext cho id
        var infoExt = '';
        var players = playerInitScript.getPlayers();
        if (typeof players != 'undefined') {
            var player = players["#streamid_" + infoAttr];
            if (typeof players != 'undefined') {
                infoExt = '_' + getRandomeString();
            }
        }

        $this.prepend('<video id="streamid_' + infoAttr + infoExt + '" class="videoNewsPlayer" playsinline="" webkit-playsinline="" height="' + height + '" width="' + width + '"></video>');
        var params = { vid: vidAttr, autoplay: autoplayAttr, location: locationAttr, _info: infoAttr, shareUrl: shareUrlVideo, mute: muteAttr, vtype: vtypeAttr, playType: playTypeAttr, nopre: true, poster: avatarAttr };

        if (dataAds == "true" || dataAds == "True" || typeof dataAds == 'undefined') {
            params.midroll = "0.8;20s";
        }
        if (dataPostroll == "true" || dataPostroll == "True" || typeof dataPostroll == 'undefined') {
            params.postroll = true;
        }

        if (dataReplay == "true" || dataReplay == "True" || vtype.replay) {
            params.replay = true;
        }

        //check video thuộc pr thì chuyển sang param file
        if (typeof vidAttr != "undefined" && vidAttr.startsWith('pr/')) {
            params.vid = "";
            params.file = "https://hls.mediacdn.vn/" + $this.attr('data-vid');
        }
        if (typeof fileAttr != "undefined" && fileAttr != "") {
            params.vid = "";
            params.file = fileAttr;
        }

        try {
            var secureToken = pageSettings.VideoToken;
            if (typeof secureToken == "undefined" || secureToken == "")
                secureToken = "L3NlY3VyZS92ZXJpZnkveHZxcmNhZGhlYmZpMHY1dm5zM2Ywd3d3a3Y2MDdkMDgvMTAwNjU4L2V5SmhiR2NpT2lKSVV6STFOaUlzSW5SNWNDSTZJa3BYVkNKOS5leUp5WldZaU9pSWlMQ0poY0hCclpYa2lPaUo0ZG5GeVkyRmthR1ZpWm1rd2RqVjJibk16WmpCM2QzZHJkall3TjJRd09DSXNJbkJzWVhsbGNpSTZJakV3TURZMU9DSXNJbWxuYm05eVpVVjRjR2x5WVhScGIyNGlPblJ5ZFdVc0ltbGhkQ0k2TVRVNU1UYzRNRGc0TXl3aVpYaHdJam94TlRreE56Z3hNREF6ZlEucnR0aUR3QUFBb2ppNlV1ODRMN1A0VXUzNGlLRFNIbWNWdzhJaGh5V2ZuYw==";

            // dùng cho bài magazine
            if ((dataCover + "").toLowerCase() == "true") {
                params.mute = false;
                //token cover
                secureToken = "L3NlY3VyZS92ZXJpZnkveHZxcmNhZGhlYmZpMHY1dm5zM2Ywd3d3a3Y2MDdkMDgvMTAwNTk3L2V5SmhiR2NpT2lKSVV6STFOaUlzSW5SNWNDSTZJa3BYVkNKOS5leUp5WldZaU9pSWlMQ0poY0hCclpYa2lPaUo0ZG5GeVkyRmthR1ZpWm1rd2RqVjJibk16WmpCM2QzZHJkall3TjJRd09DSXNJbkJzWVhsbGNpSTZJakV3TURVNU55SXNJbWxuYm05eVpVVjRjR2x5WVhScGIyNGlPblJ5ZFdVc0ltbGhkQ0k2TVRVM09EQTBPVFE1T0N3aVpYaHdJam94TlRjNE1EUTVOakU0ZlEuM2dzZ0V5dU0zb0kySzljUmJlZFdHTVhVMVhjRDg3dmlLNGRtcVNvTktWQQ==";
            }

            playerInitScript('streamid_' + infoAttr + infoExt, { params: params, secure: secureToken }, function () {
                var player = this;
                if (typeof (settings.functionCallBack) == 'function')
                    settings.functionCallBack();
            });
            $('#vPlayerv2').removeClass('hidden')
            $('#playOnSite').hide()
        } catch (ex) {
            console.log(ex);
        }

    },

    image_thumb_w: function (url, w) {
        if (typeof url == "undefined" || url == "")
            return;

        var me = this;
        if (w == 0 || typeof w == "undefined")
            return url;
        var regex = /thumb_w\/\d+\/|zoom\/([0-9]+)_([0-9]+)\//g;
        url = url.replace(regex, '');
        var storageDomain = me.videoStorage;

        url = url.replace("http://", 'https://');
        url = url.replace("https://video-thumbs.mediacdn.vn/bcp.cdnchinhphu.vn", 'https://videothumbs.mediacdn.vn/bcp.cdnchinhphu.vn')
            .replace("https://video-thumbs-ext.mediacdn.vn", 'https://videothumbs-ext.mediacdn.vn');


        if (url.indexOf(me.videoStorage_ext) != -1 || url.indexOf("https://video-thumbs-ext.mediacdn.vn") != -1 || url.indexOf("https://videothumbs-ext.mediacdn.vn") != -1) {
            storageDomain = me.videoStorage_ext;
            url = url.replace(me.videoStorage_ext, '');
            url = url.replace('https://video-thumbs-ext.mediacdn.vn', '');
            url = url.replace('https://videothumbs-ext.mediacdn.vn', '');
        } else {
            if (url.indexOf(me.videoStorage) != -1) {
                url = url.replace(me.videoStorage, '');
            }
            if (url.indexOf("http://video-thumbs.mediacdn.vn") != -1) {
                url = url.replace("http://video-thumbs.mediacdn.vn", '');
            }
            if (url.indexOf("http://video-thumbs.vcmedia.vn") != -1) {
                url = url.replace("http://video-thumbs.vcmedia.vn", '');
            }
            if (url.indexOf("https://video-thumbs.mediacdn.vn") != -1) {
                url = url.replace("https://video-thumbs.mediacdn.vn", '');
            }
            if (url.indexOf("https://videothumbs.mediacdn.vn") != -1) {
                url = url.replace("https://videothumbs.mediacdn.vn", '');
            }
        }

        if (url.startsWith("http"))
            return url;

        return String.format('{0}/thumb_w/{1}/{2}', storageDomain, w, url);

    },

    getPlayerToken: function (content_id, namespace) {
        var me = this;
        var json;
        $.ajax({
            async: false,
            url: pageSettings.DomainUtils + '/Handlers/Video/getPlayerToken.ashx',
            xhrFields: { withCredentials: true },
            data: { content_id: content_id, apinamespace: namespace },
            type: 'POST',
            dataType: 'json',
            success: function (r) {
                if (r.Success) {
                    json = $.parseJSON(r.Data);
                }
            }
        });
        return json;
    },
    buildEmbedVideo: function (width, height, videoId, fileName, key, autoPlay) {
        var me = this;

        var src = me.host + fileName;

        src += '&_info=' + key;

        var param = "0;0;0;0";
        if (typeof admParamTvc === 'function') {
            param = admParamTvc(0);
        }

        src += "&_admParamTvc=" + param;

        if (autoPlay) {
            src += "&autoplay=" + autoPlay;
        }

        if (me.isSuggest) {
            src += "&_listsuggest=" + me.suggsetDomain + videoId;
        }

        return String.format(me.videoFormat, width, height, src, videoId, me.bgPauseNotify);
    },
    videoFunction: function (ele, name) {
        var me = this;
        var params;
        switch (name) {
            case 'play':
                params = {
                    action: 'play'
                };
                $(ele).get(0).contentWindow.postMessage(params, me.originDomain);
                break;
            case 'pause':
                params = {
                    action: 'pause'
                };
                $(ele).get(0).contentWindow.postMessage(params, me.originDomain);
                break;
        }
    },
    listFocus: function (ele, w, h, wrap) {
        var me = this;

        if ($(ele).hasClass('playing')) return;

        $(ele).parent().find('li').removeClass('playing');
        $(ele).addClass('playing');

        var vId = $(ele).attr('data-id');
        var fileName = $(ele).attr('data-filename');
        var key = $(ele).attr('data-key');

        var video = me.buildEmbedVideo(w, h, vId, fileName, key, true);

        if (wrap != null) {
            $(wrap).html(video);
        } else {
            $('#video-player-wrapt').html(video);
        }
    },
    genVideoSource: function (src, videoId, vtype) {
        if (src == 'undefined' || src == null)
            return '';
        var me = this;

        if (vtype) {
            //console.log(vtype);
            if (src.indexOf('mute') < 0) {
                src += '&mute=' + vtype.isMute;
            }

            if (src.indexOf('vtype') < 0) {
                src += '&vtype=' + vtype.vtype;
            }

            if (src.indexOf('playType') < 0) {
                src += '&playType=' + vtype.playType;
            }

            if (vtype.playType == me.playType.autoplay) {
                src += '&autoplay=true';
            }
        }

        src = src.replace('http://vcplayer.mediacdn.vn', pageSettings.videoplayer);
        src = src.replace('&amp;', '&').replace('_tag=http://vscc.hosting.vcmedia.vn/tag/', '_info=');
        var param = "0;0;0;0";
        if (typeof admParamTvc === 'function') {
            param = admParamTvc(0);
        }
        src += "&_admParamTvc=" + param;

        if (me.isSuggest) {
            src += "&_listsuggest=" + me.suggsetDomain + videoId;
        }

        if (me.isHideControlbar) {
            src += "&_controlbar=hide";
        }

        if (src.indexOf('postroll') < 0 && vtype != me.videoType.videoDetail) {
            src += '&postroll=true';
        }
        if (src.indexOf('replay') < 0) {
            src += '&replay=true';
        }
        if (src.indexOf('nonVol') < 0) {
            src += '&nonVol=true';
        }
        if (src.indexOf('volume') < 0) {
            src += '&volume=0.6';
        }


        var prBoxVideoID = getParameterByName('boxVideoID', src);
        src = src.replace('&boxVideoID=' + prBoxVideoID, '');

        src += "&boxVideoID=ifVideo-" + videoId;

        if (detectmob()) {
            src = src.replace("&nopre=true", "");
            src = src.replace("&midroll=0.8;20s", "");
        }
        else {
            if (src.indexOf('nopre') < 0) {
                src += '&nopre=true';
            }

            if (!me.isAd) {
                src += "&tag=0";
                src = src.replace('&midroll=0.8;20s', '');
            }
            else {
                if (src.indexOf('midroll') < 0) {
                    src += '&midroll=0.8;20s';
                }
            }
        }

        return src;
    },
    playType: {
        viewable: 0,
        autoplay: 1,
        clickToPlay: 2
    },
    videoType: {
        newsDetail: 1,
        stream: 2,
        videoDetail: 3,
        boxVideo: 4,
        newsBottom: 5,
        boxMutex: 6,
        clickToPlay: 7,
        zoneVideo: 8
    },
    getVideoType: function (type) {
        var me = this;
        switch (type) {
            case 1:
                return { vtype: "1", position: "bài chi tiết", playType: me.playType.viewable, isMute: false, note: "", replay: true };
                break;
            case 2:
                return { vtype: "2", position: "stream", playType: me.playType.viewable, isMute: true, note: "", replay: true };
                break;
            case 3:
                return { vtype: "3", position: "video chi tiết", playType: me.playType.autoplay, isMute: false, note: "" };
                break;
            case 4:
                return { vtype: "4", position: "box cắt ngang", playType: me.playType.viewable, isMute: true, note: "unmute khi mở popup-comment", replay: true };
                break;
            case 5:
                return { vtype: "5", position: "video chân bài", playType: me.playType.viewable, isMute: true, note: "unmute khi mở popup-comment", replay: true };
                break;
            case 6:
                return { vtype: "6", position: "box mutex", playType: me.playType.viewable, isMute: true, note: "", replay: true };
                break;
            case 7:
                return { vtype: "7", position: "video ấn mới chạy", playType: me.playType.clickToPlay, isMute: false, note: "" };
                break;
            case 8:
                return { vtype: "8", position: "chuyên mục video", playType: me.playType.viewable, isMute: true, note: "", replay: true };
                break;
            default:
                return { vtype: "2", position: "stream", playType: me.playType.viewable, isMute: true, note: "", replay: true };
                break;
        }
    }
};
function getRandomeString() {
    return Math.random().toString(36).substr(2, 9);
}


window.addEventListener ? window.addEventListener("message", function (b) {
    listenPlayer(b);
}, !1) : window.attachEvent && window.attachEvent("onmessage", function (b) {
    listenPlayer(b);
});

var waitingVideoIdForReady = [];
var readyVideoIds = [];

function listenPlayer(b) {
    if (-1 != b.origin.indexOf("vcplayer.vcmedia.vn") || -1 != b.origin.indexOf("123.31.11.105") || -1 != b.origin.indexOf("vcplayer.mediacdn.vn")) {
        if ("object" == typeof b.data) {
            if (typeof (b.data.method) != 'undefined') {
                switch (b.data.method) {
                    case 'currentTime':
                        if (typeof (b.data.rid) === 'object') {
                            //console.log('seek video currentTime: ', b.data);
                            videoInContent.seekCurrentTime(b.data.rid.id, b.data.data);
                        }
                        else {
                            //console.log('set video currentTime: ', b.data);
                            videoInContent.setCurrentTime(b.data.rid, b.data.data);
                        }
                        break;
                }
            }
            else if (typeof (b.data.event) != 'undefined') {
                switch (b.data.event) {
                    case 'canplaythrough':
                        //console.log('can play video: ', b.data.boxVideoID);
                        $('#' + b.data.boxVideoID).parent().show();
                        break;
                }
            }
            else if (typeof (b.data.action) != 'undefined') {
                switch (b.data.action) {
                    case 'ready':
                        //console.log('ready video: ', b.data);
                        var currentVideo = '#' + b.data.boxVideoID;
                        readyVideoIds.push(currentVideo);
                        if (waitingVideoIdForReady.length > 0) {
                            if ($.inArray(currentVideo, waitingVideoIdForReady) >= 0) {
                                //console.log("playVideo(" + currentVideo + ")");
                                videoInContent.playVideo(currentVideo);
                                waitingVideoIdForReady.splice($.inArray(currentVideo, waitingVideoIdForReady), 1);
                            }
                        }
                        break;
                }
            }
        }
    }
}

function admPlayNow(wrap) {
    var $wrap = $(wrap);
    var currentVideo = $wrap.find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]');
    if ($.inArray("#" + currentVideo.attr('id'), readyVideoIds) >= 0) {
        videoInContent.playVideo(currentVideo);
    }
    else {
        waitingVideoIdForReady.push("#" + currentVideo.attr('id'));
    }
    $wrap.find(".bg-wraper").hide();
}
var currentTimingVideo = null;
function admPlayProgress(wrap) {
    var count = 3;
    var $wrap = $(wrap);

    if (currentTimingVideo != $wrap && currentTimingVideo != null) {
        currentTimingVideo.find(".bg-wraper").hide();
    }
    currentTimingVideo = $wrap;

    var currentVideo = $wrap.find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]');

    if ($wrap.find(".bg-wraper").length > 0) {
        $wrap.find(".loading-vid-countdown").fadeIn(1500);
        $wrap.find(".loading-vid-countdown").addClass("quickspin");
        $wrap.find(".bg-wraper").addClass("bgPoster");

        if (detectmob()) {
            setTimeout(function () {
                if ($.inArray("#" + currentVideo.attr('id'), readyVideoIds) >= 0) {
                    videoInContent.playVideo(currentVideo);
                }
                else {
                    waitingVideoIdForReady.push("#" + currentVideo.attr('id'));
                }
                $wrap.find(".bg-wraper").hide();
            }, 1000);
        }
        else {
            $wrap.find(".lvc-label").show();
            $wrap.find(".lvc-number").show();

            //Chô này là countdown r count từ 3 - 0
            var sim = setInterval(function () {
                if (count == 2) {
                    //call play khi count = 2 tránh khựng
                    if ($.inArray("#" + currentVideo.attr('id'), readyVideoIds) >= 0) {
                        videoInContent.playVideo(currentVideo);
                    }
                    else {
                        waitingVideoIdForReady.push("#" + currentVideo.attr('id'));
                    }
                }

                if (count > 0) {
                    //đoạn này chỉ gắn count vào label thôi
                    $wrap.find(".lvc-number").html(count);
                } else {
                    //sau khi đếm ngược xong thì ẩn bg
                    clearInterval(sim);

                    $wrap.find(".bg-wraper").hide();
                }
                count = count - 1;

            }, 500);
        }
    }
    else {
        if ($.inArray("#" + currentVideo.attr('id'), readyVideoIds) >= 0) {
            videoInContent.playVideo(currentVideo);
        }
        else {
            waitingVideoIdForReady.push("#" + currentVideo.attr('id'));
        }
    }
}

var videoInContent = {
    //Kiểm tra fullscreen
    isFullscreen: false,
    init: function (wrap) {
        //$(window).load(function () {
        if (detectmob())
            return;

        var me = this;
        var screen_change_events = "webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange";
        $(document).on(screen_change_events, function () {
            me.changeIsFullscreen();
        });

        var listVideo = $(wrap).find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]');
        listVideo.each(function (key, value) {
            var currentVideo = $(this);
            //console.log(currentVideo.attr('id'));
            //console.log(typeof (currentVideo.attr('id')) == 'undefined');
            if (typeof (currentVideo.attr('id')) == 'undefined') {
                currentVideo.attr('id', 'iframeVideo' + key);
                var src = currentVideo.attr('src');
                var videoId = currentVideo.attr('id');

                src = videoHD.genVideoSource(src, videoId);
                currentVideo.attr('src', src.replace("https://", "http://"));
            }

            var isVideoBoxPlaying = false,
                isFirstTimePlayVideo = true;
            var timeout;
            $(window).scroll(function (e) {
                if (timeout) { window.clearTimeout(timeout); timeout = null; }
                var $wrap = currentVideo.parents('.VCSortableInPreviewMode');

                var action = isElementVisible(document.getElementById(currentVideo.attr('id')));
                if (action == 'play') {
                    //console.log('play ', currentVideo.attr('id'), isFirstTimePlayVideo);
                    //timeout = setTimeout(function () {
                    if (!isVideoBoxPlaying && !me.isFullscreen) {
                        if (isFirstTimePlayVideo) {
                            isFirstTimePlayVideo = false;
                            setTimeout(function () {
                                $wrap.find(".loading-vid-icon").hide();
                                admPlayProgress($wrap);
                            }, 300);
                        }
                        else {
                            //setTimeout(function () {
                            if ($.inArray("#" + currentVideo.attr('id'), readyVideoIds) >= 0) {
                                //console.log('no wait ', currentVideo);
                                me.playVideo(currentVideo);
                            }
                            else {
                                //console.log('wait ', currentVideo);
                                waitingVideoIdForReady.push("#" + currentVideo.attr('id'));
                            }
                            //}, 500);
                        }
                        isVideoBoxPlaying = true;
                    }
                    //}, 300);
                } else if (action == 'pause') {
                    //console.log('stop ', currentVideo.attr('id'), isFirstTimePlayVideo);
                    clearTimeout(timeout);
                    setTimeout(function () {
                        if (isVideoBoxPlaying && !me.isFullscreen) {
                            me.stopVideo(currentVideo);
                            isVideoBoxPlaying = false;
                            isFirstTimePlayVideo = false;
                            //console.log('stop ', currentVideo.attr('id'));
                        }
                    }, 0);
                }
            });
        });
        //});
    },
    playVideo: function (currentVideo) {
        var me = this;
        var $iframeVideo = $(currentVideo);

        //var scrollTop = $(window).scrollTop();
        //var videoOffset = 0,
        //    neoBottom = (scrollTop + screen.height),
        //    $video = null;

        me.stopAllVideo();

        var action = isElementVisible(document.getElementById($iframeVideo.attr('id')));
        //console.log(action);
        if (action == 'play') {
            var idIframe = $iframeVideo.attr('id');
            var mele = document.getElementById(idIframe);
            if (mele) {
                //var params = 'admReviceMessageToPlayer("playvideo")';
                var params = {
                    action: 'request',
                    method: 'play'
                };
                if (mele.contentWindow)
                    mele.contentWindow.postMessage(params, '*');
            }
        }
    },
    stopVideo: function (currentVideo) {
        var $iframeVideo = $(currentVideo);
        var idIframe = $iframeVideo.attr('id');
        var mele = document.getElementById(idIframe);
        if (mele) {
            //var params = 'admReviceMessageToPlayer("pausevideo")';
            var params = {
                action: 'request',
                method: 'pause'
            };
            if (mele.contentWindow)
                mele.contentWindow.postMessage(params, '*');

        }
    },
    hideControlBar: function (currentVideo) {
        var $iframeVideo = $(currentVideo);
        var idIframe = $iframeVideo.attr('id');
        var mele = document.getElementById(idIframe);
        if (mele) {
            //console.log('hidecontrolbar', idIframe);
            var params = 'admReviceMessageToPlayer("hidecontrolbar")';
            if (mele.contentWindow)
                mele.contentWindow.postMessage(params, '*');

        }
    },
    getCurrentTime: function (currentVideo, toIframeId) {
        //console.log('start get currentTime from ', currentVideo, ' set for ', toIframeId);
        var $iframeVideo = $(currentVideo);
        var idIframe = $iframeVideo.attr('id');
        var mele = document.getElementById(idIframe);
        if (mele) {
            var params = {
                action: 'request',
                method: 'currentTime',
                cid: toIframeId
            };
            if (mele.contentWindow)
                mele.contentWindow.postMessage(params, '*');
        }
    },
    setCurrentTime: function (currentVideo, currentTime) {
        //console.log('set currentTime for ', currentVideo, ' with time is ', currentTime);
        var $iframeVideo = $(currentVideo);
        $iframeVideo.attr("src", $iframeVideo.attr("src") + "&currentTime=" + currentTime);

        waitingVideoIdForReady.push("#" + $iframeVideo.attr('id'));
    },
    seekCurrentTime: function (currentVideo, currentTime) {
        //console.log('seek currentTime for ', currentVideo, ' with time is ', currentTime);
        var me = this;
        var $iframeVideo = $(currentVideo);
        var idIframe = $iframeVideo.attr('id');
        var mele = document.getElementById(idIframe);
        if (mele) {
            var params = {
                action: 'request',
                method: 'currentTime',
                args: [currentTime]
            };
            if (mele.contentWindow)
                mele.contentWindow.postMessage(params, '*');
        }
        setTimeout(function () {
            me.playVideo(currentVideo);
        }, 100);
    },
    stopAllVideo: function () {
        var me = this;
        $('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]').each(function () {
            $video = $(this);
            me.stopVideo('#' + $video.attr("id"));
        });
        playerInitScript.pauseAll();
    },
    changeIsFullscreen: function () {
        var me = this;
        me.isFullscreen = !me.isFullscreen;
    }
};

function initAudioPlayer(wrap, autoplay) {
    if ($(wrap).length == 0)
        return false;
    var $this = $(wrap);
    var fileAttr = $this.attr('data-file');
    var idAttr = $this.attr('data-id');
    var poster = $this.attr('data-poster');
    var height = $this.attr('data-height');
    var width = $this.attr('data-width');
    var linkshare = $this.attr('data-share');
    var title = $this.attr('data-title');
    //Check trùng thì gen thêm ext cho id
    var infoExt = '';
    var players = playerInitScript.getPlayers();
    if (typeof players != 'undefined') {
        var player = players["#streamid_" + idAttr];
        if (typeof players != 'undefined') {
            infoExt = '_' + getRandomeString();
        }
    }

    $this.prepend('<audio id="streamid_' + idAttr + infoExt + '" class="videoNewsPlayer" playsinline="" webkit-playsinline="" height="' + height + '" width="' + width + '"></audio>');

    var params = {
        mute: false,
        soundWavePlugin: true,
        audioBlurBackground: 5,
        audioBackground: poster,
        file: fileAttr,
        linkShareAudio: linkshare,
        titleAudio: title,
        autoplay: autoplay,
        colorAudioTrans: '#fff'
    };
    try {
        // fix cứng token
        var secureToken = 'L3NlY3VyZS92ZXJpZnkveHZxcmNhZGhlYmZpMHY1dm5zM2Ywd3d3a3Y2MDdkMDgvMTAwODE4L2V5SmhiR2NpT2lKSVV6STFOaUlzSW5SNWNDSTZJa3BYVkNKOS5leUp5WldZaU9pSWlMQ0poY0hCclpYa2lPaUo0ZG5GeVkyRmthR1ZpWm1rd2RqVjJibk16WmpCM2QzZHJkall3TjJRd09DSXNJbkJzWVhsbGNpSTZJakV3TURneE9DSXNJbWxuYm05eVpVVjRjR2x5WVhScGIyNGlPblJ5ZFdVc0ltbGhkQ0k2TVRZeU5USXdNakk1TUN3aVpYaHdJam94TmpJMU1qQXlOREV3ZlEuNFpidHVKMm1rX2IxNHpGdjlGRk00MTlhT0RlVU45VDJjS205NHU4cEhmcw';

        playerInitScript('streamid_' + idAttr + infoExt, { params: params, secure: secureToken }, function () {
            //callback
        });
    } catch (ex) {
        console.log(ex);
    }
}
function initAudioPlayerTransparent(wrap, autoplay){
    if ($(wrap).length == 0)
        return false;
    var $this = $(wrap);
    var fileAttr = $this.attr('data-file');
    var idAttr = $this.attr('data-id');
    var poster = $this.attr('data-poster');
    var height = $this.attr('data-height');
    var width = $this.attr('data-width');
    var linkshare = $this.attr('data-share');
    var title = $this.attr('data-title');
    //Check trùng thì gen thêm ext cho id
    var infoExt = '';
    var players = playerInitScript.getPlayers();
    if (typeof players != 'undefined') {
        var player = players["#streamid_" + idAttr];
        if (typeof players != 'undefined') {
            infoExt = '_' + getRandomeString();
        }
    }

    $this.prepend('<audio id="streamid_' + idAttr + infoExt + '"  playsinline="" webkit-playsinline="" height="' + height + '" width="' + width + '"></audio>');

    var params = {
        mute: false,
        soundWavePlugin: true,
        audioBlurBackground: 5,
        audioBackground: '#333',
        file: fileAttr,
        linkShareAudio: linkshare,
        titleAudio: title,
        autoplay: autoplay,
        colorAudioTrans: '#464343'
    };
    try {
        // fix cứng token
        var secureToken = 'L3NlY3VyZS92ZXJpZnkveHZxcmNhZGhlYmZpMHY1dm5zM2Ywd3d3a3Y2MDdkMDgvMTAwODIxL2V5SmhiR2NpT2lKSVV6STFOaUlzSW5SNWNDSTZJa3BYVkNKOS5leUp5WldZaU9pSWlMQ0poY0hCclpYa2lPaUo0ZG5GeVkyRmthR1ZpWm1rd2RqVjJibk16WmpCM2QzZHJkall3TjJRd09DSXNJbkJzWVhsbGNpSTZJakV3TURneU1TSXNJbWxuYm05eVpVVjRjR2x5WVhScGIyNGlPblJ5ZFdVc0ltbGhkQ0k2TVRZeU5UZzVNVEk0TXl3aVpYaHdJam94TmpJMU9Ea3hOREF6ZlEuZ29oLVB5YlpjWmh0VzJIUmZMOUpZMC15TVJNb0pJMGhYazZ2Rkt2Q2pfMA';

        playerInitScript('streamid_' + idAttr + infoExt, { params: params, secure: secureToken }, function () {
            //callback
        });
    } catch (ex) {
        console.log(ex);
    }
}
