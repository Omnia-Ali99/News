@extends('layouts.dashboard.app')
@section('title')
    Create Admin
@endsection
@section('body')
    <div class="container">
        <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body shadow mb-4 col-8" style="margin: auto">
                <div class="row gx-5 mt-3">
                    <div class="col-9">
                        <h2>Create New Admin</h2>
                    </div>
                    <div class="col-3">
                        <a class="btn btn-primary" style="" href="{{ route('admin.admins.index') }}">Back To Admins</a>
                    </div>
                </div> <br>


                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                           Enter Name :<input type="text" name="name" class="form-control" placeholder="Enter Admin Name">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                           Enter Username :<input type="text" name="username" class="form-control" placeholder="Enter Admin Username">
                            @error('username')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                           Enter Email :<input type="email" name="email" class="form-control" placeholder="Enter Admin Email">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                            Select Status :<select class="form-control" name="status">
                                <option selected disabled>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                            @error('status')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>


                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                           Select Role :<select class="form-control" name="role_id">
                                <option selected disabled>Select Role</option>
                                @forelse ($authorizations as $authorization)
                                    <option value="{{$authorization->id}}">{{$authorization->role}}</option>
                                    @empty
                                <option disbled selected>No Roles</option>
                                @endforelse
                            </select>
                            @error('role_id')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>


                </div>


                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                            Enter Password :<input type="password" name="password" class="form-control" placeholder="Enter Password">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                            Enter Confirma password :<input type="password" name="password_confirmation" class="form-control"
                                placeholder="Enter Password Again">
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Create Admin</button>

            </div>
        </form>
    </div>
@endsection
