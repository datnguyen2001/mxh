@if (!empty($dataItem))
    <div class="box-category-item" data-id="{{ $dataItem->NewsId ?? '' }}">
        @if (!isset($noThumb))
            <a class="box-category-link-with-avatar img-resize" href="{{ $dataItem->Url ?? '' }}"
                title="{{ $dataItem->Title ?? '' }}" @if(isset( $dataItem->noFollow ))rel="nofollow"@endif>
                @if (str_ends_with($dataItem->ThumbImage ?? '', '.gif'))
                    <video autoplay="true" muted loop playsinline
                        class="lozad-video {{ $classImg ?? 'box-category-avatar' }} "
                        poster="{{ ($dataItem->ThumbImage ?? '') . '.png' }}" alt="{{ $dataItem->Title ?? '' }}"
                        data-src="{{ UserInterfaceHelper::formatThumbDomain($dataItem->Avatar ?? '') . '.mp4' }}"
                        type="video/mp4">
                    </video>
                @else
                    <img data-type="avatar" {{isset($fetchpriority)?'fetchpriority=high':''}}
                        src="@if (isset($hasThumbVertical)){{ !empty($dataItem->Avatar2) ? $dataItem->AvatarVertical ?? '' : UserInterfaceHelper::formatThumbZoom($dataItem->Avatar ?? '', $thumbWidth, $thumbHeight, true)}}@elseif(isset($hasThumbSquare)){{!empty($dataItem->Avatar5) ? $dataItem->AvatarSquare ?? '' : UserInterfaceHelper::formatThumbZoom($dataItem->Avatar ?? '', $thumbWidth, $thumbHeight, true)}}@else{{ $dataItem->ThumbImage ?? '' }}@endif"
                        alt="{{ $dataItem->Title ?? '' }}" {{ !isset($noLazy) ? 'loading=lazy' : '' }}
                        class="box-category-avatar">
                @endif
            </a>
        @endif
        <div class="box-category-content">
            <{{ isset($headingTitleTag) ? $headingTitleTag : 'h3' }} class="box-category-title-text">
                <a data-type="title" data-linktype="newsdetail" data-id="{{ $dataItem->NewsId ?? '' }}"
                    class="box-category-link-title" data-type="{{ $dataItem->Type ?? '' }}"
                    data-newstype="{{ $dataItem->NewsType ?? '' }}" href="{{ $dataItem->Url ?? '' }}"
                    title="{{ $dataItem->Title ?? '' }}" @if(isset( $dataItem->noFollow ))rel="nofollow"@endif
                    @if (isset($trimLineTitle)) data-trimline="{{ $trimLineTitle ?? 4 }}" @endif>{{ $dataItem->Title ?? '' }}</a>
                </{{ isset($headingTitleTag) ? $headingTitleTag : 'h3' }}>

                @if (!isset($noDescribe))
                        @if (isset($hasCategory) && !empty($dataItem->ZoneName))
                            <a class="box-category-category" href="{{ $dataItem->ZoneUrl ?? '' }}"
                                title="{{ $dataItem->ZoneName ?? '' }}">{{ $dataItem->ZoneName ?? '' }}</a>
                        @endif

                        @if (!isset($noTime))
                            <span
                                class="box-category-time {{ isset($isTimeAgo) ? 'time-ago' : '' }}" title="{{$dataItem->DistributionDate ?? ''}}">{{ isset($isTimeAgo) ?  '' : date('d/m/Y H:s:i', strtotime($dataItem->DistributionDate ?? '')) }}</span>
                        @endif
                @endif

                @if (!isset($noSapo))
                    <p data-type="sapo" class="box-category-sapo"
                        @if (isset($trimLineSapo)) data-trimline="{{ $trimLineSapo ?? 4 }}" @endif>
                        {!! $dataItem->Sapo ?? '' !!}</p>
                @endif
        </div>
    </div>
@endif
