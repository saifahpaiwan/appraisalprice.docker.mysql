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
                    <li class="breadcrumb-item active">Show Role</li>
                </ol>
            </div>
            <h4 class="page-title"> Show Role </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Show Role Detail</h4>
                <p class="sub-header">
                    Edit the latest information {{ $role->updated_at }}
                </p>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                            <span class="badge badge-dark ml-1 p-1">{{ $v->name }}</span> 
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <hr>
                <a href="{{ route('roles.index') }}" class="btn btn-dark waves-effect waves-light">
                    <i class="fe-chevron-left"></i> Back
                </a>
                <a class="btn btn-warning waves-effect waves-light" href="{{ route('roles.edit', $role->id) }}">
                    <i class="fe-edit"></i> Edit
                </a> 
            </div>
        </div>
    </div>
</div>
@endsection