//Dùng với project
$(document).ready(function () {

//Thời tiết
    //Thời tiết
    let valueWeather = "2347727";
    try {
        let rc = Cookies.get('__RC');
        // console.log(rc);
        switch (rc) {
            case '4':// Hà nội
                valueWeather = '2347727';
                break;
            case '7':// hải phòng
                valueWeather = '2347707';
                break;
            case '9': //Bắc Giang
                valueWeather = '20070087';
                break;
            case '10': //Bắc Ninh
                valueWeather = '20070088';
                break;
            case '11': //Cao Bằng
                valueWeather = '2347704';
                break;
            case '12': //Điện Biên
                valueWeather = '28301718';
                break;
            case '13': //Hà Giang
                valueWeather = '2347734';
                break;
            case '14': //Hà Nam
                valueWeather = '2347741';
                break;
            case '15': //Hải Dương
                valueWeather = '20070080';
                break;
            case '16': //Hòa Bình
                valueWeather = '2347737';
                break;
            case '17': //Hưng Yên
                valueWeather = '20070079';
                break;
            case '18': //Lai Châu
                valueWeather = '2347708';
                break;
            case '19': //Lạng Sơn
                valueWeather = '2347718';
                break;
            case '20': //Lào Cai
                valueWeather = '2347740';
                break;
            case '21': //Nam Định
                valueWeather = '20070089';
                break;
            case '22': //Ninh Bình
                valueWeather = '2347743';
                break;
            case '23': //Phú Thọ
                valueWeather = '20070091';
                break;
            case '24': //Quảng Ninh
                valueWeather = '2347712';
                break;
            case '25': //Sơn La
                valueWeather = '2347713';
                break;
            case '26': //Thái Bình
                valueWeather = '2347716';
                break;
            case '27': //Thái Nguyên
                valueWeather = '20070083';
                break;
            case '28': //Tuyên Quang
                valueWeather = '2347751';
                break;
            case '29': //Vĩnh Phúc
                valueWeather = '20070090';
                break;
            case '30': //Yên Bái
                valueWeather = '2347753';
                break;
            case '31': //Đà Nẵng
                valueWeather = '20070085';
                break;
            case '32': //Bình Định
                valueWeather = '2347730';
                break;
            case '33': //Bình Phước
                valueWeather = '20070086';
                break;
            case '34': //Bình Thuận
                valueWeather = '2347731';
                break;
            case '35': //Đắk Lắk
                valueWeather = '2347720';
                break;
            case '36': //Đắk Nông
                valueWeather = '28301719';
                break;
            case '37': //Gia Lai
                valueWeather = '2347733';
                break;
            case '38': //Hà Tĩnh
                valueWeather = '2347736';
                break;
            case '41': //Lâm Đồng
                valueWeather = '2347709';
                break;
            case '42': //Nghệ An
                valueWeather = '2347742';
                break;
            case '43': //Ninh Thuận
                valueWeather = '2347744';
                break;
            case '44': //Phú Yên
                valueWeather = '2347745';
                break;
            case '45': //Quảng Bình
                valueWeather = '2347746';
                break;
            case '46': //Quảng Nam
                valueWeather = '2347711';
                break;
            case '47': //Quảng Ngãi
                valueWeather = '20070077';
                break;
            case '48': //Quảng Trị
                valueWeather = '2347747';
                break;
            case '49': //Thanh Hóa
                valueWeather = '2347715';
                break;
            case '50': //Thừa Thiên Huế
                valueWeather = '2347749';
                break;
            case '5': //TP HCM
                valueWeather = '2347728';
                break;
            case '52': //Bình Dương
                valueWeather = '20070078';
                break;
            case '53': //Cần Thơ
                valueWeather = '2347732';
                break;
            case '54': //An Giang
                valueWeather = '2347719';
                break;
            case '57': //Bên Tre
                valueWeather = '2347703';
                break;
            case '58': //Cà Mau
                valueWeather = '20070082';
                break;
            case '59': //Đồng Nai
                valueWeather = '2347721';
                break;
            case '60': //Đồng Tháp
                valueWeather = '2347722';
                break;
            case '61': //Hậu Giang
                valueWeather = '28301720';
                break;
            case '62': //Kiên Giang
                valueWeather = '2347723';
                break;
            case '63': //Long An
                valueWeather = '2347710';
                break;
            case '64': //Sóc Trăng
                valueWeather = '2347748';
                break;
            case '65': //Tây Ninh
                valueWeather = '2347714';
                break;
            case '66': //Tiền Giang
                valueWeather = '2347717';
                break;
            case '67': //Trà Vinh
                valueWeather = '2347750';
                break;
            case '68': //Vĩnh Long
                valueWeather = '2347752';
                break;
            case '': //
                valueWeather = '';
                break;
            case '': //
                valueWeather = '';
                break;
            case '': //
                valueWeather = '';
                break;
        }
    } catch (e) {
        console.log(e)
    }

    if ($('.weather').length){
        lotusWeather(valueWeather); // Hà Nội
        boxWeather();
    }

//Ẩn hiện box thời tiết
    $('.weather .label-weather').off('click').on('click', function () {
        $('.search_city').val('');
        var listCity = $('.box_weather ul li');
        $.each(listCity, function (index, obj) {
            $(this).css({'display': 'flex'});
        });
        $('.box_weather').toggleClass("active_box_weather");
    });
//
//Hide box click body
    var $body = $("body");
    $body.on("mousedown", function (evt) {
        $body.on("mouseup mousemove", function handler(evt) {
            if (evt.type === "mouseup") {
                if (
                    !$(".box_weather").is(evt.target) &&
                    $(".box_weather").has(evt.target).length === 0
                ) {
                    $(".box_weather").removeClass("active_box_weather");
                }
            } else {
            }
            $body.off("mouseup mousemove", handler);
        });
    });
//Time ago
    try {
        if ($('.time-ago').length){
            var $timeago = $(".time-ago");
            $timeago.timeago();
        }

    } catch (e) {
        console.log(e);
    }

//Tìm kiếm
    SearchFunction('.header-search');
    var keys = $('#hdKeyword').val();
    $('.txt-search').val(keys);


//Active menu
    try {
        var active = function () {
            function ActiveMenu(ele, nav) {

                var $ele = $(ele), $menu = $(nav);
                var navs = $menu.find('.nav-link');
                var url = $ele.attr('href');
                if (!url) {
                    $menu.first().children('a').addClass('active');
                } else {

                    $.each(navs, function (index, obj) {
                        var navUrl = $(obj).attr('href');

                        if (navUrl === url) {
                            // $(obj).parent(obj).addClass('active');
                            $(obj).parent(obj).children('a').addClass('active');
                            return;
                        }
                    });
                }
            }

            return {
                ActiveMenu: ActiveMenu,
            }
        }(jQuery);

        active.ActiveMenu('.category-page__name', '.header__nav ul li');
    } catch (e) {
        console.log(e);
    }


// $(".date").datepicker({ dateFormat: 'dd-mm-yy' });


//TrimLine
    try {
        $('.box-category-sapo[data-trimline="4"]').trimLine(4);
        $('.box-category-sapo[data-trimline="3"]').trimLine(3);
        $('.box-category-sapo[data-trimline="2"]').trimLine(2);
        $('.box-category-link-title[data-trimline="2"]').trimLine(2);
        $('.box-category-link-title[data-trimline="3"]').trimLine(3);
        $('.box-category-link-title[data-trimline="4"]').trimLine(4);
        $('.box-category-link-title[data-trimline="6"]').trimLine(6);

    } catch (e) {
        console.log(e);
    }
//Date Time
    try {
        if ($('.datetimenow').length){
            $('.datetimenow').text(formatDate(new Date()));
        }
    } catch (e) {
        console.log(e);
    }


});



