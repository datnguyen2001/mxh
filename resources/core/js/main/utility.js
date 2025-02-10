function intLozadVideo (){
    var videoObserver = lozad(".lozad-video", {
        threshold: 0.1,
        loaded: function (el) {},
    });
    videoObserver.observe();

    var $video_elements_in = $(".lozad-video");
    var $window = $(window);
    function check_if_in_view_video() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = window_top_position + window_height;

        $.each($video_elements_in, function () {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var limitTop = element_top_position + element_height / 3;
            var limitBottom = element_top_position + (element_height / 3) * 2;

            //check to see if this current container is within viewport
            if (
                limitBottom >= window_top_position + 100 &&
                limitTop <= window_bottom_position
            ) {
                //play
                $element.get(0).play();
            } else {
                //pause
                $element.get(0).pause();
            }
        });
    }
    $window.on("scroll resize", check_if_in_view_video);
    $window.trigger("scroll");
}


$.fn.trimLine = function (numberOfLines, fixMinHeight) {
    return this.each(function () {
        var c = $(this).text().trim().length;
        var height = parseFloat($(this).css('line-height')) * numberOfLines;
        if (isNaN(height))
            height = parseFloat($(this).css('font-size').replace('px', '')) * numberOfLines;

        var isRemoved = (parseInt($(this)[0].scrollHeight) > height && c > 0);
        if (isRemoved) {
            $(this).html($(this).text().trim());
        }

        while (parseInt($(this)[0].scrollHeight) > height && c > 0) {
            c--;
            var html = $(this).html().toSubString(c);
            $(this).html(html);
        }

        if (isRemoved)
            $(this).html($(this).html().substring(0, $(this).html().lastIndexOf(' ')) + "...");
        if (true === fixMinHeight)
            $(this).css({ 'min-height': height + 'px' });

    });
};

String.format = function (text) {
    if (arguments.length <= 1) {
        return text;
    }

    var tokenCount = arguments.length - 2;
    for (var token = 0; token <= tokenCount; token++) {
        text = text.replace(new RegExp("\\{" + token + "\\}", "gi"),
            arguments[token + 1]);
    }
    return text;
};

String.prototype.toSubString = function (length) {
    var p = this;
    if (p == '' || p.Length <= length)
        return p;
    var indexOfSpace = $.trim(p).lastIndexOf(' ');
    p = p.substring(0, Math.min(p.length, length));

    if (p.length > indexOfSpace)
        p = p.substring(0, indexOfSpace);
    return p;
};


function checkRunInit() {
    if (typeof runinit != "undefined" && runinit.length >= 1) {
        runinit[0]();
        var len = runinit.length;
        var arr = [];
        for (var i = 1; i < len; i++) {
            arr.push(runinit[i]);
        }
        runinit = arr;
    }
    window.setTimeout(function () {
        checkRunInit();
    }, 100);
}

function nFormatter(num) {
    if (num >= 1000000000) {
        return (num / 1000000000).toFixed(1).replace(/\.0$/, '') + 'G';
    }
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
    }
    if (num >= 1000) {
        return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
    }
    return num;
}

function escapeHTML(text) {
    var replacements = { "<": "&lt;", ">": "&gt;", "&": "&amp;", "\"": "&quot;" };
    return text.replace(/[<>&"]/g, function (character) {
        return replacements[character];
    });
}

function social_share(hr) {
    var wleft = screen.width / 2 - 700 / 2;
    var wtop = screen.height / 2 - 450 / 2;
    $('.facebook_share_button').click(function () {
        var w = window.open("https://www.facebook.com/sharer.php?u=" + hr, "chia sẻ",
            'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=700, height=485, top=' + wtop + ', left=' + wleft
        );
        w.focus();
        return false;
    });

    setTimeout(function () {
        if (!$('.social-share .fb-like iframe').is(':visible'))
            $('.social-share').remove();
    }, 10000);
}


function htmlEncode(value) {
    //create a in-memory div, set it's inner text(which jQuery automatically encodes)
    //then grab the encoded contents back out.  The div never exists on the page.
    return $('<div/>').text(value).html();
}

function encodeReplace(value) {
    return value.replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
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

//utility
var keyString = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

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

function tweetCurrentPage() { window.open("https://twitter.com/share?url=" + encodeURIComponent(window.location.href) + "&text=" + document.title, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=650'); return false; }

function IsDetectMobile() {
    if (/Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        return true;
    }
    return false;
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function copyStringToClipboard(string) {
    var textarea;
    var result;

    try {
        textarea = document.createElement('textarea');
        textarea.setAttribute('readonly', true);
        textarea.setAttribute('contenteditable', true);
        textarea.style.position = 'fixed';
        textarea.value = string;

        document.body.appendChild(textarea);

        textarea.focus();
        textarea.select();

        var range = document.createRange();
        range.selectNodeContents(textarea);

        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);

        textarea.setSelectionRange(0, textarea.value.length);
        result = document.execCommand('copy');
    } catch (err) {
        console.error(err);
        result = null;
    } finally {
        document.body.removeChild(textarea);
    }

    if (!result) {
        var isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
        var copyHotkey = isMac ? '⌘C' : 'CTRL+C';
        result = prompt('Press ' + copyHotkey, string);
        if (!result) {
            return false;
        }
    }
    return true;
}

var fbClient = {
    version: 'v10.0',
    appId: '639419762743159', /*532325580277515*/
    xfbml: true,
    status: true,
    init: function () {
        var me = this;

        $(document).ready(function () {
            if ($('#fb-root').length === 0) {
                $('body').prepend('<div id="fb-root"></div>');
            }
            me.fbLoad('//connect.facebook.net/vi_VN/sdk.js', function () {
                FB.init({
                    appId: me.appId,
                    status: me.status,
                    xfbml: me.xfbml,
                    version: me.version
                });

                FB.Event.subscribe('xfbml.render', me.renderButton);
                //FB.Event.subscribe('edge.create', me.likeCB);
            });
        });

    },
    fbParse: function (ele) {
        try {
            FB.XFBML.parse(ele);
        } catch (e) {
            console.log(e)
        }
    },
    sendClick: function (hr) {
        var link = hr != null ? hr : document.location.href;
        FB.ui({
            method: 'send',
            link: link,
        });
        return false;
    },
    fbLoad: function (url, callback) {
        callback = (typeof callback != 'undefined') ? callback : {};

        $.ajax({
            type: "GET",
            url: url,
            success: callback,
            dataType: "script",
            cache: true
        });
    },
    getLikeShareCount: function (url, eleShare, eleLike, eleTotal) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'https://sharefb.cnnd.vn/?urls=' + url,
            success: function (msg) {
                $.each(msg, function (index, value) {
                    var o = $(eleShare);
                    if (value.total_count > 0) {
                        o.html(value.share_count);
                        //o.show();
                    }
                    else {
                        o.html("0");
                    }
                });
            }
        });
    },
    shareClick: function (hr) {
        var wleft = screen.width / 2 - 700 / 2;
        var wtop = screen.height / 2 - 450 / 2;

        var link = hr != null ? hr : document.location.href;

        var w = window.open("http://www.facebook.com/sharer.php?u=" + link, "chia sẻ",
            'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=700, height=485, top=' + wtop + ', left=' + wleft
        );
        w.focus();
        return false;
    }
};

(function ($) {
    /* Twitter */
    $.fn.extend({
        tweet: function (settings) {

            /* Default settings */
            var data = {
                url: null,
                via: null,
                text: null,
                related: null,
                count: 'horizontal',
                lang: null,
                counturl: null
            };

            // Global options
            settings = $.extend(data, settings);
            var url = document.location;
            var object = $(this);

            if (data.url !== null) { var data_url = 'data-url="' + data.url + ' "'; }
            if (data.via !== null) { var data_via = 'data-via="' + data.via + '"'; }
            if (data.text !== null) { var data_text = 'data-text="' + data.text + ' "'; }
            if (data.related !== null) { var data_related = 'data-related="' + data.related + ' "'; }
            if (data.lang !== null) { var data_lang = 'data-lang="' + data.lang + ' "'; }
            if (data.countrul !== null) { var data_counturl = 'data-counturl="' + data.counturl + '"'; }

            /* Create button */
            return this.each(function () {
                var TweetButton = object;
                // Button
                $(TweetButton).html('<script src="https://platform.twitter.com/widgets.js"></script><a href="https://twitter.com/share" class="twitter-share-button" data-count="' + data.count + '" ' + data_lang + data_url + data_text + data_via + data_related + data_counturl + '>Tweet</a>');

            });
        }

    });

    /* Zalo */
    $.fn.extend({
        share: function (settings) {
            /* Default settings */
            var data = {
                href: document.location,
                appId: "",
                layout: "1",
                color: "blue",
                customize: "false",
                customize_html: "",
            };
            // Global options
            settings = $.extend(data, settings);
            var href = document.location;
            var object = $(this);

            if (data.href !== null) { var data_href = ' data-href="' + data.href + ' "'; }
            if (data.appId !== null) { var data_appId = ' data-oaid="' + data.appId + '"'; }
            if (data.layout !== null) { var data_layout = ' data-layout="' + data.layout + '"'; }
            if (data.color !== null) { var data_color = ' data-color="' + data.color + '"'; }
            if (data.customize !== null) { var data_customize = 'data-customize=' + data.customize; }

            /* Create button */
            return this.each(function () {
                var ZaloButton = object;

                // Button
                $(ZaloButton).html('<div class="zalo-share-button" ' + data_href + data_appId + data_layout + data_color + data_customize + '>' + data.customize_html + '</div>');

            });
        }

    });
})(jQuery);

checkRunInit();

function SearchFunction(ele) {
    var $ele = $(ele), btn = $ele.find('.btn-search-a'), input = $ele.find('.txt-search'), link;
    if (btn.length && input.length) {
        $(btn).click(function () {
            var fd = $('.fromDate ').val(), td = $('.toDate').val();
            if (!fd || !td) {
                fd = "";
                td = "";
            }
            var s = stripHtml(input.val());
            //if (s.length <= 0) {
            //    if (window.location.href.indexOf("/tim-kiem.htm") > 0) {
            //        window.location.href = "/";
            //    }
            //    return;
            //}
            if (fd.length > 0 && td.length > 0 && s.length > 0) {
                fd = fd.split("-").reverse().join("-")
                td = td.split("-").reverse().join("-")
                link = "/tim-kiem.htm?keywords=" + s + "&fromDate=" + fd + "&toDate=" + td + "";
                window.location.href = link;
                return;
            }

            else if (s.length > 0) {
                //s = s.substr(0, 200);
                link = "/tim-kiem.htm?keywords=" + s;
                window.location.href = link;
                return;
            }

        });
        input.keyup(function (event) {
            if (event.keyCode === 13) {
                btn.click();
            }
        });

    }
}

function stripHtml(html) {
    html = html.replace(/[<][\/]?[a-z0-9-]+\s*(\s*[a-z0-9-]+([=]?["']?[^>]*["']?)?)*\s*[>]/ig, " ").trim()
        .replace(/[_\?\+%&=\*]/ig, " ").trim()
        .replace(/--/ig, " ").trim()
        .replace(/[\*\+=\\\/]/ig, " ").trim()
        .replace(/"/g, " ").replace(/^\s+|\s+$/g, " ").trim()
    var temporalDivElement = document.createElement("div");
    temporalDivElement.innerHTML = html;
    return temporalDivElement.textContent || temporalDivElement.innerText || "";
}

function formatDate(date) {
    var dt = new Date(date);

    var dayNames = [
        "Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư",
        "Thứ Năm", "Thứ Sáu", "Thứ Bảy"
    ];

    var day = dt.getDay();
    var date = dt.getDate();
    var month = dt.getMonth() + 1;
    var year = dt.getFullYear();
    var hours = dt.getHours();
    var minutes = dt.getMinutes();

    return dayNames[day]+', '+date +'/' + month + '/' + year + ', '+hours + ':' + minutes;
}

function formatDateNames(date) {
    var dt = new Date(date);

    var dayNames = [
        "Chủ Nhật", "Thứ 2", "Thứ 3", "Thứ 4",
        "Thứ 5", "Thứ 6", "Thứ 7"
    ];

    var day = dt.getDay();
    var date = dt.getDate();
    var month = dt.getMonth() + 1;
    var year = dt.getFullYear();
    var hours = dt.getHours();
    var minutes = dt.getMinutes();

    return dayNames[day];
}

function getCountView() {
    var lstNewsIds = '';
    var cnt = 0;
    $('.item-view').each(function () {
        var newsId = ($(this).attr('rel'));
        if (cnt == 0)
            lstNewsIds += newsId;
        else
            lstNewsIds += ';' + newsId;
        cnt++;
    });
    if (cnt < 1) return;

    $.ajax({
        url: pageSettings.DomainUtils + '/get-view-adtech.chn',
        data: ({ 'command': 'adtechviewcountgetlist', 'lstNewsIds': lstNewsIds, 'domain': 'nhandaovtv.vn' }),
        dataType: "json",
        type: 'POST',
        beforeSend: function () {
        },
        success: function (msg) {
            if (msg.Success) {
                var obj = JSON.parse(msg.Data);
                $.each(obj, function (index, value) {
                    var o = $(".item-view[rel*='" + value.newsId + "']");
                    var viewCount = value.total_view;
                    var socialCount = numeral(viewCount).format('0,0a').replace(',', '.');
                    if (viewCount > 0) {
                        o.find('.text').html(socialCount);
                        o.removeClass('item-view');
                        o.show();
                    } else {
                        o.hide();
                    }
                });
            }
        },
        error: function (msg) {
            console.log(msg);
        }

    });
}

/*Weather*/
function put() {
    var channelweather1 = new channelvnWather('channelweather');
    channelweather1.LoadDataWeather();
}

// function lotusWeather(InstanceName) {
//
//     $.ajax({
//         type: 'GET',
//         url: pageSettings.DomainUtils + '/ajax/weatherinfo/' + InstanceName + '.htm',
//         contentType: 'application/json; charset=utf-8',
//         async:false,
//         timeout: 5000,
//         success: function (res) {
//             res = JSON.parse(res);
//             if (res.Success) {
//                 var data = res.Data.data;
//
//                 if (data != null) {
//                     try {
//                         var img = convertIconWeather(data.datainfo.status);
//                         var outputWeather = data.datainfo.temperature + '<sup>o</sup>' + data.datainfo.degree;
//                         var outputWeatherImage = '<img width="27" src="' + img + '" alt="' + data.datainfo.status + '" />';
//
//                         document.getElementById('weatherWrap').style.display = 'flex';
//                         document.getElementById('divWeatherImage').innerHTML = outputWeatherImage;
//                         document.getElementById('divWeather').innerHTML = outputWeather;
//                         document.getElementById('divWeatherDesciption').innerText = data.datainfo.status;
//
//                     } catch (err) {
//                         //TODO:
//                     }
//                 }
//             }
//         }
//     });
// }

//change weather
function lotusWeather(InstanceName) {

    $.ajax({
        type: 'GET',
        url: pageSettings.DomainUtils + '/ajax/weatherinfo/' + InstanceName + '.htm',
        contentType: 'application/json; charset=utf-8',
        timeout: 3000,
        success: function (res) {
            res = JSON.parse(res);
            if (res.Success) {
                var data = res.Data.data;

                if (data != null) {
                    try {
                        var img = convertIconWeather(data.datainfo.status);
                        var outputWeather =
                            data.datainfo.temperature +
                            "<sup>o</sup>" +
                            data.datainfo.degree;

                        var temperatureRange =
                            "Nhiệt độ " +
                            data.datainfo.low +
                            "<sup>o</sup>" +
                            data.datainfo.degree +
                            " - " +
                            data.datainfo.high +
                            "<sup>o</sup>";

                        var humidity = "Độ ẩm " + data.datainfo.humidity;

                        var outputWeatherImage =
                            '<img width="27px" height="22px" src="' +
                            img +
                            '" alt="' +
                            data.datainfo.status +
                            '" />';
                        var location = data.datainfo.location;

                        // document.getElementById("weatherWrap").style.display =
                        //     "flex";
                        document.getElementById(
                            "divWeatherImage"
                        ).innerHTML = outputWeatherImage;

                        $(".weather-image").html(outputWeatherImage);

                        document.getElementById(
                            "divWeather"
                        ).innerHTML = outputWeather;

                        $(".weather-temp").html(outputWeather);

                        $(".weather-temp-range").html(temperatureRange);

                        $(".weather-status").text(data.datainfo.status);

                        $(".weather-location").text(location);

                        $(".weather-humidity").text(humidity);

                        document.getElementById(
                            "divWeatherLocation"
                        ).innerHTML = location+', ';
                    } catch (err) {
                        //TODO:
                    }
                }
            }
        }
    });
}

function convertIconWeather(status) {
    var type = "";
    status = status.toLowerCase();
    switch (status) {
        case "ít mây":
        case "một chút mây":
        case "có mây":
            type = "https://static.mediacdn.vn/images/icon_weather/it-may.png";
            break;
        case "mưa nhỏ":
        case "mưa":
            type = "https://static.mediacdn.vn/images/icon_weather/mua-phun.png";
            break;
        case "nắng đẹp":
        case "mây và nắng":
        case "nắng nhẹ":
        case "nắng sau đó có ít mây":
            type = "https://static.mediacdn.vn/images/icon_weather/it-may.png";
            break;
        case "nắng":
            type = "https://static.mediacdn.vn/images/icon_weather/nang.png";
            break;
        case "chủ yếu nắng":
        case "nhiều nắng":
            type = "https://static.mediacdn.vn/images/icon_weather/nang.png";
            break;
        case "mưa rào rải rác":
        case "cơn mưa rào":
        case "mưa rào":
        case "mưa rào nhỏ":
        case "mưa lớn":
            type = "https://static.mediacdn.vn/images/icon_weather/mua.png";
            break;
        case "mưa giông rải rác":
        case "mưa giông":
        case "mưa giông lớn":
        case "mưa dông":
        case "mưa dông lớn":
        case "mưa rào có sấm":
            type = "https://static.mediacdn.vn/images/icon_weather/mua.png";
            break;
        case "sấm sét":
            type = "https://static.mediacdn.vn/images/icon_weather/mua.png";
            break;

        case "nhiều mây":
            type = "https://static.mediacdn.vn/images/icon_weather/nhieu-may.png";
            break;
        case "trong xanh":
        case "trời quang":
        case "quang mây":
            type = "https://static.mediacdn.vn/images/icon_weather/it-may.png";
            break;
        case "ảm đạm":
        case "nắng có sương mờ":
        case "có sương mù":
        case "mây mù":
        case "sương mù nhẹ":
        case "sương mù dày đặc":
            type = "https://static.mediacdn.vn/images/icon_weather/it-may.png";
            break;
        default:
            type = "https://static.mediacdn.vn/images/icon_weather/it-may.png";
            break;
    }
    return type;
}

/** Delay function */
function delay(callback, ms) {
    var timer = 0;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

function channelvnWather(InstanceName) {
    this.host = appSettings.weather;
    //http://weather.channelvn.net/ProxyHandler.ashx?MethodName=ChannelvnWeather&CallBack=channelvn.OnLoaded&RequestType=json

    this.script_folder = this.host + '/www/dantri';

    this.script_object = null;

    this.instance_name = InstanceName;

    this.LoadDataWeather = function () {
        this.CreateScriptObject(this.host + '/ProxyHandler.ashx?MethodName=ChannelvnWeather&CallBack=' + this.instance_name + '.OnLoadedWeather&RequestType=json');

    }


    this.OnLoadedWeather = function (data, methodName) {

        var NewsData = eval(data);
        var outputWeatherImage = '';
        var outputWeather = '';
        var image = '';

        var city = "Hà Nội"//document.getElementById("cbSelect").value != null ? document.getElementById("cbSelect").value : "Hà nội";

        try {

            if (document.getElementById("cbSelect").value != null || document.getElementById("cbSelect").value != '') {
                city = document.getElementById("cbSelect").value;

            } else {
                city = "Hà Nội";
            }

        }

        catch (err) {
            //TODO:
        }

        for (j = 0; j < NewsData.ChannevnJSon.Weather.length; j++) {
            //console.log(NewsData.ChannevnJSon.Weather[j]);
            if (NewsData.ChannevnJSon.Weather[j].City_Name.toString().indexOf(city) != -1) {
                //                alert(NewsData.ChannevnJSon.Weather[j].City_Name);
                image = NewsData.ChannevnJSon.Weather[j].City_Weather;
                outputWeather += '<div>';
                outputWeather += '<div class="temparete">' + NewsData.ChannevnJSon.Weather[j].City_Temp + '</div></div>';
            }
        }


        if (image == 'Không mưa') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall itmayw"  ></i>';
        } else if (image == 'Có mưa') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall muaw"  ></i>';
        } else if (image == 'Lặng gió') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall nangw"  ></i>';
        } else if (image == 'Nhiều mây' || image == 'Đêm nhiều mây') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall nhieumayw"  /></i>';
        } else if (image == 'ít mây') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall itmayw"  ></i>';
        } else if (image == 'Mây thay đổi') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall maythaydoiw"  /></i>';
        } else if (image == 'có mưa phùn') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall muaphunw"  ></i>';
        }
        else if (image == 'Nhiều mây, không mưa') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall nhieumayw"  ></i>';
        }
        else if (image == 'Ít mây, trời nắng') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall itmayw"  ></i>';
        }
        else if (image == 'Mây thay đổi, trời nắng') {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall maythaydoiw"  ></i>';
        } else {
            outputWeatherImage += '<div class="img">';

            outputWeatherImage += '<i class="spriteall itmayw"  ></i>';
        }


        try {
            document.getElementById('divWeatherImage').innerHTML = outputWeatherImage;
            document.getElementById('divWeather').innerHTML = outputWeather;
            document.getElementById('City_Weather').innerHTML = image;
        }

        catch (err) {
            //TODO:
            console.log(err);
        }
    }

    this.CreateScriptObject = function (src) {

        if (this.script_object != null) {
            this.RemoveScriptObject();

        }

        this.script_object = document.createElement('script');

        this.script_object.setAttribute('type', 'text/javascript');

        this.script_object.setAttribute('src', src);

        var head = document.getElementsByTagName('head')[0];

        head.appendChild(this.script_object);

    }

    this.RemoveScriptObject = function () {
        this.script_object.parentNode.removeChild(this.script_object);

        this.script_object = null;
    }


}

function boxWeather() {
    //Ẩn hiện box thời tiết
    $(".collapse")
        .off("click")
        .on("click", function () {
            $(".search_city").val("");
            var listCity = $(".box_weather ul li");
            $.each(listCity, function (index, obj) {
                $(this).css({display: "flex"});
            });
            $(".box_weather").toggleClass("active_box_weather");
        });
    var $body = $("body");
    $body.on("mousedown", function (evt) {
        $body.on("mouseup mousemove", function handler(evt) {
            if (evt.type === "mouseup") {
                if (
                    !$(".home__weather").is(evt.target) &&
                    $(".home__weather").has(evt.target).length === 0
                ) {
                    $(".home__weather")
                        .find(".box_weather")
                        .removeClass("active_box_weather");
                }

                // if (!$('.src-menu').is(evt.target) &&
                //     $('.src-menu').has(evt.target).length === 0
                // ) {
                //     $('.src-menu').find('.src-btn').removeClass('active');
                //     $('.src-menu').find('.menu-expand').removeClass('active');
                // }
            } //else {}
            $body.off("mouseup mousemove", handler);
        });
    });

    //Click chọn thành phố muốn hiển thị
    $(".box_weather ul li")
        .off("click")
        .on("click", function () {
            var value = $(this).attr("value");
            $(".box_weather").removeClass("active_box_weather");
            lotusWeather(value);
        });

    $(".search_city").keyup(function () {
        var listCity = $(".box_weather ul li");
        var str = $(this).val();
        str = deleteSpecial(str);

        $.each(listCity, function (index, obj) {
            var city = $(obj).text();
            city = deleteSpecial(city);
            if (!city.includes(str)) {
                $(this).css({display: "none"});
            } else {
                $(this).css({display: "flex"});
            }
        });
    });
}

function deleteSpecial(str) {
    str = str.toLowerCase();
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(
        /!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g,
        " "
    );
    return str;
}
/*Weather*/
