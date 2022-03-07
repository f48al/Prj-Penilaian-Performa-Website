<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Kemana user di-redirect bila berhasil register
     *
     * @var string
     */
    private $redirected_to = '/home';

    /**
     * Apakah user akan langsung login begitu selesai register ?
     *
     * @var boolean
     */
    private $auto_login = true;

    /**
     * Dimana letak form registrasi user?
     *
     * @var string
     */
    private $register_form_view = 'Auth.register';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() {
        return view($this->register_form_view);
    }

    /**
     * Handle percobaan register
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registration(Request $request) {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'unique:users,email', 'email', 'max:255'],
            'password'  => ['required', 'confirmed', 'min: 8']
        ]);

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'remember_me'   => true
        ]);

        if($this->auto_login) Auth::login($user);

        return redirect()->intended($this->redirected_to);
    }
}
