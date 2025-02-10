@if(!empty($listNews))
    @foreach($listNews as $key => $item)
        <x-layout::box-category-item :dataItem="$item">
            <x-slot name="noSapo"></x-slot>
            <x-slot name="noDescribe"></x-slot>
        </x-layout::box-category-item>
    @endforeach
@endif
