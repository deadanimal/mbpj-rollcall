<!DOCTYPE html>
<html>

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Sistem Pengurusan Roll Call</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('argon') }}/img/mbpj.png ">
    <!-- Fonts -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Icons -->
    <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <link rel="stylesheet" href="/assets/vendor/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="/assets/vendor/sweetalert2/dist/sweetalert2.min.css">

    <!-- Argon CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets') }}//css/argon.min.css?v=1.2.1" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('assets') }}//css/argon.min.css?v=1.2.1" type="text/css">

    {{-- QrCode --}}
    <script src="/js/qrcode.min.js"></script>

    {{-- AdvSelect --}}
    <link rel="stylesheet" href="/AdvSelect/virtual-select.min.css" />

    @yield('head')
    @notifyCss
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  d-flex  align-items-center  ">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img src="{{ asset('argon') }}/img/mbpj.png" style="padding:20px 0px 0px 45px;">
                </a>
                <div class=" ml-auto mt-auto ">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items pentadbir -->
                    @if (auth()->user()->role == 'pentadbir_sistem')
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard">
                                    <i class="ni ni-archive-2 text-red"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/users">
                                    <i class="ni ni-archive-2 text-red"></i>
                                    <span class="nav-link-text">Pengurusan Pengguna</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/rollcalls">
                                    <i class="ni ni-chat-round text-red"></i>
                                    <span class="nav-link-text">Pengurusan Roll Call</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#utiliti" data-toggle="collapse" role="button"
                                    aria-expanded="true" aria-controls="navbar-dashboards">
                                    <i class="ni ni-chat-round text-red"></i>
                                    <span class="nav-link-text">Utiliti</span>
                                </a>
                                <div class="collapse" id="utiliti">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/sebab" class="nav-link">
                                                <span class="sidenav-mini-icon"></span>
                                                <span class="sidenav-normal"> Sebab</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="/kumpulan" class="nav-link">
                                                <span class="sidenav-mini-icon"> </span>
                                                <span class="sidenav-normal"> Kumpulan </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/laporans">
                                    <i class="ni ni-chart-bar-32 text-red"></i>
                                    <span class="nav-link-text">Laporan</span>
                                </a>
                            </li>
                        </ul>
                        <!-- Nav items lain-lain custom -->
                    @elseif(auth()->user()->role == 'naziran')
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard">
                                    <i class="ni ni-archive-2 text-red"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/daftar-roll-call">
                                    <i class="ni ni-calendar-grid-58 text-red"></i>
                                    <span class="nav-link-text">Roll Call</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/rollcalls">
                                    <i class="ni ni-calendar-grid-58 text-red"></i>
                                    <span class="nav-link-text">Pengurusan Roll Call</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/rekod">
                                    <i class="ni ni-calendar-grid-58 text-red"></i>
                                    <span class="nav-link-text">Semak Kedatangan</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                            <a class="nav-link" href="/users"
                                <span class="nav-link-text">Pengurusan Pengguna</span>
                            </a>
                        </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/laporans">
                                    <i class="ni ni-chart-bar-32 text-red"></i>
                                    <span class="nav-link-text">Laporan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#utiliti" data-toggle="collapse" role="button"
                                    aria-expanded="true" aria-controls="navbar-dashboards">
                                    <i class="ni ni-chat-round text-red"></i>
                                    <span class="nav-link-text">Utiliti</span>
                                </a>
                                <div class="collapse" id="utiliti">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/sebab" class="nav-link">
                                                <span class="sidenav-mini-icon"></span>
                                                <span class="sidenav-normal"> Sebab</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="/kumpulan" class="nav-link">
                                                <span class="sidenav-mini-icon"> </span>
                                                <span class="sidenav-normal"> Kumpulan </span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="/pengurusan_pengguna" class="nav-link">
                                                <span class="sidenav-mini-icon"> </span>
                                                <span class="sidenav-normal"> Pengurusan Pengguna </span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>



                        </ul>
                        <!-- Nav items dalaman -->
                    @elseif(auth()->user()->role == 'penyelia' || auth()->user()->role == 'ketua_bahagian')
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard">
                                    <i class="ni ni-archive-2 text-info"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/daftar-roll-call">
                                    <i class="ni ni-calendar-grid-58 text-info"></i>
                                    <span class="nav-link-text">Roll Call</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/rollcalls">
                                    <i class="ni ni-chart-pie-35 text-info"></i>
                                    <span class="nav-link-text">Pengurusan Roll Call</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/laporans">
                                    <i class="ni ni-chart-bar-32 text-info"></i>
                                    <span class="nav-link-text">Laporan</span>
                                </a>
                            </li>
                        @else
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard">
                                        <i class="ni ni-archive-2 text-info"></i>
                                        <span class="nav-link-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/rollcalls">
                                        <i class="ni ni-chart-pie-35 text-info"></i>
                                        <span class="nav-link-text"> Roll Call</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/laporans">
                                        <i class="ni ni-chart-bar-32 text-info"></i>
                                        <span class="nav-link-text">Laporan</span>
                                    </a>
                                </li>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->

                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/person.png">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span
                                            class="mb-0 text-sm  font-weight-bold">{{ Auth()->user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                {{-- <div class="dropdown-header bg-default noti-title">
                                    <h5 class="text-white mb-2 text-center">Selamat Datang !</h5>
                                </div> --}}
                                <a href="/profiles" class="dropdown-item mt-2">
                                    <i class="ni ni-single-02"></i>
                                    <span>Profil</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="/logout" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Log Keluar</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
    @notifyJs

    <!-- Argon Scripts -->
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="/assets/vendor/moment/min/moment.min.js"></script>
    <script src="/assets/vendor/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- Argon JS -->
    <script src="/assets/js/argon.min.js?v=17"></script>
    {{-- <script src="/assets/js/demo.min.js"></script> --}}

    <script src="{{ asset('assets') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/pagination/select.js"></script>


    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({});
        });
    </script>

    @yield('script')

    {{-- AdvSelect --}}
    <script src="/AdvSelect/virtual-select.min.js"></script>
</body>

</html>
