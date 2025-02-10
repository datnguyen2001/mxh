<script>
    if (!pageSettings.allow3rd) {
        (runinitscroll = window.runinitscroll || []).push(function () {
            loadJsAsync("{{asset('/web_js/20231108/mic.base.min.js')}}",function (){//k doi ver base
                loadJsAsync("{{asset('')}}");
            });
        });
    } else if (!isNotAllow3rd) {
        loadJsAsync("{{asset('/web_js/20231108/mic.base.min.js')}}",function (){//k doi ver base
            loadJsAsync("{{asset('')}}");
        });
    }
</script>
