<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Only allow admin@gmail.com / admin123
        if ($request->email === 'admin@gmail.com' && $request->password === 'admin123') {
            // Set admin session with user data
            session([
                'is_admin' => true, 
                'admin_email' => $request->email,
                'admin_user' => [
                    'id' => 1,
                    'email' => $request->email,
                    'name' => 'Administrator'
                ]
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials.'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['is_admin', 'admin_email', 'admin_user']);
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }
}
