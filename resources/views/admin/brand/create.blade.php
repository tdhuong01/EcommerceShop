@extends("admin.layout.master")

@section('title','Create Brand')

@section('body')
<div class="card">
  <div class="card">
    <div style="display: flex;" class="card-header py-3">
      <a style="margin-right: 10px;"  href="admin/brand" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
      <h4 class="m-0 font-weight-bold text-primary">Thêm thương hiệu sản phẩm</h4>
  </div>
    <div class="card-body">
      <form method="post" action="admin/brand" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Tên thương hiệu <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Nhập tên thương hiệu..."  value="" class="form-control">
        </div>
          @if(session('notification'))
              <div class="alert alert-warning" role="alert">
                  {{session('notification')}}
              </div>
          @endif
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning"><i class="fas fa-sync-alt"></i></button>
            <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Thêm thương hiệu</button>
        </div>
      </form>
    </div>
</div>

@endsection
