@if(!empty($listNews))
    <div class="box-category" data-layout="32" {{isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
        <div class="box-category-middle">
            @foreach($listNews as $key => $item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="noSapo"></x-slot>
                    <x-slot name="hasCategory"></x-slot>
                </x-layout::box-category-item>
            @endforeach
        </div>
    </div>
@endif
