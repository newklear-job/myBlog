@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Categories</div>

                    <div class="card-body">
                        <a class="float-right" href="{{ route('category.create') }}">Create Category</a>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($categories as $category)


                            <div>
                                <h3><a href="{{route('category.edit', $category)}}">{{$category->name}}</a></h3>
                                <form onsubmit="if(confirm('Delete?')){return true;} else {return false;}" action="{{route('category.destroy', $category)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">Delete Category</button>
                                </form>
                                <p> Child categories:
                                    @forelse($category->children as $children)
                                        <a href="{{route('category.edit', $children)}}">{{$children->name}}</a>
                                    @empty
                                        No child categories
                                    @endforelse

                                </p>
                            </div>

                        @endforeach
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
