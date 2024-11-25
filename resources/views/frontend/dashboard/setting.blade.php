@extends('layouts.frontend.app')
@section('title')
setting
@endsection
@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">setting</a></li>
@endsection
@section('body')
      <!-- Dashboard Start-->

      <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
          <!-- User Info Section -->
          <div class="user-info text-center p-3">
            <img
              src="{{asset($user->image)}}"
              alt="User Image"
              class="rounded-circle mb-2"
              style="width: 80px; height: 80px; object-fit: cover"
            />
            <h5 class="mb-0" style="color: #ff6f61">{{$user->name}}</h5>
          </div>
  
          <!-- Sidebar Menu -->
          <div class="list-group profile-sidebar-menu">
            <a
              href="{{route('frontend.dashboard.profile')}}"
              class="list-group-item list-group-item-action menu-item"
              data-section="profile"
            >
              <i class="fas fa-user"></i> Profile
            </a>
            <a
              {{-- href="{{route('frontend.dashboard.notification')}}" --}}
              class="list-group-item list-group-item-action menu-item"
              data-section="notifications"
            >
              <i class="fas fa-bell"></i> Notifications
            </a>
            <a
              href="{{route('frontend.dashboard.setting')}}"
              class="list-group-item list-group-item-action active menu-item"
              data-section="settings"
            >
              <i class="fas fa-cog"></i> Settings
            </a>
          </div>
        </aside>
  
        <!-- Main Content -->
        <div class="main-content">
          <!-- Settings Section -->
          <section id="settings" class="content-section">
            <h2>Settings</h2>
            <form action="{{route('frontend.dashboard.setting.update')}}" method="POST" class="settings-form" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <label for="name">Name:</label>
                <input name="name" type="text" id="name" value="{{$user->name}}" />
                @error('name')
                <small class="text-danger mt-2">{{$message}}</small>
                @enderror
              </div>
             
              <div class="form-group">
                <label for="username">Username:</label>
                <input name="username" type="text" id="username" value="{{$user->username}}" />
                @error('username')
                <small class="text-danger mt-2">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input name="email" type="email" id="email" value="{{$user->email}}" />
                @error('email')
                <small class="text-danger mt-2">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="profile-image">Profile Image:</label>
                <input name="image" type="file" id="profile-image" accept="image/*" />
              </div>
              <div class="form-group">
                <label for="country">Country:</label>
                <input
                  name="country"
                  type="text"
                  id="country"
                  placeholder="Enter your country"
                  value="{{$user->country}}"
                />
                @error('country')
                <small class="text-danger mt-2">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="city">City:</label>
                <input name="city" type="text" id="city" placeholder="Enter your city" value="{{$user->city}}" />
                @error('city')
                <small class="text-danger mt-2">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="street">Street:</label>
                <input name="street" type="text" id="street" placeholder="Enter your street" value="{{$user->street}}"/>
                @error('street')
                <small class="text-danger mt-2">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="phone">Phone:</label>
                <input name="phone" type="text" id="phone" placeholder="Enter your phone" value="{{$user->phone}}"/>
                @error('phone')
                <small class="text-danger mt-2">{{$message}}</small>
                @enderror
              </div>
          
              <button type="submit" class="save-settings-btn">
                Save Changes
              </button>
            </form>
  
            <!-- Form to change the password -->
            <form action="{{route('frontend.dashboard.setting.ChangePassword')}}" method="POST" class="change-password-form">
              @csrf
              <h2>Change Password</h2>
              <div class="form-group">
                <label for="current-password">Current Password:</label>
                <input
                  type="password"
                  id="current-password"
                  placeholder="Enter Current Password"
                  name="current_password"
                />
                @error('current_password')
                <small class="text-danger mt-2">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="new-password">New Password:</label>
                <input
                  type="password"
                  id="new-password"
                  placeholder="Enter New Password"
                  name="password"
                />
                @error('password')
                <small class="text-danger mt-2">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="confirm-password">Confirm New Password:</label>
                <input
                  type="password"
                  id="confirm-password"
                  placeholder="Enter Confirm New "
                  name="password_confirmation"
                />
              </div>
              <button type="submit" class="btn change-password-btn">
                Change Password
              </button>
            </form>
          </section>
        </div>
      </div>
  
      <!-- Dashboard End-->
   
@endsection