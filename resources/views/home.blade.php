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
    </div>
</div>


<div class="container">
    <div class="row">
       <div class="col-md-4">
           <h2>Categories</h2>
           <form action="" method="post">
               <div class="form-group">
                    <label for="cat">Category</label>
                    <input type="text" class="form-control" id="cat" name="category">
                    <button type="submit" name="add_category" class="btn btn-default">Add Category</button>
                </div>
           </form>
       </div>
       <div class="col-md-8">
           <h2>Posts</h2>
       </div>
    </div>
</div>
@endsection
