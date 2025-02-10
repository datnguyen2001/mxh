<div class="list__menu-sub">
    <div class="container">
        <div class="box-title-menu">
            @if(($zoneInfo->Id ?? '') == ($zoneParentInfo->Id ?? ''))
            <h1 class="title-menu">
                <a href="{{ $zoneParentInfo->ZoneUrl ?? '' }}" class="category-name_ac" style="color: #111111">  {{$zoneInfo->Name??''}}</a>
            </h1>
            @else
                <div class="title-menu">
                    <a href="{{ $zoneParentInfo->ZoneUrl ?? '' }}" class="category-name_ac" style="color: #111111"> {{ $zoneParentInfo->Name ?? '' }}</a>
                </div>
            @endif
            @if (!empty($listSubZone))
            <div class="list">
                @foreach ($listSubZone as $item)
                    @if (($item->Id ?? '') == ($zoneInfo->Id ?? ''))
                        <h1 >
                            <a href="{{ $item->ZoneUrl ?? '' }}" class="item active " title="{{ $item->Name ?? '' }}" style="color: #0055a7;">
                                {{ $item->Name ?? '' }}
                            </a>
                        </h1>
                    @else
                        <a href="{{ $item->ZoneUrl ?? '' }}" class="item" title="{{ $item->Name ?? '' }}">
                            {{ $item->Name ?? '' }}
                        </a>
                    @endif
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
