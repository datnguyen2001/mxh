<div class="header__mm-cate">
    @if(!empty($listMenu))
        @foreach($listMenu as $key => $item)
            @if(!empty($item))
                <div class="box">
                    <a href="{{$item['ZoneUrl'] ?? ''}}" class="title" title="{{$item['Name'] ?? ''}}">{{$item['Name'] ?? ''}}</a>
                    <div class="list">
                @if(!empty($item['SubZone']))
                    @foreach($item['SubZone'] as $key => $sub)
                    <a href="{{$sub['ZoneUrl'] ?? ''}}" class="item" title="{{$sub['Name'] ?? ''}}">{{$sub['Name'] ?? ''}}</a>
                    @endforeach
                @endif
                    </div>
                    @if(count($item['SubZone'])>4)
                        <a href="javascript:;" class="view-more" title="xem thêm">xem thêm</a>
                    @endif
                </div>
            @endif
        @endforeach
    @endif
</div>
