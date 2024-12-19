<div class="card-body">
    <form action="{{route('admin.posts.index')}}" method="GET">
        <div class="row ">
            <div class="col-2">
               <div class="form-group"> 
                <select name="sort_by" class="form-control">
                <option selected disabled>Sort By</option>
                <option value="id">Id</option>
                {{-- <option value="name">name</option> --}}
                <option value="created_at">created at</option>
              </select>
            </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <select name="order_by" class="form-control">
                    <option selected disabled>Order By</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                  </select>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <select name="limit_by" class="form-control">
                    <option selected disabled>Limit By</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="40">40</option>
                  </select>
              </div>
            </div>
            <div class="col-2">
               <div class="form-group">
                <select name="status" class="form-control">
                    <option selected disabled>Status</option>
                    <option value="1">Active</option>
                    <option value="0">Not Active</option>
                  </select>
               </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <input class="form-control" name="Keyword" placeholder="Search Here ...">   
                </div>
            </div>

            <div class="col-1">
              <div class="form-group">
                <button type="submit" class="btn btn-info">Search</button>
              </div>
            </div>
          </div>
    </form>
</div>