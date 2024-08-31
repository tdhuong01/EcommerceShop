@extends("admin.layout.master")

@section('title','Danh sách sản phẩm')

@section('body')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">

         </div>
     </div>
    <div class="card-header py-3">
      <h4 class="m-0 font-weight-bold text-primary float-left">Danh sách sản phẩm</h4>
      <a href="admin/product/create" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm sản phẩm"><i class="fas fa-plus"></i> Thêm sản phẩm</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($products)>0)
        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr style="text-align: center;">
              <th>ID</th>
              <th>Tên sản phẩm</th>
                <th>Hình ảnh </th>
              <th>Giá liêm yết</th>
              <th>Giá giảm</th>
              <th>Số lượng</th>
              <th>Danh mục</th>
              <th>Hành động </th>
            </tr>
          </thead>

          <tbody>

            @foreach($products as $product)
                <tr>
                    <td style="width: 5%">{{$product->id}}</td>
                    <td>{{$product->name}} </td>
                    <td><img style="width: 100px;height: 100px" src="front/img/products/{{$product->productImages[0]->path !=null ? $product->productImages[0]->path: 'img.png' }}" alt="Hình ảnh"></td>
                    <td style="width: 15%" class="text-right">{{number_format($product->price, 0, ",", ".")}} VND</td>
                    <td style="width: 15%" class="text-right">{{number_format($product->discount, 0, ",", ".")}} VND</td>
                    <td class="text-center">{{$product->qty}}</td>
                    <td>{{$product->productCategory->name}}</td>
                    <td style="width: 12%;">
                        <a href="admin/product/{{$product->id}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Xem chi tiết" data-placement="bottom"><i class="fas fa-info"></i></a>
                        <a href="admin/product/{{$product->id}}/edit" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Chỉnh sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="admin/product/{{$product->id}}">
                      @csrf
                      @method('DELETE')
                          <button class="btn btn-danger btn-sm dltBtn" type="submit" data-id="" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Xóa"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">Danh sách sản phẩm trống. Hãy tạo sản phẩm mới.</h6>
        @endif
      </div>
    </div>
</div>
@endsection

