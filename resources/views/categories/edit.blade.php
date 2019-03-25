@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Category</div>

                    <div class="card-body">
                        <form action="{{route('category.update', $category)}}" method="post">
                            @csrf
                            @method('PUT')

                            @include('categories.layouts.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
