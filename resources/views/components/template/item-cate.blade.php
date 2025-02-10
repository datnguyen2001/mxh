@if(!empty($listNews))
    @foreach($listNews as $key => $item)
        <x-layout::box-category-item :dataItem="$item">
            <x-slot name="trimLineTitle">3</x-slot>
            <x-slot name="trimLineSapo">2</x-slot>
            <x-slot name="hasCategory"></x-slot>
            <x-slot name="noTime"></x-slot>
            @if(isset($headingTitleTag))
                <x-slot name="headingTitleTag">h2</x-slot>
            @endif
        </x-layout::box-category-item>
    @endforeach
@endif
