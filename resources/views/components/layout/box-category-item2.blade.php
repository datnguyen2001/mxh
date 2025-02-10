@if (!empty($dataItem))
    @if(isset($typeLayout) && isset($hasThumbVertical))
        <div class="box-category-item" data-id="{{ $dataItem->NewsId ?? '' }}" data-type="{{$typeLayout??''}}">
            <{{ isset($headingTitleTag) ? $headingTitleTag : 'h3' }} class="box-category-title-text">
            <a data-type="title" data-linktype="newsdetail" data-id="{{ $dataItem->NewsId ?? '' }}"
               class="box-category-link-title" data-type="{{ $dataItem->Type ?? '' }}"
               data-newstype="{{ $dataItem->NewsType ?? '' }}" href="{{ $dataItem->Url ?? '' }}"
               title="{{ $dataItem->Title ?? '' }}" @if(isset( $dataItem->noFollow ))rel="nofollow"@endif
               @if (isset($trimLineTitle)) data-trimline="{{ $trimLineTitle ?? 4 }}" @endif>{{ $dataItem->Title ?? '' }}</a>
        </{{ isset($headingTitleTag) ? $headingTitleTag : 'h3' }}>
        <div class="box-category-item-layout">
            @if (!isset($noThumb) && !empty($dataItem->Avatar))
                <a class="box-category-link-with-avatar img-resize" href="{{ $dataItem->Url ?? '' }}" @if(isset( $dataItem->noFollow ))rel="nofollow"@endif
                   title="{{ $dataItem->Title ?? '' }}">
                    @if (str_ends_with($dataItem->ThumbImage ?? '', '.gif'))
                        <video autoplay="true" muted loop playsinline
                               class="lozad-video {{ $classImg ?? 'box-category-avatar' }} "
                               poster="{{ ($dataItem->ThumbImage ?? '') . '.png' }}" alt="{{ $dataItem->Title ?? '' }}"
                               data-src="{{ UserInterfaceHelper::formatThumbDomain($dataItem->Avatar ?? '') . '.mp4' }}"
                               type="video/mp4">
                        </video>
                    @else
                        <img data-type="avatar"
                             src="@if (isset($hasThumbVertical)){{ !empty($dataItem->Avatar2) ? UserInterfaceHelper::formatThumbZoom($dataItem->Avatar2 ?? '', $thumbWidth, $thumbHeight, true) ?? '' : UserInterfaceHelper::formatThumbZoom($dataItem->Avatar ?? '', $thumbWidth, $thumbHeight, true)}}@else{{ UserInterfaceHelper::formatThumbZoom($dataItem->Avatar ?? '', $thumbWidth, $thumbHeight, true) }}@endif"
                             alt="{{ $dataItem->Title ?? '' }}" {{ !isset($noLazy) ? 'loading=lazy' : '' }}
                             class="box-category-avatar">
                    @endif
                </a>
            @endif
            <div class="box-category-content">

                @if (!isset($noSapo))
                    <p data-type="sapo" class="box-category-sapo"
                       @if (isset($trimLineSapo)) data-trimline="{{ $trimLineSapo ?? 4 }}" @endif>
                        {!! $dataItem->Sapo ?? '' !!}</p>
                @endif
                @if (!empty($dataItem->NewsRelation) && is_array($dataItem->NewsRelation))
                    <div class="box-content-bot">
                        <p class="title-box">Xem thêm</p>
                        <div class="box-bot-item">
                            <a class="box-bot-link-with-avatar img-resize" @if(isset( $dataItem->noFollow ))rel="nofollow"@endif
                               href="{{ $dataItem->NewsRelation[0]->Url ?? '' }}"
                               title="{{ $dataItem->NewsRelation[0]->Title ?? '' }}"
                               data-id="{{ $dataItem->NewsRelation[0]->NewsId ?? '' }}"
                               data-type="{{ $dataItem->NewsRelation[0]->Type ?? '' }}"
                            >
                                @if(!empty($dataItem->NewsRelation[0]->Type) && $dataItem->NewsRelation[0]->Type==13)
                                    <img data-type="avatar"
                                         src="{{ UserInterfaceHelper::formatThumbZoom($dataItem->NewsRelation[0]->Avatar ?? '', 96, 60,true) }}"
                                         alt="{{ $dataItem->NewsRelation[0]->Title ?? '' }}" class="box-category-avatar">
                                @else
                                    <img data-type="avatar"
                                         src="{{ UserInterfaceHelper::formatThumbZoom($dataItem->NewsRelation[0]->Avatar ?? '', 96, 60,true) }}"
                                         alt="{{ $dataItem->NewsRelation[0]->Title ?? '' }}" class="box-category-avatar">
                                @endif
                            </a>
                            <div class="box-bot-content">
                                <h3 data-vr-headline>
                                    <a data-linktype="newsdetail" data-trimline="3" @if(isset( $dataItem->NewsRelation[0]->noFollow ))rel="nofollow"@endif
                                       data-id="{{ $dataItem->NewsRelation[0]->NewsId ?? '' }}"
                                       class="box-category-link-title"
                                       data-newstype='{{ $dataItem->NewsRelation[0]->Type ?? '' }}'
                                       href="{{ $dataItem->NewsRelation[0]->Url ?? '' }}"
                                       title="{{ $dataItem->NewsRelation[0]->Title ?? '' }}">{{ $dataItem->NewsRelation[0]->Title ?? '' }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            </div>
        </div>
    @else
        <div class="box-category-item" data-id="{{ $dataItem->NewsId ?? '' }}" data-type="{{$typeLayout??''}}">
            <{{ isset($headingTitleTag) ? $headingTitleTag : 'h3' }} class="box-category-title-text">
            <a data-type="title" data-linktype="newsdetail" data-id="{{ $dataItem->NewsId ?? '' }}" @if(isset( $dataItem->noFollow ))rel="nofollow"@endif
               class="box-category-link-title" data-type="{{ $dataItem->Type ?? '' }}"
               data-newstype="{{ $dataItem->NewsType ?? '' }}" href="{{ $dataItem->Url ?? '' }}"
               title="{{ $dataItem->Title ?? '' }}"
               @if (isset($trimLineTitle)) data-trimline="{{ $trimLineTitle ?? 4 }}" @endif>{{ $dataItem->Title ?? '' }}</a>
        </{{ isset($headingTitleTag) ? $headingTitleTag : 'h3' }}>
        @if(!isset($itemDefaultThumb))
        <div class="box-category-item-layout">
        @endif
            @if (!isset($noThumb) && !empty($dataItem->Avatar))
                <a class="box-category-link-with-avatar img-resize" href="{{ $dataItem->Url ?? '' }}" @if(isset( $dataItem->noFollow ))rel="nofollow"@endif
                   title="{{ $dataItem->Title ?? '' }}">
                    @if (str_ends_with($dataItem->ThumbImage ?? '', '.gif'))
                        <video autoplay="true" muted loop playsinline
                               class="lozad-video {{ $classImg ?? 'box-category-avatar' }} "
                               poster="{{ ($dataItem->ThumbImage ?? '') . '.png' }}" alt="{{ $dataItem->Title ?? '' }}"
                               data-src="{{ UserInterfaceHelper::formatThumbDomain($dataItem->Avatar ?? '') . '.mp4' }}"
                               type="video/mp4">
                        </video>
                    @else
                        @if(!isset($itemDefaultThumb))
                        <img data-type="avatar"
                             src="@if (isset($hasThumbVertical)){{ !empty($dataItem->Avatar2) ? $dataItem->AvatarVertical ?? '' : UserInterfaceHelper::formatThumbZoom($dataItem->Avatar ?? '', $thumbWidth, $thumbHeight, true)}}@elseif(isset($hasThumbSquare)){{!empty($dataItem->Avatar2) ? $dataItem->AvatarSquare ?? '' : UserInterfaceHelper::formatThumbZoom($dataItem->Avatar ?? '', $thumbWidth, $thumbHeight, true)}}@else{{ $dataItem->ThumbImage ?? '' }}@endif"
                             alt="{{ $dataItem->Title ?? '' }}" {{ !isset($noLazy) ? 'loading="lazy"' : '' }}
                             class="box-category-avatar">
                        @else
                            <img data-type="avatar"
                                 src=" {{UserInterfaceHelper::formatThumbZoom($dataItem->Avatar ?? '', $thumbWidth, $thumbHeight, true)}}"
                                 alt="{{ $dataItem->Title ?? '' }}" {{ !isset($noLazy) ? 'loading="lazy"' : '' }}
                                 class="box-category-avatar">
                        @endif
                    @endif
                </a>
            @endif
            <div class="box-category-content">
                @if (!isset($noSapo))
                    <p data-type="sapo" class="box-category-sapo"
                       @if (isset($trimLineSapo)) data-trimline="{{ $trimLineSapo ?? 4 }}" @endif>
                        {!! $dataItem->Sapo ?? '' !!}</p>
                @endif
                @if (!empty($dataItem->NewsRelation) && is_array($dataItem->NewsRelation))
                    <div class="box-category-item-related">
                        <h3 class="box-category-related-text">
                            <a  data-linktype="newsdetail" @if(isset($dataItem->NewsRelation[0]->noFollow ))rel="nofollow"@endif
                                data-id="{{ $dataItem->NewsRelation[0]->NewsId ?? '' }}"
                                class="box-category-related-link-title"
                                data-newstype="{{ $dataItem->NewsRelation[0]->Type ?? '' }}"
                                href="{{ $dataItem->NewsRelation[0]->Url ?? '' }}"
                                title="{{ $dataItem->NewsRelation[0]->Title ?? '' }}" data-trimline="3">{{ $dataItem->NewsRelation[0]->Title ?? '' }}</a>
                        </h3>

                    </div>
                @endif

            </div>
            </div>
        @if(!isset($itemDefaultThumb))
        </div>
        @endif
    @endif
@endif
