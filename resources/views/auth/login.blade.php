<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    {{-- <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  --> --}}
    <link rel="shortcut icon" href="{{asset('src/images/bartim.png')}}">
    <!-- Page Title  -->
    <title>{{ $title }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('src/assets/css/dashlite.css?ver=3.2.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('src/assets/css/theme.css?ver=3.2.3') }}">
</head>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="{{url('/')}}" class="logo-link">
                                <img class="" width="250" src="{{ asset('src/images/piwaraan_logo.png') }}"
                                    srcset="{{ asset('src/images/piwaraan_logo.png') }} 2x" alt="logo">
                                <h6 class="text-center">BAPENDA KAB. BARITO TIMUR</h6>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Login</h4>
                                        <div class="nk-block-des">
                                            {{-- <p>Access the Dashlite panel using your email and passcode.</p> --}}
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ url('/login', []) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">No HP</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="no_hp"
                                                name="no_hp" placeholder="Masukkan No HP">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                            {{-- <a class="link link-primary link-sm"
                                                href="#">Forgot Code?</a> --}}
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                id="password" placeholder="Masukkan Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="link link-primary fw-normal py-2 px-3 fs-13px"
                                                href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="link link-primary fw-normal py-2 px-3 fs-13px"
                                                href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="link link-primary fw-normal py-2 px-3 fs-13px"
                                                href="#">Help</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2023 Dashlite. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=3.2.3"></script>
    <script src="./assets/js/scripts.js?ver=3.2.3"></script>
    <!-- select region modal -->
  
</html>
