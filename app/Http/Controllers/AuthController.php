<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use function back;
use function redirect;
use function view;

class AuthController extends Controller
{
    /**
     * @return Factory|View|Application shows login page
     */
    public function show(): Factory|View|Application
    {
        return view('login');
    }

    /**
     * @param LoginRequest $request
     * @param AuthService $service
     * @return RedirectResponse
     */
    public function login(LoginRequest $request, AuthService $service): RedirectResponse
    {
        $response = $service->login($request);
        if ($response === true) {
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'notfound' => 'The provided credentials do not match our records.',
            ]);
        }

    }

    /**
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function logout(AuthService $service): Redirector|Application|RedirectResponse
    {
        $service->logout();
        return redirect()->route('dashboard');
    }


}
