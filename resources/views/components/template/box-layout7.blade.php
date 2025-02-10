@if(!empty($listNews))
<div class="box-category" data-layout="7" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
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
                <a class="box-category-title" href="{{ $zoneUrl ?? '' }}" title="{{ $zoneName ?? '' }}">
                    {!! $icon??'' !!}
                    {{ $zoneName ?? '' }}
                </a>
            </h2>
        </div>
    @endif
    <div class="box-category-middle">
        @foreach ($listNews as $key => $item)
            <x-layout::box-category-item :dataItem="$item">
                <x-slot name="noTime">true</x-slot>
                <x-slot name="trimLineTitle">4</x-slot>
                <x-slot name="noSapo">true</x-slot>
            </x-layout::box-category-item>
        @endforeach
    </div>
    <a href="{{ $zoneUrl ?? '' }}" title="Xem thêm" class="views">
        Xem thêm
        <span class="icon">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.5 9L7.5 6L4.5 3" stroke="#0055A7" stroke-width="1.2" stroke-linecap="round"
                  stroke-linejoin="round"></path>
          </svg>
        </span>
    </a>
</div>
@endif
