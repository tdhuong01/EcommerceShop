@extends("admin.layout.master")

@section('title','Thêm danh mục')

@section('body')
    <div class="card">
      <div style="display: flex;" class="card-header py-3">
        <a style="margin-right: 10px;"  href="admin/category" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
        <h4 class="m-0 font-weight-bold text-primary">Thêm danh mục sản phẩm</h4>
    </div> 
    <div class="card-body">
      <form method="post" action="admin/category" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Tên danh mục <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Nhập tên danh mục..." required value="" class="form-control">
        </div>
          @if(session('notification'))
              <div class="alert alert-warning" role="alert">
                  {{session('notification')}}
              </div>
          @endif
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning"><i class="fas fa-sync-alt"></i></button>
            <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Thêm danh mục</button>
        </div>
      </form>
    </div>
</div>

@endsection
