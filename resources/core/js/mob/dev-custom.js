$(document).ready(function () {
    //Tìm kiếm danh sách chương trình mob
    $(".search-radio-program-text-mob").keyup(
        delay(function () {
            var text = $(this).val();
            searchProgramByText(text, "phat-thanh");
        }, 500)
    );

    $(".search-radio-program-btn-mob").click(function () {
        var text = $(".search-radio-program-text-mob").val();
        searchProgramByText(text);
    });

    $(".search-live-program-text-mob").keyup(
        delay(function () {
            var text = $(this).val();
            searchProgramByText(text);
        }, 500)
    );

    $(".search-live-program-btn-mob").click(function () {
        var text = $(".search-live-program-text-mob").val();
        searchProgramByText(text);
    });

    function searchProgramByText(text) {
        var listProgram = $(".header__channel-scroll").find(".item");
        var total = 0;
        if (!text) {
            listProgram.each(function () {
                    $(this).css("display", "flex");
                    total = listProgram.length;
            });
        } else{
            listProgram.each(function () {
                var title = $(this).attr("title");
                if (title.toLowerCase().indexOf(text.toLowerCase()) > -1) {
                    $(this).css("display", "flex");
                    total++;
                } else {
                    $(this).css("display", "none");
                }
            });
        }
        $('.title-channel').html('Tất cả chương trình (' + total + ')');
    }
    $(".header__open-news").click(function (e) {
        e.preventDefault();
        if ($.trim($("#tinmoi_header").html())=='') {
            loadTinmoi();
        }
    });
    function loadTinmoi(){
        $.ajax({
            type: "GET",
            headers: {
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            dataType:"JSON",
            cache: true,
            url: "/get-tin-moi-header.htm",
            success: function (data) {
                var listNews = $('#tinmoi_header');
                listNews.html('');
                if (data.data != null) {
                    $.each(data.data, function (index, value) {
                        listNews.append('<div class="box-category-item">\
                <a class="box-category-link-with-avatar img-resize" href="' + value.Url + '" title="' + value.Title + '" data-id="' + value.NewsId + '">\
                    <img data-type="avatar" src="' + value.ThumbImage + '" alt="' + value.Title + '" class="box-category-avatar">\
                </a>\
                <div class="box-category-content">\
                    <h3>\
                        <a data-type="title" data-linktype="newsdetail" data-id="' + value.NewsId + '" class="box-category-link-title" href="' + value.Url + '" title="{{$item->Title}}">' + value.Title + '</a>\
                    </h3>\
                </div>\
            </div>');
                    });
                }
            }
        });
    }

    $.ajax({
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        dataType: "JSON",
        cache: true,
        url: "/get-box-tag-embed.htm",
        success: function (data) {
            var listNews = $("#topic-header");
            listNews.html("");
            if (data.data != null) {
                $.each(data.data, function (index, value) {
                    listNews.append(
                        '<div class="swiper-slide" ><a href="' +
                        value.Url +
                        '" class="item">' +
                        value.Title +'</a></div>'
                    );
                });
                $('.section__top .title').show();
                var swiper = new Swiper(".stick-news-swiper", {
                    slidesPerView: 'auto',
                    spaceBetween: 12,
                });
            }else{
                $('.section__top .title').hide();
            }
        },
    });


});
