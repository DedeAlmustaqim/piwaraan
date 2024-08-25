<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
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

            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                                        class="icon ni ni-menu"></em></a>
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
                                <img class="align-center float-md-start" height="50px"
                                    src="{{ asset('src/images/bartim.png') }}"
                                    >
                                <h5 class="">Pelaporan Interaktif Wajib Pajak Secara Instan (PIWARAAN) </h5>
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="nk-block-tools-opt"><a href="{{url('login')}}" class="btn btn-primary"><em
                                        class="icon ni ni-signin"></em><span>Login</span></a></li>

                                        <li class="nk-block-tools-opt"><a href="{{url('register')}}" class="btn btn-secondary"><span>Daftar</span></a></li>
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

    @stack('scripts')

    <script>
        var BASE_URL = "{{ url('/', []) }}"
    </script>
</body>

</html>
