
/***************************************
 = bai tuong thuat rolling
 -------------------------------------- */
var rollingNews_api = function () {
    var config = {
        contentPlaceHolder: undefined,
        hotContentPlaceHolder: undefined,
        displayHotContentCallback: undefined,
        duration: 15000,
        // url: pageSettings.DOMAIN_API_ANSWER + "/api-rollingnews.chn",
        url: pageSettings.DomainUtils2 + "/api/microsite-api.htm",
        finallyCallback: undefined,
        isFirstDisplayNew: true
    };

    var consts = {
        rollingNewsEvent: {
            id: "Id",
            content: "Content",
            time: "Time",
            type: "Type",
            eventDate: "EventTime",
            isFocus: "IsFocus",
            note: "Note",
            focusDate: "FocusDate",
            modifyTime: "ModifyTime"
        },
        rollingNewsType: {
            allType: -1,
            breakingNews: 2,
            video: 3,
            photo: 5,
            quotation: 1,
            facebook: 9,
            linkhay: 10,
            vietId: 11,
            phone: 6,
            email: 7,
            message: 8,
            audio: 4

        },
        action: {
            getAll: 1,
            getNew: 2,
            getMore: 3
        },
        appendPosition: {
            top: 0,
            bottom: 1
        }
    };

    var requestStatus = {
        isLoadingNew: false,
        isLoadingAll: false,
        isLoadingMore: false
    };

    var id;
    var maxDate;
    var rollingNewsInterval;
    var staticHtmlNews = [];
    var isReversed = false;
    var countDownInterval;

    function toggleCountDown() {
        clearInterval(countDownInterval);
        if (requestStatus.isLoadingNew) {
            $(".live-countdown .couting").hide();
            $(".live-countdown .time").text(config.duration / 1000);
            $(".live-countdown .loading").show();
        } else {
            $(".live-countdown .couting").show();
            $(".live-countdown .loading").hide();
            countDownInterval = setInterval(function () {
                if (requestStatus.isLoadingAll || requestStatus.isLoadingNew) {
                    return;
                }
                var s = parseInt($(".live-countdown .time").text());
                $(".live-countdown .time").text(s > 0 ? s - 1 : config.duration / 1000);
            }, 1000);
        }
    }


    function reverse(placeHolder) {
        //if (isReversed === false) {
        //    config.contentPlaceHolder.html(staticHtmlNews.join(''));
        //}
        //else {
        //    var tmp = staticHtmlNews.slice();
        //    config.contentPlaceHolder.html(tmp.reverse().join(''));
        //}
        isReversed = !isReversed;
        //execCallback(config.finallyCallback);
        placeHolder.children().each(function (i, li) { placeHolder.prepend(li) })
    }

    function loadAll(callback) {

        $.ajax({
            url: config.url,
            data: { id: id, action: consts.action.getAll,ns:pageSettings.DOMAIN_API_NAME_SPACE,type:'rollingnews' },
            dataType: "JSON",
            type: 'GET',timeout: 5000,
            success: function (response) {
                toggleCountDown();
                if (response.Success) {

                    displayNew(response.Data != "" ? $.parseJSON(response.Data) : []);
                    execCallback(callback);
                }else {
                    $('#divRollingNews').html('Không có nội dung để hiển thị');
                }
            }
        });
    }

    function loadNew() {
        if (requestStatus.isLoadingNew === true || requestStatus.isLoadingAll === true)
            return;
        requestStatus.isLoadingNew = true;
        toggleCountDown();
        $.ajax({
            url: config.url,
            data: { id: id, action: consts.action.getNew, date: maxDate ,ns: pageSettings.DOMAIN_API_ANSWER_PARAM},
            dataType: "JSON",timeout: 5000,
            success: function (response) {
                if (response.Success) {
                    displayNew(response.Data != "" ? $.parseJSON(response.Data) : []);
                }
                requestStatus.isLoadingNew = false;
                toggleCountDown();
            }
        });
    }

    function displayNew(alldata) {

        if (alldata != null) {
            //if (!config.isFirstDisplayNew) {
            checkRolling(alldata.RollingNewsInfo);
            //}

            var data = alldata.ListItem.reverse();
            if (data != null && data.length > 0) {
                var html = [];
                var htmlHot = '';
                var htmlTimeLine = '';

                var idSetValueTimeLine = [];

                for (var i = 0; i < data.length; i++) {
                    html.push(buildHtml(data[i]));
                    if (data[i][consts.rollingNewsEvent.isFocus]) {
                        htmlHot += (buildHtml(data[i]));
                    }
                    idSetValueTimeLine.push(data[i])
                }
                htmlTimeLine =buildTimeLineHtml(idSetValueTimeLine);

                $(config.hotContentPlaceHolder).html(htmlHot);
                $('.detail__timelive-content .swiper-wrapper').html(htmlTimeLine);
                $('.detail-timelive').removeClass('hidden');
                if (htmlHot.length > 0) {
                    execCallback(config.displayHotContentCallback);
                }

                if (config.contentPlaceHolder.find(".livenews-item").length > 0) {
                    bindNextNews(data);

                } else {
                    staticLiveNews = data;
                    bindFirstNews(staticLiveNews);

                }
                staticHtmlNews = [];
                var html2 = html.slice();
                staticHtmlNews.push.apply(staticHtmlNews, html2.reverse());
                maxDate = data[0][consts.rollingNewsEvent.eventDate];
                config.isFirstDisplayNew = false;
                execCallback(config.finallyCallback);
                //ProcessVideo();
                scrollIntoview();
                if ($('.detail-tab-content').length > 0) {
                    videoHD.isAd = true;
                    videoHD.init(".detail-tab-content", {
                        type: videoHD.videoType.newsDetail
                    });
                    videoInContent.init('.detail-tab-content');
                }
            }
        }else {
            $('#divRollingNews').html('Không có nội dung để hiển thị');
        }
    }
    function bindFirstNews(res) {
        var htm = '';
        $(res).each(function (index, value) {
            htm += buildHtml(value);
        });
        config.contentPlaceHolder.html(htm);
    }

    function bindNextNews(res) {
        var htmlItems = [];
        if (isReversed)
            res = res.reverse();
        for (var i = 0; i < res.length; i++) {
            htmlItems.push(res[i]["Id"]);
        }
        //remove những item mà cms đã remove
        var existLiveNewsItems = $('.livenews-item');
        if (existLiveNewsItems.length > 0 && htmlItems.length > 0) {
            existLiveNewsItems.each(function () {
                if ($.inArray($(this).attr('rel'), htmlItems) == -1) {
                    $(this).remove();
                }
            });
        }
        // kiem tra va them cac phan tu moi
        var indexLi = 0;
        existLiveNewsItems = $('.livenews-item');
        if (existLiveNewsItems.length > 0 && htmlItems.length > 0) {
            $(res).each(function (index, data) {
                var o = $('.livenews-item')[indexLi];
                var idEvent = $(o).attr("rel");
                if (data[consts.rollingNewsEvent.id] != idEvent) { // neu co event moi
                    $(o).before(buildHtml(data));
                }
                else {
                    var lastUpdateEvent = $(o).attr("lastupdate");
                    if (data[consts.rollingNewsEvent.modifyTime] != lastUpdateEvent) { // neu last update khac tuc la event co thay doi
                        //console.log('UPDATE');
                        $(o).html(buildHtml(data, true));
                        $(o).attr("lastupdate", data[consts.rollingNewsEvent.modifyTime]);
                    }
                }
                indexLi++;
            });
        }
    }
    function checkRolling(res) {
        var roll = res;
        if (res == null) {
            roll = { status: 0 };
        }
        if (roll.status == 2) { // da ket thuc
            $('#pnlFinish span.status').html("Kết thúc");
            $('#livefinish').show();
            $('#liveCountdown').hide();
            $('#divRollingNews').show();

            clearInterval(rollingNewsInterval);
        } else if (roll.status == 1) { // dang dien ra
            $('#livefinish').hide();
            $('#liveCountdown').show();
            $('#divRollingNews').show();
        } else { // chua dien ra

            $('#livefinish').show();
            $('#liveCountdown').hide();
            if (res != null) {
                $('#livefinish span.status').html("Chưa diễn ra...");
            }
            clearInterval(rollingNewsInterval);
        }
    }

    function buildHtml(data, removeLi) {
        var html = [];
        if (!removeLi)
            html.push(String.format("<div class=\"livenews-item detail-tab-item\" lastupdate=\"{1}\" rel=\"{0}\">", data[consts.rollingNewsEvent.id], data[consts.rollingNewsEvent.modifyTime]));
        //html.push(buildTypeIcon(data[consts.rollingNewsEvent.type]));
        html.push(String.format("<span class=\"time\">{0}</span>", data[consts.rollingNewsEvent.time]));
        html.push(String.format("<p class=\"title\">{0}</p>", data[consts.rollingNewsEvent.note]));
        html.push("<div class=\"inner clearfix sapo\">");
        html.push(String.format("<div class=\"news-content content\">{0}</div>", data[consts.rollingNewsEvent.content]));
        html.push("</div>");
        if (!removeLi)
            html.push("</div>");
        return html.join('');
    }
    function buildTimeLineHtml(data) {
        var isdata = data.reverse();
        var html = '';
        $.each(isdata, function(i, value) {
            html = html +  ' <div class="swiper-slide" to-view="'+value.Id+'">\n' +
                '             <div class="box-item">\n' +
                '               <p class="box-time">'+value.Time+'</p>\n' +
                '                     <a href="javascript:void(0);" class="box-title">\n' +
                '                           '+value.Note+
                '                          </a>\n' +
                '               </div>\n' +
                '               </div>'
        });

        return html;
    }

    function scrollIntoview(){
        $(".detail-time-live-sw .swiper-wrapper .swiper-slide").on('click',function () {
            var id = $(this).attr('to-view');
            $('html, body').animate({
                scrollTop: $(`[rel=${id}]`).offset().top - 200
            }, 1000);
        });

    }
    //function buildHtmlHot(data) {
    //    var html = '<li rel="' + data[consts.rollingNewsEvent.id] + '"><span class="content"><a rel="nofollow">' + data[consts.rollingNewsEvent.note] + '</a></span><span class="time">' + data[consts.rollingNewsEvent.focusDate] + '</span></li>';
    //    return html;
    //}

    function buildTypeIcon(type) {
        var cssClass = "";
        switch (type) {
            case consts.rollingNewsType.breakingNews:
            {
                cssClass = "ico-news";
                break;
            }
            case consts.rollingNewsType.video:
            {
                cssClass = "ico-video";
                break;
            }
            case consts.rollingNewsType.photo:
            {
                cssClass = "ico-photo";
                break;
            }
            case consts.rollingNewsType.quotation:
            {
                cssClass = "ico-quote";
                break;
            }
            case consts.rollingNewsType.facebook:
            {
                cssClass = "ico-fb";
                break;
            }
            case consts.rollingNewsType.linkhay:
            {
                cssClass = "ico-linkhay";
                break;
            }
            case consts.rollingNewsType.vietId:
            {
                cssClass = "ico-vietid";
                break;
            }
            case consts.rollingNewsType.audio:
            {
                cssClass = "ico-audio";
                break;
            }
            case consts.rollingNewsType.phone:
            {
                cssClass = "ico-call";
                break;
            }
            case consts.rollingNewsType.email:
            {
                cssClass = "ico-email";
                break;
            }
            case consts.rollingNewsType.message:
            {
                cssClass = "ico-msg";
                break;
            }
        }
        if (cssClass != "")
            return String.format("<i class=\"ico-type {0}\"></i>", cssClass);
        return "";
    }

    function execCallback(cb) {
        if (typeof cb == "function")
            cb();
    }

    function init() {
        if (config.contentPlaceHolder === undefined) {
            try {
                console.log("RollingNews's ContentPlaceHolder is undefined.");
            } catch (e) {

            }
            return;
        }

        $('.detail-tab-nav a').click(function (e) {
            e.preventDefault();
            $('.detail-tab-nav a').removeClass('active');
            $('.detail-tab-content .tab').removeClass('show');
            $(this).addClass('active');
            $(this).closest('.detail-tab').find('#' + $(this).attr('data-href')).addClass('show');
            if ($('.detail-tab-filter').length > 0) {
                $('.detail-tab-filter').find('.reverse').attr('data-tab', $('.detail-tab-nav a.active').attr('data-href'));
            }
        });

        $('.list__sub-collapse .title').click(function (e) {
            e.preventDefault();
            $('.list__sub-collapse .item').removeClass('show');
            $(this).closest('.item').addClass('show');
        });

        loadAll(function () {
            if (rollingNewsInterval == null) {
                rollingNewsInterval = setInterval(loadAll, config.duration);
            }
        });
        //if (config.isFirstDisplayNew)
        //    loadAll();
        //else {
        //    rollingNewsInterval = setInterval(loadAll, config.duration);
        //}


    }

    return {
        init: function (rollingNewsId, options) {
            id = rollingNewsId;
            config = $.extend(config, options);
            init();
        },
        reverse: reverse
    };
}(jQuery);
