<div class="list__video-cate">
    <div class="container">
        <div class="box-list-cate">
            <div class="item-cate">
                <div class="box-category" data-layout="13" data-cd-key="{{$keyCd['listNews']['key']??''}}">
                    <div class="box-category-middle">
                        <x-template::item-video :listNews="$listNews"></x-template::item-video>
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
</div>
