if (typeof sDomain == "undefined") {
    sDomain = 'https://genks.cnnd.vn';
}
var poll = function () {
    var config = {
        url: sDomain + "/vote-update.chn"
    };
    var status = {
        isVoting: false,
        isViewing: false
    };
    function vote(voteId, voteItems, callback) {
        if (status.isVoting)
            return;
        status.isVoting = true;
        $.ajax({
            url: config.url,
            data: { action: "vote", voteId: voteId, voteItemIds: voteItems },
            error: function () {
                status.isVoting = false;
            },
            success: function (r) {
                //if (r > 0) {
                vcCore.exec(callback);
                //}
                status.isVoting = false;
            }
        });
    }

    function viewResult(voteId, lstAnswers, question) {
        if (status.isViewing)
            return;
        status.isViewing = true;
        ajax.vote.getResult(voteId, {
            dataType: 'json',
            error: function () {
                status.isViewing = false;
            },
            success: function (r) {
                for (var i = 0; i < lstAnswers.length; i++) {
                    for (var j = 0; j < r.length; j++) {
                        if (lstAnswers[i].Id == r[j].Value) {
                            lstAnswers[i].VoteRate = r[j].VoteRate;
                            continue;
                        }
                    }
                }
                showResult(lstAnswers, question);
                status.isViewing = false;
            }
        });
    }

    function showResult(data, question) {
        if (data && data.length > 0) {
            var html = '<div id="VCPollView">';
            html += '<div id="popup-comment-poll-left">';
            html += '    <div class="popup-comment-poll-content">';
            html += '        <span class="p-text">Kết quả khảo sát:</span>';
            if ($('.VoteObjectBoxTitle a').length > 0)
                html += '        <h2 class="p-title">' + question + '</h2>';
            else
                html += '        <h2 class="p-title">' + $('.k14_poll_embed_p1 span').html() + '</h2>';
            html += '        <span class="p-sapo">Bạn có thể chọn nhiều mục. Bình chọn của bạn sẽ được công khai</span>';
            html += '        <ul>';
            var totalAnswers = 0;
            //console.log(data);
            for (var i = 0, l = data.length; i < l; i++) {
                var answer = data[i];
                //sb.push(String.format('<tr><td class="rate">{1}</td><td class="value"><div class="ui-progress" vote="{0}"><span class="orange ui-progress-value" style="width:0%;"><span class="ui-progress-text">0%</span></span></div></td></tr>', answer.VoteRate, answer.Value));
                totalAnswers += answer.VoteRate;

                html += '            <li>';
                html += '                <span class="p-vote-title">' + answer.Value + '</span>';
                html += '                <span class="p-vote-percent" vote="' + answer.VoteRate + '"><span style="width:0%;text-align:center;white-space:nowrap">' + answer.VoteRate + ' bình chọn</span></span>';
                html += '            </li>';
            }


            html += '        </ul>';
            //html += '        <p class="p-vote-date">"Kết quả khảo sát tính đến 16:04 ngày 15/10/2015"</p>';
            html += '    </div>';
            html += '</div>';
            //end VCPollView
            html += '</div>';
            console.log(html);

            $.fancybox.open({
                padding: 0,
                content: html,
                beforeShow: function () {
                    $('#VCPollView').parent('.fancybox-inner').parent('.fancybox-wrap').parent('#fancybox-lock').css({
                        'background-color': 'black'
                    });
                    $('#VCPollView').parent('.fancybox-inner').css({
                        'border-width': '0',
                        'margin-left': '0',
                        'max-height': 'none'
                    });
                    $('#VCPollView').parent('.fancybox-inner').parent('.fancybox-wrap').css({
                        'height': 'auto!important',
                        'width': '800px',
                        'padding': '15px 0'
                    });
                },
                onUpdate: function () {
                    $(window).scroll(function () {
                        try {
                            $.fancybox.close().transitions();
                        } catch (e) {

                        }
                    });

                },
                nextEffect: 'none',
                prevEffect: 'none',
                openEffect: 'none',
                closeEffect: 'none',
                'hideOnContentClick': true
            });

            //$.fancybox(String.format("<div class='popup-comment-form'><h2 class='vote-result-title'>{1}</h2><table class=\"vote-result\">{0}</table><div class=\"vote-result-footer\">Tổng số bình chọn: <strong>{2}</strong></div></div>", sb.join(''), title, totalAnswers));


            //console.log('totalAnswers ' + totalAnswers);

            $('.popup-comment-poll-content ul li .p-vote-percent').each(function () {
                var vote = parseInt($(this).attr('vote'));
                var percent = totalAnswers == 0 ? 0 : (vote / totalAnswers * 100);
                //lam tron so
                percent = Math.round(percent * 100) / 100;
                $(this).find('span').css('width', percent + '%').text(percent + '%');
                //$(this).find('.ui-progress-text').text(percent + '%');
            });

        }
    }

    return {
        vote: function (elmt) {

            if (elmt) {
                elmt = $(elmt);
                var voteId = elmt.attr('voteid');
                var cookieName = "vote" + voteId;
                var cookie = vcCore.getCookie(cookieName);
                var cookieLifeTime = 60000; //1 phút
                var now = new Date();
                if (cookie) {
                    var diff = parseInt((cookieLifeTime - (now.getTime() - (new Date(cookie)).getTime())) / (1000));
                    alert(String.format("Vui lòng bình chọn sau {0} phút {1} giây nữa.", parseInt(diff / 60), diff % 60));
                    return;
                }
                var container = elmt.closest('.VCSortableInPreviewMode[type="Vote"]');

                if (container && container.length > 0) {
                    var voteItems = container.find('input:checked');

                    if (voteItems && voteItems.length > 0) {
                        var arrVoteId = [];
                        voteItems.each(function () {
                            arrVoteId.push($(this).val());
                        });
                        vote(voteId, arrVoteId.join(','), function () {

                            vcCore.setCookie(cookieName, now, new Date(now.getTime() + cookieLifeTime));
                            container.find('.VCPollViewResult:first').click();
                        });
                    } else {
                        alert("Bạn chưa có lựa chọn nào.");
                    }
                } else {
                    var oldContainer = elmt.closest('.k14_poll_embed');
                    var voteItemsOld = oldContainer.find('input[type="radio"]:checked');
                    if (voteItemsOld && voteItemsOld.length > 0) {
                        //console.log(voteItemsOld);
                        var arrVoteIdOld = [];
                        voteItemsOld.each(function () {
                            arrVoteIdOld.push($(this).val());
                        });
                        vote(voteId, arrVoteIdOld.join(','), function () {
                            vcCore.setCookie(cookieName, now, new Date(now.getTime() + cookieLifeTime));
                            oldContainer.find('.k14_poll_embed_b3:first').click();
                        });
                    } else {
                        //console.log("Bạn chưa có lựa chọn nào.");
                        alert("Bạn chưa có lựa chọn nào.");
                    }
                }
            }
        },
        view: function (elmt) {
            if (elmt) {
                elmt = $(elmt);

                var container = elmt.closest('.VCSortableInPreviewMode[type="Vote"]');
                var question = container.find('.VoteObjectBoxTitle > a').html();

                var voteId = elmt.attr('voteid');
                var lstAnswers = [];
                var chkList = container.find('input');
                if (chkList && chkList.length > 0) {
                    for (var i = 0, l = chkList.length; i < l; i++) {
                        var chkBox = $(chkList[i]);
                        var id = chkBox.attr('id');
                        var value = $(String.format('[for="{0}"]', id)).text();
                        var answer = { "Id": chkBox.val(), "VoteId": voteId, "Value": value, "VoteRate": 0.0 };
                        lstAnswers.push(answer);
                    }
                    viewResult(voteId, lstAnswers, question);
                } else {
                    var oldContainer = elmt.closest('.k14_poll_embed');
                    var oldChkList = oldContainer.find('input[type="radio"]');
                    for (var i = 0, l = oldChkList.length; i < l; i++) {
                        var chkBox = $(oldChkList[i]);
                        var id = chkBox.attr('id');
                        //var value = $(String.format('[for="{0}"]', id)).text();
                        var value = chkBox.parent().find('.k14_poll_embed_s1').html();
                        var answer = { "Id": chkBox.val(), "VoteId": voteId, "Value": value, "VoteRate": 0.0 };
                        //console.log(answer);
                        lstAnswers.push(answer);
                    }
                    viewResult(voteId, lstAnswers, '');
                }
            }
        },
        init: function () {
            var divVotes = $('.VCSortableInPreviewMode[type="Vote"]');

            divVotes.each(function (key, value) {
                var $this = $(value);
                var voteid = $this.attr('voteid');
                $this.find('.VCPollFooter').html('<a href="javascript:;" onclick="poll.vote(this);" voteid="' + voteid + '" class="VCPollSubmit">Bình chọn</a><a href="javascript:;" onclick="poll.view(this);" voteid="' + voteid + '"  class="VCPollViewResult">Xem kết quả</a>');
            });
        }
    };
}(jQuery);

function checkVote(divAnswer) {
    if (!$(divAnswer).is('input')) {
        var r = $(divAnswer).find('input');
        var background = "";
        if (r.attr("type") == "radio") {
            var parentDiv = $(divAnswer).parent('div').find('div');
            $(parentDiv).each(function (index) {
                if ($(this).hasClass('even')) {
                    $(this).css('background', "#ececec");
                }
                else if ($(this).hasClass('odd')) {
                    $(this).css('background', "");
                }
            });
        }
        if ($(divAnswer).hasClass('even')) {
            background = "#ececec";
            /*background_hover = "url('http://kenh143.vcmedia.vn/Images/Skins/vote_answer_bg.gif') repeat";*/
        }
        else {
            background = "";
            /*background_hover = "url('http://kenh143.vcmedia.vn/Images/Skins/vote_answer_bg_hover.gif') repeat";*/
        }

        if ($(r).is(':checked')) {
            $(r).attr("checked", false);
            $(divAnswer).css('background', background);
        }
        else {
            $(r).attr("checked", true);
            $(divAnswer).css("background", background_hover);
        }
    }
    else {
        var r = $(divAnswer);
        if ($(r).is(':checked')) {
            $(r).attr('checked', false);
        }
        else {
            $(r).attr('checked', true);
        }
    }
}

var ajax = function () {
    return {

        /*VOTE*/
        vote: {
            getResult: function (voteId, ajaxOptions) {
                $.ajax($.extend(ajaxOptions, {
                    url: sDomain + "/vote-update.chn",
                    data: { action: "view", voteId: voteId }
                }));
            }
        }
    };
}(jQuery);

var vcCore = function () {
    return {
        isAbsoluteUrl: function (url) {
            return !vcCore.isEmpty(url) && (url.indexOf("http://") == 0 || url.indexOf("https://") == 0);
        },
        isSmartPhone: function () {
            //return $('html').hasClass('smartphone');
            return (navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|Windows Phone|webOS)/i) != null);
        },
        isEmpty: function (obj) {
            return obj == undefined || obj == "" || vcCore.isEmptyObject(obj);
        },
        isEmptyObject: function (obj) {
            for (var key in obj) {
                return false;
            }
            return true;
        },
        isIE: function () {
            return $("html").hasClass("ie");
        },
        isIE7: function () {
            return $("html").hasClass("ie7");
        },
        isIE8: function () {
            return $("html").hasClass("ie8");
        },
        isIE9: function () {
            return $("html").hasClass("ie9");
        },
        addToCache: function (key, value) {
            if (!value) {
                value = key;
                key = "js" + Math.floor(Math.random() * 1000000);
            }
            vcCore[key] = value;
            return key;
        },
        getFromCache: function (key) {
            return vcCore[key];
        },
        exec: function (func) {
            if (typeof func == "function")
                func();
        },
        getUrlParameter: function (name, url) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(url) || [, ""])[1].replace(/\+/g, '%20')) || null;
        },
        getCookie: function (name) {
            var value = document.cookie;
            var start = value.indexOf(" " + name + "=");
            if (start == -1) {
                start = value.indexOf(name + "=");
            }
            if (start == -1) {
                value = null;
            }
            else {
                start = value.indexOf("=", start) + 1;
                var end = value.indexOf(";", start);
                if (end == -1) {
                    end = value.length;
                }
                value = unescape(value.substring(start, end));
            }
            return value;
        },
        setCookie: function (name, value, date) {
            var cookieValue = escape(value) + ((date == null) ? "" : "; expires=" + date.toUTCString());
            document.cookie = name + "=" + cookieValue;
        },
        createObject: function () {
            return {};
        }
    };
}(jQuery);
