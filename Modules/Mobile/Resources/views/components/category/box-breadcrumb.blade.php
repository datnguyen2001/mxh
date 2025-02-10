<div class="list__menu">
    <div class="container">
        <div class="box-list-menu">
            @if(($zoneInfo->Id ?? '') == ($zoneParentInfo->Id ?? ''))
                <h1 class="title-cate">
                    <a href="{{ $zoneParentInfo->ZoneUrl ?? '' }}" class="category-name_ac" style="color: #111111">  {{$zoneInfo->Name??''}}</a>
                </h1>
            @else
                <div class="title-cate">
                    <a href="{{ $zoneParentInfo->ZoneUrl ?? '' }}" class="category-name_ac" style="color: #111111"> {{ $zoneParentInfo->Name ?? '' }}</a>
                </div>
            @endif
            <div class="list">
                @foreach ($listSubZone as $item)
                    @if (($item->Id ?? '') == ($zoneInfo->Id ?? ''))
                        <h1 style="display: grid;">
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
        </div>
    </div>
</div>
