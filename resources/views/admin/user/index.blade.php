@extends("admin.layout.master")

@section('title','Danh sách khách hàng')

@section('body')

    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary float-left">Danh sách khách hàng</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(count($users)>0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center">
                        <th>Mã</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Ảnh đại diện</th>
                        <th>Ngày tham gia</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <img src="front/img/user/{{$user->avatar ?? 'avatar.png'}}" class="img-fluid" style="max-width:50px" alt="avatar.png">
                                </td>
                                <td>{{$user->created_at}}</td>
                                @if($user->status == 'active')
                                   <td style="color: deepskyblue">Hoạt động</td>
                                @else
                                    <td style="color: red">Đã chặn</td>
                                @endif
                                <td style="display: flex;align-items: center;justify-content: center;">
                                    <form action="admin/user/{{$user->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"  type="submit" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Chặn"><i class="fas fa-lock"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @else
                    <h6 class="text-center">Danh sách khách hàng trống</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

