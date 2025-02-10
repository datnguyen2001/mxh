<div class="list__mustream">
    <div class="container">
        <div class="box-mustream">
            <div class="col-news">
                <div class="box-category" data-layout="16" data-cd-key="{{$keyCd['listNews']['key']??''}}">
                    <div class="box-category-middle">
                        <x-template::item-video :listNews="$listNews"></x-template::item-video>
                        <div class="box-stream-item box-stream-item-load hidden"></div>
                    </div>
                    <x-category.box-layout-loading />
                    <div class="box-center list__viewmore list__center">
                        <a href="javascript:;" rel="nofollow" class="views" title="Xem thêm">Xem thêm</a>
                    </div>
                </div>
            </div>

            <div class="col-news-right">
                @include('components.category.box-ads-right')
            </div>
        </div>
    </div>
</div>
