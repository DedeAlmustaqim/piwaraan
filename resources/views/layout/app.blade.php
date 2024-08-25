<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="../">
    <meta charset="utf-8">
    {{-- <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  --> --}}
    <link rel="shortcut icon" href="{{ asset('src/images/bartim.png') }}">
    <!-- Page Title  -->
    <title>{{ $data['title'] }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('src/assets/css/dashlite.css?ver=3.2.3') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/js/leaflet/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('src/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('src/datatables.net-bs4/css/responsive.dataTables.min.css"') }}"> --}}

    <link rel="stylesheet" href="{{ asset('src/assets/css/skins/theme-blue.css') }}">


    <link id="skin-default" rel="stylesheet" href="{{ asset('src/assets/css/theme.css?ver=3.2.3') }}">
    <style>
        #map {
            height: 500px;
            /* Sesuaikan tinggi peta */
        }
    </style>
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="{{ url('html/index.html') }}" class="logo-link nk-sidebar-logo">
                            <img class="{{ asset('src/images/piwaraan_logo.png') }}" width="200"
                                src="{{ asset('src/images/piwaraan_logo.png') }}"
                                srcset="{{ asset('src/images/piwaraan_logo.png') }} 2x" alt="logo">

                            {{-- <img class="{{ asset('src/images/piwaraan_logo.png') }}" width="200" src="{{ asset('src/images/piwaraan_logo.png') }}"
                                srcset="{{ asset('src/images/piwaraan_logo.png') }} 2x" alt="logo-dark"> --}}

                            <img class="logo-small logo-img logo-img-small"
                                src="{{ asset('src/images/piwaraan_logo.png') }}" width="50"
                                srcset="{{ asset('src/images/piwaraan_logo.png') }} 2x" alt="logo-small">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none"
                            data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                            data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">




                                <li class="nk-menu-item">
                                    @if (auth()->user()->isAdmin())
                                    <a href="{{ url('/admin/dashboard', []) }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-growth-fill"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                    @endif

                                    @if (auth()->user()->isStakeholder())
                                    <a href="{{ url('/stakeholder/dashboard', []) }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-growth-fill"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                    @endif
                                   
                                   
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                                        <span class="nk-menu-text">Potensi Pajak </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/pendataan', []) }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Pendataan</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/pendataan/valid', []) }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Telah Verifikasi</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/pendataan/reject', []) }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Dibatalkan</span></a>
                                        </li>

                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                @if (auth()->user()->isAdmin())
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-done"></em></span>
                                            <span class="nk-menu-text">Verifikasi Data </span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="{{ url('/validasi', []) }}" class="nk-menu-link"><span
                                                        class="nk-menu-text">Proses Verifikasi</span></a>
                                            </li>
                                            {{-- <li class="nk-menu-item">
                                                <a href="{{ url('/pendataan/valid', []) }}" class="nk-menu-link"><span
                                                        class="nk-menu-text">Telah Verifikasi</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('/pendataan/reject', []) }}" class="nk-menu-link"><span
                                                        class="nk-menu-text">Dibatalkan</span></a>
                                            </li> --}}

                                        </ul><!-- .nk-menu-sub -->
                                    </li>
                                @endif


                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-map"></em></em></span>
                                        <span class="nk-menu-text">Survey </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @if (auth()->user()->isAdmin())
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/survey/jadwal', []) }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Penetapan Jadwal </span></a>
                                        </li>
                                        @endif
                                        
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/survey/terjadwal', []) }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Terjadwal </span></a>
                                        </li>

                                        
                                        @if (auth()->user()->isAdmin())
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/survey/data_survey', []) }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Data Survey </span></a>
                                        </li>
                                        @endif

                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-db"></em></span>
                                        <span class="nk-menu-text">Data Final </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/final/wajib_pajak', []) }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Wajib Pajak</span></a>
                                        </li>


                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                @if (auth()->user()->isAdmin())
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                        <span class="nk-menu-text">Referensi </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/stakeholder', []) }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Stakeholder</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/user', []) }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Pengguna</span></a>
                                        </li>

                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                @endif
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon"
                                    data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            {{-- <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="./images/logo.png"
                                        srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="./images/logo-dark.png"
                                        srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand --> --}}
                            <div class="nk-header-search ms-3 ms-xl-0">
                                <em class="icon ni ni-search"></em>
                                <input type="text" class="form-control border-transparent form-focus-none"
                                    placeholder="Search anything">
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">



                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-xl-block">

                                                    <div class="user-name dropdown-indicator">
                                                        {{ session('name') }}
                                                        <!-- Menampilkan semua data dari session -->
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">


                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ url('logout') }}"><em
                                                                class="icon ni ni-signout"></em><span>Logout</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; 2024 BAPENDA BARTIM <a href="#"
                                    target="_blank"></a>
                            </div>
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    {{--                                     
                                    <li class="nav-item">
                                        <a data-bs-toggle="modal" href="#region" class="nav-link"><em
                                                class="icon ni ni-globe"></em><span class="ms-1">Select
                                                Region</span></a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <!-- JavaScript -->
    <script src="{{ asset('src/assets/js/bundle.js?ver=3.2.3') }}"></script>
    <script src="{{ asset('src/assets/js/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('src/assets/js/scripts.js?ver=3.2.3') }}"></script>
    <script src="{{ asset('src/assets/js/libs/datatable-btns.js?ver=3.2.3') }}"></script>
    <script src="{{ asset('src/digital_native.js') }}?t={{ date('YmdHis') }}"></script>
    <script src="{{ asset('src/app_by_digital_native.js') }}?t={{ date('YmdHis') }}"></script>

    {{-- <script src="{{ asset('src/datatables.net/js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('src/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script> --}}
<script>
        var BASE_URL = "{{ url('/', []) }}"
    </script>
    @stack('scripts')

    
</body>

</html>
