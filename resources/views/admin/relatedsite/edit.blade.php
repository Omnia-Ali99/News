<form action="{{route('admin.related-site.update',$site->id)}}" method="POST">
    @csrf
    @method('put')
    <div class="modal fade" id="edit-site{{$site->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Site : {{$site->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <input type="text" name="name" value="{{$site->name}}" class="form-control" placeholder="Enter Site Name">
                        @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <br>
                        <input type="text" name="url" value="{{$site->url}}" class="form-control" placeholder="Enter Url Name">
                        @error('url')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Site</button>
                </div>
            </div>
        </div>
    </div>
   </form>