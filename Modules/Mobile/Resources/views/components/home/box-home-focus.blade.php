@if(!empty($listNews))
    <div class="box-category-middle" >
        @foreach($listNews as $key => $item)
            @if(!empty($item) && $key == 0)
        <div class="box-category-item-main " data-id="{{$item->NewsId}}">
            <div class="item-first">
                <a class="box-category-link-with-avatar img-resize" href="{{$item->Url}}" title="{{$item->Title}}" data-id="{{$item->NewsId}}">
                    <img data-type="avatar" src="{{UserInterfaceHelper::formatThumbZoom($item->Avatar,750,469)}}" alt="{{$item->Title}}" class="box-category-avatar">
                </a>
                <div class="box-category-content">
                    <h2>
                        <a data-type="title" data-linktype="newsdetail" data-id="{{$item->NewsId}}" class="box-category-link-title" data-newstype="{{$item->Type}}" href="{{$item->Url}}" title="{{$item->Title}}">{{$item->Title}}</a>
                    </h2>

                    <p data-type="sapo" class="box-category-sapo" data-trimline="4">{{$item->Sapo}}</p>

                </div>
            </div>
        </div>
            @endif
        @endforeach
        <div class="box-category-list-sub">
            @foreach($listNews as $key => $item)
                @if(!empty($item) && $key > 0)
            <div class="box-category-item">
                <a class="box-category-link-with-avatar img-resize" href="{{$item->Url}}" title="{{$item->Title}}" data-id="{{$item->NewsId}}">
                    <img data-type="avatar" src="{{$item->ThumbImage}}" alt="{{$item->Title}}" data-width="value-news-width" data-height="value-news-height" class="box-category-avatar">
                </a>
                <div class="box-category-content">
                    <h3>
                        <a data-type="title" data-linktype="newsdetail" data-id="{{$item->NewsId}}" class="box-category-link-title" data-newstype="{{$item->Type}}" href="{{$item->Url}}" title="{{$item->Title}}">{{$item->Title}}</a>
                    </h3>
                </div>
            </div>
                @endif
            @endforeach
        </div>
    </div>
@endif
