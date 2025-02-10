@if(!empty($tagsList))
    <div class="box-tags">
    <span class="text">
        Tags:
    </span>
        <div class="list-tags">
            @foreach($tagsList as $key => $item)
                <a href="{{!empty($item->Url)?$item->Url:''}}" class="item-tags" title="{{!empty($item->Name)?$item->Name:''}}">
                    {{!empty($item->Name)?$item->Name:''}}
                </a>
            @endforeach
        </div>
    </div>
@endif
