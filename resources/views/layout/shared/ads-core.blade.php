@if(env('ALLOW_ADS'))
    <script>
        var arfAsync = arfAsync || [];
        if (pageSettings.allow3rd) {
            //adBlock Firefox
            loadJsAsync('https://static.amcdn.vn/tka/cdn.js');
            loadJsAsync('https://media1.admicro.vn/cms/Arf.min.js',"", callbackEr = "window.arferrorload = true;");
        }
    </script>
@endif
