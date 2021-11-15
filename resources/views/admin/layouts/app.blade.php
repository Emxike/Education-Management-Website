<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        Manage |
        @yield('title')
    </title>
    <link href="{{ asset("asset/admin/vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset("asset/admin/css/sb-admin-2.min.css") }}" rel="stylesheet">
    <link href="{{ asset("asset/admin/vendor/datatables/dataTables.bootstrap4.min.css") }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include("admin.layouts.menu")
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('admin.layouts.header')
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield("content")
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="modalChange" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formChange" role="form" action="{{ route("member.change.password") }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5  class="modal-title">Change Password</h5>
                    <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="common-label" for="password_new">Password New</label>
                            <input type="password" class="form-control" value="{{ old("password_new") }}"
                                   name="password_new" id="password_new" placeholder="Password New">
                            @error('password_new')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="common-label" for="password_confirm">Password Confirm</label>
                            <input type="password" class="form-control" value="{{ old("password_confirm") }}"
                                   name="password_confirm" id="password_confirm" placeholder="Password">
                            @error('password_confirm')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline btn-danger btn-sm" data-dismiss="modal">
                        <i class="fa fa-close"></i> <span>Cancel</span>
                    </button>
                    <button id="btnChange" type="submit" class="btn btn-outline btn-primary btn-sm">
                        <i class="fa fa-trash-o"></i> <span>Change</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset("asset/admin/vendor/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("asset/admin/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset("asset/admin/js/hullabaloo/hullabaloo.js") }}"></script>
<script src="{{ asset("asset/admin/vendor/jquery-easing/jquery.easing.min.js") }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset("asset/admin/js/sb-admin-2.min.js") }}"></script>
<script src="{{ asset("asset/admin/vendor/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("asset/admin/vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("asset/admin/js/demo/datatables-demo.js") }}"></script>
<script src="{{ asset("asset/admin/vendor/chart.js/Chart.min.js") }}"></script>
<script src="{{ asset("asset/admin/js/demo/chart-area-demo.js") }}"></script>
<script src="{{ asset("asset/admin/js/demo/chart-pie-demo.js") }}"></script>

<script type="text/javascript">
    let hulla = new hullabaloo();
    @if(session('message'))
        hulla.send('{{session('message')}}', '{{session('status')}}');
    @endif

    function deleteCommon(id) {
        $("#common_id").val(id);
    }

    @if($errors->has('password_new') || $errors->has('password_confirm'))
        $('#modalChange').modal('show');
    @endif


</script>
@yield("script")
</body>
</html>
