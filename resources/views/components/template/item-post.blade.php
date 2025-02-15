<div class="box-post-full" data-id='{{ $item->NewsId }}' >
    <div class="box-item-post">
        <div class="item-post-header">
            <div class="item-post-header-left">
                <img
                    src="{{ $item->ThumbImage }}"
                    alt="" loading="lazy" class="avatar-user-post">
                <div class="box-infor-user-post">
                    <div class="line-name-user-post">
                        <span class="name-user-post">{{$item->Author}}</span>
                        <img src="{{asset('image/icon-tick.png')}}" alt="" loading="lazy"
                             class="icon-tick-xanh">
                    </div>
                    <div class="line-bottom-header-post">
                        <span class="title-date-header-post">{{$item->DateTime}}</span><span
                            class="title-date-header-post">.</span><span
                            class="title-tap-post custom-line-1">{{$firstTag}}</span>
                    </div>
                </div>
            </div>
            <div class="item-post-header-right">
                <img src="{{asset('image/icon-star.png')}}" loading="lazy" alt="" class="icon-star-post">
                <img src="{{asset('image/icon-more.png')}}" loading="lazy" alt="" class="icon-more-post">
            </div>
        </div>
        <div class="item-post-content">
            <p class="name-post">{{$item->Title}}</p>
            <p class="describe-post">{{$item->Sapo}}</p>
            <div class="line-more-describe-post">
                <span>Xem tất cả</span>
                <img src="{{asset('image/more-right.png')}}" alt="" loading="lazy">
            </div>
            <div class="box-img-post">
            @php
                // Danh sách Avatar cần kiểm tra (loại bỏ ảnh rỗng)
               $avatars = array_values(array_filter([
                   $item->ThumbImage,
               ], fn($img) => !empty($img)));

               // Đếm số ảnh hợp lệ
               $countImages = count($avatars);
            @endphp
            @if ($countImages == 1)
                <!-- Hiển thị 1 ảnh -->
                    <img
                        src="{{ $item->ThumbImage }}"
                        alt="" loading="lazy" class="img-post img-single w-100">
            @elseif ($countImages == 2)
                <!-- Hiển thị 2 ảnh -->
                    <div class="img-grid img-two">
                        @foreach(array_slice($avatars, 0, 2) as $img)
                            <img src="https://cungcau.qltns.mediacdn.vn/{{ $img }}" alt="" loading="lazy"
                                 class="img-post w-50">
                        @endforeach
                    </div>
            @elseif ($countImages == 3)
                <!-- Hiển thị 3 ảnh -->
                    <div class="img-grid img-three">
                        <div class="img-left">
                            <img src="https://cungcau.qltns.mediacdn.vn/{{ $avatars[0] }}" loading="lazy"
                                 alt="" class="w-100 img-big">
                        </div>
                        <div class="img-right">
                            @foreach(array_slice($avatars, 1, 2) as $img)
                                <img src="https://cungcau.qltns.mediacdn.vn/{{ $img }}" alt="" loading="lazy"
                                     class="w-50">
                            @endforeach
                        </div>
                    </div>
            @elseif ($countImages == 4)
                <!-- Hiển thị 4 ảnh -->
                    <div class="img-grid img-four">
                        @foreach(array_slice($avatars, 0, 4) as $img)
                            <img src="https://cungcau.qltns.mediacdn.vn/{{ $img }}" alt="" loading="lazy"
                                 class="w-50">
                        @endforeach
                    </div>
            @elseif ($countImages >= 5)
                <!-- Hiển thị 5 ảnh -->
                    <div class="img-grid img-five">
                        <div class="line-two-img-post">
                            @foreach(array_slice($avatars, 0, 2) as $img)
                                <img src="https://cungcau.qltns.mediacdn.vn/{{ $img }}" alt="" loading="lazy"
                                     class="img-line-two">
                            @endforeach
                        </div>
                        <div class="img-row w-100" style="position: relative">
                            @foreach(array_slice($avatars, 2, 3) as $img)
                                <img src="https://cungcau.qltns.mediacdn.vn/{{ $img }}" alt="" loading="lazy"
                                     class="w-33">
                            @endforeach
                            @if ($countImages > 5)
                                <div class="more-images" onclick="openGlightbox()">
                                    +{{ $countImages - 5 }}</div>
                            @endif
                        </div>
                        <div id="hidden-images" style="display: none;">
                            @foreach($avatars as $img)
                                <a href="https://cungcau.qltns.mediacdn.vn/{{ $img }}"
                                   class="glightbox">
                                    <img src="https://cungcau.qltns.mediacdn.vn/{{ $img }}" loading="lazy">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p class="no-images">Không có ảnh nào.</p>
                @endif
            </div>
            <input type="hidden" value="{{$item->NewsId}}" name="newsId">
            <input type="hidden" value="{{$item->Type}}" name="type">
            <input type="hidden" value="{{$item->SiteId}}" name="siteId">
            <input type="hidden" value="{{$item->ZoneId}}" name="zoneId">
            <input type="hidden" value="{{$item->Url}}" name="url">
            <div class="line-bottom-content-post">
                <div class="line-bottom-content-post-left">
                    <div class="item-icon-function-post">
                        <img src="{{asset('image/icon-tim.png')}}" loading="lazy" alt=""
                             class="item-icon-bottom-post add-icon-favourite">
                        <span class="title-icon-function-post count-favourite">0</span>
                    </div>
                    <div class="item-icon-function-post">
                        <img src="{{asset('image/icon-bl.png')}}" loading="lazy" alt=""
                             class="item-icon-bottom-post">
                        <span class="title-icon-function-post count-comment">0</span>
                    </div>
                    <div class="item-icon-function-post">
                        <img src="{{asset('image/icon-mat.png')}}" loading="lazy" alt=""
                             class="item-icon-bottom-post">
                        <span class="title-icon-function-post count-see">0</span>
                    </div>
                </div>
                <div class="line-bottom-content-post-right">
                    <div class="item-icon-function-post" onclick="shareToFacebook(event,'http://127.0.0.1:8000/')">
                        <img src="{{asset('image/icon-cs.png')}}" loading="lazy" alt=""
                             class="item-icon-bottom-post">
                        <span
                            class="title-icon-function-post text-icon-function-post">Chia sẻ</span>
                    </div>
                    @if(!empty($item->NewsRelation))
                        <div class="item-icon-function-post">
                            <span class="title-icon-function-post">|</span>
                        </div>
                        <div class="item-icon-function-post" onclick="toggleRelatedPosts(1)">
                            <span class="title-icon-function-post text-icon-function-post">Bài viết liên quan</span>
                            <img src="{{asset('image/icon-arrow-down.png')}}" loading="lazy" alt=""
                                 class="item-icon-bottom-post item-icon-bottom-post-mobile">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(!empty($item->NewsRelation))
        @php
            $newsRelation = json_decode($item->NewsRelation, true);
        @endphp
        <div id="related-posts-1" class="related-posts swiper mySwiper">
            <div class="related-posts-container swiper-wrapper">
                @foreach($newsRelation as $value)
                    <a href="{{$value['Url']}}" class="related-post swiper-slide">
                        <img src="https://cungcau.qltns.mediacdn.vn/{{$value['Avatar']}}"
                             alt="{{$value['Title']}}">
                        <div class="custom-line-3 text-sapo-post-more">{{$value['Title']}}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
