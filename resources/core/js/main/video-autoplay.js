$(function () {
    //Live
    Live.init();
    Radio.init();
});

var videoHDFocus = videoHD;
var Live = {
    init: function () {
        var me = this;

        var isCenterVideo = false;

        if ($.cookie('isNotAutoNext') == null) {
            $(".top-featured-video-v2 .vdbwrht-btn").addClass("active");
        }
        me.clickAutoNext();

        // if ($("#hdIsHot").val() == 'True') {
        //     $('.menu-left .list-filters .filter').first().addClass('active');
        // }
        // else {
        //     $('.menu-left .list-filters .filter').last().addClass('active');
        // }

        // $(".top-featured-video-v2 .relate-video-slider .relate-video-item").first().addClass("is-nowplaying");


        // init video
        var videoContainer = $('.vPlayer .VCSortableInPreviewMode[type="VideoStream"]');
        if (videoContainer.attr('type-video') == "1") {
            videoContainer.each(function () {
                var $this = $(this);
                var datahtml = $this.attr("data-htmlcode");
                var videoLives = JSON.parse(datahtml);
                var vid = videoLives.vid;
                var video = '<video id= "video_' + vid + '">' + '</video>';
                $this.append(video);
                OVPPlayerInitScript('video_' + vid + '', {
                    v: vid,
                    params: { autoplay: true }

                }, function () {
                    var player = this;
                });
            });
        } else {
            var videoHDFocus = videoHD;
            videoHDFocus.init(".vPlayer", {
                type: videoHD.videoType.zoneVideo,
                functionCallBack: me.addListenVideoEnd
            });
        }
        me.initVideoPlaylistClick();
    },
    clickAutoNext: function () {
        $(".top-featured-video-v2 .vdbwrht-btn").click(function () {
            if ($.cookie('isNotAutoNext') == null) {
                $.cookie("isNotAutoNext", 1, { expires: 10 });
            } else {
                $.removeCookie("isNotAutoNext");
            }
            Live.addListenVideoEnd();
            $(".top-featured-video-v2 .vdbwrht-btn").toggleClass("active");
        });
    },
    addListenVideoEnd: function () {
        var currentVideoStream = $('.video__player .VCSortableInPreviewMode');
        var currentPlayerId = '';

        if (currentVideoStream.find('video').length > 0) {
            currentPlayerId = currentVideoStream.find('video').attr('id').replace('_html5_api', '');
        }

        var players = playerInitScript.getPlayers();
        if (players != null) {
            var player = playerInitScript.getPlayers()[currentPlayerId];
            if (player != null) {
                player.one('player:endedcontent', function () {
                    if ($.cookie('isNotAutoNext') == 1)
                        return;

                    var currentVideoId = currentVideoStream.attr("data-item-id");

                    var item = $('.live-video  .item[data-id="' + currentVideoId + '"]');
                    if (item.length == 0) {
                        item = $('.live-video  .item').first();
                    }

                    var itemNext = item.next();
                    if (itemNext.length == 0) {
                        itemNext = $('.live-video  .item').first();
                    }
                    Live.nextVideoPlaylist(itemNext);
                });
            }
        }
    },
    nextVideoPlaylist: function (selectedItem) {
        var me = this;

        var playerWrapper = $('#vPlayerv2');

        if (playerWrapper.find('.video-youtube').length){
             currentVideoStream =  playerWrapper.find('.video-youtube');
             currentVideoId = currentVideoStream.attr("data-item-id");
        }else{
            var currentVideoStream = playerWrapper.find('.VCSortableInPreviewMode');
            var currentVideoId = currentVideoStream.attr("data-item-id");
        }

        var curentItem = $('.live-video  .item[data-id="' + currentVideoId + '"]');
        if (curentItem.length == 0) {
            curentItem = $('.live-video  .item').first();
        }
        currentVideoStream.addClass('hidden');
        curentItem.append(currentVideoStream);
        curentItem.removeClass("active");
        // curentItem.find('.box-category-item').removeClass("playing");
        var currentPlayerId = '';

        if (playerWrapper.find('.video-youtube').length){
            playerWrapper.find('.video-youtube').remove()
        }else{
            if (currentVideoStream.find('video').length > 0) {
                currentPlayerId = currentVideoStream.find('video').attr('id').replace('_html5_api', '');
            }
            //kill player hiện tại
            playerInitScript.remove([currentPlayerId]);
        }

        //Hiển thị player tiếp theo
        if (selectedItem.find('.video-youtube').length){
            var nextVideoStream = selectedItem.find('.video-youtube').removeClass('hidden');
            playerWrapper.append(nextVideoStream);
            selectedItem.addClass("active");
        }else{
            nextVideoStream = selectedItem.find('.VCSortableInPreviewMode');
            playerWrapper.append(nextVideoStream);
            nextVideoStream.removeClass('hidden');
            selectedItem.addClass("active");
            selectedItem.find('.box-category-item').addClass("playing");
            var videoHDFocus = videoHD;
            videoHDFocus.init(".video__player #vPlayerv2", {
                type: videoHD.videoType.zoneVideo,
                functionCallBack: me.addListenVideoEnd
            });
        }
    },
    initVideoPlaylistClick: function () {
        var me = this;
        $('.live-video  .video-item').click(function (e) {
            me.nextVideoPlaylist($(this));
        });
        $('.funcsPl .nextbtn').click(function (e) {
            var currentVideoStream = $('.video__player .VCSortableInPreviewMode');
            var currentPlayerId = '';

            if (currentVideoStream.find('video').length > 0) {
                currentPlayerId = currentVideoStream.find('video').attr('id').replace('_html5_api', '');
            }
            var players = playerInitScript.getPlayers();
            if (players != null) {
                var currentVideoId = currentVideoStream.attr("data-item-id");

                var item = $('.live-video  .item[data-id="' + currentVideoId + '"]');
                if (item.length == 0) {
                    item = $('.live-video  .item').first();
                }
                var itemNext = item.next();
                if (itemNext.length == 0) {
                    itemNext = $('.live-video  .item').first();
                }
                Live.nextVideoPlaylist(itemNext);
            }
        });
        $('.funcsPl .prevbtn').click(function (e) {
            var currentVideoStream = $('.video__player .VCSortableInPreviewMode');
            var currentPlayerId = '';

            if (currentVideoStream.find('video').length > 0) {
                currentPlayerId = currentVideoStream.find('video').attr('id').replace('_html5_api', '');
            }
            var players = playerInitScript.getPlayers();
            if (players != null) {
                var currentVideoId = currentVideoStream.attr("data-item-id");

                var item = $('.live-video  .item[data-id="' + currentVideoId + '"]');
                if (item.length == 0) {
                    item = $('.live-video  .item').first();
                }
                var itemNext = item.prev();
                if (itemNext.length == 0) {
                    itemNext = $('.live-video  .item').first();
                }
                Live.nextVideoPlaylist(itemNext);
            }
        });
    },
    getTagsList: function (tags) {
        if (tags == "")
            return '';
        if (tags.startsWith("<a"))
            return '';

        var formatItem = "<li style='margin-bottom: 10px'>\
                            <a href='{0}' title='{1}' class='tag'>{1}</a>\
                          </li>";
        var sb = "";
        var arrTag = tags.split(";");
        $(arrTag).each(function (key, value) {
            sb += String.format(
                formatItem,
                "/" + UnicodeToKoDauAndGach(value) + ".html",
                UpperCaseFirst(value)
            );
        });
        return sb;
    },
}

var Radio = {
    init: function () {
        var me = this;

        var isCenterRadio = false;

        // if ($.cookie('isNotAutoNext') == null) {
        //     $(".top-featured-video-v2 .vdbwrht-btn").addClass("active");
        // }
        // me.clickAutoNext();
        // init Radio
        var radioContainer = $('.vPlayerRadio .player-funcs audio');
        if (radioContainer) {
            radioContainer.each(function () {
                var $this = $(this);
                var playerid=$this.attr("data-id");
                var secureToken=$this.attr("data-secureToken");
                var params = {
                    autoplay: true,
                    colorAudioPodcast: "#fff",
                    file:$this.attr("data-file")
                };
                playerInitScript(playerid, {
                    params: params,
                    secure: secureToken,
                }, function () {
                    var player = this; // callback trả về player khi init thành công
                    me.addListenRadioEnd();
                });
                // var video = '<video id= "video_' + vid + '">' + '</video>';
                // $this.append(video);
                // OVPPlayerInitScript('video_' + vid + '', {
                //     v: vid,
                //     params: { autoplay: true }
                //
                // }, function () {
                //     var player = this;
                // });
            });
        }
        me.initRadioPlaylistClick();
    },
    clickAutoNext: function () {
        $(".top-featured-video-v2 .vdbwrht-btn").click(function () {
            if ($.cookie('isNotAutoNext') == null) {
                $.cookie("isNotAutoNext", 1, { expires: 10 });
            } else {
                $.removeCookie("isNotAutoNext");
            }
            Radio.addListenRadioEnd();
            $(".top-featured-video-v2 .vdbwrht-btn").toggleClass("active");
        });
    },
    addListenRadioEnd: function () {
        var currentVideoStream = $('.vPlayerRadio .player-funcs');

        var currentPlayerId = '';

        if (currentVideoStream.find('audio').length > 0) {
            currentPlayerId = currentVideoStream.find('audio').attr('id').replace('_html5_api', '');
        }
        console.log(currentPlayerId)
        var players = playerInitScript.getPlayers();
        if (players != null) {
            var player = playerInitScript.getPlayers()[currentPlayerId];
            if (player != null) {
                player.one('player:endedcontent', function () {
                    if ($.cookie('isNotAutoNext') == 1)
                        return;

                    var currentVideoId = currentVideoStream.find('audio').attr("data-item-id");

                    console.log(currentVideoId)
                    var item = $('.live-audio  .item[data-id="' + currentVideoId + '"]');
                    if (item.length == 0) {
                        item = $('.live-audio  .item').first();
                    }

                    var itemNext = item.next();
                    if (itemNext.length == 0) {
                        itemNext = $('.live-audio  .item').first();
                    }
                    Radio.nextVideoPlaylist(itemNext);
                });
            }
        }
    },
    nextVideoPlaylist: function (selectedItem) {
        var me = this;
        var playerWrapper = $('.vPlayerRadio .player-funcs');
        var currentVideoStream = playerWrapper.find('.audioPodcastPlayer');
        var currentVideoId = currentVideoStream.attr("data-item-id");
        var curentItem = $('.live-audio  .item[data-id="' + currentVideoId + '"]');
        if (curentItem.length == 0) {
            curentItem = $('.live-audio .item').first();
        }
        currentVideoStream.addClass('hidden');
        let currentAudio=currentVideoStream.find('audio').attr('id','audio-'+currentVideoId)
        curentItem.append(currentAudio);
        curentItem.removeClass("active");
        // curentItem.find('.box-category-item').removeClass("playing");

        var currentPlayerId = '';
        if (currentVideoStream.length > 0) {
            // currentPlayerId = currentVideoStream.find('audio').attr('id').replace('_html5_api', '');
            currentPlayerId = currentVideoStream.attr('data-id');
            //kill player hiện tại
            playerInitScript.remove([currentPlayerId]);
            curentItem.append(currentAudio);
        }

        //Hiển thị player tiếp theo
        var nextVideoStream = selectedItem.find('audio');
        playerWrapper.append(nextVideoStream);

        nextVideoStream.removeClass('hidden');
        selectedItem.addClass("active");
        selectedItem.find('.box-category-item').addClass("playing");

        const secureToken=nextVideoStream.attr("data-secureToken");
        const params = {
            autoplay: true,
            colorAudioPodcast: "#fff",
            file:nextVideoStream.attr("data-file")
        };
        const playerId=nextVideoStream.attr("data-id")
        console.log(playerId)
        playerInitScript(playerId, {
            params: params,
            secure: secureToken,
            functionCallBack: me.addListenRadioEnd
        }, function () {
            var player = this; // callback trả về player khi init thành công
            Radio.addListenRadioEnd();
        });
    },
    initRadioPlaylistClick: function () {
        var me = this;
        $('.live-audio  .item').click(function (e) {
            me.nextVideoPlaylist($(this));
        });
    },
}

function UpperCaseFirst(s) {
    return s.charAt(0).toUpperCase() + s.slice(1);
}
