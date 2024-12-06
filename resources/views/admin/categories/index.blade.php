@extends('layouts.dashboard.app')
@section('title')
    Categories
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories Management</h6>
            </div>
            @include('admin.categories.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Posts Count</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Posts Count</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->status == 1 ? 'Active' : 'Not Active' }}</td>
                                    <td>{{ $category->posts_count }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('Do you want to delete the category?')){document.getElementById('delete_category_{{ $category->id }}').submit();} return false;"><i
                                                class="fa fa-trash"></i></a>
                                        <a href="{{ route('admin.categories.changeStatus', $category->id) }}"><i
                                                class="fa @if ($category->status == 1) fa-stop @else fa-play @endif"></i></a>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#edit-category{{$category->id}}">
                                            <i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <form id="delete_category_{{ $category->id }}"
                                    action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                              

                                <!-- Modal edit category-->
                                @include('admin.categories.edit')
                              
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6">
                                        No Categories
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->appends(request()->input())->links() }}
                </div>
            </div>
        </div>


        <!-- Modal create category-->
        @include('admin.categories.create')
    </div>
    <!-- /.container-fluid -->
@endsection