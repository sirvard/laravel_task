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
                <form method="POST"  action="/editPost" class="editPost">
                 {{ csrf_field() }}
                    <div class="form-group center">
                    	<textarea class="form-control edit_post" name="edit_post"></textarea>
                        <input type="hidden" name="_method" class="hidden" value="PUT">
                        <button type="submit" class="btn btn-default" name="edit">Edit Post</button>
                    </div>
                </form>
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
                <form action="/deletePost" method="post" class="delete">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" name="yes" class="btn btn-default yes" >Yes</button>
                    <button type="submit" class="btn btn-default ignore" data-dismiss="modal">No</button>
                </form>
                
            </div>
            <div class="modal-footer">
               
            </div>
        </div>
      
    </div>
</div>


<div class="container">
   	<div class="row">
   		<div class="col-md-1">
   		</div>
   		<div class="col-md-10">
   			@if (session('edited'))
                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{session('edited') }}
                </div>
            @endif

            @if (session('error_msg'))
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{session('error_msg') }}
                </div>
            @endif
   			<ul class="list-group">
   			@foreach($posts as $post)
   				<li class="list-group-item post_list">
   					<div class="cont">
	   					<h4>{{$post->category->category_name}}</h4>
	   					<p class="post">{{$post->post}}</p>
	   				</div>
   					<span class="icon_cont">
                        <i class="fa fa-pencil-square-o post_edit" data-toggle="modal" data-target="#editPost" aria-hidden="true" data-id="{{$post->id}}"></i>
                        <i class="fa fa-times post_delete" data-toggle="modal" data-target="#deleteModal" aria-hidden="true" data-id="{{$post->id}}"></i>
                    </span>
                    <div class="time">{{$post->created_at}}</div>
   				</li>
   			@endforeach
   			</ul>
   		</div>
   		<div class="col-md-1">
   			
   		</div>
   	</div>
</div>

@endsection