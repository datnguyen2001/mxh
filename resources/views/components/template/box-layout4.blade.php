<div class="box-category box-border-top" data-layout="4" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
    @if (!empty($zoneInfo))
        <div class="box-category-top">
            <h2 class="title-category">
                <a class="box-category-title" href="{{ $zoneInfo->ZoneUrl ?? '' }}" title="{{ $zoneInfo->Name ?? '' }}">
                    {{ $zoneInfo->Name ?? '' }}
                </a>
            </h2>
        </div>
    @else
        <div class="box-category-top">
            <h2 class="title-category">
                <span class="box-category-title">{{ (isset($boxName)) ? $boxName: 'Đừng bỏ lỡ'}}</span>
            </h2>
        </div>
    @endif

    <div class="box-category-middle">
        @if(!empty($listNews))
            @foreach ($listNews as $key=>$item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="noTime">true</x-slot>
                    <x-slot name="noSapo">true</x-slot>
                    <x-slot name="trimLineTitle">4</x-slot>
                    @if($key>0)
                    <x-slot name="noThumb">true</x-slot>
                    @endif
                </x-layout::box-category-item>
            @endforeach
        @endif
    </div>
</div>
