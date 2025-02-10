<div class="box-category" data-layout="9" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
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
                <a class="box-category-title" href="{{ $zoneUrl ?? '' }}" title="{{ $zoneTitle ?? '' }}">
                    {{ $zoneName ?? '' }}
                </a>
            </h2>
        </div>
    @endif
    <div class="box-category-middle">
        @if(!empty($listNews))
            <div class="swiper video-cate-vtv">
                <div class="swiper-wrapper">
            @foreach ($listNews as $key => $item)
                    <div class="swiper-slide">
                    <x-layout::box-category-item :dataItem="$item">
                        <x-slot name="noTime">true</x-slot>
                        <x-slot name="trimLineTitle">2</x-slot>
                        <x-slot name="trimLineSapo">2</x-slot>
                    </x-layout::box-category-item>
                    </div>
            @endforeach
                </div>
                <div class="box-control-magazine">
                    <div class="video-cate-vtv-prev">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28.5 18H7.5" stroke="#292929" stroke-width="1.2" stroke-linecap="round"
                                  stroke-linejoin="round" />
                            <path d="M13.5 12L7.5 18L13.5 24" stroke="#292929" stroke-width="1.2" stroke-linecap="round"
                                  stroke-linejoin="round" />
                        </svg>
                    </div>

                    <div class="news-pagi">
                        <div class="video-cate-vtv-pagination"></div>
                    </div>

                    <div class="video-cate-vtv-next">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 18H28.5" stroke="#292929" stroke-width="1.2" stroke-linecap="round"
                                  stroke-linejoin="round" />
                            <path d="M22.5 12L28.5 18L22.5 24" stroke="#292929" stroke-width="1.2" stroke-linecap="round"
                                  stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
