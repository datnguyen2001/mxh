@if(!empty($listNews))
    @foreach($listNews as $key => $item)
        <li>
            <a href="{{$item->Url}}"
               title="{{$item->Name}}">
                <img alt="{{$item->Name}}"
                     src="{{$item->ThumbImage}}"
                     data-src="{{$item->ThumbImage}}"
                     class="avatar lazy loaded">
                <span class="video_ico2"></span>
                <h3>{{$item->Name}}</h3>
                <div class="ovh time">
                    <span class="clock_ico"></span><span class="time-ago" title="{{$item->DistributionDate}}">{{$item->DistributionDate}}</span>
                </div>
            </a>
        </li>

    @endforeach
@endif
