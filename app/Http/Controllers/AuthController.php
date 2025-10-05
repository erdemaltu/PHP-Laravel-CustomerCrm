<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function login(Request $request) {
        $data = $request->validate(['email'=>'required|email','password'=>'required']);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended(route('customers.index'));
        }
        return back()->withErrors(['email'=>'Giriş bilgileri hatalı']);
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:6|confirmed',
        ]);
        $user = User::create(['name'=>$data['name'],'email'=>$data['email'],'password'=>Hash::make($data['password'])]);
        Auth::login($user);
        return redirect()->route('customers.index');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
