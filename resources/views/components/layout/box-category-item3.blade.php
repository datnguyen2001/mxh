@if (!empty($dataItem))
    <div class="box-category-item" data-id="{{ $dataItem->NewsId ?? '' }}">
        <div class="box-category-content">
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
                             src="@if (isset($hasThumbVertical)){{ !empty($dataItem->Avatar2) ? $dataItem->AvatarVertical ?? '' : UserInterfaceHelper::formatThumbZoom($dataItem->Avatar ?? '', $thumbWidth, $thumbHeight, true)}}@elseif(isset($hasThumbSquare)){{!empty($dataItem->Avatar5) ? $dataItem->AvatarSquare ?? '' : UserInterfaceHelper::formatThumbZoom($dataItem->Avatar ?? '', $thumbWidth, $thumbHeight, true)}}@else{{ $dataItem->ThumbImage ?? '' }}@endif"
                             alt="{{ $dataItem->Title ?? '' }}" {{ !isset($noLazy) ? 'loading=lazy' : '' }}
                             class="box-category-avatar">
                    @endif
                </a>
            @endif
            <{{ isset($headingTitleTag) ? $headingTitleTag : 'h3' }} class="box-category-title-text">
                <a data-type="title" data-linktype="newsdetail" data-id="{{ $dataItem->NewsId ?? '' }}"
                    class="box-category-link-title" data-type="{{ $dataItem->Type ?? '' }}"
                    data-newstype="{{ $dataItem->NewsType ?? '' }}" href="{{ $dataItem->Url ?? '' }}"
                    title="{{ $dataItem->Title ?? '' }}" @if(isset( $dataItem->noFollow ))rel="nofollow"@endif
                    @if (isset($trimLineTitle)) data-trimline="{{ $trimLineTitle ?? 4 }}" @endif>{{ $dataItem->Title ?? '' }}</a>
                </{{ isset($headingTitleTag) ? $headingTitleTag : 'h3' }}>

                @if (!isset($noDescribe))
                        @if (isset($hasCategory)  && !empty($dataItem->ZoneName))
                            <a class="box-category-category" href="{{ $dataItem->ZoneUrl ?? '' }}"
                                title="{{ $dataItem->ZoneName ?? '' }}">{{ $dataItem->ZoneName ?? '' }}</a>
                        @endif

                        @if (!isset($noTime))
                            <span
                                class="box-category-time {{ isset($isTimeAgo) ? 'time-ago' : '' }}">{{ isset($isTimeAgo) ? $dataItem->DistributionDate ?? '' : date('d/m/Y H:s:i', strtotime($dataItem->DistributionDate ?? '')) }}</span>
                        @endif
                @endif


                @if (!isset($noSapo))
                    <p data-type="sapo" class="box-category-sapo"
                        @if (isset($trimLineSapo)) data-trimline="{{ $trimLineSapo ?? 4 }}" @endif>
                        {!! $dataItem->Sapo ?? '' !!}</p>
                @endif

            @if(isset($newsRelated) && !empty($dataItem->NewsRelation))
                <div class="box-category-item-related">
                    <h3 class="box-category-related-text">
                        @foreach($dataItem->NewsRelation as $key=> $value)
                        <a @if(isset( $value->noFollow ))rel="nofollow"@endif  data-type="title" class="box-category-related-link-title"  href="{{$value->Url ??''}}" title="{{$value->Title ??''}}">{{$value->Title ??''}}</a>
                        @endforeach
                    </h3>
                </div>
            @endif
        </div>
    </div>
@endif
