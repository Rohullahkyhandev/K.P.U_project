<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {


        $user =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:16'
        ]);

        User::create([
            'name' => 'Rohullah',
            'full_name' => 'Rohullah Kyhan',
            'photo' => 'public/users/iFr0qXwNnu4RFUpwnLssczlk3KRFCUDbxXP3PaOu.jpg',
            'photo_path' => 'public/users/iFr0qXwNnu4RFUpwnLssczlk3KRFCUDbxXP3PaOu.jpg',
            'position' => 'Web Developer',
            'user_type' => 'PDC_user',
            'role' => 'admin',
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (!Auth::attempt($user)) {
            return redirect('/')->with('error', 'ایمل یا رمز عبور شما درست نیست');
        } else {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'به داشبورد سیستم خوش آمدید');
        }
    }

    public function signOut(Request $request)
    {
        $request->session()->invalidate();
        auth()->logout(auth()->user());
        return redirect('/')->with('success', 'شما موفقانه از سیستم خارج شدید');
    }
}
