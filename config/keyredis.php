<?php

return [
    /*
       |--------------------------------------------------------------------------
       | Redis Keys
       |--------------------------------------------------------------------------
       |
       | Config Redis key then get data Redis
       | Ex: Get data by key newspublish
       | Redis::get(preg_replace($pattern,$replacements,config('keyredis.KeyNewsPublish')))
       |
     */

    'KeyZone'=>env('SITE_ID')."zone:id%u",

    'KeyNewsPublish'=>"newspublish:newsid%u",//không cộng SiteId

    'KeyNewsPositionIsOnHome'=>env('SITE_ID')."newspositionisonhome:zoneid%utype%u",

    'KeyNewsPosition'=>env('SITE_ID')."newsposition:zoneid%utype%u",

    'KeyNewsDisplayPosition'=>env('SITE_ID')."newsinzonedisplayposition:zone%u",

    'KeyNewsContent'=>env('SITE_ID')."newscontent:%u",

    'KeyNewsInZoneIsFocus'=>env('SITE_ID')."newsinzoneisfocus:zone%d",

    'KeyNewsInZoneIsFocusInSub'=>env('SITE_ID')."%snewsinzoneisfocus:zone%d",

    'KeyNewsContentInpage'=>env('SITE_ID')."newscontent:in_page",

    'KeyNewsContentPage'=>env('SITE_ID')."newscontent:page%u",

    'KeyNewsContentPr' => env('SITE_ID')."newscontentpr:%u",

    'KeyNewsByNewsType'=>env('SITE_ID')."newsbynewstype:newstype%u",

    'KeyNewsByType'=>env('SITE_ID')."newsbytype:type%u",

    'KeyNewsByTypeFullType'=>env('SITE_ID')."newsbytypefull:type%u",

    'KeyNewsIsFocusByNewsType'=>env('SITE_ID')."newsisfocusbynewstype:newstype%u",

    'KeyBoxNewsEmbed'=>env('SITE_ID')."newsembed:zoneid%utype%u",

    //
    'KeySortedNewsInZone'=>env('SITE_ID')."newsinzone:zone%u",

    'KeyNewsInZoneByType'=>env('SITE_ID')."newsinzonebytype:zone%utype%u",

    'KeyNewsInZoneIsOnHomeByType'=>env('SITE_ID')."newsinzonebytype%uisonhome:zone%u",

    'KeyNewsPrByModeAndZone' => env('SITE_ID')."newspr:zone%umode%u",

    'KeyNewsTopHot' => env('SITE_ID')."newstophot",

    //key special
    'KeyNewsInZoneIsOnHome'=>env('SITE_ID')."newsinzoneisonhome:zone%u",

    'KeyNewsInZoneFull'=>env('SITE_ID')."newsinzonefull:zone%u",

    'KeyNewsInZoneFullIsFoCus'=>env('SITE_ID')."newsinzonefullisfocus:zone%u",

    'KeyNewsInZoneFullIsOnHome'=>env('SITE_ID')."newsinzonefullisonhome:zone%u",

    'KeyNewsInZoneFullIsFocusHome'=>env('SITE_ID')."newsinzonefullisfocusisonhome:zone%u",

    'KeyNewsInZoneIsFocusIsOnHome'=>env('SITE_ID')."newsinzoneisfocusisonhome:zone%u",

    'KeyNewsInZoneFullOnHome'=>env('SITE_ID')."newsinzonefullonhome:zone%u",

    //key Tag
    'KeyTag'=>env('SITE_ID')."tag:id%u",

    'KeyThread'=>env('SITE_ID')."thread:id%u",

    'KeyTagUrl'=>env('SITE_ID')."tag:url%s",

    'keyVideoTagUrl'=>env('SITE_ID')."videotag:url%s",

    'KeyTagNews'=>env('SITE_ID')."tagnews:tagid%u",

    'KeySortedBoxTagEmbed'=>env('SITE_ID')."boxtagembed:type%u:zone%u",

    'KeyObjectEmbedBox'=>env('SITE_ID')."objectembedbox:zoneid%utypeid%u",

    'KeyBoxVote'=>env('SITE_ID')."vote:id%u",

    'KeyVoteAnswers'=>env('SITE_ID')."voteanswers:voteid%u",

    'KeyThreadNews'=>env('SITE_ID')."threadnews:threadid%u",

    'KeyThreadNewsFull'=>env('SITE_ID')."threadnewsfull:threadid%u",

    'KeyThreadInZone'=>env('SITE_ID')."threadinzone:zone%u",

    'KeyThreadNewsAll'=>env('SITE_ID')."thread:all",

    'KeyBoxThreadEmbed'=>env('SITE_ID')."boxthreadembed:type%u:zoneid%u",

    //highestviewnews:zoneid114hour24
    'KeyMostView'=>env('SITE_ID')."highestviewnews:zoneid%uhour%u",

    //Video
    'KeyBoxvideoEmbed'=>env('SITE_ID')."boxvideoembed:zone%u:type%u",

    'KeySortedVideoByModeAll'=>env('SITE_ID')."videomode:zoneall:mode%u",

    'KeySortedVideoByMode'=>env('SITE_ID')."videomode:zone%u:mode%u",

    'KeySortedVideoInZone'=>env('SITE_ID')."videoinzone:zone%u",

    'KeyVideoPosition'=>env('SITE_ID')."videoposition:zoneid%utype%u",

    'KeyVideo'=>env('SITE_ID')."video:id%u",

    'KeyVideoTags'=>"videotag:id%u",

    'KeyVideoIntag'=>env('SITE_ID')."videointag:videotagid%u",

    'KeySortedVideoGetAll'=>env('SITE_ID')."videoinzone:zoneall",

    'KeySortedVideoHighestplayInZone'=>env('SITE_ID')."highestplayvideo:zoneid%uhour%u",

    //Media
    'KeyMultimedia'=>env('SITE_ID')."multimedia:zone%u",

    //Đá link
    'KeyMapIdByType'=>env('SITE_ID')."type%umapid:%s",

    //Stock
    'KeyStockCode'=>env('SITE_ID')."stocks:stockcode%s",

    //Magazine
    'KeyMagazineTypeAll'=>env('SITE_ID')."magazine:typeall",

    'KeyMagazine'=>env('SITE_ID')."magazine:id%s",

    // brand
    'KeyBrandContent' =>env('SITE_ID')."brandcontent:id%u",

    'KeyBrandinnewsbyisfocus' => env('SITE_ID')."brandinnewsbyisfocus:brandid%u",


    'KeyBrandInNews' =>env('SITE_ID')."brandinnews:brandid%u",

    // thread ishot
    'KeyThreadIsHot' =>env('SITE_ID')."threadbyishot",

    // thread all
    'KeyThreadAll' =>env('SITE_ID')."threadall",

    // tag all
    'KeyTagAll' =>env('SITE_ID')."tagall",

    // topic
    'KeyTopic' =>env('SITE_ID')."topic:id%u",

    'KeyTopicInZone' =>env('SITE_ID')."topicinzone:zone%u",
    //Live Tv
    'KeyProgramChannel' =>env('SITE_ID')."programchannel:zonevideoid%u",

    'KeyNewsInTopic' =>env('SITE_ID')."newsintopic:topicid%u",

    'KeyProgramSchedule' =>"programschedule:programchannelid%udate%s",

    'KeyProgramScheduleDetail' =>"programscheduledetail:programschedule%u",

    'KeyProgramscheduleById' =>"programschedule:programchannelid%u",

    'KeyProgramScheduleDetailByZoneVideo' =>"programscheduledetail:zonevideoid%u",

    'KeyProgramScheduleDetailByZoneVideoShowonschedule' =>"programscheduledetailbyshowonschedule:zonevideoid%u",

    'KeyProgramScheduleDetailShowonschedule' =>"programscheduledetailbyshowonschedule:programschedule%u",

    'KeyProgramScheduleDetailLastestTimeByZone' =>env('SITE_ID')."programscheduledetaillastesttimebyzone:type%u",

    'KeyLastestTimeByZone' => env('SITE_ID')."lastesttimebyzone:type%u",

    //Radio
    'KeyMp3' =>env('SITE_ID')."mp3:id%u",

    'KeyMp3InZone' =>env('SITE_ID')."mp3inzone:zoneid%u",

    //Author

    'KeyAuthor' =>env('SITE_ID')."newsauthor:id%u",

    'KeyAuthorAll' =>env('SITE_ID')."newsauthor:all",

    'KeyNewsByAuthor' =>env('SITE_ID')."newsbyauthor:authorid%u",


    //game
    'KeyGateGame' => env('SITE_ID')."gategame:id%u",

    'KeygategameByOpenBetaAll' => env('SITE_ID')."gategamebyopenbeta:all",

    'KeyGateBameByIsHighHightGame'=> env('SITE_ID')."gategamebyishighlightgame:type%s",

    'GateGameByIsNewsGame'=> env('SITE_ID')."gategamebyisnewsgame:type%s",


    //Data mapping
    'KeyMapping'=> env('SITE_ID')."type9999mapid:%s",

    'KeyMapping2'=> env('SITE_ID')."type999999mapid:%s",

    'KeyMapping3'=> env('SITE_ID')."type99999mapid:%s",

];
