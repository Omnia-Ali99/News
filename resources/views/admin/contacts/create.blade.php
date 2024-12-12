@extends('layouts.dashboard.app')
@section('title')
    Create User
@endsection
@section('body')
  <center>
    <form action="{{ route('admin.users.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="card-body shadow mb-4 col-10">
            <h2>Create New User</h2><br><br>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input type="text" name="name" class="form-control" placeholder="Enter User Name">
                        @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <input type="text" name="username" class="form-control" placeholder="Enter User Username">
                        @error('username')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input type="email" name="email" class="form-control" placeholder="Enter User Email">
                        @error('email')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <input type="text" name="phone" class="form-control" placeholder="Enter User Phone">
                        @error('phone')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <select class="form-control" name="status">
                            <option selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                        @error('status')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <select class="form-control" name="email_verified_at">
                            <option selected disabled>Select Email Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                        @error('email_verified_at')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input type="text" name="country" class="form-control" placeholder="Enter Country Name">
                        @error('country')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <input type="text" name="city" class="form-control" placeholder="Enter  City Name">
                        @error('city')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input type="text" name="street" class="form-control" placeholder="Enter Street Name">
                        @error('street')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <input type="file" name="image" class="form-control">
                        @error('image')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        @error('password')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Enter Password Again">
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Create User</button>

        </div>
    </form>
  </center>
@endsection
