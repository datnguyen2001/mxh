@if (!empty($listNews))
    <div class="box-category" data-layout="1" {{ isset($cdKey) ? "data-cd-key=$cdKey" : '' }} {{ isset($cdTop) ? "data-cd-top=$cdTop" : '' }}>
        <div class="box-category-middle">
            @foreach ($listNews as $key => $item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="noLazy">true</x-slot>
                    <x-slot name="noTime">true</x-slot>
                    <x-slot name="fetchpriority"></x-slot>
                    <x-slot name="headingTitleTag">h2</x-slot>
                    <x-slot name="trimLineTitle">4</x-slot>
                    <x-slot name="hasCategory">4</x-slot>
                    <x-slot name="noSapo">true</x-slot>
                </x-layout::box-category-item>
            @endforeach
        </div>
    </div>
@endif
