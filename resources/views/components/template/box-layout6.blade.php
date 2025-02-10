<div class="box-category" data-layout="6" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
    <div class="box-category-middle">
        <div class="box-category-layout-inter">
            <div class="item-category-inter-avatar {{$classAvt??''}}">
                @if(!empty($listNews))
                    @foreach ($listNews as $key => $item)
                        @if($key==0)
                        <a class="box-category-link-with-avatar img-resize" href="{{ $item->Url ?? '' }}"
                           title="{{ $item->Title ?? '' }}" data-id="{{ $item->NewsId ?? '' }}">
                            @if (str_ends_with($item->ThumbImage ?? '', '.gif'))
                                <video autoplay="true" muted loop playsinline
                                       class="lozad-video {{ $classImg ?? 'box-category-avatar' }} "
                                       poster="{{ ($item->ThumbImage ?? '') . '.png' }}" alt="{{ $item->Title ?? '' }}"
                                       data-src="{{ UserInterfaceHelper::formatThumbDomain($item->Avatar ?? '') . '.mp4' }}"
                                       type="video/mp4">
                                </video>
                            @else
                                <img data-type="avatar"
                                     src="{{ !empty($item->Avatar2) ? \App\Helpers\UserInterfaceHelper::formatThumbZoom($item->Avatar2,235,285): $item->ThumbImage ?? ''}}"
                                     alt="{{ $item->Title ?? '' }}" loading="lazy"
                                     class="box-category-avatar">
                            @endif
                        </a>
                        @endif
                    @endforeach
                @endif

                <a href="{{ $zoneInfo->ZoneUrl ?? '' }}" class="cate" title="{{ $zoneInfo->Name ?? '' }}">
                    {{ $zoneInfo->Name ?? '' }}
                </a>
            </div>
            <div class="list-layout-content">
                    @if(!empty($listNews))
                        @foreach ($listNews as $key => $item)
                            <x-layout::box-category-item :dataItem="$item">
                                <x-slot name="noTime">true</x-slot>
                                <x-slot name="noSapo">true</x-slot>
                                <x-slot name="trimLineTitle">3</x-slot>
                                <x-slot name="noThumb">true</x-slot>
                            </x-layout::box-category-item>
                        @endforeach
                    @endif
                    @if (!empty($zoneInfo))
                        <a href="{{ $zoneInfo->ZoneUrl ?? '' }}" class="views" title="Xem thêm">
                            Xem thêm
                            <span class="icon">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                          <path d="M4.5 9L7.5 6L4.5 3" stroke="#0055A7" stroke-width="1.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                      </span>
                        </a>
                    @endif
                </div>
        </div>
    </div>
</div>
