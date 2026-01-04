<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
            //認証失敗時
            if (!Auth::attempt($request->only('email', 'password'))) {
                return back()
                    ->withErrors([
                        'password' => 'ログイン情報が登録されていません',
                    ])
                    ->withInput();
            }
            //認証成功時
            return redirect()->route('admin.index');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('logout.view');
    }
}

