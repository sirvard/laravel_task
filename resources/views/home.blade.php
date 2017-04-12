@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row user_inform">
        <div class="col-md-4">
            @if($user->avatar)
                <img src="{{ '/images/'.$user->avatar }}" class="prof_pic" alt="">
            @else
                <img src=" {{ asset('images/profile_pic.png') }}" alt=""  class="prof_pic">
            @endif
            <form action="/user/{{\Auth::id()}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group ">
                    <input type="file" class="inp" name="image">
                    @if ($errors->has('image'))
                        <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default" name='upload'>Upload photo</button>
            </form>
        </div>
        
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>
</div>


<div class="container">
    <div class="row">
       <div class="col-md-5">
            @if (session('success'))
                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('msg'))
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('msg') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('error') }}
                </div>
            @endif
            <h2>Categories</h2>
            <form action="/addCategory" method="post">
                {{ csrf_field() }}
                 <div class="form-group">
                    <label for="cat">Category</label>
                    <input type="text" class="form-control" id="cat" name="category_name">
                    <button type="submit" class="btn btn-default">Add Category</button>
                </div>
            </form>
       </div>

       <div class="col-md-2">        </div>

       <div class="col-md-5">
            @if (session('yes'))
                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('yes') }}
                </div>
            @endif

            @if (session('fail'))
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('fail') }}
                </div>
            @endif
            <h2>Add Post</h2>
            <form action="/addPost" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Choose Category</label>
                    <select id="choose_cat"  name="category_id">
                        @foreach ($categories as $category)
                            <option value ="{{$category->id}}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">

                    <label for="cat">Post</label>
                    <textarea class="form-control" rows="5" id="comment" name="post"></textarea>
                    <button type="submit" class="btn btn-default">Add Post</button>
                </div>
            </form> 
       </div>
    </div>
</div>
@endsection
