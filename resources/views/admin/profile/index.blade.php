@extends('layouts.dashboard.app')
@section('title')
    Profile
@endsection
@section('body')
    <div class="container ">

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            <div class="card-body shadow mb-4">
                <h2>Updete Profile</h2><br><br>
           
                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="input-name" class="form-label">Name</label>
                            <input type="text" name="name"  value="{{auth('admin')->user()->name}}" id="input-name" class="form-control" placeholder="Enter Name">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="input-username" class="form-label">UserName</label>
                            <input type="text" name="username" id="input-username" value="{{auth('admin')->user()->username}}" class="form-control" placeholder="Enter UserName">
                            @error('username')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="input-email" class="form-label">Email</label>
                            <input type="text" name="email" id="input-email"  value="{{auth('admin')->user()->email}}" class="form-control" placeholder="Enter Email">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                            <label for="input-password" class="form-label">Password</label>
                            <input type="password" name="password"  id="input-password" class="form-control" placeholder="Enter Password Confirm">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </div>
@endsection
