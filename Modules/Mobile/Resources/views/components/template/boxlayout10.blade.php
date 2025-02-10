@if(!empty($listNews) && count($listNews) > 1)
    <div class="box-category box-sam-cate" data-layout="10" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
        <div class="box-category-top">
            <h2>
            <span class="box-category-title" >
                Tin cùng chuyên mục
            </span>
            </h2>
        </div>
        <div class="box-category-middle">
            @foreach ($listNews as $key => $item)
                <x-layout::box-category-item :dataItem="$item">
                    <x-slot name="trimLineTitle">4</x-slot>
                    <x-slot name="noSapo"></x-slot>
                    <x-slot name="noDescribe"></x-slot>
                </x-layout::box-category-item>
            @endforeach
        </div>
    </div>
    <script>
        (runinit = window.runinit || []).push(function () {
            var item = $('.box-sam-cate .box-category-item');
            var newsId = $('#hdNewsId').val();
            $.each(item, function (index, obj) {
                if (newsId != "undefined" && newsId != "") {
                    if ($(this).attr("data-id") == newsId) {
                        $(this).remove();
                    }
                }
            }).promise().done(function (){
                if ($('.box-sam-cate .box-category-item').length > 3){
                    $('.box-category[data-layout="13"] .box-category-item:last-child').remove();
                }
                $('.box-category-link-title[data-trimline="4"]').trimLine(4);
                try {
                    //mặc định không xoá
                    if ($('.lozad-video').length) {
                        intLozadVideo();
                    }
                }catch (e){
                    console.log(e);
                }
                try {
                    if ($('.time-ago').length){
                        var $timeago = $(".time-ago");
                        $timeago.timeago();
                    }
                } catch (e) {
                    console.log(e);
                }
            });
        });
    </script>
@endif
