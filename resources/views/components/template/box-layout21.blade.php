@if(!empty($listNews))
    <div class="box-category" data-layout="21" {{isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
        <div class="box-category-top">
            <h2 class="title-category">
                <a class="box-category-title" href="{{ $zoneInfo->ZoneUrl ?? '' }}" title="{{ $zoneInfo->Name ?? '' }}">
                    {{ $zoneInfo->Name ?? '' }}
                </a>
            </h2>
        </div>
        <div class="box-category-middle">
            @foreach($listNews as $key => $item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="noDescribe"></x-slot>
                    <x-slot name="noSapo"></x-slot>
                    @if($key > 0)
                        <x-slot name="hasThumbSquare"></x-slot>
                        <x-slot name="thumbWidth">84</x-slot>
                        <x-slot name="thumbHeight">84</x-slot>
                    @endif
                </x-layout::box-category-item>
            @endforeach
        </div>
    </div>
@endif
