<div class="row">

    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Last Posts</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latest_posts as $post)
                            <tr>
                                <td>
                                  @can('posts')
                                  <a
                                  href="{{ route('admin.posts.show', $post->id) }}">{{ Str::limit($post->title, 20) }}
                                </a>
                                  @endcan
                                  @cannot('posts')
                                  {{ Str::limit($post->title, 20) }}
                                  @endcannot
                                </td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->comments_count }}</td>
                                <td>{{ $post->status == 0 ? 'Not Active' : 'Active' }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>



    </div>
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Last Comments</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Post</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latest_comments as $comment)
                            <tr>
                                <td>{{ $comment->user->name }}</td>
                                <td>
                                   @can('posts')
                                   <a href="{{ route('admin.posts.show', $comment->post->id) }}">
                                    {{ Str::limit($comment->post->title, 20) }}
                                </a>
                                   @endcan
                                   @cannot('posts')
                                   {{ Str::limit($comment->post->title, 20) }}
                                   @endcannot
                                </td>
                                <td>{{ Str::limit($comment->comment, 40) }}</td>
                                <td>{{ $comment->status == 0 ? 'Not Active' : 'Active' }}</td>


                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>



    </div>

</div>
