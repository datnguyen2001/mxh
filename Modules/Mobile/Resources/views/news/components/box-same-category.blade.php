@if(!empty($listNewsbyThead))
<div class="detail__same-cate-nmew" style="padding: 0 13px 0 13px; margin-top: 20px">
    <div class="box-category-top">
        <h2>
            <a class="box-category-title" href="javascript:;" title="Bài viết cùng chủ đề">
                Bài viết cùng chủ đề
            </a>
        </h2>
    </div>

    <div class="swiper-container detail-sticky-swiper">
        <div class="swiper-wrapper">
            @foreach($listNewsbyThead as $key=>$value)
                @if(!empty($value))
                    <div class="swiper-slide">
                        <div class="box-category-item" data-id="{{$value->NewsId}}">
                            <a class="box-category-link-with-avatar  img-resize" href="{{$value->Url}}" title="{{$value->Title}}" data-id="{{$value->NewsId}}">
                                <img data-type="avatar" src="{{$value->ThumbImage}}" alt="{{$value->Title}}" data-width="value-news-width" data-height="value-news-height" class="box-category-avatar">
                            </a>
                            <div class="box-category-item-content">
                                <h3>
                                    <a data-type="title" data-linktype="newsdetail" data-id="{{$value->NewsId}}" class="box-category-link-title" data-newstype="{{$value->NewsType}}" href="{{$value->Url}}" title="{{$value->Title}}">{{$value->Title}}</a>
                                </h3>
                                <div class="box-category-info">
                                    <a href="{{$value->ZoneUrl}}" class="box-category-cate" title="{{$value->ZoneName}}">{{$value->ZoneName}}</a>
                                    <span class="box-category-time">{{!empty($value->DateTime)?$value->DateTime:""}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="detail-sticky-pagination">
        </div>
    </div>
</div>
@endif

