<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Kemana user di-redirect bila sukses login
     */
    private $redirected_to = '/home';

    /**
     * Dimana letak form login user
     *
     * @var string
     */
    private $login_form_view = 'Auth.login';

    public function index()
    {
        return view($this->login_form_view);
    }

    /**
     * Handle percobaan login
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'         => ['required', 'email'],
            'password'      => ['required'],
            'remember_me'   => ['nullable', 'boolean']
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember_me ?? false)) {
            $request->session()->regenerate();

            return redirect()->intended($this->redirected_to);
        }

        return redirect()->route('login-form');
    }

    /**
     * Logout user
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('login-form');
    }
}
