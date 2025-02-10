@if(!empty($relationNewsList))

    <div class="detail__related">
        <div class="box-category box-border-top" data-layout="17" >
            <div class="box-category-top">
                <h2 class="title-category">
                    <a class="box-category-title" href="javascript:;" title=" Tin liên quan">
                        Tin liên quan
                    </a>
                </h2>
            </div>
            <div class="box-category-middle">
                <div class="swiper new-related-swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                    <div class="swiper-wrapper" id="swiper-wrapper-f13eaa826af2b8f1" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                        @foreach($relationNewsList as $key => $item)
                            <div class="swiper-slide">
                                <div class="box-category-item" data-id="{{$item->NewsId}}">
                                    <a class="box-category-link-with-avatar  img-resize" href="{{$item->Url}}"
                                       title="{{$item->Title}}" data-id="{{$item->NewsId}}">
                                        <img data-type="avatar" src="{{$item->ThumbImage}}" alt="{{$item->Title}}"  class="box-category-avatar">
                                    </a>
                                    <div class="box-category-item-content">
                                        <h4>
                                            <a data-type="title" data-linktype="newsdetail" data-id="{{$item->NewsId}}" class="box-category-link-title" data-newstype="{{$item->Type}}"
                                               href="{{$item->Url}}" title="{{$item->Title}}">{{$item->Title}}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                <div class="news-related-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-f13eaa826af2b8f1" aria-disabled="false">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.00053 0.455078L5.83053 1.59481L10.396 6.18235H0.455078V7.81871H10.396L5.83053 12.3784L7.00053 13.546L13.546 7.00053L7.00053 0.455078Z" fill="#686868"></path>
                    </svg>

                </div>
                <div class="news-related-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-f13eaa826af2b8f1" aria-disabled="true">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 0L8.25125 1.21887L3.36875 6.125H14V7.875H3.36875L8.25125 12.7514L7 14L0 7L7 0Z" fill="#686868"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>


@endif
