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
            {!! Form::open(['url' => url('/user/'.$user->id), 'method' => 'PUT',  'files' => true]) !!}
                <div class="form-group ">
                    {!! Form::file('image', array('class' => 'inp')) !!}
                    @if ($errors->has('image'))
                        <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>
                {!! Form::button('Upload photo', array('class' => 'btn btn-default','type' => 'submit')) !!}
            {!! Form::close() !!}
            <!-- <form action="/user/{{\Auth::id()}}" method="post" enctype="multipart/form-data">
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
                <button type="submit" class="btn btn-default" name='upload'>@if($user->avatar)Update photo @else Upload photo @endif</button>
            </form> -->
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
            {!! Form::open(['url' => url('/addCategory'), 'method' => 'Post']) !!}
                <div class="form-group">
                    {!! Form::label('cat', 'Category') !!}
                    {!! Form::text('category_name', null, array('class' => 'form-control'))!!}
                    {!! Form::button('Add Category', array('class' => 'btn btn-default','type' => 'submit')) !!}
                </div>
            {!! Form::close(); !!}
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
            {!! Form::open(['url' => url('/addPost'), 'method' => 'Post']) !!}
                <div class="form-group">
                    {!! Form::label('choose_cat', 'Choose Category') !!}
                    <select id="choose_cat" name='category_id'>
                        @foreach ($categories as $category)
                            <option value ="{{$category->id}}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('Post') !!}
                    {!! Form::textarea('post', null, array('class' => 'form-control', 'size' => '4x4'))!!}
                    {!! Form::button('Add Post', array('class' => 'btn btn-default','type' => 'submit')) !!}
                </div>
            {!! Form::close() !!}
            
       </div>
    </div>
</div>
@endsection
