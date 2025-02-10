<a href="javascript:;" class="clickpopupdetail detail__create-question" rel="nofollow" data-act="open-modal" data-modal="question" style="color: white">Gửi câu hỏi Phỏng vấn trực tuyến</a>
<div id="interview-content-place">

</div>
<div class="modal modal-small" data-id="question" id="fromGuiTin" >
    <div class="modal-header">
        <p class="title">Gửi câu hỏi Phỏng vấn trực tuyến</p>
        <a class="close" data-act="close-modal">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 15L15 1" stroke="#4F4F4F" stroke-miterlimit="10" stroke-linecap="square"></path>
                <path d="M15 15L1 1" stroke="#4F4F4F" stroke-miterlimit="10" stroke-linecap="square"></path>
            </svg>
        </a>
    </div>
    <div class="modal-content">
        <div class="modal-question-form">
            <div class="row">
                <span class="label">Họ và tên</span>
                <input id="txtNameInterView" class="btn" placeholder="Nhập họ và tên của bạn">
            </div>
            <div class="row">
                <div class="col-input">
                    <span class="label">Email</span>
                    <input id="txtEmailInterView" class="btn" placeholder="Nhập email của bạn">
                </div>
            </div>
            <div class="row">
                <span class="label">Nội dung</span>
                <textarea id="txtContentInterView" placeholder="Nhập nội dung"></textarea>
            </div>

            <div class="row row2 ">
                <div class="captcha-control col-input">
                    <div class="captcha-info">
                        <input id="txtcapcha" class="btn" placeholder="Captcha">
                        <img id="imgcaptchaapi" class="imgcaptchaapi" src="{{env('DOMAIN_API_ANSWER')}}/get-captcha.htm?v={{date('ddmmhhmmss')}}" alt="mã captcha" />
                        <a href="javascript:;" rel="nofollow" class="refresh-captcha" title="lấy mã khác">
                            <img src="https://static.mediacdn.vn/suckhoedoisong/image/01-refresh-icon.png" alt="refresh captcha" />
                        </a>
                    </div>
                </div>
                <div class="col">
                    <a id="btnSendInterView" href="javascript:void(0);" rel="nofollow" title="Gửi" class="submit">Gửi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-bg"></div>
<input type="hidden" name="hdInterviewId" id="hdInterviewId" value="{{$InterviewId}}" />
