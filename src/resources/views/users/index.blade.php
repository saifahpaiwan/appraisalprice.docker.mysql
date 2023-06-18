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
                    <li class="breadcrumb-item active">Users Management</li>
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
                <h4 class="header-title">Users Management
                    <a href="{{ route('users.create') }}" class="btn btn-primary waves-effect waves-light float-right">
                        <i class="fe-plus-square"></i> Create Data
                    </a>
                </h4>
                <p class="sub-header">
                    Daily User Management Table {{ date('Y-m-d') }}
                </p>

                @if ($message = Session::get('success'))
                <div class="alert alert-success text-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="mdi mdi-check-all mr-2"></i> {{ $message }}
                </div>
                @endif

                {!! Form::open(['route' => 'users.index', 'method'=>'GET', 'class' => 'mb-2']) !!} 
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex">
                            <input type="search" class="form-control" id="keywrod" name="keywrod" placeholder="Find more...">
                            <div class="d-flex w-220">
                                <button class="btn btn-dark waves-effect waves-light ml-1" type="summit"><i class="fe-search"></i> Search</button>
                                <a href="{{ route('users.index') }}" class="btn btn-dark waves-effect waves-light ml-1"><i class="fe-rotate-cw"></i> Reset </a>
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
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="230px">Action</th>
                        </tr>
                        @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-secondary waves-effect waves-light" href="{{ route('users.show',$user->id) }}">Show</a>
                                <a class="btn btn-secondary waves-effect waves-light" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger waves-effect waves-light']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>

                {!! $data->render() !!}

            </div>
        </div>
    </div>
</div>
@endsection