@if(config('config-ads.ALLOW_ADS'))
<div class="adscode">
    <zone id="{{$idAds}}"></zone>
</div>
<script>
    if (pageSettings.allow3rd) arfAsync.push("{{$idAds}}");
</script>
@endif
