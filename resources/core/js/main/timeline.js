$(document).ready(function () {
    var zoneID = $('#hdZoneId').val(),
    urlAjax, keys, news = $('#hdNewsId').val(),
    keyword = $('#hdKeyword').val(),
    keywordVideo = $("#hdKeywordVideo").val() ,
    tag = $("#hdCatUrl").val(),
    video = $("#hdZoneVideo").val(),
    media = $("#hdZoneMedia").val(),
    podcast = $("#hdZonePodcast").val(),
    magazine = $("#hdZoneMagazine").val(),
    thread = $("#hdThreadId").val(),
    newbytype = $("#hdNewsByType").val(),
    newmostview = $("#hdMostview").val(),
    newnews = $("#hdNewnews").val() ,
    live = $("#hdZoneLive").val(),
    radio = $("#hdZoneRadio").val(),
    home = $('#hdZoneHome').val(),
    topic = $('#hdTopicId').val();

    urlAjax = (tag) ? "timelinetag/{0}/{1}.htm" :
    (video) ? "/timelinevideo/{0}/{1}.htm" :
    ((thread) ? "/timelinethread/{0}/{1}.htm" :
    ((keyword) ? "/timelinesearch/{0}/{1}.htm" :
    ((keywordVideo) ? "/timelinesearchvideo/{0}/{1}.htm" :
    ((media) ? "timelinemedia/{0}/{1}.htm" :
    ((newbytype) ? "/timelinenewbytype/{0}/{1}.htm" :
    ((podcast) ? "/timelinepodcast/{0}/{1}.htm" :
    ((magazine) ? "/timelinemagazine/{0}/{1}.htm" :
    ((news) ? "/timelinedetail/{0}/{1}.htm" :
    ((newmostview)?"/timelinemostview/{0}/{1}.htm":
    ((live) ? "/timelinelive/{0}/{1}.htm" :
    ((radio) ? "/timelineradio/{0}/{1}.htm" :
    ((home) ? "/timelinehome/{1}.htm" :
    ((topic) ? "/timelinetopic/{0}/{1}.htm" :
    ((newnews)?"/timelinenewnews/{0}/{1}.htm":"/timelinelist/{0}/{1}.htm"))))))))))))));
    keys = (tag) ? tag : ((keyword) ? keyword : (keywordVideo) ? keywordVideo : ((newbytype)?newbytype:((video)?video:((live)?live:((radio)?radio:((newmostview)?newmostview:((newnews)?newnews:((topic)?topic : zoneID))))))));
    $(window).scroll(function () {
        x = ($(window).scrollTop() + $(window).height()) + 700;
        y = 0;
        if ($('.list__viewmore').length > 0)
            y = ($('.list__viewmore').offset().top);
            if (x >= y && y != 0 && checkScroll == true) {
                if (!home){
                    if (countScroll == 3) {
                        checkScroll = false;
                    }else {
                        var options = {
                            url: urlAjax,
                            keys: keys,
                            page: page
                        }
                        $('.list__center').css({ "display": "none" });
                        $('.box-stream-item-load').css({ "display": "flex" });
                        $('.box-stream-load').css({ "display": "block" });
                        timeline.GetData(options);
                    }
                }else {
                    var options = {
                        url: urlAjax,
                        keys: keys,
                        page: page
                    }
                    $('.list__center').css({ "display": "none" });
                    $('.box-stream-item-load').css({ "display": "flex" });
                    $('.box-stream-load').css({ "display": "block" });
                    timeline.GetData(options);
                }
            }
    });


    $('.list__viewmore').off('click').on('click', function () {
        var options = {
            url: urlAjax,
            keys: keys,
            page: page
        }
        $('.list__center').css({ "display": "none" });
        $('.box-stream-item-load').css({ "display": "flex " });
        $('.box-stream-load').css({ "display": "block" });
        timeline.GetData(options);
    });

    // js load bottom page
    var detailBottom = document.getElementById("insert-detail-bottom");
    var load = true;
    var lx = 0;
    var ly = 0;
    if (detailBottom ) {
        $(window).scroll(function() {
            lx = $(window).scrollTop() + $(window).height();
            if ($("#insert-detail-bottom").length) {
                var newsType = $(detailBottom).attr('news-type');
                ly = $("#insert-detail-bottom").offset().top;
                if (lx >= ly / 2 && load == true) {
                    var url = `/ajax-load-detail-bottom-${newsType}.htm`;
                    getViewBottomPage(url,"#insert-detail-bottom");
                }
            }
        });

    }

    function getViewBottomPage(url,divInsert = null) {  // js cho ds game
        load = false;
        $.ajax({
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            dataType: "html",
            cache: true,
            url: url,timeout: 5000,
            success: function(data) {
                if (data) {
                    timeline.bindDataLoadpage(data,divInsert);
                    $('.list__viewmore').off('click').on('click', function () {
                        var options = {
                            url: urlAjax,
                            keys: keys,
                            page: page
                        }
                        $('.list__center').css({ "display": "none" });
                        $('.box-stream-item-load').css({ "display": "flex " });
                        $('.box-stream-load').css({ "display": "block" });
                        timeline.GetData(options);
                    });
                }
            }
        });
    }

// end js load bottom page

});
//Plugin Loadmore
var checkScroll = true, isLoading = true, countScroll = 0, x = 0, y = 0, page = 2;
var timeline = function () {
    var obj = {
        delaySucces: 1
    }

    function GetData() {
        if (!isLoading)
            return;
        isLoading = false;
        $.ajax({
            url: String.format(obj.url, obj.keys, obj.page),
            method: "GET",
            async: true
        }).done(function (response) {
            countScroll++;
            page++;
            isLoading = true;
            if (response == "" || response==null) {
                checkScroll = false;
                $('.box-stream-item-load').css({ "display": "none" });
                $('.box-stream-load').css({ "display": "none" });
                $('.list__center').css({ "display": "none" })

            }
            else {
                setTimeout(function () {
                    bindData(response);
                    var obj = {};
                    try{

                        //Check trùng item với loadmore
                        var divCheckRemove = $('.box-stream-item-load').parents('.box-category-middle');
                        divCheckRemove.find('.box-category-item').each(function () {
                            var newsId = $(this).attr('data-id');
                            if (typeof newsId != 'undefined') {
                                if (obj[newsId]) {
                                    $(this).remove();
                                } else {
                                    obj[newsId] = true;
                                }
                            }
                        });

                    }catch (e){
                        console.log(e);
                    }



                }, obj.delaySucces);
            }
        }).fail(function (response) {
            isLoading = true;
        })
    }
    function bindData(data) {
        $('.box-stream-item-load').css({ "display": "none" });
        $('.box-stream-load').css({ "display": "none" });
        $('.list__center').css({ "display": "block" });
        $(data).insertBefore('.box-stream-item-load');

        try {
            if ($('.lozad-video').length){
                // mặc định không xoá
                intLozadVideo();
            }
        }catch (e){
            console.log(e);
        }
    }

    function bindDataLoadpage(data,divInsert = null) {
        $(data).insertBefore(divInsert);
        (runinit = window.runinit || []).push(function () {
            $('.box-category-link-title[data-trimline="3"]').trimLine(3);
            $('.box-category-link-title[data-trimline="4"]').trimLine(4);
            $('.box-category-link-title[data-trimline="2"]').trimLine(2);
            $('.box-category-sapo[data-trimline="3"]').trimLine(3);
            try {
                //mặc định không xoá
                if ($('.lozad-video').length) {
                    intLozadVideo();
                }
            }catch (e){
                console.log(e);
            }
        });
    }

    return {
        GetData: function (options) {
            obj = $.extend(obj, options);
            GetData();
        },
        bindDataLoadpage: bindDataLoadpage
    };
}(jQuery);
