@if(!empty($listNews))
    <div class="box-category" data-layout="29" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
        <div class="box-category-top">
            <h2 class="title-category">
                <a class="box-category-title" href="javascript:;" rel="nofollow" title="Tin đọc nhiều">
                    Tin đọc nhiều
                </a>
            </h2>
        </div>
        <div class="box-category-middle">
            @foreach ($listNews as $key => $item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="trimLineTitle">4</x-slot>
                    <x-slot name="noSapo"></x-slot>
                    <x-slot name="noDescribe"></x-slot>
                </x-layout::box-category-item>
            @endforeach
        </div>
    </div>
@endif
