$(document).ready(function() {

    (runinit = window.runinit || []).push(function () {
        if ($('#contactform').length) {
            registerContact('#contactform', '', pageSettings.ajaxDomain + '/api-sendemail.htm');
        }

    });

    // Khi nhấn vào khu vực đặt câu hỏi
    $(".text-content-ask-questions,.btn-send-ask-questions").click(function () {
        $(".modal-background").fadeIn();
    });

    // Khi nhấn vào nút đóng hoặc nền mờ
    $(".close-popup, .modal-background1").click(function () {
        $(".modal-background").fadeOut();
    });

    function registerContact(ele, formtype, url) {
        var contact = $(ele);
        if (!contact.length || url == null || url == "") return;
        var validExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
        var input = contact.find('input, textarea');
        var select = contact.find('select');
        var send = contact.find('.submit');
        var reset = contact.find('.reset');
        var crefresh = contact.find('.change-capcha');
        var cimg = contact.find('.captcha-img');
        //var txterr = contact.find('.txtErr');

        var txtName = contact.find('.fname'),
            txtAddress = contact.find('.faddress'),
            txtEmail = contact.find('.femail'),
            txtPhone = contact.find('.fphone'),
            txtSubject = contact.find('.ftitle'),
            txtContent = contact.find('.fcontent'),
            inputFile = contact.find('.file'),
            txtCaptcha = contact.find('.fcaptcha'),
            removeFile = contact.find('.removefile')
        txtLinhvuc = contact.find('.flinhvuc');


        function stripHtml(html) {
            html = html.replace(/[<][\/]?[a-z0-9-]+\s*(\s*[a-z0-9-]+([=]?["']?[^>]*["']?)?)*\s*[>]/ig, " ").trim()
                .replace(/--/ig, " ").trim()
                //.replace(/[\*\+=\\\/]/ig, " ").trim()
                .replace(/"/g, " ").replace(/^\s+|\s+$/g, " ").trim()
            var temporalDivElement = document.createElement("div");
            temporalDivElement.innerHTML = html;
            return temporalDivElement.textContent || temporalDivElement.innerText || "";
        }

        inputFile.change(function (e) {
            e.preventDefault();
            var files = $(".file").get(0).files;
            if (files.length > 0) {
                $('.customfile p').text(files[0].name)
            }
            removeFile.removeClass('disabled');
        });

        removeFile.on('click', function () {
            inputFile.val('');
            $('.customfile p').text('Không có tệp nào được chọn');
        });

        crefresh.click(function (e) {
            e.preventDefault();
            cimg.attr('src', pageSettings.ajaxDomain + '/capcha-sendqa.htm?c=1&siteid=174&v=' + new Date().getTime());
        });

        function resetInput() {
            input.val('');
            select.find("option").eq(0).prop('selected', true);
        }

        reset.click(function (e) {
            e.preventDefault();
            resetInput();
        });

        var MAX_FILE_SIZE = 8 * 1024 * 1024;

        send.click(function (e) {
            e.preventDefault();
            var cksenqa = getcookie('sendqa');
            if (cksenqa != null) {
               alert('Bạn đã gửi câu hỏi, vui lòng quay lại sau 10 phút');
               return false;
            }
            var check = true;
            $(input).each(function () {
                if ($(this).attr('required') != undefined) {
                    var value = $(this).val().trim();
                    if (!value) {
                        alert("Vui lòng nhập đầy đủ các trường thông tin bắt buộc!")
                        $(this).focus();
                        check = false;
                        return false;
                    }
                }
                if ($(this).attr('maxlength') != undefined) {
                    var value = $(this).val().trim().length;
                    if (value > parseInt($(this).attr("maxlength"))) {
                        alert("Không thể nhập quá " + $(this).attr(maxlength) + "ký tự!")
                        $(this).focus();
                        check = false;
                        return false;
                    }
                }
                if ($(this).attr('type') != undefined) {
                    let type = $(this).attr('type')
                    if (type == "email") {
                        var testEmail = /^[A-Z0-9._%+-]+@[A-Z0-9]+\.[A-Z]{2,4}$/i;
                        if (!testEmail.test($(this).val())) {
                            alert("Email không đúng định dạng!")
                            $(this).focus();
                            check = false;
                            return false;
                        }

                    } else if (type == "tel") {
                        var testphone = /^[0-9-+() ]+$/i;
                        if (!testphone.test($(this).val())) {
                            alert("Số điện thoại không đúng định dạng!")
                            $(this).focus();
                            check = false;
                            return false;
                        }
                    } else if (type == "file") {
                        var files = $(this).get(0).files;

                        if (files.length > 0) {
                            var fileNameExt = files[0].name.substr(files[0].name.lastIndexOf('.') + 1);
                            if ($.inArray(fileNameExt, validExtensions) < 0) {
                                alert("Vui lòng kiếm tra lại File!");
                                check = false;
                                return false;

                            }
                            if (files[0].size > MAX_FILE_SIZE) {
                                alert("Vui lòng kiếm tra lại File!");
                                check = false;
                                return false;

                            }
                        }
                    }
                }
            });

            if (check) {
                sendContact();
            }
        });

        function sendContact() {
            var formData = new FormData();
            formData.append('name', stripHtml('Khách'));
            formData.append('subject', stripHtml('Gửi câu hỏi site Cungcau.vn'));
            formData.append('email', stripHtml(txtEmail.val()));
            formData.append('content', stripHtml(txtContent.val()));
            formData.append('Captcha', stripHtml(txtCaptcha.val()));
            formData.append('SiteName', pageSettings.commentSiteName);
            formData.append('siteid', 174);

            $.ajax({
                url: url,
                data: formData,
                xhrFields: {
                    withCredentials: true
                },
                contentType: false,
                cache: false,
                processData: false,
                type: 'POST',
                //beforeSend: function () {
                //    send.addClass('sending');
                //    send.text('Đang gửi...')
                //},
                success: function (data) {
                    console.log(211,data)
                    if (data == "invalid_captcha") {
                        alert("Sai mã captcha!");
                        crefresh.click();
                        txtCaptcha.focus();
                        txtCaptcha.val('');
                        //send.removeClass('sending');
                        //send.text('Gửi');
                    } else {
                        var date = new Date(data);
                        if (date != "Invalid Date") {
                            var d1 = new Date();
                            date.setMinutes(date.getMinutes() + 10);
                            if (date > d1) {
                                var tx = (date.getMinutes() - d1.getMinutes());
                                var alr = (date.getMinutes() - d1.getMinutes()) + ' phút';
                                if (tx <= 0)
                                    alr = date.getSeconds() - d1.getSeconds() + ' giây';
                                alert('Bạn hãy gửi câu hỏi sau: ' + alr);
                            }
                            crefresh.click();
                            //send.removeClass('sending');
                            //send.text('Gửi');
                            return;
                        }
                        if (data == "Success!" || data == 'True') {
                            savecookie('sendqa', 1);
                            resetInput();
                            crefresh.click();
                            inputFile.val('');
                            // $('.customfile p').text('Không có tệp nào được chọn');
                            //send.removeClass('sending');
                            //send.text('Gửi');
                            alert("Gửi thành công!");
                            // $(".modal-background").slideUp();
                            $('.close-popup').click();
                        } else if (data.indexOf('Fail') > 0) {
                            crefresh.click();
                            //send.removeClass('sending');
                            //send.text('Gửi');
                            alert("Đã có lỗi xảy ra, chúng tôi sẽ sớm khắc phục!");
                            $(".modal-background").slideUp();
                            $('html').removeClass('overflow-hiden');
                            console.log(data);
                        } else {
                            crefresh.click();
                            //send.removeClass('sending');
                            //send.text('Gửi');
                            alert(data);
                        }
                    }
                },
                error: function (errorText) {
                    crefresh.click();
                    alert("Đã có lỗi xảy ra, chúng tôi sẽ khắc phục sớm!");
                    //send.removeClass('sending');
                    //send.text('Gửi');
                }
            });
        }
        function getcookie(_logname) {
            var result;
            return (result = new RegExp('(?:^|; )' + encodeURIComponent(_logname) + '=([^;]*)').exec(document.cookie)) ? (result[1]) : null;
        }
        function savecookie(_logname, _value) {
            var date = new Date();
            date.setTime(date.getTime() + (10 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
            document.cookie = _logname + "=" + _value + expires + "; path=/;";
        }
    }

    var mySwiperMarket = new Swiper(".mySwiperMarket", {
        slidesPerView: 4,
        spaceBetween: 6,
        navigation: {
            nextEl: ".swiper-market-button-next",
            prevEl: ".swiper-market-button-prev",
        },
        breakpoints: {
            1024:{
                slidesPerView: 4,
            },
            768: {
                slidesPerView: 3,
            },
            0: {
                slidesPerView: 2.5,
            }
        }
    });

// chứng khoán
    $(document).ready(function () {
        const apiUrl = 'https://nc97.cnnd.vn/api-stockdata.htm?m=index';
        const marketContainer = $('.swiper-wrapper-market');

        function fetchMarketData() {
            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.Success && response.Data) {
                        try {
                            const parsedData = JSON.parse(response.Data);
                            renderMarketData(parsedData.data.index);
                        } catch (error) {
                            console.error("Error parsing nested JSON:", error);
                        }
                    }
                },
                error: function (error) {
                    console.error("Error fetching market data:", error);
                }
            });
        }

        function renderMarketData(data) {
            marketContainer.empty(); // Xóa dữ liệu cũ trước khi render mới

            data.forEach(market => {
                const { name, indexValue, percent } = market;
                const isUp = parseFloat(percent.replace(',', '.')) >= 0;
                const icon = isUp ? 'icon-up-market.png' : 'icon-down-market.png';
                const itemClass = isUp ? 'item-market-up' : 'item-market-down';
                const changeClass = isUp ? 'title-market-2' : 'title-market-down-2';
                const indexClass = isUp ? 'title-market-1' : 'title-market-down-1';

                const marketItem = `
                <div class="swiper-slide ${itemClass}">
                    <div class="line-top-market">
                        <img src="/image/${icon}" loading="lazy" alt="" class="icon-market">
                        <span class="name-market custom-line-1">${name}</span>
                        <span class="${changeClass} title-market-mobile">${percent}%</span>
                    </div>
                    <div class="line-bottom-market">
                        <span class="${indexClass}">${indexValue}</span>
                        <span class="${changeClass}">${percent}%</span>
                    </div>
                </div>
            `;
                marketContainer.append(marketItem);
            });
        }

        fetchMarketData();
    });

// giá cả hàng hóa
    $(document).ready(function () {
        const apiUrl = 'https://nc97.cnnd.vn/api-stockdata.htm?m=hanghoa';
        const tableBody = $('#body-table-commodity-price');

        function fetchCommodityPrices() {
            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.Success && response.Data) {
                        try {
                            const parsedData = JSON.parse(response.Data);
                            renderCommodityPrices(parsedData.data.value);
                        } catch (error) {
                            console.error("Error parsing nested JSON:", error);
                        }
                    }
                },
                error: function (error) {
                    console.error("Error fetching commodity data:", error);
                }
            });
        }

        function renderCommodityPrices(data) {
            tableBody.empty();
            let row =' <tr class="line-hidden-table"></tr>';
            data.forEach(item => {
                row += `
                            <tr>
                                <td class="col-content-1 col-content-tbody-one">
                                        <span>${item.material}</span>
                                        <div class="col-content-tbody-one-item">
                                            <strong>${item.last.toLocaleString()}</strong> <span>(USD)</span>
                                        </div>
                                    </td>
                                    <td class="${item.change >= 0 ? 'positive' : 'negative'} col-content-2">${item.change.toFixed(2)}</td>
                                    <td class="${item.changePercent >= 0 ? 'positive' : 'negative'} col-content-3">${item.changePercent.toFixed(2)}%</td>
                            </tr>
                        `;
            });
            tableBody.append(row);
        }

        fetchCommodityPrices();
    });

// giá vàng
    $(document).ready(function () {
        function fetchGoldPrices() {
            $.ajax({
                url: '/api/gold-prices',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.code === 200 && response.data.length > 0) {
                        let rawData = response.data;

                        // Sắp xếp dữ liệu theo thời gian mới nhất (giảm dần)
                        rawData.sort((a, b) => new Date(b.date) - new Date(a.date));

                        let filteredData = [];
                        let seenNames = new Set();

                        // Lọc ra 5 mặt hàng khác nhau
                        for (let item of rawData) {
                            if (!seenNames.has(item.name)) {
                                filteredData.push(item);
                                seenNames.add(item.name);
                            }
                            if (filteredData.length === 5) break;
                        }

                        let tableBody = $('#gold-price-table');
                        tableBody.empty(); // Xóa dữ liệu cũ trước khi cập nhật mới
                        let row ='<tr class="line-hidden-table"></tr>';

                        filteredData.forEach(item => {
                            row += `
                                            <tr>
                                                <td class="col-content-gold-1">
                                                    ${item.company_name}
                                                </td>
                                                <td class="col-content-gold-2"><strong>${item.buy.toLocaleString()}</strong></td>
                                                <td class="col-content-gold-3"><strong>${item.sell.toLocaleString()}</strong></td>
                                            </tr>
                                        `;
                        });
                        tableBody.append(row);
                    } else {
                        console.log('Dữ liệu không hợp lệ hoặc không có dữ liệu.');
                    }
                },
                error: function () {
                    console.log('Lỗi khi tải dữ liệu từ API');
                }
            });
        }

        fetchGoldPrices();
    });

// ngoại tệ
    $(document).ready(function () {
        function fetchForeignCurrency() {
            $.ajax({
                url: "https://nc97.cnnd.vn/api-goldandusd.htm?c=GetRateCurrency&bank=%5B%22VPBANK%22%2C%22BIDV%22%5D&date=13%2F02%2F2025",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.success && response.data.length > 0) {
                        let tbody = $("#body-table-foreign-currency");
                        tbody.empty(); // Xóa dữ liệu cũ nếu có
                        let row = '<tr class="line-hidden-table"></tr>';

                        response.data.slice(0, 5).forEach(function (currency) {
                            row += `
                                    <tr>
                                        <td class="col-content-gold-1">${currency.currency_name}</td>
                                        <td class="col-content-gold-2"><strong>${currency.buy_cash}</strong></td>
                                        <td class="col-content-gold-3"><strong>${currency.price}</strong></td>
                                    </tr>
                                `;
                        });
                        tbody.append(row);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Lỗi khi lấy dữ liệu: ", error);
                }
            });
        }

        fetchForeignCurrency();
    });

// lịch kinh tế
    $(document).ready(function () {
        var settings = {
            url: "/api/proxy-api/lsk",
            method: "GET",
            timeout: 0,
        };

        $.ajax(settings).done(function (response) {
            let events = response;
            let tableBody = $(".body-table-economic-calendar");

            tableBody.empty();

            if (events.length > 0) {
                events.forEach(event => {
                    let row = `
                    <tr>
                        <td class="col-content-kt-1">${event.Date}</td>
                        <td class="col-content-kt-2">${event.Symbol}</td>
                        <td class="col-content-kt-3">${event.Title}</td>
                    </tr>
                `;
                    tableBody.append(row);
                });
            } else {
                tableBody.append(`<tr><td colspan="3" style="text-align:center;">Không có sự kiện kinh tế nào</td></tr>`);
            }
        }).fail(function () {
            $(".body-table").append(`<tr><td colspan="3" style="text-align:center;">Lỗi tải dữ liệu</td></tr>`);
        });
    });

    let postBox = document.querySelector(".box-create-post");
    let inputCreatePost = document.querySelector(".input-create-post");
    let expandedPost = document.getElementById("expandedPost");
    let btnCreatePost = document.querySelector(".btn-create-post");
    let nameInfoUser = document.querySelector(".name-info-user-create-post");
    let textarea = document.querySelector('.expanded-post textarea');

    // Mở hộp nhập bài viết
    inputCreatePost.addEventListener("click", function () {
        inputCreatePost.style.display = 'none';
        expandedPost.style.display = 'flex';
        nameInfoUser.style.display = 'inline-block';
    });

    // Click bên ngoài để đóng hộp nhập bài viết
    document.addEventListener("click", function (event) {
        if (!postBox.contains(event.target)) {
            expandedPost.style.display = "none";
            inputCreatePost.style.display = "block";
            nameInfoUser.style.display = "none";
        }
    });

    // Gửi bài viết
    btnCreatePost.addEventListener("click", function () {
        let content = textarea.value.trim();
        if (content !== '') {
            alert("Bài viết đã được đăng: " + content);
            textarea.value = '';
        }
        expandedPost.style.display = 'none';
        inputCreatePost.style.display = 'block';
        nameInfoUser.style.display = "none";
    });

});
