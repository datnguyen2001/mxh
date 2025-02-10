<div class="clearfix">
    <div id="pnlInfomationBeforeMatch" class="detail_left main-col" style="width: 100%;">
    </div>
</div>
<div class="clear"></div>
<div class="clearfix loadDataLiveSport">

    <div class="boxtisotop fl" style="width:100%;">
    @if(!empty($LiveMatch))
            <div class="spritelive-x lvs_boxtiso" style="">
                <span id="lblStatus" class="spritelive lvs_time">{{!empty($LiveMatch->StatusString)?$LiveMatch->StatusString:''}}</span>
                <p class="match-info">
                    <span id="lblNameA" class="team">{{$LiveMatch->TeamA}}</span>
                    <span class="tyso">
                <span id="lblScoreA">{{$LiveMatch->ScoreOfTeamA}}</span>
                <span class="tyso_dot">-</span>
                <span id="lblScoreB">{{$LiveMatch->ScoreOfTeamB}}</span>
            </span>
                    <span id="lblNameB" class="team">{{$LiveMatch->TeamB}}</span>
                </p>
            </div>
        @endif

    </div>
    <div class="live_sport_timeline">
        <ul class="lvs_goal" id="pnlGoal" style="display: block;">
            @foreach($LiveMatchEvent as $key=>$value)
                @if($value->IsTeamA==1)
            <li style="display: flex">
                <div class="playerleft fl">
                    <span class="spritelive icon_goal"></span>
                    <span class="name_player">{{$value->PlayerName}}</span>
                </div>
                <span class="minute_goal fl">({{$value->InMinute}}')</span>
            </li>
                @else
                    <li style="display: flex">
                        <p class="playerleft fl">&nbsp;</p>
                        <span class="minute_goal fl">({{$value->InMinute}}')</span>
                        <div class="playerright fr"><span class="spritelive icon_goal"></span>
                            <span class="name_player">{{$value->PlayerName}}</span>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
        <ul class="lvs_timeline" id="pnlTimeline">
            @if(!empty($LiveMatchTimeline))
                @foreach($LiveMatchTimeline as $key=>$value)
                    <li id="timeline_{{$value->Id}}" rel={{$key}} dir={{$key}}>
                    <p id=" info_{{$value->Id}}">
                        <span class="spritelive-x tl_time fl" style="display: inline-block">{{$value->InMinute}}'</span>
                        <span class="tl_des">
                            {{$value->Description}}
                        </span>
                    <p></p>
                    <div id="video_{{$value->Id}}" class="tl_video">
                        @if(!empty($VideoKey=$value->VideoKey))
                            <div class="VCSortableInPreviewMode active" type="VideoStream" embed-type="4"
                                 data-width="490px" data-height="300px"
                                 data-item-id=""
                                 data-vid="{{$VideoKey->FileName}}"
                                 data-info="{{$VideoKey->KeyVideo}}" data-autoplay="false"
                                 data-removedlogo="false" data-location="" data-displaymode="0"
                                 data-thumb="{{$value->VideoAvatar}}"
                                 data-contentid="" data-namespace="{{$VideoKey->NameSpace}}" data-originalid="7"
                                 data-src="">
                            </div>
                        @endif
                    </div>
                    <div id="images_{{$value->Id}}" style="margin-top:10px">
                        @if(!empty((!empty($value->Images))))
                            @foreach($value->ListImages as $key=>$image)
                                <p style="text-align:center">
                                    <img title="" alt="" src="{{$image}}" width="320" height="200">
                                </p>
                            @endforeach
                        @endif
                    </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
<div class="clear"></div>
