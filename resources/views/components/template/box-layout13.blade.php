@if(!empty($listNews) && count($listNews) > 1)
    <div class="box-category" data-layout="13" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
        <div class="box-category-top">
            <h2>
                <span class="box-category-title">
                    Tin cùng chuyên mục
                </span>
            </h2>
        </div>
        <div class="box-category-middle">
            @foreach ($listNews as $key=> $item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="trimLineTitle">3</x-slot>
                    <x-slot name="noSapo"></x-slot>
                    <x-slot name="noDescribe"></x-slot>
                </x-layout::box-category-item>
            @endforeach
        </div>
    </div>
@endif
