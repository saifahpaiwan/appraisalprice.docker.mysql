@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('users.index') }}">Users Management</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Users</li>
                </ol>
            </div>
            <h4 class="page-title"> Users Management </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Edit Users</h4>
                <p class="sub-header">
                    Edit the latest information {{ $user->updated_at }}
                </p>

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                </div>
                @endif

                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong> 
                            {!! Form::text('name', null, 
                                $attributes = $errors->has('name') 
                                ? array('placeholder' => 'Name', 'class'=>'form-control parsley-error') 
                                : array('placeholder' => 'Name', 'class'=>'form-control') ) !!}
                            @error('name')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong> 
                            {!! Form::text('email', null, 
                                $attributes = $errors->has('email') 
                                ? array('placeholder' => 'Email', 'class'=>'form-control parsley-error') 
                                : array('placeholder' => 'Email', 'class'=>'form-control') ) !!}
                            @error('email')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong> 
                            {!! Form::password('password', 
                                $attributes = $errors->has('password') 
                                ? array('placeholder' => 'Password','class' => 'form-control parsley-error')
                                : array('placeholder' => 'Password','class' => 'form-control') ) !!} 
                            @error('password')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Confirm Password:</strong>
                            {!! Form::password('confirm-password', 
                                $attributes = $errors->has('confirm-password') 
                                ? array('placeholder' => 'Confirm Password','class' => 'form-control parsley-error')
                                : array('placeholder' => 'Confirm Password','class' => 'form-control') ) !!} 
                            @error('confirm-password')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role:</strong> 
                            {!! Form::select('roles[]', $roles,$userRole,
                                $attributes = $errors->has('roles') 
                                ? array('class'=>'form-control parsley-error', 'multiple') 
                                : array('class'=>'form-control', 'multiple') ) !!}
                            @error('roles')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <hr>
                        <a href="{{ route('users.index') }}" class="btn btn-dark waves-effect waves-light">
                            <i class="fe-chevron-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fe-save"></i> Submit
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection