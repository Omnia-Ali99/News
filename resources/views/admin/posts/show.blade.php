@extends('layouts.dashboard.app')
@section('title')
    Show Post
@endsection
@section('body')
    <div class="d-flex justify-content-center">
        <div class="card-body shadow mb-4 container" style="max-width: 95ch">
            <a class="btn btn-primary"  href="{{route('admin.posts.index',['post'=>request()->page])}}">Back To Posts</a>
            <br><br>
            <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#newsCarousel" data-slide-to="1"></li>
                    <li data-target="#newsCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" >
                    @foreach ($post->images as $image)
                        <div class="carousel-item @if ($loop->index == 0) active @endif">
                            <img src="{{ asset($image->path) }}" class="d-block w-100" alt="First Slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $post->title }}</h5>
                                <p>
                                    {{-- {substr($post->desc,0,80)}} --}}
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Add more carousel-item blocks for additional slides -->
                </div>
                <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="row mt-4">
                <div class="col-5">
                    <h5 class="">
                        <i class="fa fa-user"></i> : {{ $post->user->name ?? $post->admin->name }}
                    </h5>
                </div>
                <div class="col-3">
                    <h5 class="">
                        <i class="fa fa-eye"></i>: {{ $post->num_of_views }}
                    </h5>
                </div>
                <div class="col-4">
                    <h5 class="">
                        <i class="fa fa-edit"></i> : {{ $post->created_at->format('Y-m-d h:m') }}
                    </h5>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4">
                    <h5 class="">
                        comments: {{ $post->comment_able == 1 ?'Active' : 'No Active'}}
                    </h5>
                </div>
                <div class="col-4">
                    <h5 class="">
                        status: {{ $post->status == 1 ?'Active' : 'No Active'}}
                    </h5>
                </div>
                <div class="col-4">
                    <h5 class="">
                        category : {{ $post->category->name }}
                    </h5>
                </div>
            </div>
            <br>
            <div class="sn-content">
                <strong>Small Description : {{$post->small_desc}}</strong>
            </div>
            <br>
            <div class="sn-content">
                {!! chunk_split(strip_tags($post->desc), 30) !!}
            </div>
            <br>
            <center>
                <a href="javascript:void(0)" class="btn btn-danger" onclick="if(confirm('Do you want to delete the post?')){document.getElementById('delete_post_{{$post->id}}').submit();} return false;">Delete Post <i class="fa fa-trash"></i></a>
                <a class="btn btn-primary" href="{{route('admin.posts.changeStatus', $post->id)}}">Change Status <i class="fa @if($post->status ==1)fa-stop @else fa-play @endif"></i></a>
                @if($post->user_id == null)
                <a class="btn btn-info" href="{{route('admin.posts.edit',$post->id)}}">Edit Post <i class="fa fa-edit"></i></a>
                @endif
            </center>     
            <form id="delete_post_{{$post->id}}" action="{{route('admin.posts.destroy',$post->id)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
    @endsection
