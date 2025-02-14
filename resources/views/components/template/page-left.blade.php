<div class="box-page-left">
    <div class="box-featured-topic">
        <div class="header-featured-topic">
            <div class="box-icon-topic">
                <img src="{{asset('image/icon-topic.png')}}" alt="" loading="lazy">
            </div>
            <span class="title-topic">Chủ đề nổi bật</span>
        </div>
        <div class="box-item-featured-topic">
            @if(!empty($featuredTopics))
                @foreach($featuredTopics as $item)
                    <a href="{{$item->Url}}" class="item--featured-topic-post">
                        <img
                            src="{{ $item->Avatar ? $item->Avatar : asset('image/img-ex.png') }}"
                            alt="{{$item->Title}}" loading="lazy" class="img-post-featured-topic">
                        <div class="title-featured-topic-post">
                            {{$item->Title}}
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
    <div class="box-introduce-left">
        <a href="#" class="item-introduce-left">
            <img src="{{asset('image/icon-introduce.png')}}" loading="lazy" alt="" class="icon-introduct-left">
            <span class="title-introduct-left">Về chúng tôi</span>
        </a>
        <a href="#" class="item-introduce-left">
            <img src="{{asset('image/icon-dk.png')}}" loading="lazy" alt="" class="icon-introduct-left">
            <span class="title-introduct-left">Điều khoản bảo mật</span>
        </a>
        <a href="#" class="item-introduce-left">
            <img src="{{asset('image/icon-tt.png')}}" loading="lazy" alt="" class="icon-introduct-left">
            <span class="title-introduct-left">Thỏa thuận sử dụng</span>
        </a>
        <a href="#" class="item-introduce-left" style="border: none">
            <img src="{{asset('image/icon-qc.png')}}" loading="lazy" alt="" class="icon-introduct-left">
            <span class="title-introduct-left">Liên hệ quảng cáo</span>
        </a>
    </div>
</div>
