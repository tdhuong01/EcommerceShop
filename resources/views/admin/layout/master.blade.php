<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{asset('/')}}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> @yield('title')  | Meow Shop </title>

    <!-- Custom fonts for this template-->
    <link href="./admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="./admin/css/my_css.css" rel="stylesheet">
    <link href="./admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{(request()->segment(2)=='dashboard') ? 'active' : ''}}">
            <a class="nav-link" href="/admin/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Trang chủ</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{(request()->segment(2)=='product') ? 'active' : ''}}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-cubes"></i>
                <span>Sản phẩm</span>
            </a>
            <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-pink py-2 collapse-inner rounded">
                    <a class="collapse-item" href="admin/product">Danh sách sản phẩm </a>
                    <a class="collapse-item" href="admin/product/create">Thêm sản phẩm</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item {{(request()->segment(2)=='category') ? 'active' : ''}}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-sitemap fa-folder"></i>
                <span>Danh mục sản phẩm</span>
            </a>
            <div id="collapseCategory" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-pink py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/admin/category">Danh sách danh mục</a>
                    <a class="collapse-item" href="admin/category/create">Thêm danh mục</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{(request()->segment(2)=='brand') ? 'active' : ''}}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBrand"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-table"></i>
                <span>Thương hiệu</span>
            </a>
            <div id="collapseBrand" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-pink py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/admin/brand">Danh sách thương hiệu</a>
                    <a class="collapse-item" href="admin/brand/create">Thêm thương hiệu</a>
                </div>
            </div>
        </li>
        <li class="nav-item {{(request()->segment(2)=='order') ? 'active' : ''}}">
            <a class="nav-link" href="admin/order">
                <i class="fas fa-users"></i>
                <span>Danh sách đơn hàng</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{(request()->segment(2)=='user') ? 'active' : ''}}">
            <a class="nav-link" href="admin/user">
                <i class="fas fa-users"></i>
                <span>Danh sách khách hàng</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>



    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <img src="front/img/logoMS-1.png" alt="Logo">
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                            <img class="img-profile rounded-circle"
                                 src="admin/img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">

                            <a class="dropdown-item" href="admin/logout">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đăng xuất
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
            @yield('body')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



    <!-- Bootstrap core JavaScript-->
    <script src="./admin/vendor/jquery/jquery.min.js"></script>
    <script src="./admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="./admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="./admin/js/demo/chart-area-demo.js"></script>
    <script src="./admin/js/my_script.js"></script>
    <script src="./admin/js/demo/chart-pie-demo.js"></script>
    <script src="./admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="./admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="./admin/js/demo/datatables-demo.js"></script>
    <script>

        $('#dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[6]
                }
            ]
        } );
        $('#banner-dataTable').DataTable( {
            "scrollX": false,
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[2]
                }
            ]
        } );
        $('#product-dataTable').DataTable( {
            "scrollX": false,
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[7]
                }
            ]
        } );
        $('#productDetail-dataTable').DataTable( {
            "scrollX": false,
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[4]
                }
            ]
        } );
        // Sweet alert

        function deleteData(id){

        }
    </script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e){
                var form=$(this).closest('form');
                var dataID=$(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                    title: "Bạn có muốn xóa không?",
                    text: "Sau khi xóa dữ liệu sẽ không khôi phục lại được nữa!",
                    icon: "warning",
                    buttons: ['Không','Có'],
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal({
                                position: 'center',
                                icon: 'error',
                                title: 'Đã hủy quá trình xóa !',
                                buttons: false,
                                timer: 1000
                            });

                        }
                    });
            })
        })
    </script>
</body>

</html>
