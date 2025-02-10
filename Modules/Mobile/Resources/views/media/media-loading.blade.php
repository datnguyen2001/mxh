@if(!empty($zoneData1))
@foreach($zoneData1 as $key => $item)
<div class="box-category-item">
    <a class="box-category-link-with-avatar img-resize " href="{{$item->Url}}" title="{{$item->Name}}"
        data-id="{{$item->NewsId}}">
        @if(strpos($item->ThumbImage,".gif"))
        <a class="box-category-link-with-avatar img-resize" href="{{$item->Url}}" title="{{$item->Name}}"
            data-id="{{$item->NewsId}}">
            <video autoplay="true" muted loop playsinline class="lozad-video box-category-avatar"
                poster="{{$item->ThumbImage.'.png'}}" alt="{{$item->Name}}"
                data-src="{{UserInterfaceHelper::formatThumbDomain($item->Avatar).'.mp4'}}" type="video/mp4">
            </video>
        </a>
        @else
        <img data-type="avatar" src="{{$item->ThumbImage}}" alt="{{$item->Name}}" data-width="value-news-width"
            data-height="value-news-height" class="box-category-avatar">
        @endif

        <div class="box-label">
            <span class="icon">
                <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.9799 7.27565C11.4966 7.67599 11.4966 8.45622 10.9799 8.85656L2.36252 15.5341C1.7054 16.0433 0.749999 15.5749 0.749999 14.7436L0.75 1.38858C0.75 0.557269 1.7054 0.0889301 2.36252 0.598124L10.9799 7.27565Z"
                        fill="white" />
                </svg>
            </span>
            <span class="time">{{date_format(date_create($item->Duration),"i:s")}}</span>
        </div>

    </a>
    <div class="box-category-content">
        <h3>
            <a data-type="title" data-linktype="newsdetail" data-id="{{$item->NewsId}}" class="box-category-link-title"
                data-newstype="value-news-type" href="{{$item->Url}}" title="{{$item->Name}}"
                data-trimline="4">{{$item->Name}}</a>
        </h3>

    </div>
</div>
@endforeach
@endif
