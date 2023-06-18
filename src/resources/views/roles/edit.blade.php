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
                        <a href="{{ route('roles.index') }}">Role Management</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Role</li>
                </ol>
            </div>
            <h4 class="page-title"> Edit Role </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Edit Role</h4>
                <p class="sub-header">
                    Edit Role Day {{ Date('Y-m-d') }}
                </p>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                </div>
                @endif

                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, $attributes = $errors->has('name') ? array('placeholder' => 'Name', 'class'=>'form-control parsley-error') : array('placeholder' => 'Name', 'class'=>'form-control') ) !!}
                            @error('name')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <div class="row checkbox checkbox-primary mt-2">
                                @foreach($permission as $value)
                                <div class="col-md-4">
                                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name', 'id' => $value->id)) }}
                                    <label for="{{ $value->id }}" class="m-1">
                                        {{ $value->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <hr>
                        <a href="{{ route('roles.index') }}" class="btn btn-dark waves-effect waves-light">
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