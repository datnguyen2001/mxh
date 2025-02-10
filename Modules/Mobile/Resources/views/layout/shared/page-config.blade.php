<script>
    function getMeta(t) { let e = document.getElementsByTagName("meta"); for (let n = 0; n < e.length; n++)if (e[n].getAttribute("name") === t) return e[n].getAttribute("content"); return "" }
    var hdUserAgent = getMeta("uc:useragent");
    var isNotAllow3rd = hdUserAgent.includes("not-allow-ads");
    var pageSettings = {
        Domain: "{{config('siteInfo.site_path')}}",
        sharefbApiDomain: "{{env('SHEAR_FB_API_DOMAIN')}}",
        videoplayer: "{{env('VIDEO_PLAYER')}}",
        VideoToken: "{{env('VIDEO_TOKEN')}}",
        commentSiteName: "{{env('COMMENT_SITE_NAME')}}",
        DomainUtils: "{{env('DOMAIN_UTILS')}}",
        imageDomain: "{{env('THUMB_DOMAIN')}}",
        DomainApiVote: "{{env('DOMAIN_API_VOTE')}}",
        allowAds: {{env('ALLOW_ADS')?'true':'false'}} && !isNotAllow3rd,
        DomainUtils2: "{{env('DOMAIN_UTILS2')?env('DOMAIN_UTILS2'):'https://nc68.cnnd.vn'}}",
        DOMAIN_API_NAME_SPACE:'{{env('COMMENT_SITE_NAME')}}',
    }

    function loadJsAsync(jsLink, callback, callbackEr) {
        var scriptEl = document.createElement("script");
        scriptEl.type = "text/javascript";
        scriptEl.async = true;
        if (typeof callback == "function") {
            scriptEl.onreadystatechange = scriptEl.onload = function () {
                callback();
            };
        }
        scriptEl.src = jsLink;
        if (typeof callbackEr != "undefined") {
            scriptEl.setAttribute('onerror', callbackEr);
        }
        if (scriptEl) {
            var _scripts = document.getElementsByTagName("script");
            var checkappend = false;
            for (var i = 0; i < _scripts.length; i++) {
                if (_scripts[i].src == jsLink)
                    checkappend = true
            }
            if (!checkappend) {
                var head = document.getElementsByTagName('head')[0];
                head.appendChild(scriptEl);
            }
        }
    }

    function checkRunInit() {
        if (typeof runinit != "undefined" && runinit.length >= 1) {
            runinit[0]();
            var len = runinit.length;
            var arr = [];
            for (var i = 1; i < len; i++) {
                arr.push(runinit[i]);
            }
            runinit = arr;
        }
        window.setTimeout(function () {
            checkRunInit();
        }, 100);
    }
</script>

{{-- @include('expert.Css-quoc-tang') --}}