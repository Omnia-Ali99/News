@extends('layouts.frontend.app')
@section('title')
notification
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
<li class="breadcrumb-item active">notification</a></li>
@endsection
@section('body')
          <!-- Dashboard Start-->
          <div class="dashboard container">
            <!-- Sidebar -->
           @include('frontend/dashboard/_sidebar',['notify_active'=>'active'])
    
            <!-- Main Content -->
            <div class="main-content">
                <div class="container">
                    <div class="row g-0">
                        <div class="col-sm-8 col-md-10">
                            <h2 class="mb-4">Notifications</h2>
                        </div>
                        <div class="col-sm-4 col-md-2">.
                            <a href="{{route('frontend.dashboard.notification.deleteAll')}}" class="btn btn-danger btn-sm">Delete All</a>
                        </div>
                      </div>
                  @forelse (auth()->user()->notifications as $notify)
                  <a href="{{ $notify->data['link'] }}?notify={{ $notify->id }}">
                    <div class="notification alert alert-info">
                        <strong>You have a notification form : {{$notify->data['user_name']}}</strong> Post title : {{$notify->data['post_title']}} <br>
                        {{$notify->created_at->diffForHumans()}}
                        <div class="float-right">
                            <button href="javascript:void(0)" onclick="if(confirm('Are u sure to delete notify?')){document.getElementById('deleteNotify').submit();} return false;" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                   </a>
                   <form id="deleteNotify" action="{{route('frontend.dashboard.notification.delete')}}" method="POST">
                    @csrf
                    <input hidden name="notify_id" value="{{$notify->id}}" >
                   </form>
                 
                  @empty
                      <div class="alert alert-info">No Notifications Yet</div>
                  @endforelse
                  
                </div>
            </div>
          </div>
          <!-- Dashboard End-->     
@endsection