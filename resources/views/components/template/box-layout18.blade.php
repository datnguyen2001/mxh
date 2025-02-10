<div class="box-category" data-layout="18" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
    @if (!empty($zoneInfo))
        <div class="box-category-top">
            <h2 class="title-category">
                <a class="box-category-title" href="{{ $zoneInfo->ZoneUrl ?? '' }}" title="{{ $zoneInfo->Name ?? '' }}">
                    @if(!empty($icon))
                        <span class="icon">
                            {!! $icon??'' !!}
                        </span>
                    @endif
                    {{ $zoneInfo->Name ?? '' }}
                </a>
            </h2>
            @if(!empty($listSubZone) && is_array($listSubZone))
                <div class="box-category-menu">
                    @foreach ($listSubZone as $key=> $itemZone)
                        @if($key<2)
                            <a href="{{$itemZone->ZoneUrl??''}}" class="box-category-menu-item " title="{{$itemZone->Name??''}}" data-catid="{{$itemZone->Id??''}}">
                                {{$itemZone->Name??''}}
                            </a>
                        @endif
                    @endforeach
                    @if(count($listSubZone)>2)
                        <div class="collapse-menu">
                    <span class="icon">
                        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.52861 5.73522C3.78895 5.47487 4.21106 5.47487 4.47141 5.73522L8.00001 9.26381L11.5286 5.73522C11.789 5.47487 12.2111 5.47487 12.4714 5.73522C12.7318 5.99557 12.7318 6.41768 12.4714 6.67803L8.47142 10.678C8.34639 10.8031 8.17682 10.8733 8.00001 10.8733C7.8232 10.8733 7.65363 10.8031 7.52861 10.678L3.52861 6.67803C3.26826 6.41768 3.26826 5.99557 3.52861 5.73522Z" fill="#292929" />
                        </svg>
                    </span>
                            <div class="sub-menu">
                                @foreach ($listSubZone as $key=> $itemZone)
                                    @if($key>1)
                                        <a href="{{$itemZone->ZoneUrl??''}}" class="item " title="{{$itemZone->Name??''}}" data-catid="{{$itemZone->Id??''}}">
                                            {{$itemZone->Name??''}}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @endif
    <div class="box-category-middle">
        <div class="box-content-main">
            @if(!empty($listNews))
                @foreach ($listNews as $key => $item)
                    <x-layout::box-category-item :dataItem="$item">
                        <x-slot name="noTime">true</x-slot>
                        <x-slot name="isTimeAgo">true</x-slot>
                        <x-slot name="trimLineTitle">3</x-slot>
                        <x-slot name="noSapo">true</x-slot>
                        @if($key>0)
                            <x-slot name="noThumb">true</x-slot>
                        @endif
                    </x-layout::box-category-item>
                @endforeach
            @endif
        </div>
    </div>
</div>
