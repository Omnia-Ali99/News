@extends('layouts.dashboard.app')
@section('title')
    Create Role
@endsection
@section('body')
    <div class="container">
        <form action="{{ route('admin.authorizations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body shadow mb-4 col-8" style="margin: auto">
                <div class="row gx-5 mt-3">
                    <div class="col-9">
                        <h2>Create New Role</h2>
                    </div>
                    <div class="col-3">
                        <a class="btn btn-primary" style="" href="{{ route('admin.authorizations.index') }}">Back To
                            Role</a>
                    </div>
                </div> <br>


                <div class="row ">
                    <div class="col-12">
                        <div class="form-group ">
                            <input type="text" name="role" class="form-control" placeholder="Enter Role Name">
                            @error('role')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row ">
                    @foreach (config('authorization.premessions') as $key => $value)
                        <div class="col-3">
                            <div class="form-group ">
                                <div class="form-check ">
                                    <input class="form-check-input" value="{{ $key }}" name="premessions[]"
                                        type="checkbox">
                                    <label class="form-check-label">
                                        {{ $value }}
                                    </label>
                                </div>

                            </div>
                        </div>
                    @endforeach
                 <div class="col-9">
                    @error('premessions')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                 </div>
                </div>





                <br>
                <button type="submit" class="btn btn-primary">Create New Role</button>

            </div>
        </form>
    </div>
@endsection
