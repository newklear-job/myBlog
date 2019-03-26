@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show Post</div>

                    <div class="card-body">
                        <h3>Title: {{$post->title}}</h3>
                        @if($post->photo)
                            <label for="">Photo:</label>
                            <br>
                            <img width="600px;" height="600px;" src="{{asset('storage/'.$post->photo) }}"
                                    alt="This image is not available at the moment"/>
                        @endif
                        <p>Description: <br>
                            {{ $post->body }}
                        </p>

                        <p>Post Categories:
                            @forelse ($post->categories as $category)
                                <a href="{{route('category.show', $category)}}">{{$category->name}}</a>
                            @empty This post has no categories!
                            @endforelse
                        </p>
                        <form onsubmit="if(confirm('DELETE?')){return true;} else {return false;}"
                              action="{{route('post.destroy', $post)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('post.edit', $post)}}">Edit</a>
                            <button class="btn" type="submit">Delete post</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
