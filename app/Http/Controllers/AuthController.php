<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthController extends Controller
{
    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required | min:5',
            're_password' => 'required |same:password'
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        return Redirect('/login')->with('Pendaftaran Berhasil Warga');
    }


    public function loginpage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email dan Password tidak di temukan');
        }

        Auth::login($user);

        session([
            'user_id' => $user->id,
            'role' => $user->usertype,
            'name' => $user->name,
            'phone' => $user->phone,
            'is_logged_in' => true,
        ]);

        if ($user->usertype == 'admin') {
            return Redirect('/admin');
        }
        return Redirect('/home');
    }

    public function logout()
    {
        session()->flush();

        return view('/home.welcome_warga');
    }
}
