@extends('layouts.frontend.app')
@section('title')
Search news
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
  <li class="breadcrumb-item active">Search</a></li>
@endsection
@section('body')
      <!-- Main News Start-->
      <div class="main-news mt-4">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
               @foreach ($posts as $post )
               <div class="col-md-4">
                <div class="mn-img">
                  <img src="{{$post->images->first()->path}}" />
                  <div class="mn-title">
                    <a href="{{route('frontend.post.show', $post->slug)}}">{{$post->title}}</a>
                  </div>
                </div>
              </div>
               @endforeach
              <div class="col-md-12 d-flex justify-content-center"> {{$posts->links()}}</div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- Main News End-->
@endsection