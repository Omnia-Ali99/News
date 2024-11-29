@extends('layouts.frontend.app')
@section('title')
    Edit : {{ $post->title }}
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit</a></li>
@endsection
@section('body')
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ asset(Auth::user()->image) }}" alt="{{ auth()->user()->name }}" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px; object-fit: cover" />
                <h5 class="mb-0" style="color: #ff6f61"></h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile') }}"
                    class="list-group-item list-group-item-action active menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="" class="list-group-item list-group-item-action menu-item" data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="{{ route('frontend.dashboard.setting') }}" class="list-group-item list-group-item-action menu-item"
                    data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content col-md-9">
            <!-- Show/Edit Post Section -->
            @if (@session()->has('errors'))
            <div class="alert alert-danger" role="alert">
               @foreach ( session('errors')->all() as $error)
                   <li>{{$error}}</li>
               @endforeach
             </div>                 
            @endif
            <form action="{{ route('frontend.dashboard.post.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section id="posts-section" class="posts-section">
                    <h2>Your Posts</h2>
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input name="title" type="text" class="form-control mb-2 post-title"
                                value="{{ $post->title }}" />

                            <!-- Editable Content -->
                            <textarea id="post-desc" name="desc" class="form-control mb-2 post-content">
                            {!! strip_tags($post->desc) !!}
                            </textarea>

                            <input hidden name="post_id" value="{{$post->id}}">


                            <!-- Image Upload Input for Editing -->
                            <input name="images[]" id="post-images" type="file" class="form-control mt-2 edit-post-image"
                                accept="image/*" multiple />

                            <!-- Editable Category Dropdown -->
                            <select name="category_id" class="form-control mb-2 post-category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input name="comment_able" @checked($post->comment_able == 1)
                                    class="form-check-inpuhe enable-comments" type="checkbox" />
                                <label class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fas fa-eye"></i> {{ $post->num_of_views }}
                                </span>
                                <span class="post-comments">
                                    <i class="fas fa-comment"></i> {{ $post->comments->count() }}
                                </span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">

                                <button type="submit" class="btn btn-success save-post-btn ">
                                    Save
                                </button>
                                <button class="btn btn-secondary cancel-edit-btn ">
                                    Cancel
                                </button>
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </section>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
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
                            url: "{{ route('frontend.dashboard.post.image.delete', [$image->id, '_token' => csrf_token()]) }}",
                            key: "{{ $image->id }}",
                        },
                    @endforeach
                @endif
            ]
        });

        $('#post-desc').summernote({
            height: 300,
        });
    </script>
@endpush
