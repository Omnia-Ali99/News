@extends('layouts.dashboard.app')
@section('title')
   Notification
@endsection
@section('body')

<div class="dashboard container">

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="row g-0">
                <div class="col-sm-8 col-md-10">
                    <h2 class="mb-4">Notifications</h2>
                </div>
                <div class="col-sm-4 col-md-2">.
                    <a href="{{route('admin.notification.deleteAll')}}" class="btn btn-danger btn-sm">Delete All</a>
                </div>
              </div>
          @forelse ($notifications as $notify)
          <a href="{{ $notify->data['link'] }}?notify_admin={{ $notify->id }}" style="text-decoration: none;">
            <div class="notification alert alert-info">
                <strong>You have a notification form : {{$notify->data['user_name']}}</strong> Post title : {{$notify->data['contact_title']}} <br>
                {{$notify->created_at->diffForHumans()}}
                <div class="float-right">
                    <button href="javascript:void(0)" onclick="if(confirm('Are u sure to delete notify?')){document.getElementById('deleteNotify').submit();} return false;" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
           </a>
           <form id="deleteNotify" action="{{route('admin.notification.delete')}}" method="POST">
            @csrf
            <input hidden name="notify_id" value="{{$notify->id}}" >
           </form>
         
          @empty
              <div class="alert alert-info">No Notifications Yet</div>
          @endforelse
          
        </div>
    </div>
  </div>
@endsection