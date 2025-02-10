@if (!empty($dataByZone))
    @php
        $count = 0;
    @endphp
    @foreach ($dataByZone as $key => $dataZone)
        @if (($dataZone['info']->Id ?? '') != ($zoneInfo->Id ?? ''))
            <div class="home__tech {{$count%2==0?'bg':''}}" data-marked-zoneid="thanhnienviet_cat_right{{ ++$count }}">
                <div class="container">
                    <div class="box-tech">
                        <x-mobile:template::box-layout2 :listNews="$dataZone['list'] ?? ''"  :zoneInfo="$dataZone['info'] ?? ''">
                            <x-slot name="cdTop">4</x-slot>
                            <x-slot name="cdKey">{{ $dataZone['cdKey'] ?? '' }}</x-slot>
                        </x-mobile:template::box-layout2>
                    </div>
                </div>

            </div>
        @endif
    @endforeach
@endif
@if(!empty($boxMostView))
    <div class="home__read bg">
        <div class="container">
            <div class="box-read">
                <x-mobile:template::box-layout9 :listNews="$boxMostView">
                    <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}highestviewnews:zoneid0hour24</x-slot>
                    <x-slot name="cdTop">6</x-slot>
                </x-mobile:template::box-layout9>
            </div>
        </div>
    </div>
@endif
