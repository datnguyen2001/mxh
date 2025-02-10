var ajax = function () {
    return {
        /*LIVEMATCH*/
        liveMatch: {
            getInfo: function (matchId, ajaxOptions) {
                $.ajax($.extend({
                    //url: appSettings.ajaxDomain.trimEnd('/') + String.format("/livematch/{0}/info.htm", matchId),
                    url: String.format("{0}/api/microsite-api.htm?ns="+pageSettings.commentSiteName+"&type=livematch&id={1}&action=1&url=/livematch/{1}/info.htm", ajaxDomain.trimEnd('/'), matchId),
                    xhrFields: { withCredentials: true }
                }, ajaxOptions));
            },
            getEvent: function (matchId, ajaxOptions) {
                $.ajax($.extend({
                    url: String.format("{0}/api/microsite-api.htm?ns="+pageSettings.commentSiteName+"&type=livematch&id={1}&action=2&url=/livematch/{1}/event.htm", ajaxDomain.trimEnd('/'), matchId),
                    xhrFields: { withCredentials: true }
                }, ajaxOptions));
            },
            getTimeline: function (matchId, ajaxOptions) {
                $.ajax($.extend({
                    url: String.format("{0}/api/microsite-api.htm?ns="+pageSettings.commentSiteName+"&type=livematch&id={1}&action=3&url=/livematch/{1}/timeline.htm", ajaxDomain.trimEnd('/'), matchId),
                    xhrFields: { withCredentials: true }
                }, ajaxOptions));
            }
            ,
            getAll: function (matchId, ajaxOptions) {
                $.ajax($.extend({
                    url: String.format("{0}/api/microsite-api.htm?ns="+pageSettings.commentSiteName+"&type=livematch&id={1}&action=5&url=/livematch/{1}/all.htm", ajaxDomain.trimEnd('/'), matchId),
                    xhrFields: { withCredentials: true }
                }, ajaxOptions));
            }
        }
    };
}(jQuery);

var liveSport = function () {

    var action = {
        getLiveMatch: 1,
        getLiveMatchEvent: 2,
        getLiveMatchTimeline: 3
    };

    var cardType = {
        firstYellow: 1,
        secondYellow: 2,
        red: 3
    };

    var config = {
        matchId: undefined,
        requestUrl: "/api/microsite-api.htm",
        updateTimeInterval: 15000,
        displayLiveMatchTimelineCallback: undefined,
        contentPlaceHolder: {
            status: $("#lblStatus"),
            scoreOfTeamA: $("#lblScoreA"),
            scoreOfTeamB: $("#lblScoreB"),
            stadium: $("#lblStadium"),
            referee: $("#lblReferee"),
            logoOfTeamA: $("#imgTeamA"),
            logoOfTeamB: $("#imgTeamB"),
            nameOfTeamA: $("#lblNameA"),
            nameOfTeamB: $("#lblNameB"),
            externInfo: $("#pnlExternInfo"),
            goal: $(".goal"),
            goalDetail: $("#goalDetail"),
            goalA: $("#pnlGoalA"),
            goalB: $("#pnlGoalB"),
            goalPenalty: $(".penalty"),
            goalPenaltyA: $("#pnlGoalPenaltyA"),
            goalPenaltyB: $("#pnlGoalPenaltyB"),
            card: $(".card"),
            cardDetail: $("#cardDetail"),
            cardA: $("#pnlCardA"),
            cardB: $("#pnlCardB"),
            exchange: $(".exchange"),
            exchangeDetail: $("#exchangeDetail"),
            exchangeA: $("#pnlExchangeA"),
            exchangeB: $("#pnlExchangeB"),
            timeline: $("#pnlTimeline"),
            infoBeforeMatch: $("#pnlInfomationBeforeMatch")
        }
    };

    var consts = {
        liveMatch: {
            id: "Id",
            title: "Title",
            teamA: "TeamA",
            teamB: "TeamB",
            logoTeamA: "LogoTeamA",
            logoTeamB: "LogoTeamB",
            scoreOfTeamA: "ScoreOfTeamA",
            scoreOfTeamB: "ScoreOfTeamB",
            stadium: "Stadium",
            referee: "Referee",
            beginFirstHalf: "BeginFirstHalf",
            finishFirstHalf: "FinishFirstHalf",
            beginSecondHalf: "BeginSecondHalf",
            finishSecondHalf: "FinishSecondHalf",
            beginFirstExtraTime: "BeginFirstExtraTime",
            finishFirstExtraTime: "FinishFirstExtraTime",
            beginSecondExtraTime: "BeginSecondExtraTime",
            finishSecondExtraTime: "FinishSecondExtraTime",
            isPenalty: "IsPenalty",
            matchFinished: "MatchFinished",
            timeOfMatchBegin: "TimeOfMatchBegin",
            timeOfFinishFirstHalf: "TimeOfFinishFirstHalf",
            timeOfBeginSecondHalf: "TimeOfBeginSecondHalf",
            timeOfFinishSecondHalf: "TimeOfFinishSecondHalf",
            timeOfBeginFirstExtraTime: "TimeOfBeginFirstExtraTime",
            timeOfFinishFirstExtraTime: "TimeOfFinishFirstExtraTime",
            timeOfBeginSecondExtraTime: "TimeOfBeginSecondExtraTime",
            timeOfFinishSecondExtraTime: "TimeOfFinishSecondExtraTime",
            timeOfMatchFinished: "TimeOfMatchFinished",
            status: "Status",
            statusstring: "StatusString",
            infomationBeforeMatch: "InfomationBeforeMatch",
            cdnDomain : pageSettings.imageDomain,
        },
        liveMatchEvent: {
            id: "Id",
            inMinute: "InMinute",
            eventType: "EventType",
            isTeamA: "IsTeamA",
            playerName: "PlayerName",
            playerNameOut: "PlayerNameOut",
            turn: "Turn",
            isGoal: "IsGoal",
            thedo: "https://static.thanhnien.com.vn/thanhnien.vn/image/icon_the_do.svg",
            thevang: "https://static.thanhnien.com.vn/thanhnien.vn/image/icon_the_vang.svg",
            thevang2: "https://static.thanhnien.com.vn/thanhnien.vn/image/icon_the_vang.svg",
        },
        liveMatchTimeline: {
            id: "Id",
            liveMatchId: "LiveMatchId",
            inMinute: "InMinute",
            eventType: "EventType",
            description: "Description",
            videoKey: "VideoKey",
            videoAvatar: "VideoAvatar",
            images: "Images",
            extraTime: "ExtraTime",
            status: "Status",
            videoUrl: "VideoUrl",
            type: "Type",
            location: "Location",
        }
    };

    var liveMatchTimelineEventType = {
        BatDau: 0,
        SutVao: 1,
        NguyHiem: 2,
        PenaltyVao: 3,
        PenaltyHut: 4,
        TheVang1: 5,
        TheVang2: 6,
        TheDo: 7,
        ThayNguoi: 8,
        ChanThuong: 9,
        KienThiet: 10,
        XungDot: 11,
        KetThuc: 12
    };





    var clientStatus = {
        inMinute: 0,
        extraTime: 0,
        isEnd: false,
        isLoadingLiveMatchTimeline: false,
        isLoadingLiveMatch: false,
        isLoadingLiveMatchEvent: false,
        isSignalDisconnected: false,
    };

    var liveMatchInterval;
    var staticHtml = [];
    var staticData = [];
    var loadInfoFirstTime = true;
    var countDownInterval;
    function toggleCountDown() {
        $(".live-countdown .finished").hide();
        $(".live-countdown .isBegin").hide();

        clearInterval(countDownInterval);
        $(".live-countdown .coutingsignalr").hide();

        countDownInterval = setInterval(function () {
            var s = parseInt($(".live-countdown .time").text());
            $(".live-countdown .time").text(s > 0 ? s - 1 : config.updateTimeInterval / 1000);
        }, 1000);

    }
    function loadLiveMatch(data) {
        displayLiveMatch(data);
        return;
    }

    function displayLiveMatch(d) {
        if (d != null) {
            $('.match-info').show();
            clientStatus.isEnd = d.StatusString == "Kết thúc";
            config.contentPlaceHolder.status.text(d[consts.liveMatch.statusstring] ? d[consts.liveMatch.statusstring]: '');
            config.contentPlaceHolder.scoreOfTeamA.text((d[consts.liveMatch.scoreOfTeamA]) ? d[consts.liveMatch.scoreOfTeamA]: 0);
            config.contentPlaceHolder.scoreOfTeamB.text((d[consts.liveMatch.scoreOfTeamB]) ? d[consts.liveMatch.scoreOfTeamB] : 0);
            config.contentPlaceHolder.stadium.text(d.Stadium ? ("Sân " + d.Stadium) : '');
            config.contentPlaceHolder.referee.text((d[consts.liveMatch.referee])?d[consts.liveMatch.referee]: '');
            config.contentPlaceHolder.nameOfTeamA.text(d[consts.liveMatch.teamA]?d[consts.liveMatch.teamA]:'');
            config.contentPlaceHolder.nameOfTeamB.text(d[consts.liveMatch.teamB]?d[consts.liveMatch.teamB]:'');
            var LogoTeamA = d[consts.liveMatch.logoTeamA]?d[consts.liveMatch.logoTeamA]:'';

            //if (!logoTeamA.startsWith("http")) {
            if (LogoTeamA.indexOf("http") !== 0) {
                LogoTeamA = Thumb_Zoom(LogoTeamA, 100, 100, consts.liveMatch.cdnDomain);
            }
            var LogoTeamB = d[consts.liveMatch.logoTeamB]?d[consts.liveMatch.logoTeamB]:'';
            //if (!logoTeamB.startsWith("http")) {
            if (LogoTeamB.indexOf("http") !== 0) {
                LogoTeamB = Thumb_Zoom(LogoTeamB, 100, 100, consts.liveMatch.cdnDomain);

            }
            if(LogoTeamA){
                config.contentPlaceHolder.logoOfTeamA.attr("src", LogoTeamA);
                config.contentPlaceHolder.logoOfTeamA.attr("alt", d[consts.liveMatch.teamA]?d[consts.liveMatch.teamA]:'Home Team');
                config.contentPlaceHolder.logoOfTeamA.removeClass("hidden");
            }

            if(LogoTeamB){
                config.contentPlaceHolder.logoOfTeamB.attr("src", LogoTeamB);
                config.contentPlaceHolder.logoOfTeamB.attr("alt", d[consts.liveMatch.teamB]?d[consts.liveMatch.teamB]:'Away Team');
                config.contentPlaceHolder.logoOfTeamB.removeClass("hidden");
            }

            // var infoBefore = config.contentPlaceHolder.infoBeforeMatch.html();

            config.contentPlaceHolder.infoBeforeMatch.html(d[consts.liveMatch.infomationBeforeMatch]);

            if (clientStatus.isEnd) $("#countDown").hide();

            //ẩn hiện tab theo trạng thái trận đấu hiện tại
            if (loadInfoFirstTime) {
                if (clientStatus.isEnd) //kết thúc
                {
                    $(".live-tab").hide();
                    $(".live-tab.matchfinish").show();
                    $(".live-tab.matchfinish").last().click();

                } else {
                    var matchStatus = d[consts.liveMatch.statusstring];
                    if (matchStatus == "Chưa bắt đầu") //chưa diễn ra
                    {
                        $(".live-tab").hide();
                        $(".live-tab.beforematch").show();
                        $(".live-tab.beforematch").click();
                    } else //đang diễn ra
                    {
                        $(".live-tab").hide();
                        $(".live-tab.running").show();
                        $(".live-tab.running").first().click();
                    }
                }
            }
            loadInfoFirstTime = false;

                //try {
                //    if (d[consts.liveMatch.status] != "Chưa bắt đầu" && d[consts.liveMatch.infomationBeforeMatch].replace(' ', '').length > 0 && $(".content_detail").length > 0)
                //        //ẩn nội dung content
                //    {
                //        $(".content_detail").remove();
                //    }
                //} catch(e) {
                //    $(".content_detail").remove();
                //}

            }

    }

    function loadLiveMatchEvent(data) {
        displayLiveMatchEvent(data);
        return;
    }

    function displayLiveMatchEvent(data) {

        if (data == null || data.length == 0) {
            config.contentPlaceHolder.externInfo.hide();
            return;
        }
        if (data != null) {
            config.contentPlaceHolder.externInfo.show();
            console.log(data['ghi-ban'])
            //ghi bàn
            // config.contentPlaceHolder.goal.hide();

                var d = data['ghi-ban'];
                if (d != null && d.length > 0) {

                    var html = [];
                    for (var i = 0, length = d.length; i < length; i++) {
                        var di = d[i];

                        if (di[consts.liveMatchEvent.isTeamA] === true) {
                            html +=(`
                            <div class="item">
                                <div class="team">
                                    <div class="row">
                                        <span class="icon">
                                            <img src="https://static.thanhnien.com.vn/thanhnien.vn/image/icon_football_fill.svg">
                                        </span>
                                        <span class="name">${ di[consts.liveMatchEvent.playerName] }</span>
                                    </div>
                                </div>
                                <span class="time">${ di[consts.liveMatchEvent.inMinute] }'</span>
                                <div class="team home">
                                    <div class="row">
                                        <span class="icon">
                                        </span>
                                        <span class="name"></span>
                                    </div>
                                </div>
                            </div>
                            `);
                        } else {
                            html +=`
                            <div class="item">
                            <div class="team">
                                <div class="row">
                                    <span class="icon">

                                    </span>
                                    <span class="name"></span>
                                </div>
                            </div>
                            <span class="time">${ di[consts.liveMatchEvent.inMinute] }'</span>
                            <div class="team home">
                                <div class="row">
                                    <span class="icon">
                                    <img src="https://static.thanhnien.com.vn/thanhnien.vn/image/icon_football_fill.svg">
                                    </span>
                                    <span class="name">${ di[consts.liveMatchEvent.playerName] }</span>
                                </div>
                            </div>
                            </div>
                            `;
                        }
                    }

                    config.contentPlaceHolder.goalDetail.html(html);
                    config.contentPlaceHolder.goal.show();
                }


            //thẻ
            config.contentPlaceHolder.card.hide();

                var d = data['the'];
                if (d != null && d.length > 0) {
                    var html = [];
                    for (var i = 0, length = d.length; i < length; i++) {
                        var di = d[i];
                        var cardClass = '';
                        switch (di[consts.liveMatchEvent.eventType]) {
                            case cardType.firstYellow:
                                {
                                    cardClass = consts.liveMatchEvent.thevang;
                                    break;
                                }
                            case cardType.secondYellow:
                                {
                                    cardClass = consts.liveMatchEvent.thevang2;
                                    break;
                                }
                            case cardType.red:
                                {
                                    cardClass = consts.liveMatchEvent.thedo;
                                    break;
                                }
                        }
                        if (di[consts.liveMatchEvent.isTeamA]) {
                            html+=`
                            <div class="item">
                                <div class="team">
                                    <div class="row">
                                        <span class="icon">
                                            <img src="${cardClass}">
                                        </span>
                                        <span class="name">${ di[consts.liveMatchEvent.playerName] }</span>
                                    </div>
                                </div>
                                <span class="time">${ di[consts.liveMatchEvent.inMinute] }'</span>
                                <div class="team home">
                                    <div class="row">
                                        <span class="icon">
                                        </span>
                                        <span class="name"></span>
                                    </div>
                                </div>
                            </div>
                            `;
                        } else {
                            html += `
                            <div class="item">
                            <div class="team">
                                <div class="row">
                                    <span class="icon">

                                    </span>
                                    <span class="name"></span>
                                </div>
                            </div>
                            <span class="time">${ di[consts.liveMatchEvent.inMinute] }'</span>
                            <div class="team home">
                                <div class="row">
                                    <span class="icon">
                                    <img src="${cardClass}">
                                    </span>
                                    <span class="name">${ di[consts.liveMatchEvent.playerName] }</span>
                                </div>
                            </div>
                            </div>
                            `;
                        }
                    }
                    config.contentPlaceHolder.cardDetail.html(html);
                    config.contentPlaceHolder.card.show();
                }

            //thay người
            config.contentPlaceHolder.exchange.hide();

                var d = data['thay-nguoi'];
                if (d != null && d.length > 0) {
                    var exchangeHtml = '';
                    for (var i = 0, length = d.length; i < length; i++) {
                        var di = d[i];
                        if (di[consts.liveMatchEvent.isTeamA]) {
                            exchangeHtml += `
                            <div class="item">
                                <div class="team">
                                    <div class="row">
                                        <span class="icon">
                                                <img src="https://static.thanhnien.com.vn/thanhnien.vn/image/icon_arrow_up_fill.svg">
                                        </span>
                                        <span class="name">${di[consts.liveMatchEvent.playerName]}</span>
                                    </div>
                                    <div class="row">
                                        <span class="icon">
                                            <img src="https://static.thanhnien.com.vn/thanhnien.vn/image/icon_arrow_down_fill.svg">
                                        </span>
                                        <span class="name">${di[consts.liveMatchEvent.playerNameOut]}</span>
                                    </div>
                                </div>
                                <span class="time">${di[consts.liveMatchEvent.inMinute]}'</span>
                                <div class="team home">
                                    <div class="row">
                                        <span class="icon">
                                        </span>
                                        <span class="name"></span>
                                    </div>
                                    <div class="row">
                                        <span class="icon">
                                        </span>
                                        <span class="name"></span>
                                    </div>
                                </div>
                            </div>
                            `;
                        } else {
                            exchangeHtml+=`
                            <div class="item">
                            <div class="team">
                                <div class="row">
                                    <span class="icon">

                                    </span>
                                    <span class="name"></span>
                                </div>
                                <div class="row">
                                    <span class="icon">

                                    </span>
                                    <span class="name"></span>
                                </div>
                            </div>
                            <span class="time">${di[consts.liveMatchEvent.inMinute]}'</span>
                            <div class="team home">
                                <div class="row">
                                <span class="icon">
                                        <img src="https://static.thanhnien.com.vn/thanhnien.vn/image/icon_arrow_up_fill.svg">
                                </span>
                                <span class="name">${di[consts.liveMatchEvent.playerName]}</span>
                            </div>
                            <div class="row">
                                <span class="icon">
                                    <img src="https://static.thanhnien.com.vn/thanhnien.vn/image/icon_arrow_down_fill.svg">
                                </span>
                                <span class="name">${di[consts.liveMatchEvent.playerNameOut]}</span>
                            </div>
                            </div>
                        </div>
                            `;
                        }
                    }
                    config.contentPlaceHolder.exchangeDetail.html(exchangeHtml);
                    config.contentPlaceHolder.exchange.show();
                }

        }
    }

    function loadLiveMatchTimeline(data) {
        displayLiveMatchTimeline(data);
        return;
    }


    function displayLiveMatchTimeline(data) {
        if (data != null && data.length > 0) {
            //remove những item mà cms đã remove
            var htmlItems = [];
            for (var i = 0; i < data.length; i++) {
                htmlItems.push(data[i][consts.liveMatchTimeline.id]);
            }
            var existItems = $('.timeline-row');
            if (existItems.length > 0 && htmlItems.length > 0) {
                existItems.each(function (index, item) {
                    if ($.inArray(parseInt($(item).attr('rel')), htmlItems) == -1) {
                        $(this).remove();
                    }
                });
            }

            var html = [];
            for (var i = 0, length = data.length; i < length; i++) {
                html.push(buildTimelineItem(data[i]));
            }
            var tmp = html.slice();
            staticHtml.push.apply(staticHtml, tmp.reverse());
            if (config.contentPlaceHolder.timeline.children().length == 0)
                config.contentPlaceHolder.timeline.html(html.join(''));
            else {
                config.contentPlaceHolder.timeline.children().first().before(html.join(''));
            }

            clientStatus.inMinute = data[0][consts.liveMatchTimeline.inMinute];
            clientStatus.extraTime = data[0][consts.liveMatchTimeline.extraTime];

            //manhlv 23/08 tam commnet
            //execCallback(config.displayLiveMatchTimelineCallback);

        }
    }

    function buildTimelineItem(data) {
        var html = [];
        html.push(String.format('<div class=\"timeline-row\" id=\"timeline-row-{0}\" rel=\"{0}\" processed=\"0\">', data[consts.liveMatchTimeline.id]));
        html.push('<ul class="row-item">');
        html.push(buildTimelineLeft(data));
        html.push(buildTimelineRight(data));
        html.push('</ul>');
        html.push('</div>');
        var result = html.join('');
        var id = data[consts.liveMatchTimeline.id];

        if (staticData.length > 0 && staticData[id] != null) {
            if (staticData[id] != result) {
                var existItem = $(String.format('#timeline-row-{0}', id));
                if (existItem.length > 0) {
                    existItem.replaceWith(result);
                    staticData[id] = result;

                }
            }
            return '';

        }
        staticData[id] = result;
        return result;
    }

    function execCallback(cb) {
        if (typeof cb == "function") {
            cb();
        }
    }

    function buildTimelineLeft(data) {
        return String.format("<li class=\"time-left\"><div id=\"info_2284\"><span class=\"icon-box fl\"><span class=\"time\">{0}</span></span><span class=\"action fl\">{1}</span></div></li>",
            String.format("{0} {1}'", data[consts.liveMatchTimeline.inMinute], parseInt(data[consts.liveMatchTimeline.extraTime]) > 0 ? String.format("<span class=\"extra-time\">+{0}</span>", data[consts.liveMatchTimeline.extraTime]) : ""),
            getEventType(data[consts.liveMatchTimeline.eventType])
            //<div class=\"fb-like mgt8 fl\" data-href=\"{2}\" data-send=\"false\" data-layout=\"button_count\" data-width=\"50\" data-show-faces=\"false\" data-font=\"arial\"></div>
            //String.format('http://soha.vn{0}#{1}', document.location.href, data[consts.liveMatchTimeline.id])
        );
    }

    function getEventType(actionId) {
        var className = '';
        switch (actionId) {
            case liveMatchTimelineEventType.BatDau:
                className = "tranbatdau";
                break;
            case liveMatchTimelineEventType.SutVao:
                className = "bong";
                break;
            case liveMatchTimelineEventType.NguyHiem:
                className = "bolo";
                break;
            case liveMatchTimelineEventType.PenaltyVao:
                className = "pen";
                break;
            case liveMatchTimelineEventType.PenaltyHut:
                className = "penno";
                break;
            case liveMatchTimelineEventType.TheVang1:
                className = "thevang1";
                break;
            case liveMatchTimelineEventType.TheVang2:
                className = "thevang2";
                break;
            case liveMatchTimelineEventType.TheDo:
                className = "thedo";
                break;
            case liveMatchTimelineEventType.ThayNguoi:
                className = "thaynguoi-timeline";
                break;
            case liveMatchTimelineEventType.ChanThuong:
                className = "chanthuong";
                break;
            case liveMatchTimelineEventType.KienThiet:
                className = "giay";
                break;
            case liveMatchTimelineEventType.XungDot:
                className = "xungdot";
                break;
            case liveMatchTimelineEventType.KetThuc:
                className = "kethuchiep";
                break;
        }
        if (className != '')
            return String.format("<span class=\"{0} fl spritelive\"></span>", className);
        return '';
    }

    function buildTimelineRight(data) {
        var imagePath = data[consts.liveMatchTimeline.images];
        var images = "";
        if (imagePath != "") {
            images = (imagePath.indexOf("http://") > 0 || imagePath.indexOf("https://") > 0 || imagePath.indexOf("data:image/") > 0) ? imagePath : BuildTimelineImage(imagePath);
        }

        var video = "";
        if (typeof (data[consts.liveMatchTimeline.videoUrl]) != 'undefined' && data[consts.liveMatchTimeline.videoUrl] + "" != "") {
            data[consts.liveMatchTimeline.videoKey] = String.format('{"KeyVideo":"{0}","FileName":"{1}","Location":"{2}","Type":{3},"NameSpace":"{4}"}', data[consts.liveMatchTimeline.videoKey], data[consts.liveMatchTimeline.videoUrl], data[consts.liveMatchTimeline.location], data[consts.liveMatchTimeline.type], data[consts.liveMatchTimeline.nameSpace]);
            video = buildHtmlVideo(data[consts.liveMatchTimeline.videoKey], 490, 300, false, data[consts.liveMatchTimeline.videoAvatar]);
        }
        else if (data[consts.liveMatchTimeline.videoKey] != '') {
            video = buildHtmlVideo(data[consts.liveMatchTimeline.videoKey], 490, 300, false, data[consts.liveMatchTimeline.videoAvatar]);
        }

        return String.format("<li class=\"time-right\"><div class=\"timeline-des\">{0}</div><div class=\"mgt8\">{1}</div><div ><div class=\"image-timeline mgt8\"><ul>{2}</ul></div></div></li>",
            data[consts.liveMatchTimeline.description],
            video,
            images
        );
    }

    function BuildTimelineImage(images) {
        if (images + '' != '') {
            var arrImages = images.split(';');

            if (arrImages.length > 0) {
                var sb = '';
                $.each(arrImages, function (index, img) {
                    if ((img + '').trim() != '')
                        sb += String.format("<li>{0}</li>", BuildPhoto(img, "", 490, 300));
                });
                return sb;
            }
        }
        return '';
    }

    function BuildPhoto(imageUrl, title, width, height) {
        if (imageUrl + '' == '') {
            return "";
        }
        else {
            return String.format(
                "<img title=\"{1}\" alt=\"{1}\" src=\"{0}\" width=\"{2}\" height=\"{3}\" />",
                Thumb_Zoom(imageUrl, width, height, settings.imageDomain),
                htmlEncode(title),
                width,
                height
            );
        }

    }

    function Thumb_Zoom(imagePath, imageWidth, imageHeight, domain) {
        if (imagePath + '' != '') {
            imagePath = imagePath.indexOf(domain) != -1
                ? imagePath.substring(domain.Length)
                : imagePath;

            if (imagePath.startsWith("http://") || imagePath.startsWith("https://") || imagePath.startsWith("data:image/"))
                return imagePath;

            imagePath = imagePath.trimStart('/');

            if(imagePath.indexOf('zoom') > -1){
                return domain + "/" + imagePath;
            }

            return domain + String.format('/zoom/{0}_{1}/{2}', imageWidth, imageHeight, imagePath);
        }
        return null;
    }

    //21/04/2018 manhlv build videoplayer
    function buildHtmlVideo(key, width, height, autoPlay, avatar) {
        try {
            var resData = JSON.parse(key);

            var videoFormat = '<div class="VCSortableInPreviewMode" type="VideoStream" embed-type="4" data-width="{0}" data-height="{1}" data-vid="{2}" data-info="{3}" data-autoplay="true" data-removedlogo="false" data-location="" data-advmode="1" data-displaymode="1" data-thumb="{4}" data-contentId="" data-namespace="kenh14"></div>';
            var fileName = resData.FileName;
            var videoKey = resData.KeyVideo;

            return String.format(videoFormat, width, height, fileName, videoKey, avatar);

        }
        catch (err) {
            return '';
        }



    }
    //build embedcode
    function buildVideoEmbedCodeNew(key, width, height, autoPlay, avatar) {
        try {
            var resData = JSON.parse(key);

            var videoFormat = '<iframe width="{0}" height="{1}" src="{2}" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen scrolling="no"></iframe>';
            var host = Constants.videoHdDomain + '/1.1/?_site=kenh14&vid=';

            var src = host + resData.FileName;

            src += '&_info=' + resData.KeyVideo;

            if (resData.Location == 'vn') {
                src += '&location=vn';
            }

            var param = "0;0;0;0";
            if (typeof admParamTvc === 'function') {
                param = admParamTvc(0);
            }

            src += "&_admParamTvc=" + param;

            if (autoPlay) {
                src += "&autoplay=" + autoPlay;
            }

            return String.format(videoFormat, width, height, src);

        }
        catch (err) {
            return '';
        }



    }

    //build embedcode
    function buildVideoEmbedCode(id, key, name, width, height, autoPlay, avatar) {
        if (autoPlay == null) {
            autoPlay = true;
        }
        if (avatar == null) {
            avatar = '';
        } else {
            avatar = getSouceAvatar(avatar);
        }
        var sb = '';
        var videoUrl = String.format("{0}/media/{1}", settings.videoDomain, key);

        sb += String.format("<object width=\"{0}\" height=\"{1}\" classid=\"{2}\" id=\"{3}\">", width, height, settings.classId, id);
        sb += "<param name=\"wmode\" value=\"transparent\">";
        sb += String.format("<param name=\"movie\" value=\"{0}\">", videoUrl);
        sb += "<param name=\"allowFullScreen\" value=\"true\">";
        sb += String.format("<param name=\"flashvars\" value=\"videotag=true&autostart={0}\">", autoPlay);
        sb += "<param name=\"allowscriptaccess\" value=\"always\">";
        sb += "<param name=\"bgcolor\" value=\"#000000\">";
        sb += String.format("<embed width=\"{0}\" height=\"{1}\"  src=\"{2}\"  id=\"{3}\" name=\"movie\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" wmode=\"transparent\" flashvars=\"videotag=true&autostart={4}&image={5}&stretching=exactfit\" bgcolor=\"#000000\" quality=\"high\"></object>",
            width, height, videoUrl, id, autoPlay, avatar);
        return sb;
    }

    function getSouceAvatar(url) {
        if (url.indexOf("http:") != -1 || url.indexOf("https:") != -1) {
            if (url.indexOf(settings.videoImageDomain) != -1) {
                url = url.replace(settings.videoImageDomain, '');
            }
            else {
                return url;
            }
        }
        return String.format('{0}/{1}', settings.videoImageDomain, url.trimStart('/'));
    }

    function loadData() {
        loadAllData();

    }

    function loadAllData() {
        if (clientStatus.isLoadingLiveMatch) {
            return;
        }
        clientStatus.isLoadingLiveMatch = true;
        ajax.liveMatch.getAll(config.matchId, {
            timeout: 8000,
            dataType: "JSON",
            error: function (e) {
                clientStatus.isLoadingLiveMatch = false;
            },
            success: function (response) {
                var dataAll = JSON.parse(response.Data);

                try {
                    var dataLiveMatch = dataAll.LiveMatch;

                    if (typeof(dataLiveMatch) != "undefined") loadLiveMatch(dataLiveMatch);

                    var dataLiveMatchEvent = dataAll.LiveMatchEvent;
                    if (typeof(dataLiveMatchEvent) != "undefined") loadLiveMatchEvent(dataLiveMatchEvent);

                    var dataLiveMatchTimeline = dataAll.LiveMatchTimeLine;
                    loadLiveMatchTimeline(dataLiveMatchTimeline);

                    //trận đấu đã kết thúc
                    if (clientStatus.isEnd) {
                        clearInterval(liveMatchInterval);
                        config.contentPlaceHolder.timeline.html(staticHtml.join(''));
                        execCallback(config.displayLiveMatchTimelineCallback);

                    } else {
                        //signalr start
                        listenSignal();
                        execCallback(config.displayLiveMatchTimelineCallback);
                    }

                    $('.detail__lf-main, .box-lf-top, .box-lf-tab, .box-lf-content').removeClass('hidden');
                } catch(e) {
                    console.log(e);
                }

                clientStatus.isLoadingLiveMatch = false;
            }
        });
    }
    function listenSignal() {
        //if (appSettings.allowSignalr) {
        if (false) {
            SignalRConfig.startSignalr({
                channel: "tienphong",
                type: signalRType.liveSport,
                endpoint: appSettings.signalrHost,
                id: config.matchId,
                onReceiveSignal: displayDataFromSignalr,
                onDisconnected: switchToNormalMode
            });
        } else {
            switchToNormalMode();
        }
    };
    function switchToNormalMode() {
        console.log("switch to normal mode");
        if (clientStatus.isEnd) {
            console.log("match finished!");
            //do nothing
        } else {

            //console.log(liveMatchInterval);
            if (liveMatchInterval == undefined) {
                console.log("interval started!", config.updateTimeInterval);
                toggleCountDown();
                liveMatchInterval = setInterval(function () {
                    loadData();
                }, config.updateTimeInterval);
            }
        }
    }
    function displayDataFromSignalr(message) {
        var dataAll = message;// $.parseJSON(message);
        var dataLiveMatch = dataAll.LiveMatch;

        if (typeof (dataLiveMatch) != "undefined") loadLiveMatch(dataLiveMatch);
        var dataLiveMatchEvent = dataAll.LiveMatchEvent;
        if (typeof (dataLiveMatchEvent) != "undefined") loadLiveMatchEvent(dataLiveMatchEvent);
        var dataLiveMatchTimeline = dataAll.LiveMatchTimeLine;
        loadLiveMatchTimeline(dataLiveMatchTimeline);
    }

    String.prototype.trimStart = function (c) {
        if (this.length == 0)
            return this;
        c = c ? c : ' ';
        var i = 0;
        for (; this.charAt(i) == c && i < this.length; i++);
        return this.substring(i);
    };

    String.prototype.trimEnd = function (c) {
        c = c ? c : ' ';
        var i = this.length - 1;
        for (; i >= 0 && this.charAt(i) == c; i--);
        return this.substring(0, i + 1);
    };

    String.prototype.trim = function (c) {
        return this.trimStart(c).trimEnd(c);
    };


    return {
        init: function (options) {
            config = $.extend(config, options);
            var requestUrl = config.requestUrl;

            if(requestUrl == '' || requestUrl == undefined) return;
            ajaxDomain = requestUrl;

            if (config.matchId == '' || config.matchId == 0)return;
            loadData();
            $("#tabs .tab-ul .live-tab").click(function () {
                $("#tabs .tab-ul .live-tab").removeClass("active");
                $(this).addClass("active");
                $("#tabs .tab").hide();
                var idshow = $("#tabs .tab-ul .live-tab.active a").attr("href");
                $(idshow).show();
            });

            $(".ico-toggle.toggle-content").click(function () {
                var base = $(this);
                $('.boxtisotop1.togglable').stop(true, true).slideToggle(function () {
                    base.toggleClass('active');
                    if (base.hasClass('active')) {
                        $('body,html').animate({
                            scrollTop: $('.livesport-content').offset().top
                        }, 1000);
                    }
                });

            });
        },
        buildVideoEmbedCode: function (key, width, height, autoplay, avatar, videoUrl, location) {
            return buildVideoEmbedCode(key, width, height, autoplay, avatar, videoUrl, location);
        },
        loadLiveMatchTimeline: function (data){
            return loadLiveMatchTimeline(data);
        }
    };
}(jQuery);
