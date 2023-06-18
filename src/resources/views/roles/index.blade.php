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
                    <li class="breadcrumb-item active">Role Management</li>
                </ol>
            </div>
            <h4 class="page-title"> Role Management </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Role Management
                    <a href="{{ route('roles.create') }}" class="btn btn-primary waves-effect waves-light float-right">
                        <i class="fe-plus-square"></i> Create Data
                    </a>
                </h4>
                <p class="sub-header">
                    Daily roles Management Table {{ date('Y-m-d') }}
                </p>

                @if ($message = Session::get('success'))
                <div class="alert alert-success text-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="mdi mdi-check-all mr-2"></i> {{ $message }}
                </div>
                @endif

                {!! Form::open(['route' => 'roles.index', 'method'=>'GET', 'class' => 'mb-2']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex">
                            <input type="search" class="form-control" id="keywrod" name="keywrod" placeholder="Find more...">
                            <div class="d-flex w-220">
                                <button class="btn btn-dark waves-effect waves-light ml-1" type="summit"><i class="fe-search"></i> Search</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-dark waves-effect waves-light ml-1"><i class="fe-rotate-cw"></i> Reset </a>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive">
                    <table class="table table-hover m-0 table-actions-bar">

                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th width="230px">Action</th>
                        </tr>

                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a class="btn btn-secondary waves-effect waves-light" href="{{ route('roles.show',$role->id) }}">Show</a>
                                @can('role-edit')
                                <a class="btn btn-secondary waves-effect waves-light" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                @endcan
                                @can('role-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger waves-effect waves-light']) !!}
                                {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>

                {!! $roles->render() !!}

            </div>
        </div>
    </div>
</div>
@endsection