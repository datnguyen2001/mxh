@if(!empty($listNews))
    <div class="box-category" data-layout="6" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
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
                    <span class="box-category-title" >
                        Video nổi bật
                    </span>
                </h2>
            </div>
        @endif
        <div class="box-category-middle">
            <div class="swiper video-home-sw">
                <div class="swiper-wrapper">
                    @foreach ($listNews as $key => $item)
                                <div class="swiper-slide">
                        <x-layout::box-category-item :dataItem="$item">
                            <x-slot name="noTime">true</x-slot>
                            <x-slot name="trimLineTitle">4</x-slot>
                            <x-slot name="noSapo">true</x-slot>
                        </x-layout::box-category-item>
                                </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="video-home-sw-pagination"></div>
@endif
