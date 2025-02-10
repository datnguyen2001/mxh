@if(!empty($listNews))
    <div class="box-category" data-layout="34"  {{isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
        @if(!empty($zoneInfo) && !isset($boxName))
            <div class="box-category-top">
                <h2 class="title-category">
                    <a class="box-category-title" href="{{ $zoneInfo->ZoneUrl ?? '' }}" title="{{ $zoneInfo->Name ?? '' }}">
                        {{ (!empty($zoneInfo->ShortURL) && $zoneInfo->ShortURL == 'clip-hay')?'Clip hot' : $zoneInfo->Name ?? '' }}
                    </a>
                </h2>
            </div>
        @elseif(!empty($boxName))
            <div class="box-category-top">
                <h2 class="title-category">
                    <a class="box-category-title" href="javascript:;" title="{{ $boxName ?? '' }}">
                        {{ $boxName ?? '' }}
                    </a>
                </h2>
            </div>
        @endif
        <div class="box-category-middle">
            @foreach($listNews as $key => $item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="noSapo"></x-slot>
                    <x-slot name="noDescribe"></x-slot>
                    <x-slot name="hasThumbSquare"></x-slot>
                    <x-slot name="thumbHeight">80</x-slot>
                    <x-slot name="thumbWidth">80</x-slot>
                </x-layout::box-category-item>
            @endforeach
        </div>
    </div>
@endif
