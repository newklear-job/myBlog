@foreach($categories as $eachCategory)
    <option value="{{$eachCategory->id}}"
        @isset($category->id)
            @if($category->parent_id === $eachCategory->id)
            selected
            @endif

            @if($category->id === $eachCategory->id)
            disabled
            @endif
        @endisset
    >
        {{$splitter.$eachCategory->name}}
    </option>

    @include('categories.layouts.categoriesTree', ['categories'=>$eachCategory->children, 'splitter'=> $splitter."-"])

@endforeach

