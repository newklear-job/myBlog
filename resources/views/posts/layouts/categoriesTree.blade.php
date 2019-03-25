@foreach($categories as $eachCategory)
    <option value="{{$eachCategory->id}}"
            @isset($post->id)
            @foreach($post->categories as $post_category)
            @if($eachCategory->id === $post_category->id)
            selected
            @endif
            @endforeach
            @endisset
    >
        {{$splitter.$eachCategory->name}}
    </option>

    @include('posts.layouts.categoriesTree', ['categories'=>$eachCategory->children, 'splitter'=> $splitter."-"])

@endforeach

