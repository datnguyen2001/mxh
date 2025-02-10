@if(!empty($listNews))
    <div class="box-category" data-layout="33" {{isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
        @if(!empty($zoneInfo) && !isset($boxName))
            <div class="box-category-top">
                <h2 class="title-category">
                    <a class="box-category-title" href="{{ $zoneInfo->ZoneUrl ?? '' }}" title="{{ $zoneInfo->Name ?? '' }}">
                        {{  $zoneInfo->Name ?? '' }}
                    </a>
                </h2>
            </div>
        @elseif(!empty($boxName))
            <div class="box-category-top">
                <h2 class="title-category">
                    <a class="box-category-title" href="javascript:;" title="{{ $boxName ?? '' }}">
                        {{ $boxName ?? '' }}
                    </a>
                </h2>
            </div>
        @endif
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
