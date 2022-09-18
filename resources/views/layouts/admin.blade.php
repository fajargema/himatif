<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Himatif</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('adm/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('adm/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('adm/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('adm/img/favicon/site.webmanifest') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('adm/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('adm/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adm/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('components.admin.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('components.admin.header')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('components.admin.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('adm/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adm/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('adm/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('adm/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('adm/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adm/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adm/js/demo/datatables-demo.js') }}"></script>

    <script>
        //sweetalert for success or error message
        @if(session()->has('success'))
            swal({
                type: "success",
                icon: "success",
                title: "BERHASIL!",
                text: "{{ session('success') }}",
                timer: 5000,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
            @elseif(session()->has('error'))
            swal({
                type: "error",
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                timer: 5000,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
            @elseif(session()->has('info'))
            swal({
                type: "info",
                icon: "info",
                title: "INFO!",
                text: "{{ session('info') }}",
                timer: 5000,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
            @endif
    </script>

</body>

</html>
