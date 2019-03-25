@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<label clss="form-control">Category name:</label>
<input class="form-control" name="name" type="text" placeholder="enter name" value="{{$category->name ?? ''}}" required>

<label for="">Select Parent category:</label>
<select class="form-control" name="parent_id" id="">
    <option value="0"> -- No parent category -- </option>
    @include('categories.layouts.categoriesTree')
</select>
<button class="btn btn-primary" type="submit">Submit</button>