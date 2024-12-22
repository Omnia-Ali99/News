<form action="{{route('admin.related-site.store')}}" method="POST">
    @csrf
    <div class="modal fade" id="add-site" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Site</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <input type="text" name="name" class="form-control" placeholder="Enter Site Name">
                        @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <br>
                        <input type="text" name="url" class="form-control" placeholder="Enter Site Url">
                        @error('url')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                      
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Site</button>
                </div>
            </div>
        </div>
    </div>
</form>