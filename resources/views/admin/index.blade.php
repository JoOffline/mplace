<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Home</title>
    <link rel="icon" type="image/png" sizes="16x20" href="{{ asset('/Assets/images/kasirpe.png') }}">
    <link href="{{ asset('/Assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/Assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Preloader start -->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/>
            </svg>
        </div>
    </div>
    <!-- Preloader end -->

    <div id="main-wrapper">
        <div class="nav-header text-white">
            <div class="container-fluid">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-box menu-icon">
                        <h2 style="color: white;" class="mt-2">Sistem Kasir</h2>
                    </i>
                </a>
            </div>
        </div>

        <div class="header">
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mt-4 btn btn-danger"><i class="icon-key"></i> <span>Logout</span></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a href="{{ url('admin/dashboard') }}"><i class="icon-bag menu-icon"></i><span class="nav-text">Home</span></a></li>
                    <li><a href="{{ url('view_kategori') }}"><i class="icon-bag menu-icon"></i><span class="nav-text">Data Kategori</span></a></li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()"><i class="icon-basket menu-icon"></i><span class="nav-text">Data Produk</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('add_produk') }}">Tambah Produk</a></li>
                            <li><a href="{{ url('add_produk') }}">Edit Produk</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('view_order') }}"><i class="icon-speedometer menu-icon"></i><span class="nav-text">Data Laporan</span></a></li>
                </ul>
            </div>
        </div>

        <div class="content-body">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('/Assets/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('/Assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('/Assets/js/settings.js') }}"></script>
    <script src="{{ asset('/Assets/js/gleek.js') }}"></script>
    <script src="{{ asset('/Assets/js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('/Assets/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/Assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/Assets/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
    <script src="script.js"></script>
</body>
</html>
