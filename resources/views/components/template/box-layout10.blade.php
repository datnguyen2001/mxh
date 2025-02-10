<div class="box-category" data-layout="10" {{ isset($cdKey) ? "data-cd-key=$cdKey" : '' }} {{ isset($cdTop) ? "data-cd-top=$cdTop" : '' }}>
    @if (!empty($zoneInfo))
        <div class="box-category-top">
            <h2 class="title-category">
                <a class="box-category-title" href="{{ $zoneInfo->ZoneUrl ?? '' }}" title="{{ $zoneInfo->Name ?? '' }}">
                    {{ $zoneInfo->Name ?? '' }}
                </a>
            </h2>
        </div>
    @endif
    <div class="box-category-middle">
        @if(!empty($listNews))
            @foreach ($listNews as $key=> $item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="noTime">true</x-slot>
                    <x-slot name="trimLineTitle">2</x-slot>
                    <x-slot name="noSapo">true</x-slot>
                    @if($key>0)
                        <x-slot name="noThumb">true</x-slot>
                    @endif

                    {{--<x-slot name="noThumb">true</x-slot>--}}
                    {{--<x-slot name="noLazy">true</x-slot>--}}
                    {{-- <x-slot name="noDescribe">true</x-slot> --}}
                    {{-- <x-slot name="noSapo">true</x-slot> --}}
                    {{-- <x-slot name="noTime">true</x-slot> --}}

                    {{-- <x-slot name="hasCategory">true</x-slot> --}}
                    {{-- <x-slot name="trimLineSapo">4</x-slot> --}}
                    {{-- <x-slot name="isTimeAgo">true</x-slot> --}}

                    {{-- <x-slot name="hasThumbVertical">true</x-slot> --}}
                    {{-- <x-slot name="hasThumbSquare">true</x-slot> --}}
                    {{-- <x-slot name="thumbWidth">192</x-slot> --}}
                    {{-- <x-slot name="thumbHeight">255</x-slot> --}}

                </x-layout::box-category-item>
            @endforeach
        @endif
    </div>
</div>
