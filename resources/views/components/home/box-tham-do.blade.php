@if(!empty($boxThamDoInfo))
<div class="home__ns-vote-sub" data-cd-key="siteid192:objectembedbox:zoneid0typeid2;siteid192:voteanswers:voteid{{$boxThamDoInfo->ObjectId??0}}">
        <div class="box-table">
            <p class="title">Bình chọn</p>
            <input type="hidden" id="idVote" value="{{ $boxThamDoInfo->Id ?? '' }}">
            <p class="text">
                {{ $boxThamDoInfo->Title ?? '' }}
            </p>
            <div class="form-thamdo chooseListVotex" id="chooseListVotex">
                @forelse ($listAnswers as $key=>$item)
                    <div class="form-item item" id="voteitem{{ $item->Id ?? '' }}">
                        <input type="{{ ($boxThamDoInfo->MaxAnswers??0) == 1 ? 'radio' : 'checkbox' }}" id="vote{{ $key }}"
                               name="vote" value="{{ !empty($item->Id) ? $item->Id : '' }}" class="checkdata">
                        <label for="vote{{ $key }}" class="poll-name item-answer">{{ $item->Value ?? '' }}</label>
                    </div>
                @empty
                @endforelse
            </div>
            <div class="bottom">
                <a href="javascript:;" class="btn-kq btn-kq" rel="nofollow" onclick="showResult()">Kết quả</a>
                <a href="javascript:;" class="btn-submit btnSendVote"  rel="nofollow">Bỏ phiếu</a>
            </div>
        </div>
        <script type="text/javascript">
            (runinit = window.runinit || []).push(function () {
                $(".btnSendVote").click(function () {
                    customAlert.init();
                    var idVote = $("#idVote").val();
                    var arrAnswer = "";
                    $(".checkdata:checked").each(function () {
                        arrAnswer += $(this).val() + ",";
                    });
                    arrAnswer = arrAnswer.slice(0, -1);
                    var idResult = "";
                    var textResult = $('input[name="vote"]:checked')
                        .parent()
                        .find("label")
                        .text();
                    if (
                        "undefined" == $(".checkdata:checked").val() ||
                        $(".checkdata:checked").val() == null
                    ) {
                        customAlert.alert("Bạn chưa có lựa chọn nào");
                        return;
                    }
                    if (Cookies.get("boxvote" + idVote) == idVote) {
                        customAlert.alert("Bạn đã bình chọn rồi");
                        return;
                    }
                    $.ajax({
                        type: "POST",
                        xhrFields: {
                            withCredentials: true
                        },
                        url: pageSettings.DomainApiVote + "/vote-update.chn",
                        data: {
                            action: "vote",
                            voteId: idVote,
                            voteItemIds: arrAnswer,

                        },
                        timeout: 5000,
                        success: function (res) {
                            if (res == 1) {
                                var date = new Date();
                                var minutes = 30;
                                date.setTime(date.getTime() + minutes * 60 * 1000);
                                Cookies.set("boxvote" + idVote, idVote, {
                                    expires: date,
                                    path: "/"
                                });
                                showResult();
                                customAlert.alert("Gửi bình chọn thành công!");
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

            function showResult() {
                var idVote = $("#idVote").val();
                $.ajax({
                    type: "get",
                    url: pageSettings.DomainApiVote + "/vote-view.chn?",
                    timeout: 5000,
                    data: {
                        action: "view",
                        voteId: idVote
                    },
                    success: function (data) {
                        var data = JSON.parse(data);
                        $(".chooseListVotex").addClass("show-result");
                        $(".title-result").css("display", "block");
                        $.each(data, function (i, field) {
                            var Value = field.Value.replace('"', "");
                            $(".chooseListVotex #voteitem" + Value + " .item-answer + span").remove();
                            $(".chooseListVotex #voteitem" + Value + "").append(
                                "<div>&nbsp; (" + field.VoteRate + " lượt bình chọn)</div>"
                            );
                        });
                        $(".btn-kq").attr('onclick', 'javascript:;');
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
        </script>
</div>
@endif
