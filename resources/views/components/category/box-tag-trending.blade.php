@if(!empty($boxTags))
    @foreach($boxTags as $key=>$item)
        <a href="{{$item->Url??''}}" class="tag" title="{{$item->Title??''}}">
          <span class="t-tag">
            #
          </span>
            <span class="text-tag">
            {{$item->Title??''}}
            </span>
        </a>
    @endforeach
@endif
