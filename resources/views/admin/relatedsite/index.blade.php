@extends('layouts.dashboard.app')
@section('title')
    R-sites
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Related Sites</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Related Sites Management</h6>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-site">
                    Create Related Site</button>
                    <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($sites as $site)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $site->name }}</td>
                                    <td>{{ $site->url }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('Do you want to delete the site?')){document.getElementById('delete_site_{{ $site->id }}').submit();} return false;"><i
                                                class="fa fa-trash"></i></a>
                                       
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#edit-site{{$site->id}}">
                                            <i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <form id="delete_site_{{ $site->id }}"
                                    action="{{ route('admin.related-site.destroy', $site->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                              

                                <!-- Modal edit site-->
                                @include('admin.relatedsite.edit')
                              
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6">
                                        No Related sites
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $sites->links() }}
                </div>
            </div>
        </div>


        <!-- Modal create site-->
        @include('admin.relatedsite.create')
    </div>
    <!-- /.container-fluid -->
@endsection
