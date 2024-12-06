@extends('layouts.dashboard.app')
@section('title')
    Create User
@endsection
@section('body')
  <center>
 
        <div class="card-body shadow mb-4 col-10">
            <h2>User : {{$user->name}}</h2><br>
                <img src="{{asset($user->image)}}" class="img-rounded"  style="height: 300px; width: 300px;" alt="...">
            <br><br>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input disabled  class="form-control" value="Name : {{$user->name}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <input disabled  class="form-control" value="Username : {{$user->username}}">
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input disabled value="Email : {{$user->email}}" class="form-control" >
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <input disabled value="Phone : {{$user->phone}}" class="form-control" >
                    </div>
                </div>

            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input disabled value="Status : {{$user->status == 1?'Active':'Not Active'}}" class="form-control" >
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <input disabled value="Email Status : {{$user->email_verified_at ==null?'Not Active':'Active'}}" class="form-control" >                    
                    </div>
                </div>

            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input disabled class="form-control" value="Country : {{$user->country}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <input disabled class="form-control" value="City : {{$user->city}}" >
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group ">
                        <input disabled  class="form-control" value="Street : {{$user->street}}">
                    </div>
                </div>       

            </div>
           
            <br>
            <a href="{{route('admin.users.changeStatus',$user->id)}}" class="btn btn-primary">{{$user->status == 1 ? 'Block':'Active'}}</a>
            <ahref="javascript:void(0)" onclick="if(confirm('Do you want to delete the user?')){document.getElementById('delete_user').submit();} return false;"class="btn btn-info">Delete</ahref=>

            <form id="delete_user" action="{{route('admin.users.destroy',$user->id)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
  </center>
@endsection