@if(!empty($listPaper))
    @foreach($listPaper as $key => $item)
        <div class="box-category-item" data-newstype="1" data-order="{{$key}}" data-id="{{!empty($item->Id)?$item->Id:''}}">
            <a class="box-category-link-with-avatar" target="_blank" href="{{!empty($item->Url)?$item->Url:''}}" title="{{!empty($item->Title)?$item->Title:''}}" data-id="{{!empty($item->Id)?$item->Id:''}}">
                <img data-type="avatar" src="{{UserInterfaceHelper::formatThumbDomain($item->Avatar??'')}}" alt="{{!empty($item->Title)?$item->Title:''}}" loading="lazy" class="box-category-avatar">
            </a>
            <div class="box-category-item-info flex">
                <span class="box-category-time ">{{!empty($item->PublishedDate)?"Ngày ".date("d-m-Y",strtotime($item->PublishedDate)):''}}</span>
            </div>
        </div>
    @endforeach
@endif
