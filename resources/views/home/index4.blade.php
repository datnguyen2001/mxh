@if(!empty($dataPostMore))
    @foreach($dataPostMore as $item)
        @php
            $tags = explode(';', $item->TagItem ?? '');
            $firstTag = trim($tags[0]);
        @endphp
        @include('components.template.item-post')

    @endforeach
@endif
