<div class="box-category" data-layout="5" {{ isset($cdKey)?"data-cd-key=$cdKey":'' }} {{ isset($cdTop)?"data-cd-top=$cdTop":'' }}>
    <div class="box-category-top">
        <h2>
            <a class="box-category-title" href="{{ $zoneUrl ?? '' }}" title="{{ $zoneName ?? '' }}">
                {{ $zoneName ?? '' }}
            </a>
        </h2>
    </div>
    <div class="box-category-middle">
        @if(!empty($listNewsPapers))
            @foreach($listNewsPapers as $key=>$item)
                <div class="box-category-item">
                    <a class="box-category-link-with-avatar img-resize" href="{{$item->Url??''}}" title="{{$item->Title??''}}" >
                        <img data-type="avatar" src="{{$item->ThumbImage??''}}" alt="{{$item->Title??''}}"  class="box-category-avatar lazy">
                    </a>
                    <div class="box-category-content">
                        <h3 class="box-category-title-text">
                            <a data-type="title" data-linktype="newsdetail"  class="box-category-link-title"
                                href="{{$item->Url??''}}" title="{{$item->Title??''}}">{{$item->Title??''}}</a>
                        </h3>
                        <span class="box-category-category" >Phát hành ngày {{date('d/m/Y',strtotime($item->PublishedDate??''))}}</span>
                        <div class="box-flex-oder" style="justify-content: center;">
                            <a href="{{$item->Url??''}}" class="item-oder" title="{{$item->Title??''}}">
                                    <span class="icon">
                                      <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5001 18.3333C15.1025 18.3333 18.8334 14.6023 18.8334 9.99996C18.8334 5.39759 15.1025 1.66663 10.5001 1.66663C5.89771 1.66663 2.16675 5.39759 2.16675 9.99996C2.16675 14.6023 5.89771 18.3333 10.5001 18.3333Z" stroke="#111111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M10.5 13.3333V10" stroke="#111111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M10.5 6.66663H10.5083" stroke="#111111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      </svg>
                                    </span>
                                Xem trước
                            </a>

{{--                            <a href="javascript:;" class="item-oder" title="Đặt mua">--}}
{{--                                    <span class="icon">--}}
{{--                                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <g clip-path="url(#clip0_119_7331)">--}}
{{--                                          <path d="M7.50008 18.3333C7.96032 18.3333 8.33341 17.9602 8.33341 17.5C8.33341 17.0397 7.96032 16.6666 7.50008 16.6666C7.03984 16.6666 6.66675 17.0397 6.66675 17.5C6.66675 17.9602 7.03984 18.3333 7.50008 18.3333Z" stroke="#111111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                          <path d="M16.6666 18.3333C17.1268 18.3333 17.4999 17.9602 17.4999 17.5C17.4999 17.0397 17.1268 16.6666 16.6666 16.6666C16.2063 16.6666 15.8333 17.0397 15.8333 17.5C15.8333 17.9602 16.2063 18.3333 16.6666 18.3333Z" stroke="#111111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                          <path d="M0.833252 0.833374H4.16659L6.39992 11.9917C6.47612 12.3754 6.68484 12.72 6.98954 12.9653C7.29424 13.2106 7.6755 13.3409 8.06659 13.3334H16.1666C16.5577 13.3409 16.9389 13.2106 17.2436 12.9653C17.5483 12.72 17.757 12.3754 17.8333 11.9917L19.1666 5.00004H4.99992" stroke="#111111" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                        </g>--}}
{{--                                        <defs>--}}
{{--                                          <clipPath id="clip0_119_7331">--}}
{{--                                            <rect width="20" height="20" fill="white"></rect>--}}
{{--                                          </clipPath>--}}
{{--                                        </defs>--}}
{{--                                      </svg>--}}
{{--                                    </span>--}}
{{--                                Đặt mua--}}
{{--                            </a>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
