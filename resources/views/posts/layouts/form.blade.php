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
<input class="form-control" name="title" type="text" placeholder="enter title" required>
<label>body:</label>
<input class="form-control" name="body" type="text" placeholder="enter body" required>
<label>photo:</label>
<input class="form-control" name="photo" type="text" placeholder="enter photo">

<button class="btn btn-primary" type="submit">Submit</button>