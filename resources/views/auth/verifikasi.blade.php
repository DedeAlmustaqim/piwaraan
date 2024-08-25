<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="../../../">
    <meta charset="utf-8">
    {{-- <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  --> --}}
    <link rel="shortcut icon" href="{{ asset('src/images/bartim.png') }}">
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
                                        <h5 class="nk-block-title">Kode OTP diperlukan</h5>
                                        <div class="nk-block-des">
                                            <p>Periksa WA dengan Nomor <?= $noHp ?> yang telah kami kirimkan Kode OTP
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="{{ url('/otp') }}" method="POST">
                                    @csrf
                                    <div class="form-group">

                                        <div class="form-control-wrap">
                                            <input hidden type="text"  class="form-control form-control-lg"
                                                id="no_hp_otp" name="no_hp_otp" value="{{$noHp}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Kode OTP</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" required
                                                maxlength="6" minlength="6" id="kode_otp" name="kode_otp">
                                        </div>
                                        <small>Masukkan 6 Digit Kode OTP yang telah kami kirimkan</small>
                                    </div>
                                   
                                    <div class="form-group">
                                        <!-- <small class="">Belum mendapatkan link Kode OTP ?</small> -->
                                        <button type="submit" class="btn btn-lg btn-dark btn-block">Kirim</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4">
                                    <a href="{{ url('/') }} ?>login"><strong>Kembali ke login</strong></a>
                                </div>
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
    <script src="{{ asset('src/assets/js/bundle.js?ver=3.2.3') }}"></script>
    <script src="{{ asset('src/assets/js/scripts.js?ver=3.2.3') }}"></script>
    <!-- select region modal -->
    <script></script>

</html>
