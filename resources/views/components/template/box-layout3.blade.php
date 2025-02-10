<div class="box-category" data-layout="3" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
    @if(!empty($listNews))
    <div class="box-category-middle">
        @foreach ($listNews as $item)
            <x-layout::box-category-item :dataItem="$item">
                <x-slot name="trimLineTitle">4</x-slot>
                <x-slot name="trimLineSapo">3</x-slot>
                 <x-slot name="hasCategory">true</x-slot>
                <x-slot name="noTime">true</x-slot>
            </x-layout::box-category-item>
        @endforeach
        @if(isset($isLoading))
        <div class="box-stream-item box-stream-item-load hidden"></div>
        @endif
    </div>
    @endif
    @if(isset($isPaginate))
        <div class="list__box-action">
            {{$isPaginate}}
        </div>
    @endif
</div>
