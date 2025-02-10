
<div class="detail__same-cate-nmew" data-cd-key="threadnews:threadid{{!empty($newsContent->ThreadId)?$newsContent->ThreadId:0}}">
    @if(!empty($listNewsbyThead))
    <div class="box-category-top">
        <h3>
            <a class="box-category-title" href="javascript:;" title="Bài viết cùng chủ đề">
                Bài viết cùng chủ đề
            </a>
        </h3>
    </div>
    <div class="swiper-container detail-sticky-swiper">
        <div class="swiper-wrapper">
            @foreach($listNewsbyThead as $key=>$value)
                <div class="swiper-slide">
                    <div class="box-category-item" data-id="{{$value->NewsId}}">
                        <a class="box-category-link-with-avatar  img-resize" href="{{$value->Url}}"
                           title="{{$value->Title}}" data-id="{{$value->NewsId}}">
                            <img data-type="avatar" src="{{$value->ThumbImage}}" alt="{{$value->Title}}"  class="box-category-avatar">
                        </a>
                        <div class="box-category-item-content">
                            <h4>
                                <a data-type="title" data-linktype="newsdetail" data-id="{{$value->NewsId}}" class="box-category-link-title" data-newstype="{{$value->Type}}"
                                   href="{{$value->Url}}" title="{{$value->Title}}">{{$value->Title}}</a>
                            </h4>
                            <div class="box-category-info">
                                <a href="{{$value->ZoneUrl}}" class="box-category-cate" title="{{$value->ZoneName}}">{{$value->ZoneName}}</a>
                                <span class="box-category-time time-ago" title="{{$value->DistributionDate}}">{{$value->DateTime}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="detail-sticky-pagination "></div>
    </div>
    @endif
</div>

