@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<label>title:</label>
<input class="form-control" name="title" type="text" placeholder="enter title" value="{{$post->title ?? ''}}" required>
<label>body:</label>
<input class="form-control" name="body" type="text" placeholder="enter body" value="{{$post->body ?? ''}}" required>
<label>photo:</label>
<input class="form-control-file" name="photo" type="file">
<label for="">Select Categories:</label>
<select class="form-control" name="categories[]" multiple>
    @include('posts.layouts.categoriesTree')
</select>

<button class="btn btn-primary" type="submit">Submit</button>