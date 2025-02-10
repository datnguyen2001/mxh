@if(!empty($listNews))
    <div class="detail__news-category bg">
        <div class="container">
            <div class="box-category box-sam-cate">
                <x-mobile:template::box-layout10 :listNews="$listNews">
                    <x-slot name="cdKey">{{$keyCd['listNews']['key'] ??''}}</x-slot>
                </x-mobile:template::box-layout10>
            </div>
        </div>
    </div>

    <script>
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
                $('.box-sam-cate .box-category-item:last-child').remove();
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
    </script>

@endif
