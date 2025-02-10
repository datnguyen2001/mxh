@if(!empty($zoneData1))
@foreach($zoneData1 as $key => $item)
<div class="box-category-item" data-id="{{$item->NewsId}}">
    <a class="box-category-link-with-avatar img-resize" href="{{$item->Url}}" title="{{$item->Title}}"
        data-id="{{$item->NewsId}}">
        <img data-type="avatar" src="{{$item->ThumbImage}}" alt="{{$item->Title}}" data-width="value-news-width"
            data-height="value-news-height" class="box-category-avatar">
        <div class="box-label">
            <span class="icon">
                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.5565 3.04603H11.2176V0.439331C11.2176 0.196703 11.0209 0 10.7782 0H0.439331C0.196703 0 0 0.196703 0 0.439331V11.8033C0 13.0146 0.985418 14 2.19665 14H12.7992C14.0104 14 14.9958 13.0146 14.9958 11.8033V3.48536C14.9958 3.24273 14.7991 3.04603 14.5565 3.04603ZM2.19665 13.1213C1.46991 13.1213 0.878661 12.5301 0.878661 11.8033V0.878661H10.3389C10.3389 12.4906 10.3334 11.8451 10.349 12.0106C10.3872 12.4179 10.5391 12.802 10.7793 13.1213H2.19665ZM14.1172 11.8033C14.1172 12.5301 13.5259 13.1213 12.7992 13.1213C12.7006 13.1213 12.6324 13.1213 12.5356 13.1213C11.8088 13.1213 11.2176 12.5301 11.2176 11.8033V3.92469H14.1172V11.8033Z"
                        fill="white" />
                    <path
                        d="M8.90332 2.10889H2.34265C2.10002 2.10889 1.90332 2.30559 1.90332 2.54822C1.90332 2.79084 2.10002 2.98755 2.34265 2.98755H8.90332C9.14595 2.98755 9.34265 2.79084 9.34265 2.54822C9.34265 2.30559 9.14595 2.10889 8.90332 2.10889Z"
                        fill="white" />
                    <path
                        d="M8.90332 3.9834H2.34265C2.10002 3.9834 1.90332 4.1801 1.90332 4.42273C1.90332 4.66536 2.10002 4.86206 2.34265 4.86206H8.90332C9.14595 4.86206 9.34265 4.66536 9.34265 4.42273C9.34265 4.1801 9.14595 3.9834 8.90332 3.9834Z"
                        fill="white" />
                    <path
                        d="M8.90332 11.0127H2.34265C2.10002 11.0127 1.90332 11.2094 1.90332 11.452C1.90332 11.6947 2.10002 11.8914 2.34265 11.8914H8.90332C9.14595 11.8914 9.34265 11.6947 9.34265 11.452C9.34265 11.2094 9.14595 11.0127 8.90332 11.0127Z"
                        fill="white" />
                    <path
                        d="M8.90424 5.85791H5.6239C5.38127 5.85791 5.18457 6.05461 5.18457 6.29724V9.57758C5.18457 9.8202 5.38127 10.0169 5.6239 10.0169H8.90424C9.14686 10.0169 9.34357 9.8202 9.34357 9.57758V6.29724C9.34357 6.05461 9.14686 5.85791 8.90424 5.85791ZM8.4649 9.13824H6.06323V6.73657H8.4649V9.13824Z"
                        fill="white" />
                    <path
                        d="M2.34265 7.43921H3.74851C3.99114 7.43921 4.18784 7.24251 4.18784 6.99988C4.18784 6.75725 3.99114 6.56055 3.74851 6.56055H2.34265C2.10002 6.56055 1.90332 6.75725 1.90332 6.99988C1.90332 7.24251 2.10002 7.43921 2.34265 7.43921Z"
                        fill="white" />
                    <path
                        d="M2.34265 9.31372H3.74851C3.99114 9.31372 4.18784 9.11702 4.18784 8.87439C4.18784 8.63176 3.99114 8.43506 3.74851 8.43506H2.34265C2.10002 8.43506 1.90332 8.63176 1.90332 8.87439C1.90332 9.11702 2.10002 9.31372 2.34265 9.31372Z"
                        fill="white" />
                </svg>

            </span>
        </div>
    </a>
    <div class="box-category-content">

        <h3>
            <a data-type="title" data-linktype="newsdetail" data-id="{{$item->NewsId}}" class="box-category-link-title"
                data-newstype="value-news-type" href="{{$item->Url}}" title="{{$item->Title}}"
                data-trimline="4">{{$item->Title}}</a>
        </h3>

    </div>
</div>
@endforeach
@endif
