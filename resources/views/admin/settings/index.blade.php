@extends('layouts.dashboard.app')
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
@endpush
@section('title')
    Setting
@endsection
@section('body')
    <div class="container ">

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body shadow mb-4">
                <h2>Updete Setting</h2><br><br>
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">Site Name :</label>
                            <input type="text" name="site_name"  value="{{$getSetting->site_name}}" class="form-control" placeholder="Enter Site Name">
                            @error('site_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">Email :</label>
                            <input type="text" name="email" value="{{$getSetting->email}}" class="form-control" placeholder="Enter Email">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">Phone :</label>
                            <input type="text"  value="{{$getSetting->phone}}" name="phone" class="form-control" placeholder="Enter Phone">
                            @error('phone')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">Country :</label>
                            <input type="text" name="country"  value="{{$getSetting->country}}" class="form-control" placeholder="Enter Country Name">
                            @error('country')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">City :</label>
                            <input type="text" name="city" value="{{$getSetting->city}}" class="form-control" placeholder="Enter City Name">
                            @error('city')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">Street :</label>
                            <input type="text" name="street"  value="{{$getSetting->street}}" class="form-control" placeholder="Enter Street Name">
                            @error('street')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">Facebook :</label>
                            <input type="text" name="facebook"  value="{{$getSetting->facebook}}" class="form-control" placeholder="Enter Facebook Link">
                            @error('facebook')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">Twitter :</label>
                            <input type="text" name="twitter"  value="{{$getSetting->twitter}}" class="form-control" placeholder="Enter twitter Link">
                            @error('twitter')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">Instagram :</label>
                            <input type="text" name="instagram"  value="{{$getSetting->instagram}}" class="form-control" placeholder="Enter instagram Link">
                            @error('instagram')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label class="form-label">Youtube :</label>
                            <input type="youtube" name="youtube"  value="{{$getSetting->youtube}}" class="form-control" placeholder="Enter youtube Link">
                            @error('youtube')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                            <label class="form-label">Small Description :</label>
                            <textarea type="text"  name="small_desc" class="form-control"
                                placeholder="Enter Small Description"> {{$getSetting->small_desc}}</textarea>
                            @error('small_desc')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="exampleFormControlInput1" class="form-label ">Logo :</label>
                            <input type="file" name="logo" class="form-control dropify">
                            @error('logo')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            <br>
                            <img src="{{asset($getSetting->logo)}}" class="img-thumbnail" alt="">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="exampleFormControlInput1" class="form-label">Favicon :</label>
                            <input type="file" name="favicon" class="form-control dropify">
                            @error('favicon')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            <br>
                            <img src="{{asset($getSetting->favicon)}}" class="img-thumbnail" alt="">
                        </div>
                    </div>
                </div>
                <br>
                <input name="setting_id" value="{{$getSetting->id}}" hidden>
                <button type="submit" class="btn btn-primary">Update Setting</button>

            </div>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drop a file here',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endpush
