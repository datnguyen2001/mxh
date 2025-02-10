@if(!empty($listNews))
    @foreach ($listNews as $key=>$item)
        <x-layout::box-category-item :dataItem="$item">
            <x-slot name="isTimeAgo">true</x-slot>
            <x-slot name="noSapo">true</x-slot>
            <x-slot name="trimLineTitle">3</x-slot>
        </x-layout::box-category-item>
    @endforeach
@endif
