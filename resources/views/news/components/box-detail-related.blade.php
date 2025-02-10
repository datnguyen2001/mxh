
<x-template::box-layout13 :listNews="$listNews">
    <x-slot name="cdKey">{{$keyCd['listNews']['key'] ??''}}</x-slot>
</x-template::box-layout13>

@if(!empty($newsFocus))
    <div class="hidden">
        <div class="box-detail-new list-news-focus-detail">
            <x-template::box-layout4 :listNews="$newsFocus">
                <x-slot name="cdKey">{{$keyCd['boxFocusHome']['key'] ??''}}</x-slot>
                <x-slot name="boxName">Nổi bật</x-slot>
            </x-template::box-layout4>
        </div>
    </div>
@endif

<script>
    (runinit = window.runinit || []).push(function () {

        if ($('.hidden .list-news-focus-detail').length > 0) {
            jQuery('.hidden .list-news-focus-detail').detach().insertBefore('.insert-box-focus');
        }

        var item = $('.box-category[data-layout="13"] .box-category-item');
        var newsId = $('#hdNewsId').val();
        $.each(item, function (index, obj) {
            if (newsId != "undefined" && newsId != "") {
                if ($(this).attr("data-id") == newsId) {
                    $(this).remove();
                }
            }
        }).promise().done(function (){
            if ($('.box-category[data-layout="13"] .box-category-item').length > 6){
                $('.box-category[data-layout="13"] .box-category-item:last-child').remove();
            }
            $('.box-category-link-title[data-trimline="3"]').trimLine(3);

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
