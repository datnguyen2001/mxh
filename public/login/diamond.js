//build login/logout header
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
function intAuthen(user) {
    var _link = window.location.pathname;
    if (user) {
        user = checkVefifyEmail(user);
        console.log(user);
        _token = user.access_token;
        sid = user.profile.sid;
        $('#diamond-login').hide();

        $('#diamon-haslogin').css('display', 'flex');
        if (user.profile) {
            $('#diamond_uinfo').text(user.profile.email).attr('href', '/user/profile.htm');

            if (_link == '/thanh-toan.htm') {
                if (user.profile.email_verified) {
                    pagePayments(user);
                }
                else {
                    var urlReturn = appSettings.domain + '/thanh-toan.htm' + '?verify=1';
                    window.location.href = "https://ids.danviet.vn/Account/Confirm?clientId=danviet_diamond&returnUrl=" + urlReturn;
                }
            }
        }

        if (_link == '/thanh-toan-thanh-cong.htm') {
            var billcode = getParameterByName('billcode');
            if (typeof billcode != "undefined" && billcode != '')
                getOrderNo(billcode, _token);
        }

        //load contentdetail
        pageDetail(user);

        // User profile
        if (_link == '/user/profile.htm') {
            userProfile(user);
        }
    }
    else {
        $('#diamond-login').show();

        $('#diamon-haslogin').hide();

        if (_link == '/thanh-toan.htm' || _link == '/user/profile.htm') {
            startSigninMainWindow();
        }
        //load contentdetail
        pageDetail();
    }
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
$(function () {
    $('#diamond-login').on('click', function () {
        startSigninMainWindow();
    });

    $('#diamond-logout').on('click', function () {
        signOut();
    });
    $('#diamond-logoutprofile').on('click', function () {
        signOut();
    });
});

//=====Trang thanh toán
function pagePayments(user) {
    if (user.profile) {
        $('#userEmail').val(user.profile.email);
        $('#userPhone').val(user.profile.phone);
        $('#chkTerm').prop('checked', false);
        $('.news-purchase__policy input').on('change', () => {
            $('.news-purchase__buttons .pay').toggleClass('disabled')
        })

        $('.export-bill-checkbox input').on('change', () => {
            $('.export-bill-form').toggleClass('hidden')
        });

        //get pack
        $.ajax({
            url: appSettings.ajaxDomain + '/api-diamond.htm',
            data: {
                m: 'paypack', token: user.access_token
            },
            xhrFields: { withCredentials: true },
            type: "GET",
            contentType: "text/plain",
            success: function (res) {
                var data = JSON.parse(res);
                if (data.code == 200) {
                    if (data.data != null && data.data.length > 0) {
                        var htmlPayPack = '';
                        var dtpack = data.data.sort(function (a, b) {
                            if (a.price > b.price) {
                                return 1;
                            }
                            if (a.price < b.price) {
                                return -1;
                            }
                            return 0;
                        });
                        var icount = 0;
                        for (var i = 0; i < dtpack.length; i++) {
                            var r = dtpack[i];
                            if (r.status == 1 && r.productType == 1) {

                                htmlPayPack += '<li class="pack-selection__item' + (icount == 0 ? ' active' : '') + '" data-id="' + r.id + '">\
                                                    <span class="bold">' + r.productName + ' </span>\
                                                    <span class="price" data-price='+ r.price + '>' + r.price..format(0, 3, '.', ',') + 'đ</span>\
                                          </li>';
                                icount++;
                            }
                        }
                        $('#loadPayPack').html(htmlPayPack);

                        $('#userPack').html($('.pack-selection__box .pack-selection__item').first().find('.bold').html() + ' (' + $('.pack-selection__box .pack-selection__item').first().find('.price').html() + ')');
                        $('#userPay').html($('.pack-selection__box .pack-selection__item').first().find('.price').html());

                        $('.pack-selection__box .pack-selection__item').each(function () {
                            var $this = $(this);
                            $this.on('click', function () {
                                $('.pack-selection__box .pack-selection__item').removeClass('active');
                                $this.addClass('active');
                                $('#userPack').html($this.find('.bold').html() + ' (' + $this.find('.price').html() + ')');
                                $('#userPay').html($this.find('.price').html());
                            })
                        });
                    }
                }
            }
        });

        //get paymethod
        getPayMethod('#loadPayMethod', user.access_token);

        getUserInfo(user, function (dataUser) {
            if (dataUser != null) {
                if (dataUser.code == 200) {
                    if (dataUser.data != null) {
                        if (dataUser.data.userTax != null) {
                            var tax = dataUser.data.userTax;
                            $('#taxCompany').val(tax.companyName);
                            $('#taxCode').val(tax.taxCode);
                            $('#taxAddress').val(tax.companyAddress);
                            $('#taxEmail').val(tax.companyEmail);
                        }
                        $('#userPhone').val(dataUser.data.phone);
                        clickToPay(dataUser, user.access_token);
                    }
                }
            }
        });
    }
}
function getPayMethod(elm, token) {
    $.ajax({
        url: appSettings.ajaxDomain + '/api-diamond.htm',
        data: {
            m: 'paymethod', token: token
        },
        xhrFields: { withCredentials: true },
        type: "GET",
        contentType: "text/plain",
        success: function (res) {
            var data = JSON.parse(res);
            if (data.code == 200) {
                if (data.data != null && data.data.length > 0) {
                    var htmlPaymethod = '';
                    var paycount = 0;
                    for (var i = 0; i < data.data.length; i++) {
                        var r = data.data[i];
                        if (r.status == 1) {
                            var avt = r.avatar != null && r.avatar != '<p class="payments-selection-name">' + r.name + '</p>' ? '<div class="payments-selection-img-wrap" data-id="' + r.id + '"><img src="' + r.avatar + '" alt="' + r.name + '"></div>' : '';
                            htmlPaymethod += '<div class="payments-selection-option' + (paycount == 0 ? ' active' : '') + '' + (r.avatar == null || r.avatar == '' ? " flex-column" : "") + '">\
                                                ' + avt + '\
                                            </div>';
                            paycount++;
                        }
                    }
                    $(elm).html(htmlPaymethod);

                    $(elm + ' .payments-selection-option').each(function () {
                        var $this = $(this);
                        $this.on('click', function () {
                            $(elm + ' .payments-selection-option').removeClass('active');
                            $this.addClass('active');
                        })
                    });
                }
            }
        }
    });
}

function pageDetail(user) {
    if ($('#contentDetailAjax').length > 0) {
        var newsid = $('#__HFIELD__nid').val();
        var tk = '';
        if (user)
            tk = user.access_token;
        $.ajax({
            url: '/getcontent/newid' + newsid + '.htm',
            headers: { "authorization": tk },
            xhrFields: { withCredentials: true },
            type: "GET",
            success: function (response) {
                var globalobject = $("<div/>").html(response);//.contents();
                $('#contentDetailAjax').html(globalobject);

                setTimeout(function () {
                    //iniDetail.init();
                    initDetailAjax.init();
                    insertAdsContent("k57lxxr9", 2);

                    poll.init();

                    //init download button
                    $('.VCSortableInPreviewMode[type="Audio"]').each(function () {
                        let link = $(this).attr('data-link');
                        if (link) {
                            $(this).prepend('<a href="' + link + '" target="_blank" class="download-button"><img src="http://static.mediacdn.vn/danviet/web_images/download1.jpg" width="20">&nbsp;Tải về</a>')
                        }
                    });
                    //action chua mua goi
                    if ($('#loadPayDetail').length > 0) {
                        if (user) {
                            var urlDetail = $('#__HFIELD__nurl').val();
                            $('#diamond-logindetail').hide();
                            $('.purchase-btn').click(() => {
                                if (user.profile.email_verified) {
                                    $('.news-purchase').addClass('show').fadeIn();;
                                    $('.modal-overlay-dark').addClass('show');
                                    $('body').addClass('showpopup');
                                }
                                else {
                                    window.location.href = "https://ids.danviet.vn/Account/Confirm?clientId=danviet_diamond&returnUrl=" + appSettings.domain + urlDetail + '?verify=1';
                                }
                            });
                        } else {
                            $('#diamond-logindetail').show();
                            $('#diamond-logindetail').on('click', function () {
                                startSigninMainWindow();
                            });
                            $('.purchase-btn').click(() => {
                                startSigninMainWindow();
                            });
                        }

                        $('.close-modal').click(() => {
                            $('.news-purchase').removeClass('show').fadeOut();
                            $('.modal-overlay-dark').removeClass('show');
                            $('body').removeClass('showpopup');
                        });
                        $('.modal-overlay-dark').click(() => {
                            $('.news-purchase').removeClass('show').fadeOut();
                            $('.modal-overlay-dark').removeClass('show');
                            $('body').removeClass('showpopup');
                        });
                        $('.export-bill-checkbox input').on('change', () => {
                            $('.export-bill-form').toggleClass('hidden')
                        });
                        $('.news-purchase__policy input').on('change', () => {
                            $('.news-purchase__buttons .pay').toggleClass('disabled')
                        });

                        getPayMethod('#loadPayMethod', tk);

                        getUserInfo(user, function (dataUser) {
                            if (dataUser != null) {
                                if (dataUser.code == 200) {
                                    if (dataUser.data != null) {
                                        if (dataUser.data.userTax != null) {
                                            var tax = dataUser.data.userTax;
                                            $('#taxCompany').val(tax.companyName);
                                            $('#taxCode').val(tax.taxCode);
                                            $('#taxAddress').val(tax.companyAddress);
                                            $('#taxEmail').val(tax.companyEmail);
                                        }

                                        //get pack
                                        $.ajax({
                                            url: appSettings.ajaxDomain + '/api-diamond.htm',
                                            data: {
                                                m: 'paypack', token: user.access_token
                                            },
                                            xhrFields: { withCredentials: true },
                                            type: "GET",
                                            contentType: "text/plain",
                                            success: function (res) {
                                                var data = JSON.parse(res);
                                                if (data.code == 200) {
                                                    if (data.data != null && data.data.length > 0) {
                                                        for (var i = 0; i < data.data.length; i++) {
                                                            var r = data.data[i];
                                                            if (r.status == 1 && r.productType == 0) {
                                                                $('#hidProductId').val(r.id);
                                                                $('#hidTransAmount').val(r.price);
                                                                $('#packPriceDetail').text(r.price..format(0, 3, '.', ',') + 'đ');
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                        clickToPay(dataUser, user.access_token);
                                    }
                                }
                            }
                        });
                    }
                }, 1000);
            }
        });
    }
}

function getUserInfo(user, callback) {
    if (user) {
        $.ajax({
            url: appSettings.ajaxDomain + '/api-diamond.htm',
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
function clickToPay(data, token) {
    if (!data)
        return false;

    $('#btnPay').on('click', function () {
        if (!$(this).hasClass('disabled')) {
            $(this).addClass('disabled');

            //lưu thông tin hóa đơn
            if ($('#chkSaveTax').is(":checked")) {
                var companyName = $('#taxCompany').val();
                var taxCode = $('#taxCode').val();
                var companyAddress = $('#taxAddress').val();
                var companyEmail = $('#taxEmail').val();
                $.ajax({
                    url: appSettings.ajaxDomain + '/api-diamond.htm',
                    data: {
                        m: 'updtax', token: token, userid: data.data.id, company: companyName, taxcode: taxCode, address: companyAddress, email: companyEmail
                    },
                    xhrFields: { withCredentials: true },
                    type: "GET",
                    contentType: "text/plain",
                    success: function (res) {
                        $(this).removeClass('disabled');
                    }
                });
            }
            //tạo order
            createOrder(data, token);
        }
    });
}
function createOrder(data, token, callback) {
    //tạo order
    var paymethod = $('.payments-selection-option.active').find('.payments-selection-img-wrap').attr('data-id');
    var note = '';
    var isAcceptTerm = $('#chkTerm').is(":checked") == true ? 1 : 0;
    var isReceiptInvoice = true;
    debugger;
    var trans_amount = $('.pack-selection__item.active').find('.price').attr('data-price');
    if (typeof trans_amount == "undefined" || trans_amount == '')
        trans_amount = $('#hidTransAmount').val(); //product mua theo bài chi tiết
    var productId = $('.pack-selection__item.active').attr('data-id');
    if (typeof productId == "undefined" || productId == '')
        productId = $('#hidProductId').val(); //product mua theo bài chi tiết
    var title = typeof $('#__HFIELD__ntitle').val() == "undefined" ? "" : $('#__HFIELD__ntitle').val();
    var newsid = typeof $('#__HFIELD__nid').val() == "undefined" ? "" : $('#__HFIELD__nid').val();

    var companyName = $('#taxCompany').val();
    var taxCode = $('#taxCode').val();
    var companyAddress = $('#taxAddress').val();
    var companyEmail = $('#taxEmail').val();

    if (!paymethod) {
        alert('Bạn chưa chọn phương thức thanh toán!');
        $('#btnPay').removeClass('disabled');
        return false;
    }
    if (!productId) {
        alert('Bạn chưa chọn gói đọc báo!');
        $('#btnPay').removeClass('disabled');
        return false;
    }

    $.ajax({
        url: appSettings.ajaxDomain + '/api-diamond.htm',
        data: {
            m: 'order'
            , token: token
            , paymethod: paymethod
            , email: data.data.email
            , phone: data.data.phone
            , note: note
            , isterm: isAcceptTerm
            , invoice: isReceiptInvoice
            , trans_amount: trans_amount
            , productid: productId
            , title: title
            , newsid: newsid
            , taxcompany: companyName
            , taxcode: taxCode
            , taxaddress: companyAddress
            , taxemail: companyEmail
        },
        type: "POST",
        success: function (res) {
            $('#btnPay').removeClass('disabled');
            if (typeof res != "undefined" && res != null && res != '') {
                console.log(res);
                window.location.href = res;
            }
        }
    });
}

function getOrderNo(billcode, token) {
    $.ajax({
        url: appSettings.ajaxDomain + '/api-diamond.htm',
        data: {
            m: 'getorderno', token: token, billcode: billcode
        },
        xhrFields: { withCredentials: true },
        type: "GET",
        contentType: "text/plain",
        success: function (res) {
            var data = JSON.parse(res);
            var obj = data.data;
            if (obj != null) {
                if (obj.orderDetails != null && obj.orderDetails.length > 0) {
                    var ordetail = obj.orderDetails[0];
                    $('#paystt_name').text('mua gói ' + ordetail.productName + ' thành công!')
                    $('#paystt_expire').text('');
                    if(obj.orderNo)
                    $('#paystt_billcode, #paystt_billcode2').text(obj.orderNo);
                    if (ordetail.productName)
                        $('#paystt_fullname, #paystt_fullname2').text(ordetail.productName);
                    $('#paystt_price, #paystt_price2').text(ordetail.price..format(0, 3, '.', ',') + 'đ');
                    if (obj.paymentMethodName)
                        $('#paystt_method').text(obj.paymentMethodName);
                    $('#paystt_total').text(obj.totalAmount..format(0, 3, '.', ',') + 'đ');

                    var sdate = new Date(obj.purchasedDate).getDate() + '/' + (new Date(obj.purchasedDate).getMonth() + 1) + '/' + new Date(obj.purchasedDate).getFullYear();
                    $('#paystt_date').text(sdate);
                }
            }
        }
    });
}


//User profile
function userProfile(user) {
    $('.account-management__change-password').click(() => {
        $('.change-password').fadeIn();
        $('.modal-overlay-dark').addClass('show');
        $('body').addClass('showpopup');
    });

    $('.close-modal').click(() => {
        $('.modal').fadeOut()
        $('.modal-overlay-dark').removeClass('show')
        $('body').removeClass('showpopup')
    })

    const tabsManageAccount = document.querySelectorAll(".account-management__tab-item");
    const panes = document.querySelectorAll(".account-management__tab-pane-item");

    tabsManageAccount.forEach((tab, index) => {
        const pane = panes[index];

        tab.onclick = function () {
            $(".account-management__tab-item.active").removeClass("active");
            $(".account-management__tab-pane-item.active").removeClass("active");

            this.classList.add("active");
            pane.classList.add("active");
        }
    });
    const packItems = document.querySelectorAll(".pack-selection__item");
    packItems.forEach(pack => {
        pack.onclick = function () {
            $('.pack-selection__item').removeClass("active");
            this.classList.add("active");
        }
    })

    const dataInputs = document.querySelectorAll('.account-management__info-data .data-input-text')
    const dataAcc = document.querySelectorAll('.account-management__info-data .data')
    dataInputs.forEach((input) => {
        input.value = input.previousElementSibling.innerText
    })

    $('.account-management__info-edit.account-edit').click(function () {
        if ($(this).hasClass('editing')) {
            dataAcc.forEach((data, index) => {
                if (data) return;

                if (dataInputs[index].classList.contains('date')) {
                    const saveDate = new Date(dataInputs[index].value)
                    data.innerHTML = `${saveDate.getDate()}/${saveDate.getMonth() + 1}/${saveDate.getFullYear()}`

                    return
                }

                data.innerHTML = dataInputs[index].value
            })

            $('.data-radio').text($('.gender-select input:checked').val())
        }


        dataInputs.forEach((input) => {
            input.value = input.previousElementSibling.innerText
        })
        $(this).toggleClass("editing")
        $('.account-management__account-info .account-management__info-list').toggleClass("editing")
    })

    const billdataInputs = document.querySelectorAll('.account-management__bill-info .account-management__info-data .data-input-text')
    const billdataAcc = document.querySelectorAll('.account-management__bill-info .account-management__info-data .data')

    $('.account-management__info-edit.bill-edit').click(function () {
        if ($(this).hasClass('editing')) {
            billdataAcc.forEach((data, index) => {
                data.innerHTML = billdataInputs[index].value
            })
        }

        billdataInputs.forEach((input) => {
            input.value = input.previousElementSibling.innerText
        })
        $(this).toggleClass("editing")
        $('.account-management__bill-info .account-management__info-list').toggleClass("editing")
    })

    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth() + 1; //January is 0!
    let yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    today = yyyy + '-' + mm + '-' + dd;
    $('.data-input-text.date').attr('max', today);

    $(window).scroll(function () {
        if ($(this).scrollTop() > $('.detail-page__header').height()) {
            $('.detail-page__header').addClass('fixed w-100 top-0 left-0');
        } else {
            $('.detail-page__header').removeClass('fixed')
        }
    });

    //bind data
    getUserInfo(user, function (dataUser) {
        if (dataUser != null && dataUser.code == 200) {
            var json = dataUser.data;
            if (json != null) {
                if (json.avatarReset != null && json.avatarReset != '')
                    $('#u_avatar').attr('src', json.avatarReset);
                if (user.profile.email_verified) {
                    $('.verifymail').addClass('active').text('Đã xác minh');
                } else {
                    var urlReturn = appSettings.domain + '/user/profile.htm' + '?verify=1';
                    var verifyUrl = "https://ids.danviet.vn/Account/Confirm?clientId=danviet_diamond&returnUrl=" + urlReturn;
                    $('.verifymail').html('<a target="_blank" href="' + verifyUrl + '" title="Xác minh địa chỉ email">Chưa xác minh</a>');
                }
                $('#u_name, #u_fulname').text(json.fullName);
                $('#u_code').text(json.code);
                $('#u_email').text(json.email);
                $('#u_phone').text(json.phone);
                if (json.birthday != null && json.birthday != '') {
                    var sdate = new Date(json.birthday).getDate() + '/' + (new Date(json.birthday).getMonth() + 1) + '/' + new Date(json.birthday).getFullYear();
                    $('#u_birth').text(sdate);
                }
                if (json.sex == '1') {
                    $('#u_sex').text('Nam');
                    $('#male').prop('checked', true);
                } else if (json.sex == '2') {
                    $('#u_sex').text('Nữ');
                    $('#female').prop('checked', true);
                }

                if (json.address)
                    $('#u_address').text(json.address);
                //tax
                if (json.userTax != null) {
                    $('#tax_com').text(json.userTax.companyName);
                    $('#tax_code').text(json.userTax.taxCode);
                    $('#tax_address').text(json.userTax.companyAddress);
                    $('#tax_email').text(json.userTax.companyEmail);
                }

                $('#btnSaveUserInfo').on('click', function () {
                    var $this = $(this);
                    if (!$this.hasClass('disabled')) {
                        $this.addClass('disabled');
                        //lưu thông tin user
                        var phone = $('#txtPhone').val();
                        var fullName = $('#txtFullName').val();
                        var birth = $('#txtBirth').val();
                        var address = $('#txtAddress').val();
                        var sex = $('#male').is(":checked") ? "1" : "0";
                        $.ajax({
                            url: appSettings.ajaxDomain + '/api-diamond.htm',
                            data: {
                                m: 'userupdate', token: user.access_token, userid: json.id, phone: phone, fullName: fullName, birth: birth, sex: sex, address: address
                            },
                            xhrFields: { withCredentials: true },
                            type: "POST",
                            success: function (res) {
                                var data = JSON.parse(res);
                                $this.removeClass('disabled');
                                if (data.success) {
                                    $('#u_name, #u_fulname').text(fullName);
                                    $('#u_phone').text(phone);
                                    if (birth != '')
                                        $('#u_birth').text(birth);
                                    if (sex == '1') {
                                        $('#u_sex').text('Nam');
                                        $('#male').prop('checked', true);
                                    } else {
                                        $('#u_sex').text('Nữ');
                                        $('#female').prop('checked', true);
                                    }
                                    $('#u_address').text(address);
                                }
                            }
                        });
                    }
                });
                $('#btnUpdateTax').on('click', function () {
                    if (!$(this).hasClass('disabled')) {
                        //lưu thông tin userTax
                        var companyName = $('#tax_txtcom').val();
                        var taxCode = $('#tax_txtcode').val();
                        var companyAddress = $('#tax_txtaddress').val();
                        var companyEmail = $('#tax_txtemail').val();


                        $.ajax({
                            url: appSettings.ajaxDomain + '/api-diamond.htm',
                            data: {
                                m: 'updtax', token: user.access_token, userid: json.id, company: companyName, taxcode: taxCode, address: companyAddress, email: companyEmail
                            },
                            xhrFields: { withCredentials: true },
                            type: "POST",
                            success: function (res) {
                                var data = JSON.parse(res);
                                if (data.success) {
                                    $('#tax_com').text(companyName);
                                    $('#tax_code').text(taxCode);
                                    $('#tax_address').text(companyAddress);
                                    $('#tax_email').text(companyEmail);
                                }
                                $(this).removeClass('disabled');
                            }
                        });
                    }
                });

                //load lịch sử thanh toán
                UserLoadHistoryPay('#lstHistoryPayment', user, 1, 0);
                $('#btnViewMoreHis').on('click', function () {
                    var $this = $(this);
                    if (!$this.hasClass('disabled')) {
                        $this.addClass('disabled');
                        var pageindex = $(this).attr('data-index');
                        UserLoadHistoryPay('#lstHistoryPayment', user, pageindex, 0, function () {
                            $this.removeClass('disabled');
                            $this.attr('data-index', parseInt(pageindex) + 1);
                        });
                    }
                });
                //load quản lý gói diamond
                UserLoadHistoryPay('#listDiamond', user, 1, 1);
                $('#btnViewMoreDia').on('click', function () {
                    var $this = $(this);
                    if (!$this.hasClass('disabled')) {
                        $this.addClass('disabled');
                        var pageindex = $(this).attr('data-index');
                        UserLoadHistoryPay('#listDiamond', user, pageindex, 1, function () {
                            $this.removeClass('disabled');
                            $this.attr('data-index', parseInt(pageindex) + 1);
                        });
                    }
                });

                if (json.expiredDate != null && json.expiredDate != '') {
                    var packExpire = new Date(json.expiredDate);
                    if (packExpire > new Date()) {
                        $('#u_diamonstatus').text('Gói Diamond đang được kích hoạt');
                        var sdate = new Date(json.expiredDate).getDate() + '/' + (new Date(json.expiredDate).getMonth() + 1) + '/' + new Date(json.expiredDate).getFullYear();
                        $('#u_diamondactive').show().html('Hạn dùng đến ngày <span class="bold">' + sdate + '</span>');
                        $('#u_linkpay').remove();
                    } else {
                        $('#u_diamonstatus').text('Đã hết hạn sử dụng gói Special');
                        $('#u_linkpay').show();
                    }
                }
                else {
                    $('#u_diamonstatus').text('Tài khoản của bạn chưa kích hoạt gói Special');
                    $('#u_linkpay').show();
                }

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
                            $('#excerp').html('* Mật khẩu là dãy ký tự có độ dài từ 8 – 16 ký tự\
                                                    <br />* Phải bao gồm cả chữ (trong bảng chữ cái từ a-z) và số (trong dãy số tự nhiên từ 0-9) \
                                                    <br />* Phải có ít nhất một chữ cái viết thường và một chữ cái viết hoa (trong bảng chữ cái từ a-z) \
                                                    <br />* Phải có ít nhất một ký tự đặc biệt');
                            $this.removeClass('disabled');
                            return false;
                        }

                        if (passwordOld != '' && passwordNew != '' && passwordComfirm != '') {
                            if (passwordNew != passwordComfirm) {
                                $('#excerp').text('Mật khẩu xác nhận chưa khớp!');
                                $this.removeClass('disabled');
                            } else if (passwordOld == passwordNew) {
                                $('#excerp').text('Mật khẩu mới phải khác mật khẩu cũ!');
                                $this.removeClass('disabled');
                            }
                            else {
                                $.ajax({
                                    url: appSettings.ajaxDomain + '/api-diamond.htm',
                                    data: {
                                        m: 'userupdatepass', token: user.access_token, userid: json.id, passwordOld: passwordOld, passwordNew: passwordNew, passwordComfirm: passwordComfirm
                                    },
                                    xhrFields: { withCredentials: true },
                                    type: "POST",
                                    success: function (res) {
                                        var json = JSON.parse(res);
                                        if (json.success) {
                                            $('#excerp').text();
                                            $('.modal').fadeOut()
                                            $('.modal-overlay-dark').removeClass('show')
                                            $('body').removeClass('showpopup')
                                        } else {
                                            if (json.code == 2004) {
                                                $('#excerp').text('Mật khẩu xác nhận chưa khớp!');
                                            }
                                            else if (typeof json.data.PasswordMismatch != "undefined") {
                                                $('#excerp').text('Thông tin mật khẩu cũ không đúng!');
                                            } else if (typeof json.data.PasswordMismatch != "undefined") {
                                                $('#excerp').text('Thông tin mật khẩu xác nhận trùng khớp!');
                                            } else if (typeof json.data.PasswordRequiresNonAlphanumeric != "undefined") {
                                                $('#excerp').text("Phải bao gồm cả chữ (trong bảng chữ cái từ a-z) và số (trong dãy số tự nhiên từ 0-9)");
                                            } else if (typeof json.data.PasswordTooShort != "undefined") {
                                                $('#excerp').text("Mật khẩu là dãy ký tự có độ dài từ 8 – 16 ký tự");
                                            } else if (typeof json.data.PasswordRequiresLower != "undefined") {
                                                $('#excerp').text("Phải có ít nhất một chữ cái viết thường và một chữ cái viết hoa (trong bảng chữ cái từ a-z)");
                                            } else if (typeof json.data.PasswordRequiresUpper != "undefined") {
                                                $('#excerp').text("Phải có ít nhất một chữ cái viết thường và một chữ cái viết hoa (trong bảng chữ cái từ a-z)");
                                            } else {
                                                $('#excerp').text(json.message);
                                            }
                                        }
                                        $this.removeClass('disabled');
                                    }
                                });
                            }
                        } else {
                            $('#excerp').text('Không được để trống các trường!');
                            $this.removeClass('disabled');
                        }
                    }
                });
            }
        }
    });
}
function UserLoadHistoryPay(elm, user, pageindex, product, callback) {
    $.ajax({
        url: appSettings.ajaxDomain + '/api-diamond.htm',
        data: {
            m: 'listorder', token: user.access_token, pageindex: pageindex, pagesize: 10, producttype: product
        },
        xhrFields: { withCredentials: true },
        type: "GET",
        success: function (res) {
            var json = JSON.parse(res);
            var html = '';
            if (json.data.data != null && json.data.data.length > 0) {
                for (var i = 0; i < json.data.data.length; i++) {
                    var r = json.data.data[i];

                    var sdate = new Date(r.purchasedDate).getDate() + '/' + (new Date(r.purchasedDate).getMonth() + 1) + '/' + new Date(r.purchasedDate).getFullYear();
                    $('#paystt_date').text(sdate);
                    var title = '';
                    if (r.orderDetails != null && r.orderDetails.length > 0) {
                        title = r.orderDetails[0].newsTitle != null && r.orderDetails[0].newsTitle != "" ? '<span class="bold">Bài viết</span> - ' + r.orderDetails[0].newsTitle
                            : r.orderDetails[0].productName;
                    }
                    var status = '';
                    if (product == 0) {
                        status = '<div class="status"><span class="pending active">Chờ xác nhận</span></div>';
                        if (r.status == 1)
                            status = '<div class="status"><span class="success active">Thành công</span></div>';
                        else if (r.status == 2)
                            status = '<div class="status"><span class="fail active">Không thành công</span></div>';
                    }

                    html += '<li class="row">\
                                        <div class="number-code">' + r.orderNo + '</div>\
                                        <div class="date">' + sdate + '</div>\
                                        <div class="product">' + title + '</div>\
                                        <div class="total">' + r.totalAmount..format(0, 3, '.', ',') + 'đ</div>\
                                            ' + status + '\
                                    </li>';
                }
            }
            $(elm).parents('.account-management__bill-list').find('.viewmoreorder').show();
            if (json.data.data.length < 10) {
                $(elm).parents('.account-management__bill-list').find('.viewmoreorder').remove();
            }
            $(elm).append(html);
            if (callback && typeof (callback) == "function") {
                callback();
            }
        }
    });
}

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


