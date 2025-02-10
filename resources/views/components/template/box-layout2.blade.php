<div class="box-category" data-layout="2" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
    @if(!empty($listNews))
    <div class="box-category-middle">
        @foreach ($listNews as $item)
            <x-layout::box-category-item :dataItem="$item">
                <x-slot name="noLazy">true</x-slot>
                <x-slot name="noTime">true</x-slot>
                <x-slot name="headingTitleTag">h2</x-slot>
                <x-slot name="trimLineTitle">4</x-slot>
                <x-slot name="noSapo">true</x-slot>

                {{--<x-slot name="noThumb">true</x-slot>--}}
                {{--<x-slot name="noLazy">true</x-slot>--}}
                {{-- <x-slot name="noDescribe">true</x-slot> --}}
                {{-- <x-slot name="noSapo">true</x-slot> --}}
                {{-- <x-slot name="noTime">true</x-slot> --}}

                {{-- <x-slot name="hasCategory">true</x-slot> --}}
                {{--<x-slot name="headingTitleTag">h2</x-slot>--}}
                {{--<x-slot name="trimLineTitle">3</x-slot>--}}
                {{-- <x-slot name="trimLineSapo">4</x-slot> --}}

                {{-- <x-slot name="isTimeAgo">true</x-slot> --}}

                {{-- <x-slot name="hasThumbVertical">true</x-slot> --}}
                {{-- <x-slot name="hasThumbSquare">true</x-slot> --}}
                {{-- <x-slot name="thumbWidth">192</x-slot> --}}
                {{-- <x-slot name="thumbHeight">255</x-slot> --}}
            </x-layout::box-category-item>
        @endforeach
    </div>
    @endif
</div>
