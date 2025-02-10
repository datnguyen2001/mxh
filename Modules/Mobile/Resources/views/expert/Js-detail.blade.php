{{--    Check ads không xóa--}}
@if(!empty($newsContent))
    <script>
        var _chkPrLink = {{$newsContent->allowAds==false?'true':'false'}};
    </script>
@endif
<script>
    if (!isNotAllow3rd) {
        loadJsAsync("https://adminplayer.sohatv.vn/resource/init-script/playerInitScript.js", function () {});
        loadJsAsync("{{asset('/web_js/20240521/thanhnienviet.base.min.js')}}", function () { //k doi ver base
            loadJsAsync("{{asset('/mob_js/20240521/thanhnienviet.detail.min.js?v').config('siteInfo.ver_css_js')}}", function () {});
            @if(($newsContent->Type != 13 || $newsContent->Type != 38) )
            loadJsAsync('https://static.mediacdn.vn/common/js/embedTTSv13min.js', function () {
                embedTTS.init({
                    apiCheckUrlExists: 'https://speech.aiservice.vn/tts/get_file',
                    wrapper: '.af-tts',/* chỗ chứa embed trên trang*/
                    cookieName: 'embedTTS',/* Tên cookie để lưu lại lựa chọn tiếng nói của user*/
                    primaryColor: '#1259a0', /*Màu sắc chủ đạo của kênh*/
                    newsId: '{{$newsContent->NewsId}}', /*NewsId cần lấy*/
                    distributionDate: '{{date('Y/m/d',strtotime($newsContent->DistributionDate))}}', /*Thời gian xuất bản của tin, theo format yyyy/MM/dd*/
                    nameSpace: 'thanhnienviet',/*Namespace của kênh*/
                    domainStorage: 'https://tts.mediacdn.vn', /*Domain storage, k cần đổi*/
                    srcAudioFormat: '{0}/{1}/{2}-{3}-{4}.{5}', /*"https:tts.mediacdn.vn/2021/05/18/afmily-nam-20210521115520186.wav"*/
                    ext: 'm4a', /*ext của file, có thể là 'mp3', 'wav', 'raw', 'ogg', 'm4a'*/
                    defaultVoice: 'nu',/*giọng mặc định, ‘nam’ hoặc ‘nu’*/
                    labelAudio: 'ĐỌC BÀI', /*label audio Báo nói*/
                },function ({ }) {
                    $('.af-tts .loading').remove();
                });
            });
            @endif
            @if(env('APP_ENV')=='production')
            loadJsAsync("{{asset('https://ims.mediacdn.vn/micro/quiz/sdk/dist/play.js')}}");
            @else
            loadJsAsync("{{asset('https://mic21.cnnd.vn/statics/quiz-sdk/dist/play.js')}}");
            @endif
            loadJsAsync("{{asset('https://sp.zalo.me/plugins/sdk.js')}}");
        });
    }
</script>

