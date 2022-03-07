<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganti Password Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background: rgb(9,170,230);
            background: linear-gradient(90deg, rgba(9,170,230,1) 0%, rgba(124,229,43,1) 100%);
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0 min-vh-100">
            <div class="col-lg-5 col-md-8 py-8 py-xl-0">
                <div class="card shadow" style="border-radius: 20px;">
                    <div class="card-body p-6">
                        <div class="mb-4">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('/plugin/images/0__login-page/logo-img_u2.png') }}" class="mb-4" alt="logo" width="50%"/>
                            </div>
                            <h1 class="mb-1 fw-bold">Ganti Password Baru</h1>
                            <p>Silahkan isi form dibawah dengan password yang baru</p>
                        </div>
                        <form action="{{ route('password.reset.post', $token) }}" method="POST">
                            @csrf @method('POST')
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="password yang baru" minlength="8" required>
                                <span style="font-size: 13px;">
                                    <small class="text-danger">
                                        *Password minimal 8 karakter
                                    </small>
                                </span>
                                @if ($errors->has('password'))
                                    <div id="passwordFeedback" class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" placeholder="ketik ulang password baru" required>
                                <span style="font-size: 13px;">
                                    <small class="text-danger">
                                        *Password konfirmasi harus sama dengan password baru
                                    </small>
                                </span>
                                @if ($errors->has('password_confirmation'))
                                    <div id="password_confirmationFeedback" class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 text-end">
                                <button type="submit" class="btn btn-success" id="submit-btn" disabled>
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('password').onfocus = function() {
            this.classList.remove('is-invalid');
            document.getElementById('password_confirmation').value = null;
            this.value = null;
        }

        document.getElementById('password_confirmation').onfocus = function() {
            this.value = null;
            this.classList.remove('is-invalid');
        }

        document.getElementById('password_confirmation').onkeyup = function() {
            var password = document.getElementById('password').value;
            var password_confirmation = this.value;

            if (password != password_confirmation && password_confirmation != null) {
                document.getElementById('submit-btn').disabled = true;
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                document.getElementById('submit-btn').disabled = false;
            }
        }
    </script>
</body>
</html>
