$(function () {
    $(".VCPollSubmit").click(function (e) {
        e.preventDefault();

        var _this = $(this);
        var voteid = $(_this).attr('voteid');

        var parent = $(_this).parents(`.VCSortableInPreviewMode[voteid=${voteid}]`);// lấy ra div bao vote

        var elAnswer = $(parent).find('.VCListVoteAnswers input');// tất cả câu trả lời trong vote

        var arrAnswer = '';
        $(elAnswer).each(function (index,value) {
            if (value.checked == true){
                arrAnswer += $(this).val() + ',';
            }
        });
        arrAnswer = arrAnswer.slice(0, -1);
        if (!arrAnswer){
            window.scrollTo(0,window.pageYOffset);
            customAlert.alert("Bạn chưa có lựa chọn");
            return;
        }else {
            if (Cookies.get("boxvote" + voteid) == voteid) {
                //console.log("cookie");
                customAlert.alert("Bạn đã bình chọn rồi");
                $(`[voteid=${voteid}] .VCListVoteAnswers`).addClass("backgroundoff");
                $(`.VCPollViewResult[voteid=${voteid}]`).hide();
                $(`.VCPollSubmit[voteid=${voteid}]`).hide();
                showResult(voteid);
                return;
            }
        }


        $.ajax({
            type: "POST",
            xhrFields: {withCredentials: true},
            url: pageSettings.DomainApiVote + '/vote-update.chn',timeout: 5000,
            data: {
                action: 'vote',
                voteId: voteid,
                voteItemIds: arrAnswer,
            },
            success: function (res) {
                if (res == 1) {
                    var date = new Date();
                    var minutes = 30;
                    date.setTime(date.getTime() + (minutes * 60 * 1000));
                    Cookies.set("boxvote" + voteid, voteid, {expires: date, path: '/'});
                    customAlert.alert('Gửi bình chọn thành công!');
                    showResult(voteid);
                    $(`[voteid=${voteid}] .VCListVoteAnswers`).addClass("backgroundoff");
                    $(`.VCPollViewResult[voteid=${voteid}]`).hide();
                    $(`.VCPollSubmit[voteid=${voteid}]`).hide();

                }
            },
            error: function (x, t, m) {
                if (t === "timeout") {
                    // alert("got timeout");
                } else {
                    //  alert(t);
                }
            }
        });
    });

    $(".VCPollViewResult").click(function (e) {
        e.preventDefault();
        var _this = $(this);
        var voteid = $(_this).attr('voteid');

        showResult(voteid,'false');
    });


    function showResult(voteid,status = '') {
        if( $(".VCListVoteAnswers").hasClass("showResult") && !status){
            $(`.VCPollViewResult[voteid=${voteid}]`).hide();
            $(`.VCPollSubmit[voteid=${voteid}]`).hide();
        }
        $.ajax({
            type: 'get',
            url: pageSettings.DomainApiVote + '/vote-view.chn?',timeout: 5000,
            timeout: 1000 * 60,
            data: {action: 'view', voteId: voteid},
            success: function (data) {
                var data = JSON.parse(data);
                if (data.length > 0){

                    printResult(data,voteid);
                    if (!status){
                        $(`.VCPollViewResult[voteid=${voteid}]`).hide();
                        $(`.VCPollSubmit[voteid=${voteid}]`).hide();
                    }
                    $(".VCListVoteAnswers").addClass("showResult");
                }else {
                    // printResult([],voteid);
                }

            },
            error: function (x, t, m) {
                if (t === "timeout") {
                    customAlert.alert("got timeout");
                } else {
                    customAlert.alert(t);
                }
            }
        });
    }


    function printResult(array,voteid) {
        var _chkVote = 0;
        var voteAnser = '';
        $.ajax({ // get vote info
            type: 'get',
            url: `/api/get-vote-info-${voteid}.htm`,timeout: 5000,
            timeout: 1000 * 60,
            success: function (data) {
                var sumVote = 0;
                var setarray = array;
                sumVote = countValueVote(array,voteid);

                if (data){
                    _chkVote = data.DisplayStyle ;
                }
                console.log('vào',sumVote,array)
                if (setarray.length > 0 && sumVote){
                    var textNews ='';
                    window.scrollTo(0,window.pageYOffset);
                    for (var i = 0; i < setarray.length; i++) {
                        var valuevote = setarray[i].Value;
                        if ( $(`[voteid=${voteid}] label[for=VoteAnswer${valuevote}]`)){
                            console.log('vào')
                            $(`[voteid=${voteid}] label[for=VoteAnswer${valuevote}] b`).remove();
                            let textOld = $(`[voteid=${voteid}] label[for=VoteAnswer${valuevote}]`).text();
                            if (_chkVote == 1){
                                if (setarray[i].VoteRate > 0){
                                    textNews = `${textOld} <b class="bgVote"> <i style="width:${(setarray[i].VoteRate/sumVote * 100).toFixed(0)}%; text-align:right">${(setarray[i].VoteRate/sumVote * 100).toFixed(0)}%</i> </b>`;
                                }else {
                                    textNews = `${textOld} <b style="color: #009AD9;"> <i class="nobg">0%</i> </b>`;
                                }
                            }else {
                                textNews= `${textOld} <b style="color: #009AD9;"> <br> <i>- Tỉ lệ bình chọn ${setarray[i].VoteRate}/${sumVote}</i> </b>`;
                            }
                            $(`[voteid=${voteid}] label[for=VoteAnswer${valuevote}]`).addClass('showResult');
                            $(`[voteid=${voteid}] label[for=VoteAnswer${valuevote}]`).html(textNews);
                        }
                    }
                }else {
                    if ($(`[voteid=${voteid}] input[value]`).length > 0){
                        $(`[voteid=${voteid}] input[value]`).each(function (index, item){
                            var parent = $(item).parent();
                            var label = parent.find('label');
                            if(!$(label).hasClass("showResult")){
                                $(label).children('b').remove();
                                let textOld = $(label).text();
                                if (_chkVote == 1) {
                                    textNews = `${textOld} <b style="color: #009AD9;">  <i class="nobg" >0%</i> </b>`;
                                }else {
                                    textNews = `${textOld} <b style="color: #009AD9;"> <br> <i>- Tỉ lệ bình chọn 0/${sumVote}</i> </b>`;
                                }
                                $(label).addClass('showResult');
                                $(label).html(textNews);
                            }
                        });
                    }
                }
            }
        });
    }

    function countValueVote(array,voteid) {
        var sumVote = 0;
        if ($(`[voteid=${voteid}] input[value]`).length > 0){
            $(`[voteid=${voteid}] input[value]`).each(function (index, item){
                var ansId = $(item).attr('value');
                for (var j = 0; j < array.length; j++){
                    if(array[j].Value == ansId){
                        sumVote += parseInt(array[j].VoteRate) ;
                    }
                }
            });
        }
        return sumVote;
    }


//    js vote game detail

    $(".VoteGameInfoBtn").click(function () {
        var _this = $(this);
        var voteid = $(_this).attr('data-id');

        var parent = $(_this).parents(`.VCSortableInPreviewMode[data-gameid=${voteid}]`);// lấy ra div bao vote

        if (Cookies.get("boxvotegame" + voteid) == voteid) {
            //console.log("cookie");
            if(_this.hasClass('VoteGameInfoBtn')){
                customAlert.alert("Bạn đã bình chọn rồi");
            }
            var count = Cookies.get("countboxvotegame"+voteid);
            _this.html(`${count} Bình chọn`);
            _this.removeClass('VoteGameInfoBtn');
            _this.removeClass('btn');
            _this.removeClass('btn-primary');
            return;
        }
        $.ajax({
            type: "POST",
            xhrFields: {withCredentials: true},
            url: pageSettings.DomainUtils2 + '/api/vote/game-channel/like.htm',timeout: 5000,
            data: {
                SiteName: pageSettings.commentSiteName,
                object_id: voteid,
            },
            success: function (res) {
                var res = JSON.parse(res)

                if (res.status) {
                    var date = new Date();
                    var minutes = 30;
                    date.setTime(date.getTime() + (minutes * 60 * 1000));
                    Cookies.set("boxvotegame" + voteid, voteid, {expires: date, path: '/'});
                    Cookies.set("countboxvotegame" + voteid, res.data, {expires: date, path: '/'});

                    customAlert.alert('Gửi bình chọn thành công!');
                    var isGame = $(parent).find(`.VoteGameInfoBtn[data-id=${voteid}]`);
                    isGame.html(`${res.data} Bình chọn`);
                    isGame.removeClass('VoteGameInfoBtn');
                    isGame.removeClass('btn');
                    isGame.removeClass('btn-primary');
                }
            },
            error: function (x, t, m) {
                if (t === "timeout") {
                    // alert("got timeout");
                } else {
                    //  alert(t);
                }
            }
        });
    });


});
