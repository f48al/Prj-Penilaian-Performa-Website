@extends('master')
@guest
    @section('title') Login @endsection
    @section('style')
        <style>
            .bg-theme {
                background: rgb(9,170,230);
                background: linear-gradient(90deg, rgba(9,170,230,1) 10%, rgba(124,229,43,1) 50%);
            }
        </style>
    @endsection
    @section('content')
        <div class="container-fluid">
            <div class="row justify-content-center bg-theme" style="height: 100vh">
                <div class="col-lg-4 col-md-4 col-sm-8 bg-light my-auto" style="border-radius: 25px">
                    <div class="login-wrap p-3 p-md-4">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <img class="rounded mx-auto d-block" src="{{ asset('/plugin/images/assets/nav_logo.png') }}" alt="logo" width="50%">
                        </div>
                        <form action="{{ route('login') }}" method="POST" class="px-4 pt-4 px-md-5">
                            @csrf @method('POST')
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="email" style="border-radius: 20px" placeholder="Username" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control" name="password" style="border-radius: 20px" placeholder="Password" required>
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="submit" class="btn btn-primary px-4" style="border-radius: 20px">Login</button>
                            </div>
                            <div class="form-group">
                                <div class="d-md-flex align-items-center justify-content-center">
                                    <a class="link-danger" href="{{ route('lupa-password') }}">
                                        <small>Lupa Password?</small>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endguest
