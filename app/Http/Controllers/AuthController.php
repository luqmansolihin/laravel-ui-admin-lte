<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function loginView() {
        return view('auth.login');
    }

    public function registerView() {
        return view('auth.register');
    }

    public function registerProcess(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255',
            'password' => 'required|string|min:8|max:32|confirmed',
            'identity_card' => 'required|image|mimes:jpg,png',
            'g-recaptcha-response' => 'required'
        ]);

        $register = Http::attach(
            'identity_card',
            fopen($request->file('identity_card')->getRealPath(), 'r'),
            $request->file('identity_card')->getClientOriginalName()
        )->post(
            config('app.api_base_url').'register',
            $request->only(['name', 'email', 'password'])
        );

        if ($register->status() == 400)
            return redirect()->back()->withErrors($register->json('errors'));

        return redirect()->route('login')->with(['success' => 'Account successfully created']);
    }

    public function loginProcess(Request $request) {
        $this->validate($request, [
            'email' => 'required|string|email:rfc,dns|max:255',
            'password' => 'required|string|min:8|max:32',
            'g-recaptcha-response' => 'required'
        ]);

        $login = Http::post(
            config('app.api_base_url').'login',
            $request->only(['email', 'password'])
        );

        if ($login->status() == 400)
            return redirect()->back()->withErrors($login->json('errors'));

        if ($login->status() == 401)
            return redirect()->back()->with(['error' => $login->json('message')]);

        Session::put('data', $login->json('data'));

        return redirect()->route('dashboard');
    }

    public function logout () {
        Session::remove('data');

        return redirect()->route('login');
    }
}
