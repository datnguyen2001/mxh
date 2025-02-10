<div class="box-category" data-layout="4" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
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
                                         src="{{ !empty($item->Avatar) ? \App\Helpers\UserInterfaceHelper::formatThumbWidth($item->Avatar,642): $item->ThumbImage ?? ''}}"
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

            <div class="box-category-item">
                <div class="box-category-content">
                    @if(!empty($listNews))
                        @foreach ($listNews as $key => $item)
                            <h3 class="box-category-title-text">
                                <a data-type="title" data-linktype="newsdetail" data-id="{{$item->NewsId??''}}" data-trimline="3"
                                   class="box-category-link-title" data-newstype="{{$item->NewsType??''}}" href="{{$item->Url??''}}"
                                   title="{{$item->Title??''}}">{{$item->Title??''}}</a>
                            </h3>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
