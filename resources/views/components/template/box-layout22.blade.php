@if(!empty($listNews))
    <div class="box-category" data-layout="22" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
        <div class="box-category-top">
            <h2 class="title-category">
                <a class="box-category-title" href="javascript:;" rel="nofollow" title="Đọc nhiều">
                    Đọc nhiều
                </a>
            </h2>
        </div>
        <div class="box-category-middle">
            @foreach ($listNews as $key => $item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="noSapo"></x-slot>
                    <x-slot name="noDescribe"></x-slot>
                    @if($key > 0)
                        <x-slot name="noThumb"></x-slot>
                    @endif
                </x-layout::box-category-item>
            @endforeach
        </div>
    </div>
@endif
