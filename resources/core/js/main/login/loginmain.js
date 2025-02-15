//build login/logout header
(runinit = window.runinit || []).push(function () {
    // $('#head_login').hide();
    // $('#head_login_mb').hide();
    var _token = "";
    mgr.getUser().then(function (user) {
        var checkVerify = getParameterByName('verify');
        if (typeof checkVerify != "undefined" && checkVerify == "1") { //load lại token đã verify email
            mgr.signinSilent().then(function (userverify) {
                intAuthen(userverify);
            }).catch(function (e) {
                log("silent renew error", e.message);
            });
            window.history.pushState("", window.document.title, window.location.pathname);
        } else {
            intAuthen(user);

        }
    });
});
function intAuthen(user) {
    var _link = window.location.pathname;
    if (user) {
        user = checkVefifyEmail(user);
        // console.log(user);
        _token = user.access_token;
        sid = user.profile.sid;
        // $('#head_login').hide();
        // $('.detail__login').hide();
        var ckuser = getCookie("_ck_user");
        $('.login-wrap').prop('id','head_islogin')
        $('#head_login').prop('id','').prop('class','header-is-login')
        if (typeof ckuser == "undefined" || ckuser == null || ckuser == '') {
            getUserInfo(user, function (dataUser) {
                if (dataUser != null && dataUser.code == 200) {
                    var json = dataUser.data;
                    if (json != null) {
                        var avt = (json.avatar != null && json.avatar != '') ? json.avatar : json.avatarReset;
                        var user = { id: json.id, name: json.fullName, email: json.email, avatar: avt };
                        setCookie("_ck_user", JSON.stringify(user), 60);
                        var uname = json.fullName == null || json.fullName == '' ? json.email : json.fullName;
                        $('#head_islogin .h_name').text(uname);
                        if ($('.ykcb').length){
                            $('#usercmthuong').val(uname);
                            $('#emailcmthuong').val(juser.email);
                        }
                        if (avt!=null && avt!=''){
                            $('.header-icon-user').attr('src', avt);
                        }
                        $('#head_islogin #head_u_name').text(uname);
                    }
                }
            });
        } else {
            var juser = JSON.parse(ckuser);
            var uname = juser.name == null || juser.name == '' ? juser.email : juser.name;
            if ($('.ykcb').length){
                $('#usercmthuong').val(uname);
                $('#emailcmthuong').val(juser.email);
            }
            $('#head_islogin .h_name').text(uname);
            if (juser.avatar!=null && juser.avatar!=''){
                $('#head_islogin img.h_avatar').attr('src', juser.avatar);
                $('#head_islogin_mb img.h_avatar').attr('src', juser.avatar);
            }
            $('#head_islogin #head_u_name').text(uname);

        }

        let profileMenu = document.querySelector(".header__profile");
        let loginHeader = document.querySelector(".header-is-login");

        loginHeader.addEventListener("click", function (event) {
            event.stopPropagation();
            profileMenu.style.display = "inline-block";
        });

        document.addEventListener("click", function (event) {
            if (!profileMenu.contains(event.target) && !loginHeader.contains(event.target)) {
                profileMenu.style.display = "none";
            }
        });

        getUserLiked(user)

        if ($('.btn-follow').length){
            $(document).on('click','.btn-follow',function (e){
                e.preventDefault()
                userFollow($(this))
            })
        }

        // User profile
        if (_link == '/thong-tin-tai-khoan.htm' || _link == '/thong-tin-tai-khoan/doi-mat-khau.htm'
            || _link == '/thong-tin-tai-khoan/tin-da-xem.htm'   || _link == '/thong-tin-tai-khoan/binh-luan.htm'
            || _link == '/thong-tin-tai-khoan/tin-da-luu.htm') {
            userProfile(user, _link);
        }

        //Add history view detail
        var newsidDetail = $('#hdNewsId').val();
        if (typeof newsidDetail != "undefined" && newsidDetail != "") {
            var title = $('#hdNewsTitle').val();
            var url = $('#hdUrl').val();
            var avatar = $('#hdAvatar').val();
            var sapo = $('#hdSapo').val();
            var type = $('#hdType').val();
            var distributionDate = $('#distributionDate').val();
            var cklogDetail = getCookie("_ck_log" + newsidDetail);
            if (typeof cklogDetail == "undefined" || cklogDetail == null || cklogDetail == '') {
                $.ajax({
                    url:'/api/userprofile.htm',
                    data: {
                        m: 'historyview', token: user.access_token, newsid: newsidDetail, title: htmlDecode(title), link: url, sapo: htmlDecode(sapo), avatar: avatar,distributionDate:distributionDate,type:type
                    },
                    type: "POST",
                    success: function (res) {
                        var json = JSON.parse(res);
                        if (json.success) {
                            console.log('log ok: ' + json.data);
                            setCookie("_ck_log" + newsidDetail, true, 5);
                        } else {
                            console.log('log enought: ' + json.message);
                        }
                    }
                });
            }

            //save tin
            // var cklogDetailSave = getCookie("_ck_logsave" + newsidDetail);
            // if (cklogDetailSave)
            //     $('.btnSaveNews').addClass('active').find('span').text('Đã lưu');

            $('.btnSaveNews').on('click', function () {
                var $this = $(this);
                if (!$this.hasClass('active')) {
                    if (typeof cklogDetailSave == "undefined" || cklogDetailSave == null || cklogDetailSave == '') {
                        $.ajax({
                            url: '/api/userprofile.htm',
                            data: {
                                m: 'interactionread', token: user.access_token, newsid: newsidDetail, title: htmlDecode(title), link: url, sapo: htmlDecode(sapo), avatar: avatar, isimportant: true
                                ,distributionDate:distributionDate,type:type
                            },
                            type: "POST",
                            success: function (res) {
                                var json = JSON.parse(res);
                                if (json.success) {
                                    setCookie("_ck_logsave" + newsidDetail, true, 525600); //expire 1 năm
                                    alert('Lưu bài viết thành công!')
                                    $this.addClass('active').find('span').text('Bỏ lưu');
                                } else {
                                    console.log('log enought: ' + json.message);
                                }
                            }
                        });
                    }
                }else{

                    $.ajax({
                        url: '/api/userprofile.htm',
                        data: {
                            m: 'removeboomarknewsid', token: user.access_token, newsid: newsidDetail
                        },
                        type: "POST",
                        success: function (res) {
                            var json = JSON.parse(res);
                            if (json.success) {
                                setCookie("_ck_logsave" + newsidDetail, true, 0); //expire 1 năm
                                alert('Bỏ lưu bài viết thành công!')
                                $('.btnSaveNews').find('span').text('Lưu');
                                $('.btnSaveNews').removeClass('active');
                            } else {
                                console.log('log enought: ' + json.message);
                            }
                        }
                    });
                }
            });

            $.ajax({
                url: '/api/userprofile.htm',
                data: {
                    m: 'checkboomarknewsid', token: user.access_token, newsid: newsidDetail
                },
                type: "POST",
                success: function (res) {
                    var json = JSON.parse(res);
                    if (json.data) {
                        setCookie("_ck_logsave" + newsidDetail, true, 525600); //expire 1 năm
                        $('.btnSaveNews').find('span').text('Bỏ lưu');
                    } else {
                        console.log('log enought: ' + json.message);
                    }
                }
            });


        }
        //Filter
        $('#select_type').change(function() {
            var type = $('#select_type').find('option:selected').val();
            getInteractionread(1, 5, user.access_token, true,type);
        });

        if ($('.btn-like').length){
            $('.btn-like').each(function (){
                const newsId = $(this).attr('data-newsid')
                const userLike = getCookie(`_user_like_${newsId}`)
                if (userLike){
                    $(`.btn-like[data-newsid=${newsId}]`).addClass('active').find('span').text(userLike)
                }
            });
        }

        $(document).on('click','.btn-like',function (){
            const $this = $(this)
            const getUser = getCookie('_ck_user')
            if (getUser.length){
                const newsid = $this.attr('data-newsid'),
                    siteid = $this.attr('data-siteid'),
                    zoneid = $this.attr('data-zoneid'),
                    objecttype = $this.attr('data-objecttype')
                const data = {newsid, siteid, zoneid, objecttype}
                let likeCount = parseInt($this.attr('data-like-count'));

                let userData = JSON.parse(getUser);
                data.userid = userData.id
                data.email = userData.email

                const userLike = getCookie(`_user_like_${newsid}`)

                if(userLike.length){
                    $.ajax({
                        url: 'https://nc97.cnnd.vn/remove-votereaction.api',
                        xhrFields: { withCredentials: true },
                        data:{
                            newsid: newsid,
                            type: 3,
                            siteid: siteid,
                            zoneid: zoneid,
                            userid: userData.id
                        },
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (data){
                            likeCount -= 1
                            $(`.btn-like[data-newsid=${newsid}]`)
                                .removeClass('active')
                                .attr('data-like-count',likeCount)
                                .find('span')
                                .text(likeCount)
                            setCookie(`_user_like_${newsid}`,'',-1)
                        }
                    })
                } else {
                    if ($this.attr('data-liked') === '1'){
                        $.ajax({
                            url: 'https://nc97.cnnd.vn/remove-votereaction.api',
                            xhrFields: { withCredentials: true },
                            data:{
                                newsid: newsid,
                                type: 3,
                                siteid: siteid,
                                zoneid: zoneid,
                                userid: userData.id
                            },
                            type: 'POST',
                            dataType: 'JSON',
                            success: function (data){
                                likeCount -= 1
                                $(`.btn-like[data-newsid=${newsid}]`)
                                    .removeClass('active')
                                    .attr('data-like-count',likeCount)
                                    .find('span')
                                    .text(likeCount)
                                setCookie(`_user_unlike_${newsid}`,likeCount,15)
                            }
                        })
                    } else {
                        $.ajax({
                            url: '/insert-vote.htm',
                            xhrFields: { withCredentials: true },
                            data,
                            type: 'POST',
                            dataType: 'JSON',
                            success:function (data){
                                if (!data.Success){
                                    let msg = '';
                                    switch (data.Type){
                                        case 1006: msg = 'Không đủ điểm'; break;
                                        case 1005: msg = 'Lỗi hệ thống'; break;
                                        case 1004: msg = 'Lỗi API'; break;
                                        case 1003: msg = 'Không tìm thấy user'; break;
                                        case 1002: msg = 'Sai định dạng User'; break;
                                        case 1001: msg = 'Lỗi hệ thống'; break;
                                        case 1007: msg = 'Đã vote'
                                    }
                                    if(msg !== '') alert(msg);
                                } else {
                                    likeCount += 1
                                    $(`.btn-like[data-newsid=${newsid}]`)
                                        .addClass('active')
                                        .attr('data-like-count',likeCount)
                                        .find('span')
                                        .text(likeCount)
                                    setCookie(`_user_like_${newsid}`,likeCount,15)
                                }
                            },
                            error:function (xhr, status, error){
                                console.log(error)
                            }
                        })
                    }
                }
            } else {
                startSigninMainWindow();
            }
        })
    }
    else {
        $('#head_login').css('display','flex');
        $('#head_login_mb').css('display','flex');
        $('#head_islogin').hide();
        if (_link == '/thong-tin-tai-khoan.htm' || _link == '/thong-tin-tai-khoan/doi-mat-khau.htm' || _link == '/thong-tin-tai-khoan/binh-luan.htm'
            || _link =='/thong-tin-tai-khoan/tin-da-luu.htm' || _link == '/thong-tin-tai-khoan/tin-da-xem.htm') {

            startSigninMainWindow();
        }

        $('.btnSaveNews').on('click', function () {
            startSigninMainWindow();
        });

        $(document).on('click','.btn-like',function (){
            startSigninMainWindow();
        })

        $(document).on('click','.btn-follow',function (e){
            e.preventDefault()
            startSigninMainWindow();
        })

        setCookie("_ck_user", null, -1);
    }
}

function userProfile(user, _link) {
    //bind data
    // $('.prf_menu li').each(function () {
    //     var $this = $(this);
    //     $this.on('click', function () {
    //         $('.prf_menu li').removeClass('active');
    //         $(this).addClass('active');
    //         var tab = $(this).attr('data-tab');
    //         $('.prf_tabcontent').hide();
    //         $('#prf_' + tab).fadeIn(200);
    //     });
    // });
    $('.menuactivity li').each(function () {
        var $this = $(this);
        $this.on('click', function () {
            $('.menuactivity li').removeClass('active');
            $(this).addClass('active');
            var tab = $(this).attr('data-tab');
            $('.prf_atvtab').hide();
            $('#atv_' + tab).fadeIn(200);
            if (tab == "view") {
                getListHistoryView(1, 9, user.access_token);
            }
            if (tab == 'comment') {
                getListHistoryComment(1, 9, user.access_token);
            }
        });
    });
    getUserInfo(user, function (dataUser) {
        if (dataUser != null && dataUser.code == 200) {
            var json = dataUser.data;
            if (json.status===0){
                setCookie("_ck_user", null, -1);
                signOut();
            }
            if (json != null) {
                if (json.avatarReset != null && json.avatarReset != '')
                    $('#u_avatar').attr('src', json.avatarReset);
                if (user.profile.email_verified) {
                    $('.verifymail').addClass('active').text('Đã xác minh');
                } else {
                    var urlReturn =pageSettings.Domain+'/user/profile.htm' + '?verify=1';
                    var verifyUrl = "https://idscungcau1.cnnd.vn/Account/Confirm?clientId=cungcau_diamond&returnUrl=" + urlReturn;
                    $('.verifymail').html('<a target="_blank" href="' + verifyUrl + '" title="Xác minh địa chỉ email">Chưa xác minh</a>');
                }
                var avt = (json.avatar != null && json.avatar != '') ? json.avatar : json.avatarReset;
                if (avt != null && avt != '') {
                    $('#prf_avatar1').attr('src', avt);
                    $('#prf_avatar').attr('src', avt);
                }
                $('#prfUsername').text(json.fullName);
                $('#prfEmail').text(json.email);
                $('#txt_email').val(json.email);
                $('#txt_uname').val(json.fullName);
                $('#txt_phone').val(json.phone);
                if (json.birthday != null && json.birthday != '') {
                    // $("#prf_days option[value=" + new Date(json.birthday).getDate() + "]").attr('selected', 'selected');
                    // $("#prf_months option[value=" + (new Date(json.birthday).getMonth() + 1) + "]").attr('selected', 'selected');
                    // $("#prf_years option[value=" + new Date(json.birthday).getFullYear() + "]").attr('selected', 'selected');
                    var date=new Date(json.birthday);
                    var year = date.getFullYear();
                    var month = date.getMonth()+1;
                    var dt = date.getDate();
                    // $('#txt_date').val(date.toISOString().substring(0,10));
                    $('#txt_date').val(dt+'/'+month+'/'+year);
                }
                if (json.sex == '1') {
                    $('#male').prop('checked', true);
                } else if (json.sex == '2') {
                    $('#female').prop('checked', true);
                }
                else {
                    $('#other').prop('checked', true);
                }
                // //lấy tỉnh thành
                // getProvinceCode(user, function () {
                //     if (json.provinceCode)
                //         $('#prf_city option[value="' + json.provinceCode + '"]').attr('selected', 'selected');
                // });
               if (_link=='/thong-tin-tai-khoan/tin-da-xem.htm'){
                   // tin đã xem
                   getListHistoryView(1, 5, user.access_token);

               }else if(_link=='/thong-tin-tai-khoan/binh-luan.htm'){
                   //tin đã bình luận
                   getListHistoryComment(1, 5, user.access_token);

               }else if(_link=='/thong-tin-tai-khoan/tin-da-luu.htm'){
                   var type = $('#select_type').find('option:selected').val();
                   // tin đã lưu
                   getInteractionread(1, 5, user.access_token, true,type);
               }
                if (json.address)
                    $('#txt_address').val(json.address);

                $('.icoupload').click(function (e) {
                    $("#fileupload").click();
                });
                $('#fileupload').change(function (e) {
                    e.preventDefault();
                    //fasterPreview(this);
                    //upload ảnh khi ấn lưu
                    uploadImage();
                });

                $('#btnSaveProfile').on('click', function () {
                    var $this = $(this);
                    if (!$this.hasClass('disabled')) {

                        //lưu thông tin user
                        var phone = $('#txt_phone').val();
                        var fullName = $('#txt_uname').val();
                        // if ($('#prf_days option:selected').val() == '0' || $('#prf_months option:selected').val() == '0' || $('#prf_years option:selected').val() == '0') {
                        //     alert('Bạn vui lòng nhập đủ ngày/tháng/năm sinh!');
                        //     $this.removeClass('disabled');
                        //     return false;
                        // }
                        if ($('#txt_date').val() == '0' ) {
                            alert('Bạn vui lòng nhập đủ ngày/tháng/năm sinh!');
                            $this.removeClass('disabled');
                            return false;
                        }
                        //Regex for Valid Characters i.e. Numbers.
                        var regex = /^0(3|5|7|8|9){1}[0-9]{4}[0-9]{4}$/;

                        //Validate TextBox value against the Regex.
                        var isValid = regex.test(phone);
                        if (!isValid) {
                            alert("Số điện thoại không hợp lệ!");
                            $('#txt_phone').focus();
                            return false;
                        }
                        $this.addClass('disabled');
                        var avatar = $('#prf_avatar').attr('src');
                        // var birth = $('#prf_months option:selected').val() + '/' + $('#prf_days option:selected').val() + '/' + $('#prf_years option:selected').val();
                        var birth =  $('#txt_date').val();
                        var address = $('#txt_address').val();
                        var sex = $('#male').is(":checked") ? "1" : ($('#female').is(":checked") ? "2" : "0");
                        var provinceCode = $('#prf_city option:selected').val()
                        $.ajax({
                            url:  '/api/userprofile.htm',
                            data: {
                                m: 'userupdate', token: user.access_token, userid: json.id, phone: phone, fullName: fullName, birth: birth, sex: sex, address: address, provinceCode: provinceCode, avatar: avatar
                            },
                            xhrFields: { withCredentials: true },
                            type: "POST",
                            success: function (res) {
                                var data = JSON.parse(res);
                                $this.removeClass('disabled');
                                if (data.success) {
                                    setCookie("_ck_user", null, -1);
                                    alert('Cập nhật thông tin thành công!');
                                } else {
                                    alert('Cập nhật thất bại! Vui lòng thử lại sau ít phút!');
                                    console.log(data.message);
                                }
                            }
                        });
                    }
                });
                //Đổi mật khẩu
                $('#btnChangePass').on('click', function () {
                    var $this = $(this);
                    if (!$this.hasClass('disabled')) {
                        $this.addClass('disabled');
                        var passwordOld = $('#old-password').val();
                        var passwordNew = $('#new-password').val();
                        var passwordComfirm = $('#confirm-password').val();

                        var regexPass = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$";
                        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/.test(passwordNew)) {
                            alert('* Mật khẩu là dãy ký tự có độ dài từ 8 – 16 ký tự \
                                                    \n* Phải bao gồm cả chữ (trong bảng chữ cái từ a-z) và số (trong dãy số tự nhiên từ 0-9) \
                                                    \n* Phải có ít nhất một chữ cái viết thường và một chữ cái viết hoa (trong bảng chữ cái từ a-z) \
                                                    \n* Phải có ít nhất một ký tự đặc biệt');
                            $this.removeClass('disabled');
                            return false;
                        }

                        if (passwordOld != '' && passwordNew != '' && passwordComfirm != '') {
                            if (passwordNew != passwordComfirm) {
                                console.log('Mật khẩu xác nhận chưa khớp!');
                                alert('Mật khẩu xác nhận chưa khớp!');
                                $this.removeClass('disabled');
                            } else if (passwordOld == passwordNew) {
                                alert('Mật khẩu mới phải khác mật khẩu cũ!');
                                $this.removeClass('disabled');
                            }
                            else {
                                $.ajax({
                                    // url: pageSettings.ajaxDomainUser + '/userprofile.htm',
                                    url: '/api/userprofile.htm',
                                    data: {
                                        m: 'userupdatepass', token: user.access_token, userid: json.id, passwordOld: passwordOld, passwordNew: passwordNew, passwordComfirm: passwordComfirm
                                    },
                                    xhrFields: { withCredentials: true },
                                    type: "POST",
                                    success: function (res) {
                                        var json = JSON.parse(res);
                                        if (json.success) {
                                            $this.removeClass('disabled');
                                            alert('Mật khẩu đã được thay đổi');
                                            window.location='/thong-tin-tai-khoan.htm';
                                        } else {
                                            if (json.code == 2004) {
                                                alert('Mật khẩu xác nhận chưa khớp!');
                                            }
                                            else if (json.data == null) {
                                                alert(json.message);
                                            } else {
                                                if (typeof json.data.PasswordMismatch != "undefined") {
                                                    alert('Thông tin mật khẩu cũ không đúng!');
                                                } else if (typeof json.data.PasswordMismatch != "undefined") {
                                                    alert('Thông tin mật khẩu xác nhận trùng khớp!');
                                                } else if (typeof json.data.PasswordRequiresNonAlphanumeric != "undefined") {
                                                    alert("Phải bao gồm cả chữ (trong bảng chữ cái từ a-z) và số (trong dãy số tự nhiên từ 0-9)");
                                                } else if (typeof json.data.PasswordTooShort != "undefined") {
                                                    alert("Mật khẩu là dãy ký tự có độ dài từ 8 – 16 ký tự");
                                                } else if (typeof json.data.PasswordRequiresLower != "undefined") {
                                                    alert("Phải có ít nhất một chữ cái viết thường và một chữ cái viết hoa (trong bảng chữ cái từ a-z)");
                                                } else if (typeof json.data.PasswordRequiresUpper != "undefined") {
                                                    alert("Phải có ít nhất một chữ cái viết thường và một chữ cái viết hoa (trong bảng chữ cái từ a-z)");
                                                } else {
                                                    alert(json.message);
                                                }
                                            }
                                        }
                                        $this.removeClass('disabled');
                                    }
                                });
                            }
                        } else {
                            alert('Không được để trống các trường!');
                            $this.removeClass('disabled');
                        }
                    }
                });
                $('#showpass').on('change', function () {
                    viewPass('old-password');
                    viewPass('new-password');
                    viewPass('confirm-password');
                });

            }
        }else{
            setCookie("_ck_user", null, -1);
            signOut();
        }
    });
}

//function fasterPreview(uploader) {
//    if (uploader.files && uploader.files[0]) {
//        $('#prf_avatar').attr('src',
//            window.URL.createObjectURL(uploader.files[0]));
//    }
//}

function uploadImage() {
    var formData = new FormData();
    formData.append('File', $('#fileupload').get(0).files[0]);
    formData.append('ns', 'cungcau');
    console.log($('#fileupload').get(0).files[0])
    $.ajax({
        //url: 'http://local.apisocial.vn/Handlers/UploadStorageHandler.ashx',
        url: pageSettings.DomainUtils + '/Handlers/UploadStorageHandler.ashx',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        contentType: false,
        cache: false,
        processData: false,
        type: 'POST',
        beforeSend: function () {
            $('.avtmain').addClass('loading');
            $('#btnSaveProfile').addClass('disable');
        },
        success: function (json) {
            var data = JSON.parse(json)
            if (data.Success) {
                $('#prf_avatar').attr('src', pageSettings.imageDomain + data.Data);
            } else {
                alert('Lỗi tải ảnh lên, vui lòng thử lại sau!');
            }
            $('.avtmain').removeClass('loading');
            $('#btnSaveProfile').removeClass('disable');
        },
        error: function () {
            alert('Lỗi tải ảnh lên, vui lòng thử lại sau!')
            $('.avtmain').removeClass('loading');
            $('#btnSaveProfile').removeClass('disable');
        }
    });
}
function getProvinceCode(user, callback) {
    if (user) {
        $.ajax({
            url: '/api/userprofile.htm',
            data: {
                m: 'provincecode', token: user.access_token
            },
            xhrFields: { withCredentials: true },
            type: "GET",
            contentType: "text/plain",
            success: function (res) {
                var json = JSON.parse(res);
                if (json.success) {
                    var data = json.data;
                    if (data != null && data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            $('#prf_city').append('<option value="' + data[i].iso + '">' + data[i].label + '</option>')
                        }

                        if (callback && typeof (callback) == "function") {
                            callback(data)
                        }
                    }
                }
            }
        });
    }
}

function getUserInfo(user, callback) {
    if (user) {
        $.ajax({
            url: '/api/userprofile.htm',
            data: {
                m: 'userinfo', token: user.access_token
            },
            xhrFields: { withCredentials: true },
            type: "GET",
            contentType: "text/plain",
            success: function (res) {
                var data = JSON.parse(res);
                if (callback && typeof (callback) == "function") {
                    callback(data)
                }
            }
        });
    }
}
function getListHistoryView(page, pagesize, token, isimportant) {
    if (typeof isimportant == "undefined")
        isimportant = 'false';
    $.ajax({
        // url: pageSettings.ajaxDomainUser + '/userprofile.htm',
        url: '/api/userprofile.htm',
        data: {
            m: 'gethistoryview', token: token, pageindex: page, pagesize: pagesize, isimportant: isimportant
        },
        xhrFields: { withCredentials: true },
        type: "GET",
        contentType: "text/plain",
        beforeSend: function () {
            var elm = $('#lstView');
            if (isimportant == 'true')
                elm = $('#lstSave');
            elm.append('<div style="display: flex;justify-content: center;" class="loading"><img style="width: fit-content" src="https://static.mediacdn.vn/nld/Images/loading.gif"/></div>');
        },
        success: function (res) {
            var json = JSON.parse(res);
            if (json.success) {
                if (json.data != null) {
                    var total = json.data.total;
                    var elm = $('#lstView');
                    var elmpage = $('#atv_view .page');
                    if (isimportant == 'false') {
                        $('#prfCountView').text(total);
                    }
                    else {
                        $('#prfCountSave').text(total);
                        elm = $('#lstSave');
                        elmpage = $('#atv_save .page');
                    }
                    $('.loading').remove()
                    if (json.data.data != null && json.data.data.length > 0) {
                        var html = '';
                        for (var i = 0; i < json.data.data.length; i++) {
                            var r = json.data.data[i];
                            html += '<div class="search__item">\
                                        <a href="' + r.url + '" class="search__item--img" title="' + r.title + '">\
                                        <img src="' + thumbImage(r.avatar, 269, 168) + '" alt="' + r.title + '" class="search__item--img__v2">\
                                        </a>\
                                        <div>\
                                            <a href="' + r.url + '" class="search__item--title">' + r.title + '</a>\
                                            <p class="search__item--des">' + r.sapo + '</p>\
                                            <a href="javascript:;" class="search__item--tag" title="' + r.title + '"></a>\
                                            <p class="search__item--time time-ago" title="'+r.distributionDate+'">' + formatDate(r.distributionDate) + '</p>\
                                            <div class="detail__tag--right">\
                                                <div class="fb-like" data-href="' +pageSettings.Domain+ r.url + '" data-layout="button_count" data-size="small" data-action="like" data-show-faces="false" data-share="false"></div>\
                                                <a onclick="fbClient.shareClick(\'' +pageSettings.Domain+ r.url + '\');" href="javascript:; " rel="nofollow" class=" kbwcs-fb detail__tag--right__button"><i class="sprite-detail sprite-icon-fb-detail"></i><span>Chia sẻ</span></a>\
                                                <a class="detail__tag--right__button" target="_blank" rel="nofollow"\
                                                        href="https://twitter.com/intent/tweet?text=' +pageSettings.Domain+ r.url + '"\
                                                        data-size="large"><i class="sprite-detail sprite-icon-twitter-detail"></i><span>Chia sẻ</span></a>\
                                                <div class=" zalo-share-button zalo-share " data-href="' +pageSettings.Domain+ r.url + '" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false><i class="sprite-detail sprite-icon-zalo-detail"></i><span>Chia sẻ</span></div>\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                        elm.append(html);
                        $(".time-ago").timeago();
                        fbClient.init();
                        $('.zalo-share:not(.inited)').share({
                            appId: "4480473846126001397",
                            layout: "1",
                            color: "blue",
                            customize: "false",
                            customize_html: "",
                            href: $('.zalo-share:not(.inited)').attr('data-href')
                        }).addClass('inited');
                    }
                }
                elmpage.html('');
                if (total > pagesize) {
                    var numpage = total % pagesize == 0 ? parseInt(total / pagesize) : parseInt(total / pagesize) + 1;
                    elmpage.append('<a  class="search__more--button"  href="javascript:;" onclick="getListHistoryView(' + (page+1) + ',' + pagesize + ', \'' + token + '\',\'' + isimportant + '\');" title="Xem thêm">Xem thêm </a>');
                    //
                    // for (var i = 0; i < numpage; i++) {
                    //     var spl = i != numpage - 1 ? '|' : '';
                    //     elmpage.append('<a ' + (page == i + 1 ? ' class="active"' : '') + ' href="javascript:;" onclick="getListHistoryView(' + (i + 1) + ',' + pagesize + ', \'' + token + '\',\'' + isimportant + '\');" title="trang ' + (i + 1) + '">' + (i + 1) + '</a>' + spl);
                    // }
                }
                if (page ==numpage){
                    $('#atv_view').remove()
                }
            }
        }
    });
}


function getInteractionread(page, pagesize, token, isimportant,type,loadmore=null) {
    if (typeof isimportant == "undefined")
        isimportant = 'false';
    $.ajax({
        // url: pageSettings.ajaxDomainUser + '/userprofile.htm',
        url: '/api/userprofile.htm',
        data: {
            m: 'getinteractionread', token: token, pageindex: page, pagesize: pagesize, isimportant: isimportant,type:type
        },
        xhrFields: { withCredentials: true },
        type: "GET",
        contentType: "text/plain",
        beforeSend: function () {
            var elm = $('#lstView');
            if (isimportant == 'true')
                elm = $('#lstSave');
            $('#atv_view .page').html('')
            if (loadmore===1){
                elm.append('<div style="display: flex;justify-content: center;" class="loading"><img style="width: fit-content!important" src="https://static.mediacdn.vn/nld/Images/loading.gif"/></div>');
            }
            else{
                elm.html('<div style="display: flex;justify-content: center;" class="loading"><img style="width: fit-content!important" src="https://static.mediacdn.vn/nld/Images/loading.gif"/></div>');
            }

        },
        success: function (res) {
            var json = JSON.parse(res);
            if (json.success) {
                $('.loading').remove()
                if (json.data != null) {
                    var total = json.data.total;
                    var elm = $('#lstView');
                    var elmpage = $('#atv_view .page');
                    if (isimportant == 'false') {
                        $('#prfCountView').text(total);
                    }
                    else {
                        $('#prfCountSave').text(total);
                        elm = $('#lstSave');
                        elmpage = $('#atv_save .page');
                    }
                    $('.loading').remove()
                    if (json.data.data != null && json.data.data.length > 0) {
                        var html = '';
                        for (var i = 0; i < json.data.data.length; i++) {
                            var r = json.data.data[i];
                            html += '<div class="search__item">\
                                        <a href="' + r.url + '" class="search__item--img" title="' + r.title + '">\
                                        <img src="' + thumbImage(r.avatar, 269, 168) + '" alt="' + r.title + '" class="search__item--img__v2">\
                                        </a>\
                                        <div>\
                                            <a href="' + r.url + '" class="search__item--title">' + r.title + '</a>\
                                            <p class="search__item--des">' + r.sapo + '</p>\
                                            <a href="javascript:;" class="search__item--tag" title="' + r.title + '"></a>\
                                            <p class="search__item--time time-ago" title="'+r.distributionDate+'">' + formatDate(r.distributionDate) + '</p>\
                                            <div class="detail__tag--right">\
                                                <div class="fb-like" data-href="' +pageSettings.Domain+ r.url + '" data-layout="button_count" data-size="small" data-action="like" data-show-faces="false" data-share="false"></div>\
                                                <a onclick="fbClient.shareClick(\'' +pageSettings.Domain+ r.url + '\');" href="javascript:; " rel="nofollow" class=" kbwcs-fb detail__tag--right__button"><i class="sprite-detail sprite-icon-fb-detail"></i><span>Chia sẻ</span></a>\
                                                <a class="detail__tag--right__button" target="_blank" rel="nofollow"\
                                                        href="https://twitter.com/intent/tweet?text=' +pageSettings.Domain+ r.url + '"\
                                                        data-size="large"><i class="sprite-detail sprite-icon-twitter-detail"></i><span>Chia sẻ</span></a>\
                                                <div class=" zalo-share-button zalo-share " data-href="' +pageSettings.Domain+ r.url + '" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false><i class="sprite-detail sprite-icon-zalo-detail"></i><span>Chia sẻ</span></div>\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                        elm.append(html);
                        $(".time-ago").timeago();
                        fbClient.init();
                        $('.zalo-share:not(.inited)').share({
                            appId: "4480473846126001397",
                            layout: "1",
                            color: "blue",
                            customize: "false",
                            customize_html: "",
                            href: $('.zalo-share:not(.inited)').attr('data-href')
                        }).addClass('inited');
                    }
                }
                elmpage.html('');
                if (total > pagesize) {
                    var type = $('#select_type').find('option:selected').val();
                    var numpage = total % pagesize == 0 ? parseInt(total / pagesize) : parseInt(total / pagesize) + 1;
                    elmpage.append('<a  class="search__more--button"  href="javascript:;" onclick="getInteractionread(' + (page+1) + ',' + pagesize + ', \'' + token + '\',\'' + isimportant + '\',\'' + type + '\',1);" title="Xem thêm">Xem thêm </a>');
                }
                if (page==numpage){
                    $('#atv_save').remove()
                }
            }
        }
    });
}
function getListHistoryComment(page, pagesize, token) {
    $.ajax({
        url:  '/api/userprofile.htm',
        data: {
            m: 'gethistorycomment', token: token, pageindex: page, pagesize: pagesize
        },
        xhrFields: { withCredentials: true },
        type: "GET",
        contentType: "text/plain",
        beforeSend: function () {
            $('#lstComment').append('<div style="display: flex;justify-content: center;" class="loading"><img style="width: fit-content" src="https://static.mediacdn.vn/nld/Images/loading.gif"/></div>');
        },
        success: function (res) {
            var json = JSON.parse(res);
            if (json.success) {
                $('.loading').remove()
                if (json.data != null) {
                    var total = json.data.total;
                    $('#prfCountComment').text(total);
                    if (json.data.data != null && json.data.data.length > 0) {
                        var html = '';
                        for (var i = 0; i < json.data.data.length; i++) {
                            var r = json.data.data[i];
                            html += '<div class="search__item">\
                                        <a href="' + r.url + '" class="search__item--img" title="' + r.title + '">\
                                        <img src="' + thumbImage(r.avatar, 269, 168) + '" alt="' + r.title + '" class="search__item--img__v2">\
                                        </a>\
                                        <div>\
                                            <a href="' + r.url + '" class="search__item--title">' + r.title + '</a>\
                                            <p class="search__item--des">' + r.sapo + '</p>\
                                            <a href="javascript:;" class="search__item--tag" title="' + r.title + '"></a>\
                                            <p class="search__item--time time-ago" title="'+r.distributionDate+'">' + formatDate(r.distributionDate) + '</p>\
                                            <div class="detail__tag--right">\
                                                <div class="fb-like" data-href="' +pageSettings.Domain+ r.url + '" data-layout="button_count" data-size="small" data-action="like" data-show-faces="false" data-share="false"></div>\
                                                <a onclick="fbClient.shareClick(\'' +pageSettings.Domain+ r.url + '\');" href="javascript:; " rel="nofollow" class=" kbwcs-fb detail__tag--right__button"><i class="sprite-detail sprite-icon-fb-detail"></i><span>Chia sẻ</span></a>\
                                                <a class="detail__tag--right__button" target="_blank" rel="nofollow"\
                                                        href="https://twitter.com/intent/tweet?text=' +pageSettings.Domain+ r.url + '"\
                                                        data-size="large"><i class="sprite-detail sprite-icon-twitter-detail"></i><span>Chia sẻ</span></a>\
                                                <div class=" zalo-share-button zalo-share " data-href="' +pageSettings.Domain+ r.url + '" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false><i class="sprite-detail sprite-icon-zalo-detail"></i><span>Chia sẻ</span></div>\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                        if (page==1){
                            $('#lstComment').html(html);
                        }else{
                            $('#lstComment').append(html);
                        }
                        $(".time-ago").timeago();
                        fbClient.init();
                        $('.zalo-share:not(.inited)').share({
                            appId: "4480473846126001397",
                            layout: "1",
                            color: "blue",
                            customize: "false",
                            customize_html: "",
                            href: $('.zalo-share:not(.inited)').attr('data-href')
                        }).addClass('inited');
                    }
                }
                $('#atv_comment .page').html('');
                if (total > pagesize) {
                    var numpage = total % pagesize == 0 ? parseInt(total / pagesize) : parseInt(total / pagesize) + 1;
                        $('#atv_comment .page').append('<a  class="search__more--button"  href="javascript:;" onclick="getListHistoryComment(' + (page+1) + ',' + pagesize + ', \'' + token + '\');" title="Xem thêm">Xem thêm </a>');
                    if (page==numpage){
                        $('#atv_comment').remove()
                    }
                }
            }
        }
    });
}
function checkVefifyEmail(user) {
    var checkVerify = getParameterByName('verify');
    if (typeof checkVerify != "undefined" && checkVerify == "1") {
        mgr.signinSilent().then(function (userverify) {
            _token = user.access_token;
            user = userverify;
        }).catch(function (e) {
            log("silent renew error", e.message);
        });

        window.history.pushState("", window.document.title, window.location.pathname);
    }
    return user;
}

function getUserLiked(){
    let userData = getCookie('_ck_user');
    if (userData.length){
        userData = JSON.parse(userData)
        $.ajax({
            url: 'https://nc97.cnnd.vn/get-votebyuser.api',
            data: {
                userid: userData.id,
                type: 3,
                pageindex: 1,
                pagesize: 1000
            },
            xhrFields: { withCredentials: true },
            type: "GET",
            dataType: 'json',
            success:function (data){
                // let newsIds = []
                if (data.Success === true){
                    data.Data.map(function (item){
                        let userUnlike = getCookie(`_user_unlike_${item.NewsId}`)
                        if (userUnlike.length){
                            $(`.btn-like[data-newsid=${item.NewsId}]`).attr('data-liked',0).removeClass('active')
                        } else {
                            $(`.btn-like[data-newsid=${item.NewsId}]`).attr('data-liked',1).addClass('active')
                        }
                    })
                }
            }
        })
    }
}

function userFollow($el){
    let userData = getCookie('_ck_user');
    if (userData.length){
        userData = JSON.parse(userData)
        let data = {
            newsid: $el.attr('data-author-id'),
            type: 4,
            siteid: $el.attr('data-siteid'),
            zoneid: $el.attr('data-zoneid'),
            objecttype: $el.attr('data-objecttype'),
            userid: userData.id,
            email: userData.email
        }

        $.ajax({
            url: 'https://nc97.cnnd.vn/add-votereaction.api',
            data,
            xhrFields: { withCredentials: true },
            type: "POST",
            dataType: 'json',
            success:function (data){
                if (data.Success){
                    $el.addClass('active').find('.icon').addClass('hidden');
                    $el.find('span').text('Đã theo dõi')
                }
            },
            error:function (err){
                console.log(err)
            }
        })
    }
}


(runinit = window.runinit || []).push(function () {
    $(function () {
        $('#head_login').on('click', function () {
            startSigninMainWindow();
        });
        $('#head_login_mb').on('click', function () {
            startSigninMainWindow();
        });
        $('#head_login_mb_detail').on('click', function () {
            startSigninMainWindow();
        });
        $(document).on('click', '#head_login_detail', function () {
            startSigninMainWindow();
        });

        $('#head_logout').on('click', function () {
            setCookie("_ck_user", null, -1);
            signOut();
        });
        $('#btn_logout').on('click', function () {
            setCookie("_ck_user", null, -1);
            signOut();
        });
        $('#btn-logoutprofile').on('click', function () {
            setCookie("_ck_user", null, -1);
            signOut();
        });
        $('#btn-follow').on('click',function (){
            startSigninMainWindow();
        })
    });

});




function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function viewPass(id) {
    var x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function htmlDecode(input) {
    var doc = new DOMParser().parseFromString(input, "text/html");
    return doc.documentElement.textContent;
}
function formatDate(date) {
    try {
        var date = new Date(date);

        return date.getHours() + ":" + date.getMinutes() + ", " + date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
    } catch (e) {
        console.log(e)
        return '';
    }
}
function thumbImage(img, w, h) {
    if (typeof img == "undefined" || img == null)
        return "";

    if (img.startsWith('http'))
        return img;

    img = pageSettings.imageDomain + '/zoom/' + w + '_' + h + '/' + img;
    return img;
}
/*Cookie*/
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

function setCookie(c_name, value, exdays) {
    var exdate = new Date();
    exdate.setMinutes(exdate.getMinutes() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString()) + ';path=/';
    document.cookie = c_name + "=" + c_value;
}

let linkUrl = document.querySelector('meta[name="asset-url"]').getAttribute("content");
const menu = document.querySelector(".mobile-menu");
const toggleMenuBtn = document.querySelector(".icon-tab-header-mobile");
let isMenuOpen = false;

toggleMenuBtn.addEventListener("click", function () {
    if (!isMenuOpen) {
        menu.style.right = "0";
        toggleMenuBtn.src = linkUrl+"image/icon-close-menu.png";
        toggleMenuBtn.classList.add("menu-open");
    } else {
        menu.style.right = "-100%";
        toggleMenuBtn.src = linkUrl+"image/tab-header-mobile.png";
        toggleMenuBtn.classList.remove("menu-open");
    }
    isMenuOpen = !isMenuOpen;
});

// Đóng menu khi click ra ngoài
document.addEventListener("click", function (event) {
    if (!menu.contains(event.target) && !toggleMenuBtn.contains(event.target)) {
        menu.style.right = "-100%";
        toggleMenuBtn.src = linkUrl+"image/tab-header-mobile.png";
        toggleMenuBtn.classList.remove("menu-open");
        isMenuOpen = false;
    }
});
