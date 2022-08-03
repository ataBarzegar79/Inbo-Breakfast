<?php

namespace App\Http\Controllers;


use App\Dtos\Request\BreakfastStoreRequestDtoFactory;
use App\Dtos\Request\BreakfastUpdateRequestDtoFactory;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\StoreBreakfastRequest;
use App\Models\Breakfast;
use App\Services\Breakfast\BreakfastService;
use App\Services\User\UsersParticipateAverageService;
use App\Services\User\UserViewAvatarService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

class BreakfastController extends Controller
{
    public function index(BreakfastService $service, UserViewAvatarService $userViewAvatarService): Factory|View|Application
    {
        return view('dashboard',
            ['breakfasts' => $service->index(),
                'avatar' => $userViewAvatarService->viewAvatar(Auth::user())]);
    }

    public function create(
        BreakfastService               $service,
        UserViewAvatarService          $userViewAvatarService,
        UsersParticipateAverageService $averageParticipateService
    ): Factory|View|Application
    {
        return view('breakfast-create',
            [
                'users' => $service->create(),
                'avatar' => $userViewAvatarService->viewAvatar(Auth::user()),
                'averageParticipate' => $averageParticipateService->participateAverage()
            ]
        );
    }

    public function store(BreakfastService $service, StoreBreakfastRequest $request): RedirectResponse
    {
        $breakfastDto = BreakfastStoreRequestDtoFactory::fromRequest($request);
        $service->store($breakfastDto);
        return redirect()->route('dashboard');
    }

    public function destroy(Breakfast $breakfast, BreakfastService $service): RedirectResponse
    {
        $service->destroy($breakfast);
        return redirect()->route('dashboard');
    }

    public function edit(
        Breakfast             $breakfast,
        BreakfastService      $service,
        UserViewAvatarService $userViewAvatarService,
    ): Factory|View|Application|RedirectResponse
    {
        $editedBreakfast = $service->edit($breakfast);
        if ($editedBreakfast === false) {
            return redirect()->route('dashboard');
        }
        return view('breakfast-update',
            ['breakfast' => $editedBreakfast["breakfast"],
                'users' => $editedBreakfast['users'],
                'avatar' => $userViewAvatarService->viewAvatar(Auth::user())
            ]
        );
    }

    public function update(
        BreakfastUpdateRequest $request,
        Breakfast              $breakfast,
        BreakfastService       $service): RedirectResponse
    {
        $requestData = BreakfastUpdateRequestDtoFactory::fromRequest($request);
        $service->update($requestData, $breakfast);
        return redirect()->route('dashboard');
    }

}
