<div class="box-category" data-layout="1" {{ isset($cdKey) ? "data-cd-key=$cdKey" : '' }} {{ isset($cdTop) ? "data-cd-top=$cdTop" : '' }}>
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
        @if(!empty($listNews))
        @foreach ($listNews as $key=> $item)
            <x-layout::box-category-item :dataItem="$item">
                @if($key==0)
                    <x-slot name="trimLineTitle">2</x-slot>
                    <x-slot name="trimLineSapo">3</x-slot>
                @else
                    <x-slot name="trimLineTitle">3</x-slot>
                    <x-slot name="noSapo">true</x-slot>
                @endif
            </x-layout::box-category-item>
        @endforeach
        @endif
    </div>
</div>
