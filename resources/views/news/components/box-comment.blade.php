@if(!$newsContent->allowNoComment)
    @if(env('ALLOW_COMMENT') )
        <div id="detail_comment" class="mt-20">
            <div class="detail__comment notPopUp">
                <input type="hidden" name="CheckMXH" id="CheckMXH" value="0"/>
                <input type="hidden" name="CheckMXHName" id="CheckMXHName" value="0"/>
                <input type="hidden" name="CheckMXHEmail" id="CheckMXHEmail" value="0"/>
                <input type="hidden" name="CheckMXHImg" id="CheckMXHImg" value="0"/>
                <div class="box-comment ykcb" id="ykcb-form">
                    <div class="title-comment">
                        <p class="text">
                            <span>Bình luận <span class="count-comment">(<span
                                        data-count-comment="{{$newsContent->NewsId??''}}">0</span>)</span></span>
                        </p>
                        {{--                    <a href="javascript:;"  class="btn-submit scoll-comment">Gửi bình luận</a>--}}
                    </div>

                    <div class="t-content">
                    <textarea placeholder="Chia sẻ ý kiến của bạn" class="btn-comment require" id="txt_bl"
                              name="txt_bl"></textarea>
                    </div>
                    <div class="input-info">
                        <div class="umail">
                            <input type="text" id="emailcmthuong" class="require " placeholder="Nhập email">
                        </div>
                        <div class="uname">
                            <input type="text" id="usercmthuong" class="require " placeholder="Họ và tên">
                        </div>

                        <div>
                            <input type="hidden" id="pu-usercmthuong" value="">
                        </div>
                        <div>
                            <input type="hidden" id="pu-emailcmthuong" value="">
                        </div>
                    </div>
                    <div class="box-bottom">
                        <a href="javascript:;" id="btn_bl" class="btn-submit">Gửi bình luận</a>
                    </div>
                </div>
                <div class="cmbl hidden">
                    <div class="filter_coment ">
                        <a href="javascript:;" class="active" rel="2">Quan tâm nhất</a>
                        <a href="javascript:;" class="" rel="1">Mới nhất</a>
                    </div>
                    <div class="list-comment content_cm" data-page-size="5">
                    </div>
                    <a href="javascript:;" class="view-more" id="ViewMoreComment">Xem tất cả bình luận</a>
                </div>
            </div>
        </div>
    @endif
@endif


