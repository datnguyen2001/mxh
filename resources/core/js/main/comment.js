/*Comment detail*/
$(function () {
    if ($('#detail_comment').length){
        comment.init();
    }
});

var comment = function () {
    setuser=false;
    var settings = {
        noLogin: true,
        usingPopup: 0,
        usingCaptcha: 0,
        siteName: '',
        PageIndexComment: 1,
        checkShowLoginVietID: 0,
        checkSendCmDetail: 0,
        username: '',
        useremail: '',
        isSupComment: 0,
        idComment: 0,
        commentContent: '',
        captcha: '',
        avatar: '',
        settings: '',
        orderComment : 2,
        refId : '',
        initPopup:true,
        domain:'',
        pageSize:1,
        newsId:'',
        newsSapo:'',
        newsTitle:'',
        newsUrl:'',
        newsZoneId:'',
        newsDistributionDate:'',
        newsAvatar:'',
        newsObjectType:1

    };

    function initSettings() {
        var setuser = getCookie("_ck_user");
        if(setuser){
            try {
                setuser = JSON.parse(setuser);
                settings.username = setuser.name == null || setuser.name == '' ? setuser.email : setuser.name;
                settings.useremail = setuser.email;
                settings.refId = setuser.id;
                settings.token = setuser._token;
                settings.avatar = setuser.avatar;

            } catch (error) {
                console.log(error)
            }
        }
    }

    function init() {
        var setuser = getCookie("_ck_user");
        if(setuser){
            try {
                setuser = JSON.parse(setuser);
                settings.username = setuser.name == null || setuser.name == '' ? setuser.email : setuser.name;
                settings.useremail = setuser.email;
                settings.refId = setuser.id;
                settings.token = setuser._token;
                settings.avatar = setuser.avatar;

            } catch (error) {
                console.log(error)
            }
        }

        $(".username").val(settings.username);
        $(".useremail").val(settings.useremail);

        var arrEle='#detail_comment';
        settings.siteName =$(arrEle).attr('data-sitename')
        settings.domain =$(arrEle).attr('data-domain-comment')
        settings.pageSize =$(arrEle).attr('page-size')
        settings.newsId =$(arrEle).attr('data-news-id')
        settings.newsSapo =$(arrEle).attr('data-news-sapo')
        settings.newsTitle =$(arrEle).attr('data-news-title')
        settings.newsUrl =$(arrEle).attr('data-news-url')
        settings.newsZoneId =$(arrEle).attr('data-news-zone-id')
        settings.newsDistributionDate =$(arrEle).attr('data-news-distribution-date')
        settings.newsDistributionDate =$(arrEle).attr('data-news-distribution-date')
        settings.newsAvatar =$(arrEle).attr('data-news-avatar')
        $(arrEle).html('<div class="detail__comment notPopUp blNoLogin">\n' +
            '            <div class="box-comment ykcb" id="ykcb-form">\n' +
            '                <div class="title-comment">\n' +
            '                    <p class="text">\n' +
            '                        <span>Bình luận</span>\n' +
            '                    </p>\n' +
            '                </div>\n' +
            '                <div class="t-content">\n' +
            '                    <textarea placeholder="Chia sẻ ý kiến của bạn" class="btn-comment require" id="txt_bl" name="txt_bl"></textarea>\n' +
            '                </div>\n' +
            '                <div class="input-info">\n' +
            '                    <div class="umail">\n' +
            '                        <input type="text" id="emailcmthuong" class="require" placeholder="Nhập email"/>\n' +
            '                    </div>\n' +
            '                    <div class="uname">\n' +
            '                        <input type="text" id="usercmthuong" class="require" placeholder="Họ và tên"/>\n' +
            '                    </div>\n' +
            '                    <div>\n' +
            '                        <input type="hidden" id="pu-usercmthuong" value=""/>\n' +
            '                    </div>\n' +
            '                    <div>\n' +
            '                        <input type="hidden" id="pu-emailcmthuong" value=""/>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="box-bottom">\n' +
            '                    <a href="javascript:;" id="btn_bl" class="btn-submit">Gửi bình luận</a>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '            <div class="cmbl">\n' +
            '                <div class="filter_coment">\n' +
            '                    <a href="javascript:;" class="active" rel="2">Quan tâm nhất</a>\n' +
            '                    <a href="javascript:;" class="" rel="1">Mới nhất</a>\n' +
            '                </div>\n' +
            '                <div class="list-comment content_cm" data-page-size="5">\n' +
            '\n' +
            '                </div>\n' +
            '                <a href="javascript:;" class="view-more" id="ViewMoreComment" style="display: none">Xem tất cả bình luận</a>\n' +
            '            </div>\n' +
            '        </div>')

        pushData(arrEle);
        loadMoreComment('#detail_comment');
        showXemThemDetail(arrEle);
        changeTabComment(arrEle);
        toggelRep(arrEle);
        likeComment();
        sendSubComment(arrEle);
        sendComment(arrEle);
        getCountComment(arrEle);


        // $(".notPopUp .btn-comment").click(function () {
        //
        //     var infoUser = getCookie("_ck_user");
        //     if(!settings.noLogin){
        //         if(!infoUser){
        //             customAlert.alert('Bạn cần đăng nhập để thực hiện chức năng này!',function(){
        //                 $('.login-box').addClass('show')
        //                 $('body').addClass('show-alert-box');
        //             });
        //         }
        //     }
        //
        // });

        $('#commentNologin').on("click", function (){
            $('.alert-box').removeClass('show');
            $('.alert-box').removeClass('login-box');
            $('body').removeClass('show-alert-box');
            $('.detail__comment.notPopUp').addClass('blNoLogin');
            $('#boxCommentPopup .login-comment').addClass('hidden');
            settings.noLogin = true;
        });

        //popup-comment
        if (settings.usingPopup == 1) {
            $(".disablepop").remove();
            sendByPopup(arrEle);
            closePopup();
        } else {
            $(".disablepop").removeClass("disablepop");
            $("#cmt-popup-comment-getinfo").remove();
        }

        // scroll box comment
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const textcomment = urlParams.get('cmtid')
        $( document ).ready(function() {
            if (textcomment) {
                setTimeout(() => {
                    $("html, body").animate({
                        scrollTop: $(".cmbl .list-comment").offset().top - 100
                    }, 1e3)
                }, 2000);
            }
        });

        //Add comment v2
        $(".modal__commentpopup .close-modal").click(function (e) {
            e.preventDefault();
            $('body').removeClass('open-modalcomment');
        });

        $(".scoll-comment").click(function (e) {
            // loadPopupComment();
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $('.detail__comment').offset().top - 200
            }, 1000);
        });

        // $("#detail_comment #ViewMoreComment").click(function (e) {
        //     viewCommentPage(arrEle);
        //     // e.preventDefault();
        //     // loadPopupComment()
        // });
    }

    function innitCommentPopup(){
        var arrEle='#boxCommentPopup';
        if (settings.initPopup){
            loadMoreComment(arrEle);
            showXemThemDetail(arrEle);
            changeTabComment(arrEle);
            toggelRep(arrEle);
            sendComment(arrEle);
            sendSubComment(arrEle);
            settings.initPopup=false;
        }

        // $(arrEle).find(".box-bottom").on("click", ".login-comment",function () {
        //     var infoUser = getCookie("_ck_user");
        //     if(!infoUser){
        //         customAlert.alert('Bạn cần đăng nhập để thực hiện chức năng này!',function(){
        //             $('.login-box').addClass('show')
        //         });
        //     }
        // });
        var height_poup = $("#popupFormComment").height();
        var height_top_box = $("#popupFormComment .box-comment").outerHeight();
        var height_top_box2 = $("#popupFormComment .filter_coment").outerHeight();
        var height_top_bottom = $("#popupFormComment .box-comment-bottom").outerHeight();
        var height_list_cmt = height_poup - height_top_box -height_top_box2 - height_top_bottom;
        $("#popupFormComment .cmbl").css("max-height", "" + height_list_cmt + "px")
        $(arrEle).find('#ViewMoreComment').remove();
    }

    function initLoginPopup() {
        var setuser = getCookie("_ck_user");
        var arrEle='#detail_comment';
        pushData(arrEle);
        if (setuser) {
            try {
                setuser = JSON.parse(setuser);
                settings.username = setuser.name == null || setuser.name == '' ? setuser.email : setuser.name;
                settings.useremail = setuser.email;
                settings.refId = setuser.sub;
                settings.token = setuser._token;
                settings.avatar = setuser.avatar;
            } catch (error) {
                console.log(error)
            }
            console.log(settings.username);
        }
        var siteName=arrEle.attr('data-sitename')
        settings.siteName = siteName;
    }

    function openPopup() {
        $("#cmt-popup-comment-getinfo").css("display", "block")
        $('.login').addClass('show');
    }

    function loadMoreComment(arrEle) {
        $(arrEle).find("#ViewMoreComment").click(function () {
            viewCommentPage(arrEle);
        });

    }


    function toggelRep(arrEle) {
        $(arrEle).find(".cmbl").on("click", ".rep", function () {
            var $this = $(this);
            var dataId = $this.attr("data-id");
            var dataReplyname = $this.attr("data-replyname")!==undefined?$this.attr("data-replyname"):'';
            $(arrEle).find('.formreplaycomment').remove();
            if ($(this).parent('.item-bottom').hasClass('show-formreplay')){
                $(this).parent('.item-bottom').removeClass('show-formreplay')
                $('.show-formreplay').remove();
            }else{
                $(arrEle).find('.show-formreplay').removeClass('show-formreplay');
                $(this).parent('.item-bottom').addClass('show-formreplay');
                $(this).parent('.item-bottom').after(`<div class="item-reply replycmt formreplaycomment">
                            <div class="box-comment">
                                <div class="t-content">
                                    <textarea id="txt_bl${dataId}"  placeholder="Nhập bình luận" class="btn-comment txt_bl require" comment-parent="${dataId}" data-replyname="${dataReplyname}"></textarea>
                                </div>
                                <div class="input-info">
                                    <div class="umail">
                                        <input type="text" id="emailcmthuong${dataId}" class="require" placeholder="Nhập email">
                                    </div>
                                    <div class="uname">
                                        <input type="text" id="usercmthuong${dataId}" class="require" placeholder="Họ và tên">
                                    </div>

                                    <div>
                                        <input type="hidden" id="pu-usercmthuong" value="">
                                    </div>
                                    <div>
                                        <input type="hidden" id="pu-emailcmthuong" value="">
                                    </div>
                                </div>
                                <div class="box-bottom">
                                    <a href="javascript:void(0)" id="btn_bl${dataId}" data-id="${dataId}" class="btn-submit sendSubComment">Gửi bình luận</a>
                                </div>
                            </div>
                        </div>`)
            }



            // showReplyCommentById(arrEle,dataId);
        });
    }

    function sendSubComment(arrEle) {
        $(arrEle).find(".cmbl").on("click", ".sendSubComment", function () {
            var $this = $(this);
            settings.idComment = $this.attr("data-id");
            var  idValueComment = $this.attr("data-id");
            var commentValue =   $(arrEle).find('#txt_bl' + idValueComment).val();
            if (commentValue==undefined){
                commentValue=   $(arrEle).find('#txt_bl' + settings.idComment).val();
            }
            settings.commentContent=commentValue;

            if (!settings.noLogin){
                var infoUser = getCookie("_ck_user");
                if(infoUser) {
                    if (commentValue == "" ) {
                        alert("Vui lòng nhập nội dung bình luận");
                        $(arrEle).find('#txt_bl').blur();
                        return;
                    }else{
                        $(this).addClass('disable');
                        setTimeout(function () {  $(arrEle).find('.cmbl .sendSubComment').removeClass('disable');}, 5000);
                        pushData(arrEle);
                        addComment(arrEle);
                    }
                }else{
                    alert('Bạn cần đăng nhập để thực hiện chức năng này!',function(){
                        $('.login-box').addClass('show')
                    });
                }
            }else {
                settings.useremail= $(arrEle).find('emailcmthuong'+idValueComment).val();
                settings.username=$(arrEle).find('usercmthuong'+idValueComment).val();
                if (devInvalidFrom(`${arrEle} #ReplyComment`+idValueComment)){
                    pushData(arrEle);
                    if (commentValidate(arrEle)) {
                        addComment(arrEle);
                    }
                }
            }

        });
    }

    function sendComment(arrEle) {
        $(arrEle).find("#btn_bl").click(function () {

            settings.idComment = 0;
            if (!settings.noLogin){
                var infoUser = getCookie("_ck_user");

                if(infoUser){
                    if (settings.usingPopup == 1) {
                        //hiện popup-comment nếu tùy chọn = 1
                        var commentValue =  $(arrEle).find("#txt_bl").val();
                        if (commentValue == "") {
                            alert("Vui lòng nhập nội dung bình luận");
                            $(arrEle).find('#txt_bl').unfo;
                            return;
                        }
                        openPopup();
                    } else {
                        var commentValue =  $(arrEle).find("#txt_bl").val();
                        if (commentValue == "") {
                            alert("Vui lòng nhập nội dung bình luận");
                            $(arrEle).find('#txt_bl').blur();
                            return;
                        }
                        $(this).addClass('disable');
                        setTimeout(function () {$('#btn_bl').removeClass('disable');}, 5000);
                        pushData(arrEle);
                        addComment(arrEle);
                    }
                }else{
                    alert('Bạn cần đăng nhập để thực hiện chức năng này!',function(){
                        $('.login-box').addClass('show');
                        $('body').addClass('show-alert-box');
                    });
                }
            }else {
                devInvalidFrom(  `${arrEle} .notPopUp .ykcb`);
                if (devInvalidFrom( `${arrEle} .notPopUp .ykcb`)){
                    pushData(arrEle);
                    if (commentValidate(arrEle)) {
                        addComment(arrEle);
                    }
                }
            }
        });
    }

    function devInvalidFrom(parent){
        $(parent + ' .require').each(function () {
            if($(this).val() == ''){
                $(this).parent().addClass('inval');
            }else {
                $(this).parent().removeClass('inval');
                $(this).parent().removeClass('erroMail');
            }
        });
        if ($(parent + ' .inval').length > 0){
            return false;
        }
        return true;
    }

    function pushData(arrEle) {

        //info
        var targetUserName = `${arrEle} #usercmthuong`;
        var targetEmail = `${arrEle} #emailcmthuong`;
        if (settings.usingPopup == 1) {
            targetUserName =  `${arrEle} #pu-usercmthuong`;
            targetEmail = `${arrEle} #pu-emailcmthuong`;
        } else {
            if (settings.idComment != 0) {
                targetUserName = targetUserName + settings.idComment;
                targetEmail = targetEmail + settings.idComment;
                console.log(targetEmail,targetUserName);
            }
        }
        if (!settings.noLogin){
            var user = settings.username;
            var email = settings.useremail;
        }else {
            var user = ($(targetUserName).val())?$(targetUserName).val():'';
            var email = ($(targetEmail).val())?$(targetEmail).val():'';
        }

        //set cookie
        if (user != settings.username) {
            createCookiePhut("comment-username", user, 30 * 24 * 60);
        }
        if (email != settings.useremail) {
            createCookiePhut("comment-useremail", email, 30 * 24 * 60);
        }

        settings.username = user;
        settings.useremail = email;

        //content
        if (settings.idComment == 0) {
            settings.commentContent = $(arrEle).find("#txt_bl").val();
        } else {
            var dataReplyname = $(arrEle).find('#txt_bl' + settings.idComment).attr("data-replyname")!==undefined?$(arrEle).find('#txt_bl' + settings.idComment).attr("data-replyname"):'';
            if (dataReplyname){
                dataReplyname=`@${dataReplyname}, `;
            }else{
                dataReplyname='';
            }
            var content=$(arrEle).find('#txt_bl' + settings.idComment).val();
            settings.commentContent =dataReplyname+content;
        }


    }

    function commentValidate(arrEle) {
        //validate name
        var targetUserName = `${arrEle} #usercmthuong`;
        var targetEmail = `${arrEle} #emailcmthuong`;

        var vldName = true;

        if (settings.idComment != 0) {
            targetUserName = targetUserName + settings.idComment;
            targetEmail = targetEmail + settings.idComment;
        }
        vldEmail = true;
        if (settings.username == '' || settings.username == 'Họ tên') {
            $(targetUserName).focus();
            vldName = false;
        }else if(settings.useremail == ""){
            vldEmail = false;
        }else {

            if (settings.username!=="undefined" || settings.username!==undefined ){
                settings.username = settings.username.substring(0, 50);
                settings.username = settings.username.replace(",", " ").replace(".", " ");
            }
            if (!echeck(settings.useremail)) {
                $(targetEmail).parent().addClass('erroMail');
                vldEmail = false;
            }
            if (settings.username!=='undefined' || settings.username!=undefined) {
                settings.useremail = settings.useremail.substring(0, 120);
            }
        }

        //return
        if (vldName && vldEmail) {
            pushData(arrEle);
            return true;
        } else {
            return false;
        }
    }

    function sendByPopup(arrEle) {
        $(".sendbypopup").click(function () {
            pushData(arrEle);
            if (commentValidate(arrEle)) {
                addComment(arrEle);
            }
        });
    }

    //popup-comment
    function closePopup() {
        $(".closepucmt").on("click", function () {
            $("#cmt-popup-comment-getinfo").css("display", "none");
        });
    }

    //*Phan tac vu ben web*/
    function refreshCommentCaptcha() {
        $("#imgcaptcha").attr("src", settings.domain + '/api/capcha-comment.htm?t=' + Math.random());
    }

    function refreshCommentCaptchaSub(id) {
        $("#imgcaptcha" + id).attr("src", settings.domain + '/api/capcha-comment.htm?t=' + Math.random());
    }

    function addComment(arrEle) {
        var Name = settings.username/*.replace(/ /gi, '%20')*/;
        var Email = settings.useremail/*.replace(/ /gi, '%20')*/;
        var sContent = settings.commentContent/*.replace(/ /gi, '%20')*/;
        var hidTitle = settings.newsTitle;
        var hidUrl = settings.newsUrl;
        var hidZoneId = settings.newsZoneId;
        var parentId = settings.idComment;
        var objectId = settings.newsId.toString();
        var distributionDate = settings.newsDistributionDate;
        var hdAvatar = settings.newsAvatar;
        var sapo = settings.newsSapo ;
        var objectType = settings.newsObjectType;
        var userid = settings.refId;
        var token = settings.token;
        var checkCookieCM = getCookieLogin("comment"+settings.siteName+ objectId);

        if (checkCookieCM != null && checkCookieCM != "") {
            var dateNow=new Date();
            try {
                var second= 60 - Math.floor(((dateNow.getTime()-checkCookieCM)/1000))
            }catch (e) {
                second=60;
            }
            var display = document.querySelector('#second_comment');
            startTimer(second,display)
            // customAlert.alert('Bạn không thể gửi bình luận liên tục. Xin hãy đợi '+second+' giây nữa.' );
            alert('Bạn không thể gửi bình luận liên tục',function(){
                $('.alert-comment-box').addClass('show')
            });
        }
        else {
            $.ajax({
                type: 'POST',
                url: settings.domain + "/api/insert-comment.htm",
                data: {
                    parentId: parentId,
                    objectId: objectId,
                    userid: userid,
                    objectType: objectType,
                    senderEmail: Email,
                    senderFullName: encodeURI(Name),
                    newsTitle: encodeURI(hidTitle),
                    object_url:  hidUrl,
                    zoneId: hidZoneId,
                    captcha: settings.captcha,
                    usingcaptcha: settings.usingCaptcha,
                    senderAvatar: settings.avatar,
                    SiteName: settings.siteName,
                    nContent: sContent
                },
                timeout: 5000,
                //crosajaxDomain: true,
                success: function (res) {
                    try {
                        res = $.parseJSON(res);
                    } catch (e) {
                        // not json
                    }
                    //alert('msg:' + msg);
                    if (res.status == 1) {
                        $(arrEle).find('.detail__comment input.require').val('');

                        if (settings.noLogin == true){
                            $('.alert-box[ischeck="alert"]').addClass('login-box');
                            $(arrEle).find('.detail__comment').removeClass('blNoLogin');
                            $('#boxCommentPopup .login-comment').removeClass('hidden');
                            settings.noLogin = false;

                            $('.require').each(function () {
                                $(this).parent().removeClass('inval');
                                $(this).parent().removeClass('erroMail');
                            });

                        }
                        // $("#usercmthuong").val("");
                        // $("#emailcmthuong").val("");
                        alert('Bạn đã bình luận thành công và đang chờ duyệt!');
                        $('body').removeClass('open-modalcomment');
                        //alert('co vao 3:' + msg);
                        $(".notification").addClass('show');
                        // $(".modal-bg").css("display", "block");
                        if (parentId == 0) {
                            //comment to
                            $('#txt_bl').val("");
                            $('#cmcaptcha').val('');
                            refreshCommentCaptcha();
                        } else {
                            //comment sub
                            $(arrEle).find('#txt_bl' + parentId).val("");
                            $('#cmcaptcha' + parentId).val('');
                            $(arrEle).find('#ReplyComment' + parentId).hide();
                            refreshCommentCaptchaSub(parentId);
                            refreshCommentCaptcha();
                        }
                        //if (commentID == 0) {
                        let valuesSet = new Date();
                        createCookiePhut("ComentBGT" + objectId, valuesSet.getTime(), 1,false);
                        var display = document.querySelector('#second_comment');
                        startTimer(60,display)
                        display = document.querySelector('#second_comment');
                        if ($("#cmt-popup-comment-getinfo").length > 0) {
                            $("#cmt-popup-comment-getinfo").css("display", "none")
                        }
                        //reset attribute
                        settings.isSupComment = 0;
                        settings.idComment = 0;
                        settings.commentContent = '';
                        // if (!getCookie('_ck_logComment'+objectId)) {
                        //     saveNews(objectId, hidUrl, hdAvatar, '', hidZoneId, distributionDate, 1, objectId, userid, token, hidTitle, sapo, 1)
                        // }
                    }
                    else if (res.status == 2) {
                        var checkCookieCM = getCookieLogin("ComentBGT" + objectId);
                        var dateNow=new Date();
                        try {
                            var second= 60-(Math.floor(((dateNow.getTime()-checkCookieCM)/1000)))
                        }catch (e) {
                            second=60;
                        }

                        var display = document.querySelector('#second_comment');
                        startTimer(second,display)
                        alert('Bạn không thể gửi bình luận liên tục',function(){
                            $('.alert-comment-box').addClass('show')
                        });

                    }
                    else if (res.status == 3) {
                        alert('Mã xác nhận không đúng!');
                        refreshCommentCaptcha();
                    }
                    else {
                        alert('Bạn đã bình luận thất bại!');
                        $('body').removeClass('open-modalcomment');
                    }
                    settings.checkSendCmDetail = 0;
                },
                complete: function () {
                }
            });
        }
    }

    /*Comment*/
    //ham showXemThemDetail() goi dau tien
    function loadListCommentDetail(arrEle,PageIndex, Order, AppOrHtml) {

        var PageSizeComment =  $(arrEle).find('.list-comment').attr('data-page-size');

        //Order 1 la moi nhat 2 la hay nhat
        var newsId = settings.newsId
        var objectType = settings.newsObjectType;

        var url = settings.domain + "/api/list-comment.htm?page=" + PageIndex + "&newsId=" + newsId + "&order=" + Order +
            "&pageSize=" + PageSizeComment + "&objectType=" + objectType + "&SiteName=" + settings.siteName;
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'html',
            timeout: 5000,
            success: function (msg) {
                msg=msg.trim();
                console.log(msg.length);
                $(arrEle).find(".cmbl").removeClass('hidden');
                if ((msg !== null || msg !== " " || msg !== "") && msg.length!==0) {
                    msg = msg.replaceAll("%20", " ");
                    if (AppOrHtml == 1) {
                        $(arrEle).find(".notPopUp .content_cm").append(msg);
                        $(".username").val(settings.username);

                        readMoreTextSimple.container = ".box_cm";
                        readMoreTextSimple.amountWords = 120;
                        readMoreTextSimple.init();
                    } else {
                        $(arrEle).find(".notPopUp .content_cm").html(msg);
                    }

                    if ( $(arrEle).find(".notPopUp .box_cm").length < PageSizeComment) {
                        $(arrEle).find(".notPopUp #ViewMoreComment").hide();
                    } else {
                        $(arrEle).find(".notPopUp #ViewMoreComment").show();
                    }

                    //popup-comment
                    if (settings.usingPopup == 1) {
                        $(arrEle).find(".notPopUp .disablepop").remove();
                    }

                    try {
                        if (getWithExpiry('countComment'+newsId)){
                            var total=$(arrEle).find('.list-comment .user-name').length;
                            var totalComment=getWithExpiry('countComment'+newsId);
                            // console.log(total,totalComment)
                            if (total>=totalComment){
                                $(arrEle).find("#ViewMoreComment").hide();
                            }else{
                                $(arrEle).find("#ViewMoreComment").text(`Xem tất cả bình luận`);
                            }

                        }
                        $(arrEle).find('.detail__comment .time-ago').timeago();
                    }catch (e) {
                        console.log(e);
                    }

                    getReactionByCookie(newsId,settings.refId)
                } else {
                    $(arrEle).find("#ViewMoreComment").hide();
                    $(arrEle).find(".notPopUp .cmbl").hide();

                }
            },
            complete: function () {
            }
        });
    }

    function loadPopupComment() {
        $('body').addClass('open-modalcomment');
        setTimeout(function () {
            $('.modal__commentpopup').fadeIn(50);
        })
        $(".open-modalcomment .modal__bg").click(function (e) {
            e.preventDefault();
            $('body').removeClass('open-modalcomment');
        });
        innitCommentPopup()
    }

    function showReplyCommentById(arrEle,commentId) {

        if ($(arrEle).find("#ReplyComment" + commentId).is(':hidden')) {
            refreshCommentCaptchaSub(commentId);
            $(arrEle).find(".notPopUp #ReplyComment" + commentId).show();
            $(arrEle).find(".notPopUp #ReplyComment" + commentId).removeClass('hidden');
        } else {
            $(arrEle).find(".notPopUp #ReplyComment" + commentId).hide();
            $(arrEle).find(".notPopUp #ReplyComment" + commentId).addClass('hidden');
        }
    }

    function changeTabComment(arrEle){
        $(arrEle).find(".notPopUp .filter_coment").on("click", "a", function () {
            var elm=$(this);
            var orderComment=$(this).attr('rel');
            elm.parent('.filter_coment').children('a').removeClass('active')
            $(this).toggleClass('active');
            settings.orderComment=orderComment;
            settings.PageIndexComment=1;
            showXemThemDetail(arrEle);
        });
    }

    function likeComment(){
        $(".notPopUp .cmbl").on("click", ".like", function () {
            var elm=$(this);
            var cm_id=$(this).attr('data-cmid');
            var cm_total=parseInt($(this).children('.total-like').text());
            if ($(this).hasClass('disable-action')) {
                alert('Bạn đã sử dụng chức năng này. Đợi 1 phút để thao tác tiếp');
                setTimeout(function () {
                    $('[data-cmid="' + cm_id + '"]').removeClass('disable-action');
                }, 60000);
            }else{
                if ($(this).hasClass('active')) {
                    //unlike
                    $(this).removeClass('active');
                    likeCommentAction(elm, cm_id, false, cm_total)
                    $(this).find('.total-like').text(cm_total - 1);
                } else {
                    //like
                    $(this).addClass('active');
                    likeCommentAction(elm, cm_id, true, cm_total)
                    $(this).find('.total-like').text(cm_total + 1);
                }
            }
        });

        $(".notPopUp .cmbl").on("click","[data-act=\"sharefb\"]", function() {
            var n = pageSettings.Domain + $("#hdUrl").val();
            typeof $("#hdUrl").val() == "undefined" && (n = window.location.href);
            n = n + "?cmtid=" + $(this).attr("data-cmid");
            fbClient.shareClick(n)
        })
        $(".notPopUp .cmbl").on("click","[data-act=\"sharetwitter\"]", function() {
            var n = pageSettings.Domain + $("#hdUrl").val();
            typeof $("#hdUrl").val() == "undefined" && (n = window.location.href);
            n = n + "?cmtid=" + $(this).attr("data-cmid");
            var t = screen.width / 2 - 350
                , i = screen.height / 2 - 225
                , r = $(this).parents(".item-content").find(".text-comment").text()
                , u = "https://twitter.com/intent/tweet?refer_source=" + encodeURIComponent(n) + "&url=" + encodeURIComponent(n) + "&text=" + encodeURIComponent(r);
            return window.open(u, "chia sẻ", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=700, height=485, top=" + i + ", left=" + t),
                !1
        })

    }


    function likeCommentAction(elm,commentId,isLike,currReact){
        if (isLike){
            var url=  settings.domain +`/api/like-comment.htm`;
            var reacttype = 1;
        }else{
            var url=  settings.domain +`/api/unlike-comment.htm`;
            reacttype = 0;
        }
        var objectId = $("#hdNewsId").val();
        var objectType = 1;
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                objectId: objectId,
                objectType: objectType,
                comment_id: commentId,
                senderAvatar: settings.avatar,
                SiteName: settings.siteName,
            },
            timeout: 5000,
            success: function (msg) {
                if (msg != null && msg.status) {
                    var datareact = { id: commentId, reacttype: reacttype, total: currReact + 1,action:1 };
                    //setcookie react
                    var  userId='';
                    if (settings.refId!=undefined){
                        userId=settings.refId;
                    }
                    setReactionByCookie(elm, datareact, objectId, userId);
                } else {

                }
            },
            complete: function () {
            }
        });

    }


    function setReactionByCookie(elm, params, objectId, userid) {
        //set cookie react
        var ckCommentReactName = "_CK_CmtReact_" + objectId + '_' + userid;
        var cmtId = elm.attr('data-cmid');
        var arrReact = [params];
        var ckreact = getCookie(ckCommentReactName);
        if (ckreact != null && ckreact != '') {//nếu đã có thì push thêm
            var lstReactCmt = JSON.parse(ckreact);
            // console.log(lstReactCmt,cmtId);
            var isaddArr = true;
            $.map(lstReactCmt, function (item) {
                if (item.id == cmtId) {    // update value cookie nếu check trong cookie có comment id này rồi
                    item.total = params.total;
                    item.reacttype = params.reacttype;
                    item.action = item.action + 1;
                    isaddArr = false;
                    if (item.action>=3){
                        elm.addClass('disable-action');
                    }
                }
            });
            if (isaddArr)   // nếu chưa có newsId này trong cookie thì push thêm vào
                lstReactCmt.push(params);
            createCookiePhut(ckCommentReactName, JSON.stringify(lstReactCmt), 1,false);//1 p
        } else {
            createCookiePhut(ckCommentReactName, JSON.stringify(arrReact), 1,false);//1 p
        }
    }

    function getReactionByCookie (objectId, userid) {
        var ckCommentReactName = "_CK_CmtReact_" + objectId + '_' + userid;
        var _ckreact = getCookie(ckCommentReactName);
        if (_ckreact != null && _ckreact != '') {
            var jsonreact = JSON.parse(_ckreact);
            jsonreact.forEach(function (item) {
                if ($('.list-comment .like[data-cmid="' + item.id + '"]').length > 0) {
                    if (item.reacttype==1){
                        $('.list-comment .like[data-cmid="' + item.id + '"]').addClass('active');
                    }
                    if (item.action>=3){
                        $('.list-comment .like[data-cmid="' + item.id + '"]').addClass('disable-action');
                    }
                }
            });
        }
    }


    function viewCommentPage(arrEle) {
        settings.PageIndexComment++;
        loadListCommentDetail(arrEle,settings.PageIndexComment, settings.orderComment, 1);
    }

    function showXemThemDetail(arrEle) {
        loadListCommentDetail(arrEle,1, settings.orderComment, 0);
        $(arrEle+ ".notPopUp #ViewMoreComment").show();
    }

    function getCookieLogin(c_name) {
        var c_value = document.cookie;
        var c_start = c_value.indexOf(" " + c_name + "=");

        if (c_start == -1) {
            c_start = c_value.indexOf(c_name + "=");
        }
        if (c_start == -1) {
            c_value = null;
        }
        else {
            c_start = c_value.indexOf("=", c_start) + 1;
            var c_end = c_value.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = c_value.length;
            }
            c_value = unescape(c_value.substring(c_start, c_end));
        }
        return c_value;
    }

    function createCookie(name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        }
        else var expires = "";
        value = base64Encode(value);
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function createCookiePhut(name, value, phut,isEncode=true) {
        if (phut) {
            var date = new Date();
            date.setTime(date.getTime() + (phut * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        }
        else var expires = "";
        if (isEncode){
            value = base64Encode(value);
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function getCookie(c_name) {
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf(c_name + "=");
            if (c_start != -1) {
                c_start = c_start + c_name.length + 1;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end == -1) c_end = document.cookie.length;
                return unescape(document.cookie.substring(c_start, c_end));
            }
        }
        return "";
    }

    function eraseCookie(name) {
        createCookie(name, "", -1);
    }

    function setWithExpiry(key, value, ttl) {
        const now = new Date()

        // `item` is an object which contains the original value
        // as well as the time when it's supposed to expire
        const item = {
            value: value,
            expiry: now.getTime() + ttl,
        }
        localStorage.setItem(key, JSON.stringify(item))
    }

    function getWithExpiry(key) {
        const itemStr = localStorage.getItem(key)

        // if the item doesn't exist, return null
        if (!itemStr) {
            return null
        }
        const item = JSON.parse(itemStr)
        const now = new Date()

        // compare the expiry time of the item with the current time
        if (now.getTime() > item.expiry) {
            // If the item is expired, delete the item from storage
            // and return null
            localStorage.removeItem(key)
            return null
        }
        return item.value
    }

    function echeck(str) {
        var at = "@"
        var dot = "."
        var lat = str.indexOf(at)
        var lstr = str.length
        var ldot = str.indexOf(dot)
        if (str.indexOf(at) == -1) {
            return false;
        }

        if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
            return false;
        }

        if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
            return false;
        }

        if (str.indexOf(at, (lat + 1)) != -1) {
            return false;
        }

        if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
            return false;
        }

        if (str.indexOf(dot, (lat + 2)) == -1) {
            return false;
        }

        if (str.indexOf(" ") != -1) {
            return false;
        }
        return true;
    }

    function getCountComment(arrEle){
        var config = {
            "url": settings.domain + "/api/count-list-comment.htm?object_ids="+settings.newsId+"&SiteName="+settings.siteName,
            "method": "GET",
            "timeout": 5000,
        };
        if (getWithExpiry('countComment'+settings.newsId)){
            $('.scoll-comment .icon').append(`<span class="count">${getWithExpiry('countComment'+settings.newsId)}</span>`);
            $('.box-comment [data-count-comment="'+settings.newsId+'"]').html(`<span class="count">${getWithExpiry('countComment'+settings.newsId)}</span>`);
            $('#popupFormComment').attr('data-pagesize',getWithExpiry('countComment'+settings.newsId));
            $('#popupFormComment .list-comment').attr('data-page-size',getWithExpiry('countComment'+settings.newsId));
        }else{
            $.ajax(config).done(function (response) {
                try {
                    response = $.parseJSON(response);
                } catch (e) {
                    // not json
                }
                if (response.success) {
                    try {
                        if (response.data[0].comment_count){
                            console.log(response.data[0].comment_count)
                            $('.scoll-comment .icon').append(`<span class="count">${response.data[0].comment_count}</span>`);
                            $('.box-comment [data-count-comment="'+settings.newsId+'"]').html(`<span class="count">${response.data[0].comment_count}</span>`);
                            $('#popupFormComment').attr('data-pagesize',response.data[0].comment_count);
                            $('#popupFormComment .list-comment ').attr('data-page-size',response.data[0].comment_count);
                            setWithExpiry('countComment'+settings.newsId,response.data[0].comment_count,86400)
                            var totalComment=response.data[0].comment_count;
                            var total=3;
                            if (total>=totalComment){
                                $("#detail_comment #ViewMoreComment").find("#ViewMoreComment").hide();
                            }else{
                                $("#detail_comment #ViewMoreComment").text(`Xem tất cả bình luận`);
                            }
                        }else{
                            $(".notPopUp .cmbl").hide();
                            $("#detail_comment").find(".notPopUp .title-comment .text span").text('Hãy là người đầu tiên bình luận bài viết!');
                            $("#detail_comment").find(".count-comment").addClass('hidden')
                        }
                    }catch (e) {
                        $("#detail_comment").find(".count-comment").addClass('hidden')
                        console.log(e)
                    }

                }else{
                    console.log('log count comment: ' + response.message);
                }
            });
        }

    }

    return {
        init: function (options) {
            $.extend(settings, options);
            init();
        },
        initLoginPopup: function (options) {
            $.extend(settings, options);
            initLoginPopup();
        },
        pushData: pushData,
        initSettings: initSettings,
        addComment: addComment,
        getCountComment: getCountComment,
        commentValidate: commentValidate,
        loadListCommentDetail: loadListCommentDetail,
        inited: false
    };


}(jQuery);

function startTimer(duration, display) {
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    const myInterval=setInterval(timer, 1000);
    function timer() {
        // get the number of seconds that have elapsed since
        // startTimer() was called
        diff = duration - (((Date.now() - start) / 1000) | 0);

        // does the same job as parseInt truncates the float
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent =seconds;

        if (diff <= 0) {
            // add one second so that the count down starts at the full duration
            // example 05:00 not 04:59
            $('.alert-comment-box').removeClass('show');
            clearInterval(myInterval)
            return;
        }
    };
    // we don't want to wait a full second before the timer starts
    timer();

}




var readMoreTextSimple = {
    wrapper: ".ReadMoreText",
    container: ".box_cm",
    amountWords: 40,
    init: function () {
        var me = this;
        var $target = $(me.wrapper);
        $target.each(function (i, obj) {
            var text = obj.innerHTML;

            var textArr = text.split(" ");
            if (textArr.length > me.amountWords) {
                var index = 0;
                for (var i = 0; i < me.amountWords; i++) {
                    if (typeof textArr[i] != "undefined") {
                        index += (1 + textArr[i].length);
                    }
                }

                var textLess = text.substr(0, index);
                var textMore = text.replace(textLess, "");

                var resultText = textLess + "<span class=\"dot\">... </span><span class=\"readMore\" style=\"color: #6093e6;cursor: pointer; display: inline-block;\">&nbsp;xem thêm</span>" +
                    "<span class=\"textMore\" style=\"display: none\">" + textMore ;
                obj.innerHTML = resultText;
            }
        });

        me.readMore();
        me.readLess();
    },
    readMore: function () {
        var me = this;
        var $readMoreTarget = $(me.wrapper).find(".readMore");
        $readMoreTarget.each(function (i, obj) {
            $(this).click(function () {
                var $thisWrapper = $(this).closest(me.wrapper);
                $thisWrapper.find(".dot").css("display", "none");
                $thisWrapper.find(".readMore").css("display", "none");
                $thisWrapper.find(".textMore").slideDown();
                $thisWrapper.find(".textMore").css('display', 'unset');
            });
        });
    },
    readLess: function () {
        var me = this;
        var $readMoreTarget = $(me.wrapper).find(".readLess");
        $readMoreTarget.each(function (i, obj) {
            $(this).click(function () {
                var $thisWrapper = $(this).closest(me.wrapper);
                $thisWrapper.find(".dot").css("display", "inline-block");
                $thisWrapper.find(".readMore").css("display", "inline-block");
                //$thisWrapper.find(".textMore").slideUp();
                var boxTextMore = $thisWrapper.find(".textMore");
                boxTextMore.slideUp();
                $('html, body').animate({
                    scrollTop: boxTextMore.offset().top - 300
                }, 600);
            });
        });
    }

}

String.prototype.replaceAll = function (search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

/********* MD5 encode *********/
var MD5 = function (s) { function L(b, a) { return (b << a) | (b >>> (32 - a)) } function K(k, b) { var F, a, d, x, c; d = (k & 2147483648); x = (b & 2147483648); F = (k & 1073741824); a = (b & 1073741824); c = (k & 1073741823) + (b & 1073741823); if (F & a) { return (c ^ 2147483648 ^ d ^ x) } if (F | a) { if (c & 1073741824) { return (c ^ 3221225472 ^ d ^ x) } else { return (c ^ 1073741824 ^ d ^ x) } } else { return (c ^ d ^ x) } } function r(a, c, b) { return (a & c) | ((~a) & b) } function q(a, c, b) { return (a & b) | (c & (~b)) } function p(a, c, b) { return (a ^ c ^ b) } function n(a, c, b) { return (c ^ (a | (~b))) } function u(G, F, aa, Z, k, H, I) { G = K(G, K(K(r(F, aa, Z), k), I)); return K(L(G, H), F) } function f(G, F, aa, Z, k, H, I) { G = K(G, K(K(q(F, aa, Z), k), I)); return K(L(G, H), F) } function D(G, F, aa, Z, k, H, I) { G = K(G, K(K(p(F, aa, Z), k), I)); return K(L(G, H), F) } function t(G, F, aa, Z, k, H, I) { G = K(G, K(K(n(F, aa, Z), k), I)); return K(L(G, H), F) } function e(k) { var G; var d = k.length; var c = d + 8; var b = (c - (c % 64)) / 64; var F = (b + 1) * 16; var H = Array(F - 1); var a = 0; var x = 0; while (x < d) { G = (x - (x % 4)) / 4; a = (x % 4) * 8; H[G] = (H[G] | (k.charCodeAt(x) << a)); x++ } G = (x - (x % 4)) / 4; a = (x % 4) * 8; H[G] = H[G] | (128 << a); H[F - 2] = d << 3; H[F - 1] = d >>> 29; return H } function B(c) { var b = "", d = "", k, a; for (a = 0; a <= 3; a++) { k = (c >>> (a * 8)) & 255; d = "0" + k.toString(16); b = b + d.substr(d.length - 2, 2) } return b } function J(b) { b = b.replace(/\r\n/g, "\n"); var a = ""; for (var k = 0; k < b.length; k++) { var d = b.charCodeAt(k); if (d < 128) { a += String.fromCharCode(d) } else { if ((d > 127) && (d < 2048)) { a += String.fromCharCode((d >> 6) | 192); a += String.fromCharCode((d & 63) | 128) } else { a += String.fromCharCode((d >> 12) | 224); a += String.fromCharCode(((d >> 6) & 63) | 128); a += String.fromCharCode((d & 63) | 128) } } } return a } var C = Array(); var P, h, E, v, g, Y, X, W, V; var S = 7, Q = 12, N = 17, M = 22; var A = 5, z = 9, y = 14, w = 20; var o = 4, m = 11, l = 16, j = 23; var U = 6, T = 10, R = 15, O = 21; s = J(s); C = e(s); Y = 1732584193; X = 4023233417; W = 2562383102; V = 271733878; for (P = 0; P < C.length; P += 16) { h = Y; E = X; v = W; g = V; Y = u(Y, X, W, V, C[P + 0], S, 3614090360); V = u(V, Y, X, W, C[P + 1], Q, 3905402710); W = u(W, V, Y, X, C[P + 2], N, 606105819); X = u(X, W, V, Y, C[P + 3], M, 3250441966); Y = u(Y, X, W, V, C[P + 4], S, 4118548399); V = u(V, Y, X, W, C[P + 5], Q, 1200080426); W = u(W, V, Y, X, C[P + 6], N, 2821735955); X = u(X, W, V, Y, C[P + 7], M, 4249261313); Y = u(Y, X, W, V, C[P + 8], S, 1770035416); V = u(V, Y, X, W, C[P + 9], Q, 2336552879); W = u(W, V, Y, X, C[P + 10], N, 4294925233); X = u(X, W, V, Y, C[P + 11], M, 2304563134); Y = u(Y, X, W, V, C[P + 12], S, 1804603682); V = u(V, Y, X, W, C[P + 13], Q, 4254626195); W = u(W, V, Y, X, C[P + 14], N, 2792965006); X = u(X, W, V, Y, C[P + 15], M, 1236535329); Y = f(Y, X, W, V, C[P + 1], A, 4129170786); V = f(V, Y, X, W, C[P + 6], z, 3225465664); W = f(W, V, Y, X, C[P + 11], y, 643717713); X = f(X, W, V, Y, C[P + 0], w, 3921069994); Y = f(Y, X, W, V, C[P + 5], A, 3593408605); V = f(V, Y, X, W, C[P + 10], z, 38016083); W = f(W, V, Y, X, C[P + 15], y, 3634488961); X = f(X, W, V, Y, C[P + 4], w, 3889429448); Y = f(Y, X, W, V, C[P + 9], A, 568446438); V = f(V, Y, X, W, C[P + 14], z, 3275163606); W = f(W, V, Y, X, C[P + 3], y, 4107603335); X = f(X, W, V, Y, C[P + 8], w, 1163531501); Y = f(Y, X, W, V, C[P + 13], A, 2850285829); V = f(V, Y, X, W, C[P + 2], z, 4243563512); W = f(W, V, Y, X, C[P + 7], y, 1735328473); X = f(X, W, V, Y, C[P + 12], w, 2368359562); Y = D(Y, X, W, V, C[P + 5], o, 4294588738); V = D(V, Y, X, W, C[P + 8], m, 2272392833); W = D(W, V, Y, X, C[P + 11], l, 1839030562); X = D(X, W, V, Y, C[P + 14], j, 4259657740); Y = D(Y, X, W, V, C[P + 1], o, 2763975236); V = D(V, Y, X, W, C[P + 4], m, 1272893353); W = D(W, V, Y, X, C[P + 7], l, 4139469664); X = D(X, W, V, Y, C[P + 10], j, 3200236656); Y = D(Y, X, W, V, C[P + 13], o, 681279174); V = D(V, Y, X, W, C[P + 0], m, 3936430074); W = D(W, V, Y, X, C[P + 3], l, 3572445317); X = D(X, W, V, Y, C[P + 6], j, 76029189); Y = D(Y, X, W, V, C[P + 9], o, 3654602809); V = D(V, Y, X, W, C[P + 12], m, 3873151461); W = D(W, V, Y, X, C[P + 15], l, 530742520); X = D(X, W, V, Y, C[P + 2], j, 3299628645); Y = t(Y, X, W, V, C[P + 0], U, 4096336452); V = t(V, Y, X, W, C[P + 7], T, 1126891415); W = t(W, V, Y, X, C[P + 14], R, 2878612391); X = t(X, W, V, Y, C[P + 5], O, 4237533241); Y = t(Y, X, W, V, C[P + 12], U, 1700485571); V = t(V, Y, X, W, C[P + 3], T, 2399980690); W = t(W, V, Y, X, C[P + 10], R, 4293915773); X = t(X, W, V, Y, C[P + 1], O, 2240044497); Y = t(Y, X, W, V, C[P + 8], U, 1873313359); V = t(V, Y, X, W, C[P + 15], T, 4264355552); W = t(W, V, Y, X, C[P + 6], R, 2734768916); X = t(X, W, V, Y, C[P + 13], O, 1309151649); Y = t(Y, X, W, V, C[P + 4], U, 4149444226); V = t(V, Y, X, W, C[P + 11], T, 3174756917); W = t(W, V, Y, X, C[P + 2], R, 718787259); X = t(X, W, V, Y, C[P + 9], O, 3951481745); Y = K(Y, h); X = K(X, E); W = K(W, v); V = K(V, g) } var i = B(Y) + B(X) + B(W) + B(V); return i.toLowerCase() };
/********* json2.js *********/
if (typeof JSON !== "object") { JSON = {} } (function () { function f(n) { return n < 10 ? "0" + n : n } if (typeof Date.prototype.toJSON !== "function") { Date.prototype.toJSON = function () { return isFinite(this.valueOf()) ? this.getUTCFullYear() + "-" + f(this.getUTCMonth() + 1) + "-" + f(this.getUTCDate()) + "T" + f(this.getUTCHours()) + ":" + f(this.getUTCMinutes()) + ":" + f(this.getUTCSeconds()) + "Z" : null }; String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function () { return this.valueOf() } } var cx, escapable, gap, indent, meta, rep; function quote(string) { escapable.lastIndex = 0; return escapable.test(string) ? '"' + string.replace(escapable, function (a) { var c = meta[a]; return typeof c === "string" ? c : "\\u" + ("0000" + a.charCodeAt(0).toString(16)).slice(-4) }) + '"' : '"' + string + '"' } function str(key, holder) { var i, k, v, length, mind = gap, partial, value = holder[key]; if (value && typeof value === "object" && typeof value.toJSON === "function") { value = value.toJSON(key) } if (typeof rep === "function") { value = rep.call(holder, key, value) } switch (typeof value) { case "string": return quote(value); case "number": return isFinite(value) ? String(value) : "null"; case "boolean": case "null": return String(value); case "object": if (!value) { return "null" } gap += indent; partial = []; if (Object.prototype.toString.apply(value) === "[object Array]") { length = value.length; for (i = 0; i < length; i += 1) { partial[i] = str(i, value) || "null" } v = partial.length === 0 ? "[]" : gap ? "[\n" + gap + partial.join(",\n" + gap) + "\n" + mind + "]" : "[" + partial.join(",") + "]"; gap = mind; return v } if (rep && typeof rep === "object") { length = rep.length; for (i = 0; i < length; i += 1) { if (typeof rep[i] === "string") { k = rep[i]; v = str(k, value); if (v) { partial.push(quote(k) + (gap ? ": " : ":") + v) } } } } else { for (k in value) { if (Object.prototype.hasOwnProperty.call(value, k)) { v = str(k, value); if (v) { partial.push(quote(k) + (gap ? ": " : ":") + v) } } } } v = partial.length === 0 ? "{}" : gap ? "{\n" + gap + partial.join(",\n" + gap) + "\n" + mind + "}" : "{" + partial.join(",") + "}"; gap = mind; return v } } if (typeof JSON.stringify !== "function") { escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g; meta = { "\b": "\\b", "\t": "\\t", "\n": "\\n", "\f": "\\f", "\r": "\\r", '"': '\\"', "\\": "\\\\" }; JSON.stringify = function (value, replacer, space) { var i; gap = ""; indent = ""; if (typeof space === "number") { for (i = 0; i < space; i += 1) { indent += " " } } else { if (typeof space === "string") { indent = space } } rep = replacer; if (replacer && typeof replacer !== "function" && (typeof replacer !== "object" || typeof replacer.length !== "number")) { throw new Error("JSON.stringify") } return str("", { "": value }) } } if (typeof JSON.parse !== "function") { cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g; JSON.parse = function (text, reviver) { var j; function walk(holder, key) { var k, v, value = holder[key]; if (value && typeof value === "object") { for (k in value) { if (Object.prototype.hasOwnProperty.call(value, k)) { v = walk(value, k); if (v !== undefined) { value[k] = v } else { delete value[k] } } } } return reviver.call(holder, key, value) } text = String(text); cx.lastIndex = 0; if (cx.test(text)) { text = text.replace(cx, function (a) { return "\\u" + ("0000" + a.charCodeAt(0).toString(16)).slice(-4) }) } if (/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, "@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, "]").replace(/(?:^|:|,)(?:\s*\[)+/g, ""))) { j = eval("(" + text + ")"); return typeof reviver === "function" ? walk({ "": j }, "") : j } throw new SyntaxError("JSON.parse") } } }());

function setWithExpiry(key, value, ttl) {
    const now = new Date()

    // `item` is an object which contains the original value
    // as well as the time when it's supposed to expire
    const item = {
        value: value,
        expiry: now.getTime() + ttl,
    }
    localStorage.setItem(key, JSON.stringify(item))
}

function getWithExpiry(key) {
    const itemStr = localStorage.getItem(key)

    // if the item doesn't exist, return null
    if (!itemStr) {
        return null
    }
    const item = JSON.parse(itemStr)
    const now = new Date()

    // compare the expiry time of the item with the current time
    if (now.getTime() > item.expiry) {
        // If the item is expired, delete the item from storage
        // and return null
        localStorage.removeItem(key)
        return null
    }
    return item.value
}

var base64Encode = function (input) {
    var output = "";
    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
    var i = 0;
    input = uTF8Encode(input);
    while (i < input.length) {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);
        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;
        if (isNaN(chr2)) {
            enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
            enc4 = 64;
        }
        output = output + keyString.charAt(enc1) + keyString.charAt(enc2) + keyString.charAt(enc3) + keyString.charAt(enc4);
    }
    return output;
}

var base64Decode = function (input) {
    var output = "";
    var chr1, chr2, chr3;
    var enc1, enc2, enc3, enc4;
    var i = 0;
    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
    while (i < input.length) {
        enc1 = keyString.indexOf(input.charAt(i++));
        enc2 = keyString.indexOf(input.charAt(i++));
        enc3 = keyString.indexOf(input.charAt(i++));
        enc4 = keyString.indexOf(input.charAt(i++));
        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;
        output = output + String.fromCharCode(chr1);
        if (enc3 != 64) {
            output = output + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
            output = output + String.fromCharCode(chr3);
        }
    }
    output = uTF8Decode(output);
    return output;
};

var uTF8Encode = function (string) {
    string = string.replace(/\x0d\x0a/g, "\x0a");
    var output = "";
    for (var n = 0; n < string.length; n++) {
        var c = string.charCodeAt(n);
        if (c < 128) {
            output += String.fromCharCode(c);
        } else if ((c > 127) && (c < 2048)) {
            output += String.fromCharCode((c >> 6) | 192);
            output += String.fromCharCode((c & 63) | 128);
        } else {
            output += String.fromCharCode((c >> 12) | 224);
            output += String.fromCharCode(((c >> 6) & 63) | 128);
            output += String.fromCharCode((c & 63) | 128);
        }
    }
    return output;
};

var uTF8Decode = function (input) {
    var string = "";
    var i = 0;
    var c = c1 = c2 = 0;
    while (i < input.length) {
        c = input.charCodeAt(i);
        if (c < 128) {
            string += String.fromCharCode(c);
            i++;
        } else if ((c > 191) && (c < 224)) {
            c2 = input.charCodeAt(i + 1);
            string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
            i += 2;
        } else {
            c2 = input.charCodeAt(i + 1);
            c3 = input.charCodeAt(i + 2);
            string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3;
        }
    }
    return string;
}

var keyString = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
