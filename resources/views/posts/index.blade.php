@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Posts</div>

                    <div class="card-body">
                        <a class="float-right" href="{{ route('post.create') }}">Create post</a>
                        @if(session('status'))
                            <br>
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($posts as $post)
                            <div class="col card">
                                <h3><a href="{{route('post.edit', $post)}}">{{$post->title}}</a></h3>
                                <label for="">Photo:</label>
                                <p>Description: <br>
                                {{ $post->body_excerpt }}
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
                                    <button class="btn" type="submit">Delete post</button>
                                </form>

                            </div>
                        @endforeach
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
