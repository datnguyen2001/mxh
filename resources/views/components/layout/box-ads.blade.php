@if(config('config-ads.ALLOW_ADS'))
    <zone id="{{$idAds}}"></zone>
    <script>
        if (pageSettings.allow3rd) arfAsync.push("{{$idAds}}");
    </script>
@endif

