<!DOCTYPE html>
<html lang="vi">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <base href="{{asset('')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Hãng phim</title>

  <!-- Custom fonts for this template-->
  <link href="admin_asset/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="admin_asset/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin_asset/css/sb-admin-2.min.css" rel="stylesheet">

  <link href="admin_asset/css/bootstrap-datepicker.css" rel="stylesheet">

  <link rel="stylesheet" href="admin_asset/css/bootstrap-select.min.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('hangphim.layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <!-- Topbar -->
      @include('hangphim.layouts.header')
      <!-- End of Topbar -->

        @yield('content')

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('hangphim.layouts.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  {{-- @include('layouts.errors') --}}

  @include('admin.layouts.modaldel')
  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn chứ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên hiện tại của mình."</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ</button>
          <a class="btn btn-primary" href="{{ route('logout') }}">Đăng xuất</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="admin_asset/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <script src="js/moment.js"></script>

  <script src="js/bootstrap.min.js"></script>

  <!-- Core plugin JavaScript-->
  <!-- <script src="admin_asset/jquery-easing/jquery.easing.min.js"></script> -->

  <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin_asset/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  {{-- <script src="admin_asset/chart.js/Chart.min.js"></script> --}}

  <!-- Page level plugins -->
  <script src="admin_asset/datatables/jquery.dataTables.min.js"></script>
  <script src="admin_asset/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="admin_asset/js/demo/datatables-demo.js"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="admin_asset/js/demo/chart-area-demo.js"></script>
  <script src="admin_asset/js/demo/chart-pie-demo.js"></script> --}}
  
  <script src="admin_asset/js/bootstrap-datepicker.js"></script>

  <script src="admin_asset/js/bootstrap-select.min.js"></script>

  <script src="js/js-filmstudio.js"></script>

  @if(session('error_themphim'))
  <script>
    $('#modal_themPhim').modal('show')
  </script>
  @endif
  @if(session('error_capnhatphim'))
  <script>
    $('#modal-capnhat-phim').modal('show')
  </script>
  @endif

  @yield('script')
  @stack('script')

</body>
</html>