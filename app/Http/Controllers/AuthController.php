<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use function back;
use function redirect;
use function view;

class AuthController extends Controller
{
    public function show(): Factory|View|Application
    {
        return view('login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        //todo move logic to service
        $user = User::where('name', '=', $request->get('name'))
            ->where('password', '=', $request->get('password'))
            ->first();
        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); //fixme use route method for paths *done
        }

        return back()->withErrors([
            'notfound' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('dashboard');//fixme use route method for paths *done
    }


}
