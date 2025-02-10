@if(!empty($newsContent))
    @if(($newsContent->allowNoIndex??false) || ($newsContent->allowFollow??false))
@section('Robots'){{($newsContent->allowNoIndex)?'noindex':''}}{{($newsContent->allowFollow && $newsContent->allowNoIndex)?',':''}}{{($newsContent->allowFollow)?'nofollow':''}}@endsection
@endif
@endif
<script src="https://adminplayer.sohatv.vn/resource/init-script/playerInitScript.js" type="text/javascript"></script>
<link href="{{asset('/web_css/20230404/tn.magazine.min.css')}}" rel="stylesheet" />

