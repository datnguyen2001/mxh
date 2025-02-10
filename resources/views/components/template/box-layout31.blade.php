@if(!empty($listNews))
    <div class="box-category" data-layout="31"  {{ isset($cdKey) ? "data-cd-key=$cdKey" : '' }}
        {{ isset($cdTop) ? "data-cd-top=$cdTop" : '' }}>
        <div class="box-category-top">
            <h2 class="box-category-title">
                Video Tiếp theo
            </h2>
        </div>
        <div class="box-category-middle" id="videoAutoPlay">
            @foreach($listNews as $key => $item)
                <x-layout::box-category-item :dataItem="$item">
                    @if($key == 0)
                        <x-slot name="ItemActive">h2</x-slot>
                    @endif
                    <x-slot name="headingTitleTag">h2</x-slot>
                    <x-slot name="noSapo">true</x-slot>
                    <x-slot name="trimLineTitle">4</x-slot>
                    <x-slot name="hasThumbSquare"></x-slot>
                    <x-slot name="thumbHeight">80</x-slot>
                    <x-slot name="thumbWidth">80</x-slot>
                    <x-slot name="videoById"></x-slot>
                    <x-slot name="HtmlScript">
                        <div class="hidden contentScript">
                            @if(!empty($item->VideoMedia->FileName))
                                <div class="d-bg-short">
                                    <img src="{{!empty($item->VideoMedia->Poster)?UserInterfaceHelper::formatThumbWidth($item->VideoMedia->Poster,750):UserInterfaceHelper::formatThumbWidth($item->Avatar??'',750)}}" alt="image">
                                </div>
                                <div class="VCSortableInPreviewMode " type="VideoStream" embed-type="4"
                                    data-width="1170px" data-height="658px"
                                    data-item-id="{{$item->NewsId??''}}"
                                    data-vid="{{UserInterfaceHelper::formatAddDomainVid($item->VideoMedia->FileName??'')}}"
                                    data-info="{{$item->VideoMedia->KeyVideo??''}}"
                                    data-removedlogo="false" data-location="" data-displaymode="0"
                                    data-thumb="{{!empty($item->VideoMedia->Poster)?UserInterfaceHelper::formatThumbWidth($item->VideoMedia->Poster,750):UserInterfaceHelper::formatThumbWidth($item->Avatar??'',750)}}"
                                    data-contentid="" data-namespace="{{env('NAME_SPACE')}}" data-originalid="7">
                                </div>
                            @endif
                            @if(!empty($item->VideoYoutobe))
                                <div class="video-focus videoIfame iframe-resize">
                                    <div class="entry-content">
                                        {!!  $item->VideoYoutobe !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </x-slot>
                    <x-slot name="noDescribe"></x-slot>
                </x-layout::box-category-item>
            @endforeach
        </div>
    </div>
@endif
