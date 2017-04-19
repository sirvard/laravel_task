@extends('layouts.app')

@section('content')

<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">        
                <h4 class="modal-title">Edit Category</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => url('/editCategory/'), 'method' => 'PUT', 'class' => 'edit']) !!}
                <div class="form-group center">
                    {!! Form::text('edit_category', null, array('class' => 'form-control edit_category')) !!}
                    {!! Form::button('Edit Category', array('class' => 'btn btn-default','type' => 'submit')) !!}
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
                {!! Form::open(['url' => url('/delete/'), 'method' => 'DELETE', 'class' => 'del']) !!}
                    {!! Form::button('Yes', array('class' => 'btn btn-default confirm','type' => 'submit')) !!}
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
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2>Categories</h2>
            @if (session('edited'))
                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('edited') }}
                </div>
            @endif

            @if (session('error_msg'))
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('msg') }}
                </div>
            @endif
            @if (session('msg'))
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('msg') }}
                </div>
            @endif

            <ul class="list-group">
                @foreach($category as $category)
                    <li class="list-group-item">{{ $category->category_name}}
                        <span class="icon_cont">
                            <i class="fa fa-pencil-square-o category_edit" data-toggle="modal" data-target="#editModal" aria-hidden="true" data-id="{{ $category->id }}"></i>
                            <i class="fa fa-times category_delete" data-toggle="modal" data-target="#deleteModal" aria-hidden="true" data-id="{{ $category->id }}"></i>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
