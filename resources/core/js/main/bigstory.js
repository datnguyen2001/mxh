function ProcessDetail() {
    //tac gia
    var $source = $('.detail-content p:not([class])').last();
    if ($source.css('text-align') == 'right' && $('.detail-content .detail-author').text() != '') {
        $source.remove();
        $(function () {
            var getTokenQuiz = function (callback) {
                $.ajax({
                    type: 'POST',
                    // url: '/handlers/gettokenquizz.ashx',
                    url: pageSettings.DomainUtils + '/handlers/quiz.ashx',
                    dataType: "json",timeout: 5000,
                    success: function (res) {
                        if (typeof (res) == 'string') res = JSON.parse(res);
                        var data = res.message;
                        if (typeof (data) == 'string') data = JSON.parse(data);
                        callback(data.token);
                    }
                });
            };
            IMSQuizEmbed.init({
                getTokenFunction: getTokenQuiz
            });


        });
    }
    //
}
var big_Stor = {
    fixLinkDetailFooter: function () {
        try {
            var objChange = $('.IMSNoChangeStyle').find('a');
            objChange.css('font-size', '22px');
            var objSym = $.trim(objChange.html());
            if (objSym.indexOf('&gt;') != -1) {
                var title = objSym.replace('&gt;&gt;', '');
                objChange.html(title);
                objChange.attr('title', title);
            }
        } catch (ex) { }

        try {
            var objChange2 = $('.link-content-footer').find('a');
            objChange2.css('font-size', '22px').css('font-weight', 'bold');
            var objSym = $.trim(objChange2.html());
            if (objSym.indexOf('&gt;') != -1) {
                var title = objSym.replace('&gt;&gt;', '');
                objChange2.html(title);
                objChange2.attr('title', title);
            }
        } catch (ex) { }
    },
    FixVideoInContent: function () {
        $('.detail-content').find('.VCSortableInPreviewMode[type=VideoStream]').each(function () {

            var width = $(this).attr('data-width');
            var height = $(this).attr('data-height');
            var src = $(this).attr('data-src');
            var videoId = $(this).attr('videoid');
            //console.log(src);

            src = src.replace('&amp;', '&');
            var param = "0;0;0;0";
            try {
                param = admParamTvc(0);
            } catch (e) {
                console.log("Loi video moi:" + e);
            }

            src = src + "&_videoId=" + videoId;

            //src = src + "&_listsuggest=" ;

            src = src + "&_admParamTvc=" + param;

            var iframe = '<iframe width="' + width + '" height="' + height + '" src="' + src + '" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen scrolling="no">';
            $(this).prepend(iframe);
            //$("#videoid_" + videoId).replace("&nbsp;", "");
            //<div id="videoid_14884" videoid="14884">&nbsp;</div>
            var count = 1;
            $('.detail-content #videoid_' + videoId).each(function () {
                if (count == 2) {
                    $(this).remove();
                }
                count++;
            });
            $('.detail-content').find('.VCSortableInPreviewMode[type=VideoStream]').css("text-align", "center");
        });
    }
}
