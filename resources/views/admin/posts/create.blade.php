@extends('layouts.dashboard.app')
@section('title')
    Create Post
@endsection
@section('body')
  <center>
    <form action="{{ route('admin.posts.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="card-body shadow mb-4 col-10">
            <a class="btn btn-primary" style="margin-left: 95ch" href="{{route('admin.posts.index')}}">Show Posts</a>
            <h2>Create New Post</h2><br><br>
            @if(session()->has('errors'))
               <div class="alert alert-danger">
                <ul>
                    @foreach (session('errors')->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
               </div>
            @endif
            <div class="row ">
                <div class="col-12">
                    <div class="form-group ">
                        <input type="text" value="{{@old('title')}}" name="title" class="form-control" placeholder="Enter Post Title">
                        @error('title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="form-group ">
                        <textarea name="small_desc"  value="{{@old('small_desc')}}" class="form-control" placeholder="Enter Post Small Description"></textarea>
                        @error('small_desc')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="form-group ">
                        <textarea id="postContent" value="{{@old('desc')}}" name="desc" class="form-control" placeholder="Enter Description"></textarea>
                        @error('desc')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="form-group ">
                        <input id="postImage"  type="file" name="images[]" multiple class="form-control" >
                        @error('images')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="form-group ">
                        <select class="form-control" name="status">
                            <option selected>Select Status</option>
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
                <div class="col-6">
                    <div class="form-group ">
                        <select class="form-control" name="category_id">
                            <option selected>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <select class="form-control" name="comment_able">
                            <option selected disabled>Select Comment Able Status</option>
                            <option value="1">Active</option>
                            <option value="0">No Active</option>

                        </select>
                        @error('comment_able')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
           
            <br>
            <button type="submit" class="btn btn-primary">Create Post</button>

        </div>
    </form>
  </center>
@endsection
@push('js')
   <script>
      $(function(){
        $('#postImage').fileinput({
            theme: 'fa5',
            allowedFileTypes: ['image'],
            maxFileCount: 5,
            enableResumableUpload: false,
            showUpload: false,
        });
        $('#postContent').summernote({
                height: 300,
            });
      } );
    </script> 
@endpush