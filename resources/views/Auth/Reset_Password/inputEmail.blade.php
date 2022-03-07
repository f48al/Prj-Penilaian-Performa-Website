<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- lokasi favicon ada di /public/plugin/images/assets/favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/plugin/images/assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/plugin/images/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/plugin/images/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/plugin/images/assets/favicon/site.webmanifest') }}">

    <title>Email Reset Password | Penilaian Performa BPJS Ketenagakerjaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background: rgb(9,170,230);
            background: linear-gradient(90deg, rgba(9,170,230,1) 0%, rgba(124,229,43,1) 100%);
        }
    </style>
</head>
<body>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container-fluid d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0 min-vh-100">
            <div class="col-lg-5 col-md-8 py-8 py-xl-0">
                <div class="card shadow" style="border-radius: 20px;">
                    <div class="card-body p-6">
                        <div class="mb-4">
                            <a href="{{ url('/') }}">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('/plugin/images/0__login-page/logo-img_u2.png') }}" class="mb-4" alt="logo" width="50%"/>
                                </div>
                            </a>
                            <h1 class="mb-1 fw-bold">Lupa Password</h1>
                            <p>Lupa password? silahkan isi email dibawah</p>
                        </div>
                        <form action="{{ route('lupa-password-send') }}" method="POST">
                            @csrf @method('POST')
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" placeholder="Email yang kamu ingat" required autocomplete="off">
                                @if ($errors->has('email'))
                                    <div id="emailFeedback" class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 text-end">
                                <button type="submit" class="btn btn-success" >
                                    Reset Password
                                </button>
                            </div>
                            <span>
                                <small class="text-secondary">
                                    Kembali ke laman <a href="{{url('/')}}">Login</a>
                                </small>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('email').onfocus = function() {
            this.classList.remove('is-invalid');
        }
    </script>
</body>
</html>
