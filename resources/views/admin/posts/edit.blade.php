@extends('layouts.dashboard.app')
@section('title')
    Update Post
@endsection
@section('body')
  <center>
    <form action="{{ route('admin.posts.update',$post->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-body shadow mb-4 col-10">
            <a class="btn btn-primary" style="margin-left: 95ch" href="{{route('admin.posts.index')}}">Show Posts</a>
            <h2>Update Post</h2><br><br>
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
                        <input type="text" value="{{@old('title',$post->title)}}" name="title" class="form-control" placeholder="Enter Post Title">
                        @error('title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="form-group ">
                        <textarea name="small_desc"  class="form-control" placeholder="Enter Post Small Description">{{$post->small_desc}}</textarea>
                        @error('small_desc')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="form-group ">
                        <textarea id="postContent"  name="desc" class="form-control" placeholder="Enter Description">{!! $post->desc !!}</textarea>
                        @error('desc')desc
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="form-group ">
                        <input id="post-images"  type="file" name="images[]" multiple class="form-control" >
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
                            <option value="1" @selected($post->status == 1)>Active</option>
                            <option value="0"@selected($post->status == 0)>Not Active</option>
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
                            @foreach ($categories as $category)
                            <option  @selected($category->id == $post->category_id) value="{{$category->id}}">{{$category->name}}</option>
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
                            <option value="1"  @selected($post->comment_able == 1)>Active</option>
                            <option value="0"  @selected($post->comment_able == 0)>No Active</option>

                        </select>
                        @error('comment_able')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
           
            <br>
            <button type="submit" class="btn btn-primary">Update Post</button>

        </div>
    </form>
  </center>
@endsection
@push('js')
   <script>
      $(function(){
        $('#post-images').fileinput({
            theme: 'fa5',
            allowedFileTypes: ['image'],
            maxFileCount: 5,
            enableResumableUpload: false,
            showUpload: false,
            initialPreviewAsData: true,
            initialPreview: [
                @if ($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        "{{ asset($image->path) }}",
                    @endforeach
                @endif
            ],
            initialPreviewConfig: [
                @if ($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        {
                            caption: "{{ $image->path }}",
                            width: '120px',
                            url: "{{ route('admin.posts.image.delete', [$image->id, '_token' => csrf_token()]) }}",
                            key: "{{ $image->id }}",
                        },
                    @endforeach
                @endif
            ]
        });
        $('#postContent').summernote({
                height: 300,
            });
      } );
    </script> 
@endpush