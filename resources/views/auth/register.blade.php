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
                            <a href="{{ url('/') }}" class="logo-link">
                                <img class="" width="250" src="{{ asset('src/images/piwaraan_logo.png') }}"
                                    srcset="{{ asset('src/images/piwaraan_logo.png') }} 2x" alt="logo">
                                <h6 class="text-center">BAPENDA KAB. BARITO TIMUR</h6>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Daftar</h4>
                                        <div class="nk-block-des">
                                            {{-- <p>Access the Dashlite panel using your email and passcode.</p> --}}
                                        </div>
                                    </div>
                                </div>
                                <form id="formRegister" class="form-validate is-alter" novalidate="novalidate"
                                    method="POST">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Nama</label>
                                        <div class="form-control-wrap">
                                            <input type="text" data-msg="Isi isian ini"
                                                class="form-control form-control-lg" name="name" id="name"
                                                placeholder="Masukkan Nama" required maxlength="50">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="name">Lembaga/Instansi/Profesi</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="id_stak" name="id_stak" required>
                                                <option selected value="">Pilih</option>
                                                @foreach ($stak as $item)
                                                    <option value="{{ $item->id }}">{{ $item->stakeholder }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="name">NO. WA</label>
                                        <div class="form-control-wrap">
                                            <input type="text" data-msg="Isi isian ini"
                                                class="form-control form-control-lg" name="no_hp" id="no_hp"
                                                placeholder="Masukkan No WA" required maxlength="12" minlength="11"
                                                inputmode="numeric" pattern="\d*">
                                        </div>
                                        <small>Pastikan Nomor Anda telah terdaftar Whatsapp</small>
                                    </div>


                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="form-control-wrap">
                                            <a tabindex="-1" href="#"
                                                class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" data-msg="Isi isian ini"
                                                class="form-control form-control-lg" id="password" name="password"
                                                placeholder="Masukkan Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Konfirmasi Password</label>
                                        <div class="form-control-wrap">
                                            <a tabindex="-1" href="#"
                                                class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" data-msg="Isi isian ini"
                                                class="form-control form-control-lg" id="confirm_password"
                                                name="confirm_password" placeholder="Masukkan Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-control-xs custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox_privasi"
                                                name="checkbox_privasi">
                                            <label class="custom-control-label" for="checkbox_privasi">Dengan
                                                melakukan daftar akun ini anda telah setuju dengan kebijakan privasi
                                                kami</label>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <button class="btn btn-lg btn-dark btn-block">Register</button>
                                    </div>

                                </form><!-- form -->
                                <div class="form-note-s2 text-center pt-4"> Sudah Punya Akun ? <a
                                        href="{{ url('/login') }}"><strong>Login</strong></a>
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
    <script>
        var BASE_URL = "{{ url('/', []) }}"
    </script>
    <script>
        $(document).ready(function() {

        });
        $('#formRegister').on('submit', function(e) {
            var postData = new FormData($("#formRegister")[0]);
            postData.append('_token', $('meta[name="csrf-token"]').attr(
                'content')); // Tambahkan token CSRF ke FormData
            $.ajax({
                type: "post",
                "url": BASE_URL + "/register",
                processData: false,
                contentType: false,
                data: postData,
                dataType: "JSON",
                success: function(data) {


                    if (data.success == false) {
                        data.errors.forEach(function(error) {
                            // Swal.fire('Gagal', error.message, 'warning');
                            NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' +
                                error.message + '</p>', 'error');
                        });
                    } else if (data.success == true) {

                        if (data.success === true) {
                            Swal.fire('Pendaftaran Berhasil', '', 'success').then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to verification page with the encoded phone number
                                    window.location.href = BASE_URL + '/verifikasi/' +
                                        data.no_hp;
                                }
                            });
                        } else {
                            Swal.fire('Pendaftaran Gagal', '', 'error');
                        }
                    }

                },

            })
            return false;
        });
    </script>

</html>
