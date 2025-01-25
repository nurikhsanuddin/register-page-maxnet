<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function forgot()
    {
        return view('login-forgot');
    }

    public function reset()
    {
        return view('login-reset');
    }

    public function authenticate(Request $request)
    {
        // Validasi inputan dari request
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required|min:4',
        ]);
        // dd($credentials)


        // Tentukan apakah inputan adalah email atau nomor telepon
        $loginType = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'customer_email' : 'customer_phone';

        // Transformasi nomor telepon jika menggunakan awalan '0'
        if ($loginType == 'customer_phone' && substr($credentials['email'], 0, 1) == '0') {
            $credentials['email'] = '62' . substr($credentials['email'], 1);
        }

        // Coba untuk autentikasi menggunakan jenis login yang ditentukan
        if (Auth::attempt([$loginType => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // Jika autentikasi gagal
        return back()->with([
            'error' => 'Email atau Password Salah'
        ]);
    }



    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $customer = Customer::where('customer_email', $request->email)->first();

        if (!$customer) {
            return back()->with([
                'error' => 'Email salah silahkan Hubungi CS'
            ]);
        }

        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]
        );

        $resetLink = url('/reset-password?token=' . $token . '&email=' . urlencode($request->email));

        $data = [
            'data' => $token,
            'reset' => $resetLink
        ];
        // dd($data);
        Mail::send('emails.password_reset', ['resetLink' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });

        // Redirect with success message
        return redirect()->route('login')->with('success', 'Password has been reset successfully. Check Your Email');
        // return response()->json(['message' => 'Password reset link sent']);
    }

    public function resetPassword(Request $request)
    {

        dd($request->all());
        // $request->validate([
        //     'token' => 'required',
        //     'email' => 'required|email|exists:customers,customer_email',
        //     'password' => 'required|min:8',
        // ]);


        $passwordReset = DB::table('password_resets')->where([
            ['email', '=', $request->email],
            ['token', '=', $request->tokentu],
        ])->first();
        // dd([$request->email, $request->tokentu]);

        if (!$passwordReset) {
            return back()->with([
                'error' => 'Email atau Password Salah'
            ]);
        }

        $customer = Customer::where('customer_email', $request->email)->first();

        if (!$customer) {
            return back()->with([
                'error' => 'Email atau Password Salah'
            ]);
        }

        $customer->customer_password = Hash::make($request->password);
        $customer->password_reset = 0;
        $customer->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        // Redirect with success message
        return redirect()->route('login')->with('success', 'Password has been reset successfully.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
