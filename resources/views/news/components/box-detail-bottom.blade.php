<div class="box-careabout">
    <div class="box-category-top">
        <h2 class="box-category-title">
            Có thể bạn quan tâm
        </h2>
    </div>

    <div class="careabout-flex">
        <div class="box-left">
            <div class="box-category" data-layout="3" data-cd-key={{$keyCd['listNews']['key'] ?? ''}}>
                <div class="box-category-middle">
                    <x-template::item-cate :listNews="$listNews"></x-template::item-cate>
                    <div class="box-stream-item box-stream-item-load hidden"></div>
                </div>
                <x-category.box-layout-loading />
                <div class="box-center list__viewmore list__center">
                    <a href="javascript:;" rel="nofollow" class="views" title="Xem thêm">Xem thêm</a>
                </div>
            </div>
        </div>

        <div class="box-right">
            <div class="box-read">
                <x-template::box-layout12 :listNews="$mostViews">
                    <x-slot name="cdKey">{{$keyCd['mostViews']['key'] ?? ''}}</x-slot>
                </x-template::box-layout12>
            </div>
        </div>
    </div>
</div>
