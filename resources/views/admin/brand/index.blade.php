@extends("admin.layout.master")

@section('title','Danh sách thương hiệu')

@section('body')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">

         </div>
     </div>
    <div class="card-header py-3">
      <h4 class="m-0 font-weight-bold text-primary float-left">Danh sách thương hiệu sản phẩm</h4>
      <a href="admin/brand/create" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm thương hiệu"><i class="fas fa-plus"></i> Thêm thương hiệu</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          @if(count($brands)>0)
        <table style="text-align: center;" class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="width: 10%">Mã</th>
              <th>Tên thương hiệu</th>
              <th style="width: 10%">Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td style="width: 10%">{{$brand->id}}</td>
                    <td>{{$brand->name}}</td>
                    <td style="width: 10%">
                        <form method="POST" action="admin/brand/{{$brand->id}}">
                            @csrf
                            @method('DELETE')
                          <button class="btn btn-danger btn-sm dltBtn" data-id="" style="height:30px;width:30px;border-radius:50%;" data-toggle="tooltip" data-placement="bottom" title="Xóa"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
          @else
              <h6 class="text-center">Danh sách thương hiệu trống. Hãy thêm thương hiệu mới</h6>
          @endif
      </div>
    </div>
</div>
@endsection

