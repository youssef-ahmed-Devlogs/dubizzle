<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel') . ' Dashboard')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard_/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->

    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('dashboard_/css/sb-admin-2-rtl.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('dashboard_/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @endif


    <style>
        .child-category-row {
            background: #f1f1f1
        }

        .inline-block {
            display: inline-block;
        }

        .fw-bold {
            font-weight: bold;
            margin-bottom: 3px
        }

        table td {
            vertical-align: middle !important;
        }

        .table-image {
            width: 40px;
            border-radius: 50%;
            height: 40px;
            object-fit: cover;
        }

        .form-profile-avatar img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>

    @stack('styles')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <x-dashboard.sidebar />

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <x-dashboard.topbar />

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <x-dashboard.footer />

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <x-dashboard.logout-modal />

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dashboard_/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard_/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('dashboard_/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('dashboard_/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
