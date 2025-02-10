<?php
return
    [
        "ApiSetLog"=> 'http://logapp.cnnd.vn/api/logger/push-log',
        "Namespace_mob"=>'frontend/'.env('SITE_NAME').'Php/mob',
        "Namespace_web"=>'frontend/'.env('SITE_NAME').'Php/web',
        "AllowLog"=>env('ALLOW_LOG')
    ];
