const config = require("./webpack.config.js");
const mix = require("laravel-mix");
const path = require("path");
let golb = require("glob");
// golb.sync('./Modules/**/webpack.mix.js').forEach(item => require(item));

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
function resolve(dir) {
    return path.join(__dirname, "/resources/js", dir);
}

//base js sẽ dùng chung
mix.scripts([
    "resources/core/js/lib/jquery.min.js",
    "resources/core/js/lib/js.cookie.min.js",
    "resources/core/js/lib/jquery.timeago.js",
    "resources/core/js/lib/jquery-ui.min.js",
    "resources/core/js/main/utility.js",
    "resources/template/web/js/home.js",
    "resources/template/web/js/post.js",
    "resources/core/js/main/timeline.js",

], "public/web_js/20240927/cungcau.base.js").minify(
    "public/web_js/20240927/cungcau.base.js");

//Home
mix.styles(
    [
        "resources/core/css/lib/swiper-bundle.min.css",
        // "resources/template/Web/css/scss/styles.css",
        "resources/core/css/web/dev-custom.css",
        "resources/core/css/web/dev-custom.css",
        'resources/core/css/main/loading.css',
        "resources/core/css/main/alert.css",
    ],
    "public/web_css/20230922/cnnd.home.css"
).minify("public/web_css/20230922/cnnd.home.css");


mix.scripts([
    "resources/core/js/lib/jquery.timeago.js",
    "resources/core/js/lib/js.cookie.min.js",
    "resources/core/js/main/timeline.js",
    // "resources/template/Web/js/main.js", // tuỳ biến
    "resources/core/js/main/main.js",
    "resources/core/js/main/alert.js",
    "resources/core/js/web/dev-custom.js",

], "public/web_js/20230922/cnnd.home.js").minify(
    "public/web_js/20230922/cnnd.home.js");

mix.styles(
    [
        "resources/core/css/lib/swiper-bundle.min.css",
        "resources/core/css/lib/jquery-ui.css",
        // "resources/template/Web/css/scss/styles.css",
        'resources/core/css/main/loading.css',
        "resources/core/css/web/dev-custom.css",
        "resources/core/css/web/dev-custom.css",
        "resources/core/css/main/alert.css",
    ],
    "public/web_css/20230922/cnnd.list.css"
).minify("public/web_css/20230922/cnnd.list.css");

mix.scripts([
    "resources/core/js/lib/jquery.timeago.js",
    "resources/core/js/lib/jquery-ui.min.js",
    "resources/core/js/lib/js.cookie.min.js",
    "resources/core/js/main/timeline.js",
    // "resources/template/Web/js/main.js", // tuỳ biến

    "resources/core/js/main/main.js",
    "resources/core/js/main/alert.js",
    "resources/core/js/web/dev-custom.js",

], "public/web_js/20230922/cnnd.list.js"
).minify("public/web_js/20230922/cnnd.list.js");

mix.styles(
    [
        "resources/core/css/lib/swiper-bundle.min.css",// mặc định
        // "resources/template/Web/css/scss/styles.css",
        "resources/core/css/lib/jquery.fancybox.css",// mặc định
        "resources/core/css/lib/twentytwenty.css",// mặc định
        "resources/core/css/lib/widgets.css",// mặc định
        "resources/core/css/web/detailcontent.css",// mặc định
        "resources/core/css/main/magazine.css",// mặc định bài chỉ bài magazine
        "resources/core/css/main/alert.css",// dùng khi có box vote
        "resources/core/css/main/comment.css",
        // "resources/core/css/web/detail-old.css",
        // "resources/core/css/web/detail-custom.css",
    ],
    "public/web_css/20230922/cnnd.magazine.css"
).minify("public/web_css/20230922/cnnd.magazine.css");

mix.styles(
    [
        "resources/core/css/lib/swiper-bundle.min.css",
        // "resources/template/Web/css/scss/styles.css",
        "resources/core/css/lib/jquery.fancybox.css",// mặc định
        "resources/core/css/lib/twentytwenty.css",// mặc định
        "resources/core/css/web/detailcontent.css",// mặc định
        "resources/core/css/main/comment.css",
        "resources/core/css/lib/widgets.css",// mặc định
        "resources/core/css/main/alert.css",// dùng khi có vote
        "resources/core/css/main/loading.css",
        "resources/core/css/web/dev-custom.css",
        // "resources/core/css/web/detail-custom.css",

    ], "public/web_css/20230922/cnnd.detail.css")
    .minify("public/web_css/20230922/cnnd.detail.css");


mix.scripts(
    [
        "resources/core/js/lib/jquery-ui-1.11.js",//mặc định
        "resources/core/js/lib/jquery.flip.min.js",//mặc định
        "resources/core/js/lib/videoplayer.js",//mặc định
        "resources/core/js/lib/js.cookie.min.js",//mặc định
        "resources/core/js/lib/string.js",//mặc định
        "resources/core/js/lib/facebox_openid.js",//mặc định
        "resources/core/js/lib/jquery.twentytwenty.js",//mặc định
        "resources/core/js/lib/jquery.timeago.js",// tuỳ biến

        "resources/core/js/web/jquery.beforeafter-1.4.custom.js",//mặc định
        "resources/core/js/lib/jquery.waitforimages.min.js",//mặc định
        "resources/core/js/lib/jquery.fancybox.js",//mặc định
        "resources/core/js/lib/lazysizes.min.js",//mặc định

        "resources/core/js/main/boxvote.js", // tuỳ biến dùng khi có boxvote

        "resources/core/js/lib/gif-content.js",////mặc định

        "resources/core/js/main/timeline.js", // tuỳ biến
        // "resources/template/Web/js/main.js", // tuỳ biến
        "resources/core/js/main/comment.js",

        // "resources/core/js/main/live-news.js", //live tt
        // "resources/core/js/main/detail-inter-view.min.js", //GLTT
        // "resources/core/js/main/livesport-signal.js", //live sport

        "resources/core/js/main/dev-custom.js",// tuỳ biến

        "resources/core/js/web/detail.js",// mặc định
        "resources/core/js/main/alert.js",// dùng khi có vote
        // "resources/core/js/main/video-autoplay.js",
        "resources/core/js/main/main.js",// tuỳ biến

    ],
    "public/web_js/20230922/cnnd.detail.js"
).minify("public/web_js/20230922/cnnd.detail.js");


//Login
// mix.scripts([
//     "resources/core/js/main/login/log.js",
//     "resources/core/js/main/login/oidc-client.js",
//     "resources/core/js/main/login/signalr.min.js",
//     "resources/core/js/main/login/code-identityserver-sample.js",
//     "resources/core/js/main/login/loginmainver2.js",
//     "resources/core/js/main/login/qrcode.js",
// ],'public/web_js/20230922/cnnd.login.js').minify('public/web_js/20230922/cnnd.login.js');

//Login
mix.scripts([
    "resources/core/js/main/login/log.js",
    "resources/core/js/main/login/oidc-client.js",
    "resources/core/js/main/login/signalr.min.js",
    "resources/core/js/main/login/code-identityserver-sample.js",
    "resources/core/js/main/login/loginmain.js",
],'public/web_js/cungcau.login.v06102022.js').minify('public/web_js/cungcau.login.v06102022.js');



// bigstory
// mix.styles([
//     //Add thư viện + object check bài chi tiết (Check kĩ dev-custom.css xóa những cái không dùng
//     "resources/core/css/lib/swiper-bundle.min.css",
//     "resources/core/css/lib/jquery.fancybox.css",// mặc định
//     "resources/core/css/lib/twentytwenty.css",// mặc định
//     "resources/core/css/web/detailcontent.css",// mặc định
//     "resources/core/css/main/comment.css",
//     "resources/core/css/lib/widgets.css",// mặc định
//     "resources/core/css/web/bigstory.css",
// ], 'public/web_css/20230905/cnnd.bigstory.css')
//     .minify('public/web_css/20230905/cnnd.bigstory.css');


// mix.scripts(
//     [
//         "resources/core/js/lib/jquery.min.js",//mặc định
//         "resources/core/js/lib/jquery-ui-1.11.js",//mặc định
//         "resources/core/js/lib/swiper-bundle.min.js",//mặc định
//         "resources/core/js/lib/jquery.flip.min.js",//mặc định
//         "resources/core/js/lib/videoplayer.js",//mặc định
//         "resources/core/js/lib/js.cookie.min.js",//mặc định
//         "resources/core/js/lib/string.js",//mặc định
//         "resources/core/js/lib/facebox_openid.js",//mặc định
//         "resources/core/js/lib/jquery.twentytwenty.js",//mặc định
//
//         "resources/core/js/lib/jquery.timeago.js",// tuỳ biến
//
//         "resources/core/js/web/jquery.beforeafter-1.4.custom.js",//mặc định
//         "resources/core/js/lib/jquery.waitforimages.min.js",//mặc định
//         "resources/core/js/lib/jquery.fancybox.js",//mặc định
//         "resources/core/js/lib/lazysizes.min.js",//mặc định
//
//         "resources/core/js/lib/jquery.slimscroll.js",
//
//
//         "resources/core/js/lib/gif-content.js",////mặc định
//         "resources/core/js/main/utility.js",//mặc định
//
//         "resources/core/js/main/search.js", // tuỳ biến
//         "resources/core/js/main/timeline.js", // tuỳ biến
//         "resources/template/Web/js/main.js", // tuỳ biến
//         "resources/core/js/main/bigstory.js",
//
//
//
//         "resources/core/js/web/detail.js",// mặc định
//         "resources/core/js/main/alert.js",// dùng khi có vote
//         "resources/core/js/main/main.js",// tuỳ biến
//
//     ],
//     "public/web_js/20230905/cnnd.bigstory.js"
// ).minify("public/web_js/20230905/cnnd.bigstory.js");


if (mix.inProduction()) {
    mix.version();
} else {
    // Development settings
    mix.sourceMaps();
}
