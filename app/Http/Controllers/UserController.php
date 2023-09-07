<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(){
        return view('users/register');
    }

    public function regist(request $request){
        $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'level' => 'required',
            'foto' => 'image|file',
        ]);
        $request['password'] = Hash::make($request->password);
        if($request->file('foto')){
            $request->file('foto')->store('post-image');
            $namafoto = $request->foto->getClientOriginalName();
        }
        $user = Users::create([
            'uuid' => $uuid,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'level' => $request->level,
            'foto' => $namafoto,
        ]);
        
        // dd($user);
        $request->session()->flash('sukses', 'Registrasi Berhasil!!');
        return redirect('/');

    }
    
    public function onLogin(request $request)
    {
        $validasi = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validasi)) {
            # code...
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }else{
            return back()->with('error','Username atau password salah bro');
        }

    }

    public function LogOut(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function index(){
        return view('dashboard');
    }
}
