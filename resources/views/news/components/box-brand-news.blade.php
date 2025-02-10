@if(!empty($listNewsbyBrand))
<div class="seriesindetail">
    <div class="qleft">
        <div class="titlebox">
            <p>Tin cùng SERIES  <span>{{!empty($brandInfo)?$brandInfo->BrandName:''}}</span></p>
        </div>
        <div class="lstnews">
            <ul>
                @foreach($listNewsbyBrand as $key=>$value)
                    <li>
                        <a href="{{$value->Url}}" title="{{$value->Title}}">{{$value->Title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <a href="{{!empty($brandInfo)?$brandInfo->BrandUrl:''}}" class="viewall">Xem toàn bộ  <span>››</span></a>
    </div>
</div>
@endif
