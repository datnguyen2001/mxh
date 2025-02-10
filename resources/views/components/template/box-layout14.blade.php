<div class="box-category " data-layout="14" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
    @if (!empty($zoneInfo))
        <div class="box-category-top">
            <h2 class="title-category">
                <a class="box-category-title" href="{{ $zoneInfo->ZoneUrl ?? '' }}" title="{{ $zoneInfo->Name ?? '' }}">
                    {{ $zoneInfo->Name ?? '' }}
                </a>
            </h2>
        </div>
    @endif
    <div class="box-category-middle">
        <div class="box-content-main">
            @forelse ($listNews as $key=> $item)
                    <x-layout::box-category-item :dataItem="$item">
                        <x-slot name="noTime">true</x-slot>
                        <x-slot name="isTimeAgo">true</x-slot>
                        <x-slot name="trimLineTitle">3</x-slot>
                        <x-slot name="trimLineSapo">4</x-slot>
                        @if($key>0)
                            <x-slot name="noThumb">true</x-slot>
                        @endif
                    </x-layout::box-category-item>
            @empty
            @endforelse
        </div>
    </div>
</div>
