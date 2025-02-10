<div class="flex-category">
    <a href="/" class="item-category" title="trang chủ">
        Trang chủ
    </a>
    @if (!empty($zoneParentInfo) &&  !empty($zoneDetail) && $zoneParentInfo->Id != $zoneDetail->Id)
        <a href="{{ $zoneParentInfo->ZoneUrl ?? '' }}" title="{{ $zoneParentInfo->Name ?? '' }}"
            class="category-name_ac item-category">{{ $zoneParentInfo->Name ?? '' }}</a>
        @if(!empty($zoneDetail))
            <a href="{{ $zoneDetail->ZoneUrl ?? '' }}" title="{{ $zoneDetail->Name ?? '' }}"
                class="item-category active" data-role="cate-name">{{ $zoneDetail->Name ?? '' }}</a>
        @endif
    @elseif(!empty($zoneDetail))
        <a href="{{ $zoneDetail->ZoneUrl ?? '' }}" title="{{ $zoneDetail->Name ?? '' }}"
            class="category-name_ac item-category active"
            data-role="cate-name">{{ $zoneDetail->Name ?? '' }}</a>
    @endif
</div>
