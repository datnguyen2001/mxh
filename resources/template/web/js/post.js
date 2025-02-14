let assetUrl = document.querySelector('meta[name="asset-url"]').getAttribute("content");
var ckUser = JSON.parse(getCookie("_ck_user"));

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) c_end = document.cookie.length;
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

function openGlightbox() {
    const hiddenImages = document.querySelectorAll('#hidden-images a');
    if (hiddenImages.length > 0) {
        hiddenImages[0].click();
    }
}

const lightbox = GLightbox({ selector: '.glightbox' });

var swiper = new Swiper(".mySwiperPost", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 4.4,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
        1024: {
            slidesPerView: 4.4,
        },
        768: {
            slidesPerView: 3.5,
        },
        0: {
            slidesPerView: 3.5,
        }
    }
});
var swiper2 = new Swiper(".mySwiperPost2", {
    loop: true,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});
var swipers = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 16,
    breakpoints: {
        1024: {
            slidesPerView: 4,
        },
        768: {
            slidesPerView: 3.3,
        },
        0: {
            slidesPerView: 2.5,
            spaceBetween: 8,
        }
    }
});

function shareToFacebook(event,postUrl) {
    event.preventDefault();
    const url = encodeURIComponent(postUrl);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
}
function toggleRelatedPosts(postId) {
    let relatedPosts = document.getElementById(`related-posts-${postId}`);
    let toggleButton = document.querySelector(`.item-icon-function-post[onclick="toggleRelatedPosts(${postId})"] img`);

    if (relatedPosts.style.display === "block") {
        relatedPosts.style.display = "none";
        toggleButton.src = assetUrl +"image/icon-arrow-down.png";
    } else {
        relatedPosts.style.display = "block";
        toggleButton.src = assetUrl +"image/icon-arrow-up.png";
    }
}

$(document).ready(function () {
    // Lấy trạng thái yêu thích & số lượng từ localStorage
    let likedPosts = JSON.parse(localStorage.getItem("likedPosts")) || {};
    let likeCounts = JSON.parse(localStorage.getItem("likeCounts")) || {};
    let lastUpdate = localStorage.getItem("lastLikeCountsUpdate");

    // Hàm kiểm tra nếu đã hơn 1 giờ kể từ lần cuối cập nhật
    function shouldUpdateLikeCounts() {
        if (!lastUpdate) return true; // Nếu chưa có dữ liệu, cho phép cập nhật

        let lastUpdateTime = new Date(lastUpdate);
        let currentTime = new Date();
        let timeDiff = (currentTime - lastUpdateTime) / (1000 * 60 * 60); // Chuyển sang giờ

        return timeDiff >= 1; // Chỉ cập nhật nếu đã hơn 1 giờ
    }

    if (shouldUpdateLikeCounts()) {
        // lấy danh sách yêu thích theo từng bài
        $(".box-post-full").each(function () {
            let postContainer = $(this);
            let newsId = postContainer.find("input[name='newsId']").val();
            let type = postContainer.find("input[name='type']").val();
            let siteId = postContainer.find("input[name='siteId']").val();
            let zoneId = postContainer.find("input[name='zoneId']").val();
            let url = postContainer.find("input[name='url']").val();

            let settings = {
                url: `https://nc97.cnnd.vn/get-votereaction.api?newsids=${newsId}&type=${type}&siteid=${siteId}&zoneid=${zoneId}&url=${url}`,
                method: "GET",
                timeout: 0,
            };

            $.ajax(settings).done(function (response) {
                if (response.Success && response.Data) {
                    let postData = response.Data.find(item => item.NewsId === newsId);
                    if (postData) {
                        let totalLikes = postData.TotalStar || 0;
                        likeCounts[newsId] = totalLikes;
                        localStorage.setItem("likeCounts", JSON.stringify(likeCounts));
                        localStorage.setItem("lastLikeCountsUpdate", new Date().toISOString());
                        postContainer.find(".item-icon-function-post .count-favourite").first().text(totalLikes);
                        if (likedPosts[newsId]) {
                            postContainer.find(".add-icon-favourite").attr("src", assetUrl+"image/icon-tim-active.png");
                        }
                    }
                }
            });
        });
    }

    // Áp dụng trạng thái yêu thích khi trang load
    $(".box-post-full").each(function () {
        let postContainer = $(this);
        let newsId = postContainer.find("input[name='newsId']").val();
        let totalLikes = likeCounts[newsId]|| 0

        if (likedPosts[newsId]) {
            postContainer.find(".add-icon-favourite").attr("src", assetUrl+"image/icon-tim-active.png");
        }
        postContainer.find(".item-icon-function-post .count-favourite").first().text(totalLikes);
    });

    // yêu thích bài viết và bỏ yêu thích bài viết
    $(".add-icon-favourite").on("click", function () {
        let postContainer = $(this).closest(".box-post-full");
        let newsId = postContainer.find("input[name='newsId']").val();
        let type = postContainer.find("input[name='type']").val();
        let siteId = postContainer.find("input[name='siteId']").val();
        let zoneId = postContainer.find("input[name='zoneId']").val();
        let userId = ckUser.id;

        if (JSON.parse(localStorage.getItem("likedPosts"))?.[newsId]) {
            removeLike(postContainer, newsId, type, siteId, zoneId, userId);
        }else {
            addLike(postContainer, newsId, siteId, zoneId, userId);
        }
    });

    // Yêu thích bài viết
    function addLike(postContainer, newsId, siteId, zoneId, userId){
        let settings = {
            url: "https://nc97.cnnd.vn/add-votereaction.api",
            method: "POST",
            timeout: 0,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            data: {
                "newsid": newsId,
                "type": "3",  // Loại tương tác (3 = yêu thích)
                "siteid": siteId,
                "zoneid": zoneId,
                "objecttype": "1",
                "userid": userId
            }
        };

        $.ajax(settings).done(function (response) {
            // if (response.Success) {
            likedPosts[newsId] = true;
            localStorage.setItem("likedPosts", JSON.stringify(likedPosts));
            postContainer.find(".add-icon-favourite").attr("src", assetUrl+"image/icon-tim-active.png");
            likeCounts[newsId] = (likeCounts[newsId] || 0) + 1;
            localStorage.setItem("likeCounts", JSON.stringify(likeCounts));
            postContainer.find(".item-icon-function-post .count-favourite").first().text(likeCounts[newsId]);
            // } else {
            //     console.log("Lỗi khi yêu thích bài viết!");
            // }
        }).fail(function () {
            console.log("Không thể kết nối đến server!");
        });
    }

    // Hàm bỏ yêu thích
    function removeLike(postContainer, newsId, type, siteId, zoneId, userId) {
        let settings = {
            url: "https://nc97.cnnd.vn/remove-votereaction.api",
            method: "POST",
            timeout: 0,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            data: {
                "newsid": newsId,
                "type": type,
                "siteid": siteId,
                "zoneid": zoneId,
                "userid": userId
            }
        };

        $.ajax(settings).done(function (response) {
            // if (response.Success) {

            // Xóa khỏi danh sách bài đã thích
            delete likedPosts[newsId];

            // Giảm số lượt thích đi 1 (nếu có)
            if (likeCounts[newsId] && likeCounts[newsId] > 0) {
                likeCounts[newsId] -= 1;
            }

            localStorage.setItem("likedPosts", JSON.stringify(likedPosts));
            localStorage.setItem("likeCounts", JSON.stringify(likeCounts));
            postContainer.find(".add-icon-favourite").attr("src", assetUrl+"image/icon-tim.png");
            postContainer.find(".count-favourite").first().text(likeCounts[newsId] || 0);
            // }
        });
    }

});
