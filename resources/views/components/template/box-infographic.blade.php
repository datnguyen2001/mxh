@if(!empty($listNews))
    <div class="box-category" data-layout="11" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
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
                    <x-slot name="trimLineTitle">3</x-slot>
                    <x-slot name="noSapo">true</x-slot>
                </x-layout::box-category-item>
            @endforeach
            <div class="box-category-item tn-banner">
                <a href="https://www.co-opmart.com.vn/" target="_blank" title="SaiGon COOP" rel="nofollow">
                    <img src="https://static.mediacdn.vn/thumb_w/300/thanhnienviet.vn/banner/saigon_co.op.jpg" alt="SaiGon COOP" loading="lazy">
                </a>
            </div>
                <div class="box-category-item tn-banner">
                    <img src="https://static.mediacdn.vn/thumb_w/350/thanhnienviet.vn/banner/tuoi_tre_VN.jpg" alt="Tuổi trẻ Việt Nam với công tác phòng chống ma tuý" loading="lazy">
                </div>
                <div class="box-category-item tn-banner">
                    <img src="https://static.mediacdn.vn/thumb_w/250/thanhnienviet.vn/banner/VDB.jpg" alt="Ngân hàng phát triển Việt Nam" loading="lazy">
                </div>

                <div class="box-category-item tn-banner">
                    <img src="https://static.mediacdn.vn/thumb_w/350/thanhnienviet.vn/banner/vinamilk.jpg" alt="vinamilk" loading="lazy">
                </div>

                <div class="box-category-item tn-banner">
                    <a href="https://www.vietcombank.com.vn" target="_blank" rel="nofollow" title="Vietcombank">
                        <img src="https://static.mediacdn.vn/thumb_w/300/thanhnienviet.vn/banner/Vietcombank.jpg" alt="Vietcombank" loading="lazy">
                    </a>
                </div>
        </div>

    </div>
@endif
