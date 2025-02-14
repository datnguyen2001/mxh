<div class="box-page-right">
    <div class="header-featured-topic">
        <div class="box-icon-topic">
            <img src="{{asset('image/icon-trend.png')}}" loading="lazy" alt="">
        </div>
        <span class="title-topic">Xu hướng</span>
    </div>
    <div class="box-post-trend-right">
        @if(!empty($trendPost))
            @foreach($trendPost as $item)
                <a href="{{$item->Url}}"
                   class="item-post-trend-right @if($loop->last) last-item-post-trend-right @endif">
                    <p class="title-post-trend-right">{{$item->Title}}</p>
                    <img
                        src="https://cungcau.qltns.mediacdn.vn/{{$item->Avatar}}" loading="lazy"
                        alt="{{$item->Title}}" class="img-post-trend-right">
                    <div class="line-bottom-post-trend">
                        <div class="line-bottom-post-trend-info">
                            <img
                                src="https://cungcau.qltns.mediacdn.vn/{{$item->Avatar}}" loading="lazy"
                                alt="{{$item->Author}}" class="img-info-post-trend-right">
                            <span class="text-info-post-trend">{{$item->Author}}</span>
                        </div>
                        <span
                            class="text-time-post-trend"> {{ \Carbon\Carbon::parse($item->LastModifiedDate)->format('d/m/Y') }}</span>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</div>
