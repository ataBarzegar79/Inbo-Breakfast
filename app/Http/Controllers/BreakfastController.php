<?php

namespace App\Http\Controllers;

use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\StoreBreakfastRequest;
use App\Services\Breakfast\BreakfastService;
use App\Services\Support\AverageParticipateService;
use App\Services\User\UserSupportService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

class BreakfastController extends Controller
{
    public function index(BreakfastService $service ,  UserSupportService $support): Factory|View|Application
    {
        return view('dashboard', ['breakfasts' => $service->index() , 'avatar'=>$support->viewAvatar(\Auth::id())]);
    }

    public function create(BreakfastService $service, UserSupportService $userSupportService, AverageParticipateService $averageParticipateService): Factory|View|Application
    {
        return view('breakfast-create',
            [
                'users' => $service->create($userSupportService),
                'avatar' => $userSupportService->viewAvatar(Auth::id()),
                'averageParticipate' => $averageParticipateService->averageParticipate()
            ]
        );
    }

    public function store(BreakfastService $service, StoreBreakfastRequest $request): RedirectResponse
    {
        $service->store($request);
        return redirect()->route('dashboard');
    }

    public function destroy($id, BreakfastService $service): RedirectResponse
    {
        $service->destroy($id);
        return redirect()->route('dashboard');
    }

    public function edit($breakfastId, BreakfastService $service, UserSupportService $userSupportService): Factory|View|Application|RedirectResponse
    {
        $editedBreakfast = $service->edit($breakfastId, $userSupportService);
        if ($editedBreakfast === false) {
            return redirect()->route('dashboard');
        }
        return view('breakfast-update', ['breakfast' => $editedBreakfast["breakfast"], 'users' => $editedBreakfast['users'], 'avatar' => $userSupportService->viewAvatar(Auth::id())]);
    }

    public function update(BreakfastUpdateRequest $request, $breakfastId, BreakfastService $service): RedirectResponse
    {
        $service->update($request, $breakfastId);
        return redirect()->route('dashboard');
    }

}
