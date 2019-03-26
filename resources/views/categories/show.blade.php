@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show Category</div>

                    <div class="card-body">
                        <div>
                            <h3>Name: {{$category->name}}</h3>
                            <label for="">Posts:</label>
                            @foreach($category->posts as $post)
                                <div class="col card">
                                    <h3><a href="{{route('post.show', $post)}}">{{$post->title}}</a></h3>
                                    @if($post->photo)
                                        <label for="">Photo:</label>
                                        <img class="rounded-circle" width="200px" height="200px"
                                             src="{{asset('storage/'.$post->photo) }}"
                                             alt="This image is not available at the moment"/>
                                    @endif
                                    <p>Description: <br>
                                        {{ $post->body_excerpt }}
                                    </p>

                                    <p>Post Categories:
                                        @forelse ($post->categories as $category)
                                            <a href="{{route('category.show', $category)}}">{{$category->name}}</a>
                                        @empty This post has no categories!
                                        @endforelse
                                    </p>
                                </div>
                            @endforeach

                            <form onsubmit="if(confirm('Delete?')){return true;} else {return false;}" action="{{route('category.destroy', $category)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('category.edit', $category)}}">Edit</a>
                                <button class="btn" type="submit">Delete Category</button>
                            </form>
                            <p> Child categories:
                                @forelse($category->children as $children)
                                    <a href="{{route('category.show', $children)}}">{{$children->name}}</a>
                                @empty
                                    No child categories
                                @endforelse

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
