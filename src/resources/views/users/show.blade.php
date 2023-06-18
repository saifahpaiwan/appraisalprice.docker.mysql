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
                    <li class="breadcrumb-item active">Show Users</li>
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
                <h4 class="header-title">Show Users Detail</h4>
                <p class="sub-header">
                    Edit the latest information {{ $user->updated_at }}
                </p>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Roles:</strong>
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                            <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <hr>
                <a href="{{ route('users.index') }}" class="btn btn-dark waves-effect waves-light">
                    <i class="fe-chevron-left"></i> Back
                </a>
                <a class="btn btn-warning waves-effect waves-light" href="{{ route('users.edit', $user->id) }}">
                    <i class="fe-edit"></i> Edit
                </a> 
            </div>
        </div>
    </div>
</div>
@endsection