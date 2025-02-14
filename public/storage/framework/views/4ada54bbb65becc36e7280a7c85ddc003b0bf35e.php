<script>
    function getMeta(t) { let e = document.getElementsByTagName("meta"); for (let n = 0; n < e.length; n++)if (e[n].getAttribute("name") === t) return e[n].getAttribute("content"); return "" }
    var hdUserAgent = getMeta("uc:useragent");
    var isNotAllow3rd = hdUserAgent.includes("not-allow-ads");

    var pageSettings = {
        Domain: "<?php echo e(config('siteInfo.site_path')); ?>",
        sharefbApiDomain: "<?php echo e(env('SHEAR_FB_API_DOMAIN')); ?>",
        videoplayer: "<?php echo e(env('VIDEO_PLAYER')); ?>",
        VideoToken: "<?php echo e(env('VIDEO_TOKEN')); ?>",
        ajaxDomain: "<?php echo e(env('DOMAIN_UTILS')); ?>",
        commentSiteName: "<?php echo e(env('COMMENT_SITE_NAME')); ?>",
        DomainUtils: "<?php echo e(env('DOMAIN_UTILS')); ?>",
        imageDomain: "<?php echo e(env('THUMB_DOMAIN')); ?>",
        DomainApiVote: "<?php echo e(env('DOMAIN_API_VOTE')); ?>",
        allowAds: <?php echo e(env('ALLOW_ADS')?'true':'false'); ?> && !isNotAllow3rd,
        allow3rd: <?php echo e(env('ALLOW_ADS')?'true':'false'); ?> && !isNotAllow3rd,
        DomainUtils2: "<?php echo e(env('DOMAIN_UTILS2')?env('DOMAIN_UTILS2'):'https://nc68.cnnd.vn'); ?>",
        DOMAIN_API_NAME_SPACE:'<?php echo e(env('COMMENT_SITE_NAME')); ?>',
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


<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/layout/shared/page-config.blade.php ENDPATH**/ ?>