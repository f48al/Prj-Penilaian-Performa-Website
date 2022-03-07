<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid bg-light">
        <div class="d-flex justify-content-center">
            <div class="col-6 text-center">
                <img class="rounded mx-auto d-block" src="{{ asset('/plugin/images/assets/nav_logo.png') }}" alt="logo" width="50%">
                <h4>Ganti Password</h4>
            </div>
        </div>
        <hr>
        <div class="container">
            <p>
                Halo {{ $user->name }},<br>
                <br>
                Lupa passwordmu?<br>
                Kami baru saja menerima permintaan untuk mengganti passwordmu.<br>
                <br>
                Untuk mengganti passwordmu, klik tombol dibawah ini.<br>
                <a href="{{ route('password.reset', $token) }}">
                    <button class="btn btn-success">
                        Ganti Password
                    </button>
                </a><br>
                <br>
                Atau copy dan paste URL di bawah ini ke browsermu:<br>
                <a>{{ route('password.reset', $token) }}</a>
            </p>
            <span>
                <small class="text-secondary">
                    *Bila kamu tidak melakukan permintaan untuk mengganti password, maka abaikan email ini.
                </small>
            </span>
        </div>
    </div>
</body>
</html>
