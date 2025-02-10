@if (!empty($dataByZone))
    @php
        $count = 0;
    @endphp
    @foreach ($dataByZone as $key => $dataZone)
        @if (($dataZone['info']->Id ?? '') != ($zoneInfo->Id ?? ''))
            <div class="item-news-col" data-marked-zoneid="thanhnienviet_cat_bottom{{ ++$count }}">
                <x-template::box-layout4 :listNews="$dataZone['list'] ?? ''"  :zoneInfo="$dataZone['info'] ?? ''">
                    <x-slot name="cdTop">4</x-slot>
                    <x-slot name="cdKey">{{ $dataZone['cdKey'] ?? '' }}</x-slot>
                </x-template::box-layout4>
            </div>
        @endif
    @endforeach
@endif
@if(!empty($boxMostView))
    <div class="box-read">
        <x-template::box-layout12 :listNews="$boxMostView">
            <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}highestviewnews:zoneid0hour24</x-slot>
            <x-slot name="cdTop">6</x-slot>
        </x-template::box-layout12>
    </div>
@endif
