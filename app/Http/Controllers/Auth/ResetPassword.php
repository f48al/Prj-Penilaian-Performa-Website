<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPassword extends Controller
{
    /**
     * Dimana letak form email reset password
     *
     * @var string
     */
    private $reset_password_email_form_view = 'Auth.Reset_Password.inputEmail';

    /**
     * Dimana letak form reset password
     *
     * @var string
     */
    private $reset_password_form_view = 'Auth.Reset_Password.inputPassword';

    /**
     * Menampilkan form email reset password
     */
    public function index() {
        return view($this->reset_password_email_form_view);
    }

    /**
     * Mengirim email reset password
     *
     * @param Request $request
     */
    public function sendResetLinkEmail(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $token  = Str::random(60);
        $user   = User::where('email', $request->email)->first();

        DB::table('password_resets')->insert([
            'email'         => $request->email,
            'token'         => $token,
            'created_at'    => Carbon::now(),
        ]);

        Mail::send('Email.resetPassword', compact('token', 'user'), function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'Email reset password sudah dikirim. Harap cek inbox email anda.');
    }

    /**
     * Menampilkan form reset password
     *
     * @param string $token
     */
    public function resetPasswordForm($token) {
        $reset = DB::table('password_resets')->where('token', $token)->first();

        if (!$reset) {
            return abort(404);
        }

        return view($this->reset_password_form_view, ['token' => $token]);
    }

    /**
     * Reset password
     *
     * @param Request $request
     * @param string $token
     */
    public function resetPasswordPost($token, Request $request) {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $reset = DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (!$reset) return redirect()->route('login-form')->with('message', 'Token tidak ditemukan.');

        DB::table('users')
            ->where('email', $reset->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')
            ->where('email', $reset->email)
            ->delete();

        return redirect()->route('login-form')->with('message', 'Password berhasil diubah.');
    }
}
