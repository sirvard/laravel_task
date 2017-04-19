@extends('layouts.app')

@section('content')


<div class="modal fade" id="editPost" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Edit Post</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => url('/editPost/'), 'method' => 'PUT', 'class' => 'editPost']) !!}
                <div class="form-group center">
                    {!! Form::textarea('edit_post', null, array('class' => 'form-control edit_post')) !!}
                    {!! Form::button('Edit Post', array('class' => 'btn btn-default','type' => 'submit')) !!}
                </div>
                {!! Form::close() !!}
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      
    </div>
</div>

<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
                {!! Form::open(['url' => url('/deletePost/'), 'method' => 'DELETE', 'class' => 'delete']) !!}
                    {!! Form::button('Yes', array('class' => 'btn btn-default yes','type' => 'submit')) !!}
                    {!! Form::button('No', array('class' => 'btn btn-default ignore','type' => 'submit', 'data-dismiss' => 'modal')) !!}
                {!! Form::close() !!}
                
            </div>
            <div class="modal-footer">
               
            </div>
        </div>
      
    </div>
</div>

<div class="container">
   	<div class="row">
   		<div class="col-md-1"></div>
   		<div class="col-md-10">
   			@if (session('edited'))
                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('edited') }}
                </div>
            @endif

            @if (session('error_msg'))
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('error_msg') }}
                </div>
            @endif

            @if (session('msg'))
                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('msg') }}
                </div>
            @endif
   			<ul class="list-group">
   			@foreach($posts as $post)
   				<li class="list-group-item post_list">
   					<div class="cont">
	   					<h4>{{ $post->category->category_name }}</h4>
	   					<p class="post">{{ $post->post }}</p>
	   				</div>
   					<span class="icon_cont">
                        <i class="fa fa-pencil-square-o post_edit" data-toggle="modal" data-target="#editPost" aria-hidden="true" data-id="{{ $post->id }}"></i>
                        <i class="fa fa-times post_delete" data-toggle="modal" data-target="#deleteModal" aria-hidden="true" data-id="{{ $post->id }}"></i>
                    </span>
                    <div class="time">{{ $post->created_at }}</div>
   				</li>
   			@endforeach
            {{ $paginate->links() }}
   			</ul>
   		</div>
   		<div class="col-md-1"></div>
   	</div>
</div>
@endsection
