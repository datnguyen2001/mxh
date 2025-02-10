const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');

mix.styles(
    [
        "resources/core/css/lib/swiper-bundle.min.css",
        "resources/template/Mob/css/scss/styles.css",
        "resources/core/css/main/loading.css",
        "resources/core/css/mob/dev-custom.css",
        "resources/core/css/main/alert.css",
    ],
    "public/mob_css/20230922/cnnd.home.css")
    .minify("public/mob_css/20230922/cnnd.home.css");


mix.scripts([
    "resources/core/js/lib/js.cookie.min.js",
    "resources/core/js/main/timeline.js",
    "resources/template/Mob/js/main.js",
    'resources/core/js/main/main.js',
    "resources/core/js/mob/dev_custom.js",
    "resources/core/js/main/alert.js",

], "public/mob_js/20230922/cnnd.home.js"
).minify("public/mob_js/20230922/cnnd.home.js");


mix.styles(
    [
        "resources/core/css/lib/swiper-bundle.min.css",
        "resources/template/Mob/css/scss/styles.css",
        "resources/core/css/main/loading.css",
        "resources/core/css/mob/dev-custom.css",
        "resources/core/css/main/alert.css",
    ],
    "public/mob_css/20230922/cnnd.list.css"
).minify("public/mob_css/20230922/cnnd.list.css");


mix.scripts([

    "resources/core/js/lib/js.cookie.min.js",
    "resources/core/js/main/timeline.js",
    "resources/template/Mob/js/main.js",
    'resources/core/js/main/main.js',
    "resources/core/js/mob/dev_custom.js",
    "resources/core/js/mob/list-custom.js",

], "public/mob_js/20230922/cnnd.list.js"
).minify("public/mob_js/20230922/cnnd.list.js");


mix.styles(
    [
        "resources/core/css/lib/swiper-bundle.min.css",
        "resources/template/Mob/css/scss/styles.css",
        "resources/core/css/lib/twentytwenty.css",
        "resources/core/css/mob/detailcontent.css", // default
        "resources/core/css/lib/widgets.css",
        "resources/core/css/lib/jquery.fancybox.css",
        "resources/core/css/main/magazine.css",
        "resources/core/css/main/comment.css",
        "resources/core/css/main/alert.css",
        "resources/core/css/mob/dev-custom.css",
        "resources/core/css/mob/detail-old.css",
        "resources/core/css/mob/detail-custorm.css",
    ],
    "public/mob_css/20230922/cnnd.detail_magazine.css"
).minify("public/mob_css/20230922/cnnd.detail_magazine.css");

mix.scripts(
    [
        "resources/core/js/lib/jquery-ui-1.11.js",//default

        "resources/core/js/lib/videoplayer.js",//default
        "resources/core/js/lib/gif-content.js",////default
        "resources/core/js/lib/js.cookie.min.js",//default
        "resources/core/js/lib/string.js",//default
        "resources/core/js/lib/lazysizes.min.js",//default
        "resources/core/js/mob/jquery.beforeAfter.js",//default
        "resources/core/js/lib/jquery.twentytwenty.js",//default
        "resources/core/js/lib/jquery.waitforimages.min.js",
        "resources/core/js/lib/facebox_openid.js",//default
        "resources/core/js/lib/jquery.fancybox.js",//default
        "resources/core/js/lib/jquery.timeago.js",// tuỳ biến

        "resources/core/js/main/boxvote.js", // tuỳ biến dùng khi có boxvote

        "resources/core/js/main/comment.js",
        "resources/core/js/main/timeline.js", // tuỳ biến
        "resources/template/Mob/js/main.js", // fe
        // "resources/core/js/main/live-news.js",// bài tường thuật
        // "resources/core/js/main/detail-inter-view.min.js", //GLTT
        "resources/core/js/mob/dev_custom.js",
        "resources/core/js/mob/detail.js",// default
        "resources/core/js/main/alert.js",// dùng khi có vote
        "resources/core/js/main/main.js",// tuỳ biến
    ],
    "public/mob_js/20230922/cnnd.detail.js"
).minify("public/mob_js/20230922/cnnd.detail.js");


if (mix.inProduction()) {
    mix.version();

}
