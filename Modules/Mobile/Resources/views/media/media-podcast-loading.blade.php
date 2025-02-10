@if(!empty($zoneData1))
@foreach($zoneData1 as $key => $item)
<div class="box-category-item">
    <h3>
        <a data-type="title" data-linktype="newsdetail" data-id="{{$item->NewsId}}" class="box-category-link-title"
            data-newstype="value-news-type" href="{{$item->Url}}" title="{{$item->Title}}">{{$item->Title}}</a>
    </h3>

    <div class="box-category-flex">
        <a class="box-category-link-with-avatar img-resize " href="{{$item->Url}}" title="{{$item->Title}}"
            data-id="{{$item->NewsId}}">
            <img data-type="avatar" src="{{$item->ThumbImage}}" alt="{{$item->Title}}" data-width="value-news-width"
                data-height="value-news-height" class="box-category-avatar">
            <div class="box-label">
                <span class="icon">
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.4002 0C5.23281 0 0.200195 5.03347 0.200195 11.2C0.200195 17.3674 5.23367 22.4 11.4002 22.4C17.5676 22.4 22.6002 17.3665 22.6002 11.2C22.6002 5.03262 17.5667 0 11.4002 0ZM11.4002 21.0875C5.94819 21.0875 1.5127 16.652 1.5127 11.2C1.5127 5.748 5.94819 1.3125 11.4002 1.3125C16.8522 1.3125 21.2877 5.748 21.2877 11.2C21.2877 16.652 16.8522 21.0875 11.4002 21.0875Z"
                            fill="white" />
                        <path
                            d="M17.3066 10.6568V9.88771C17.3066 6.63106 14.657 3.98145 11.4004 3.98145C8.14375 3.98145 5.49414 6.63106 5.49414 9.88771V10.6568C4.73022 10.9278 4.18164 11.6572 4.18164 12.5127V13.8252C4.18164 14.9108 5.06484 15.794 6.15039 15.794H8.11914V10.544H6.80664V9.88771C6.80664 7.35465 8.86733 5.29395 11.4004 5.29395C13.9334 5.29395 15.9941 7.35465 15.9941 9.88771V10.544H14.6816V15.794H16.6504C17.7359 15.794 18.6191 14.9108 18.6191 13.8252V12.5127C18.6191 11.6572 18.0706 10.9278 17.3066 10.6568ZM6.80664 14.4815H6.15039C5.7886 14.4815 5.49414 14.187 5.49414 13.8252V12.5127C5.49414 12.1509 5.7886 11.8565 6.15039 11.8565H6.80664V14.4815ZM17.3066 13.8252C17.3066 14.187 17.0122 14.4815 16.6504 14.4815H15.9941V11.8565H16.6504C17.0122 11.8565 17.3066 12.1509 17.3066 12.5127V13.8252Z"
                            fill="white" />
                    </svg>

                </span>
            </div>
        </a>

        <div class="box-category-content">
            <p data-type="sapo" class="box-category-sapo" data-trimline="4">{{$item->Sapo}}</p>

        </div>
    </div>
</div>
@endforeach
@endif
