@if(!empty($listNews))
    <div class="detail__news-category special">
        <div class="container">
            <div class="box-category">
                <div class="box-category" data-layout="10" data-cd-key={{$keyCd['listNews']['key'] ?? ''}}>
                    <div class="box-category-top">
                        <h2>
                            <span class="box-category-title">
                                Có thể bạn quan tâm
                            </span>
                        </h2>
                    </div>
                    <div class="box-category-middle">
                        <x-mobile:template::item-cate :listNews="$listNews"></x-mobile:template::item-cate>
                        <div class="box-stream-item box-stream-item-load hidden"></div>
                    </div>
                    <x-category.box-layout-loading />
                    <div class="box-center list__viewmore list__center">
                        <a href="javascript:;" rel="nofollow" class="see-more" title="Xem thêm">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if(!empty($mostViews))
    <div class="home__read bg">
        <div class="container">
            <div class="box-read">
                <x-mobile:template::box-layout9 :listNews="$mostViews">
                    <x-slot name="cdKey">{{$keyCd['mostViews']['key'] ?? ''}}</x-slot>
                    <x-slot name="boxName">Đọc nhiều</x-slot>
                </x-mobile:template::box-layout9>
            </div>
        </div>
    </div>
@endif

