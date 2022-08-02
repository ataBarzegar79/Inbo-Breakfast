<?php

namespace App\Http\Controllers;

use App\Dtos\UserRequestDtoFactory;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\Breakfast\BreakfastSupportService;
use App\Services\User\UserService;
use App\Services\User\UsersParticipateAverageService;
use App\Services\User\UserSupportService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use function redirect;
use function view;

class UserController extends Controller
{
    public function index(UserService $service, BreakfastSupportService $breakfastSupportService, UserSupportService $userSupport): Factory|View|Application
    {
        return view('users', ['users' => $service->index($breakfastSupportService), 'avatar' => $userSupport->viewAvatar(Auth::id())]);
    }

    public function store(UserService $service, StoreUserRequest $request): RedirectResponse
    {
        $userDto = UserRequestDtoFactory::fromRequest($request);
        $service->store($userDto);
        return redirect()->route('dashboard');
    }

    public function edit(User $user, UserService $service, UserSupportService $userSupport): Factory|View|Application|RedirectResponse
    {
        $updateUser = $service->edit($user);
        if ($updateUser === false) {
            return redirect()->route('dashboard');
        }
        return view('update-user', ['update_user' => $updateUser, 'avatar' => $userSupport->viewAvatar(Auth::id())]);
    }

    public function update(UserService $service, UpdateUserRequest $request, User $user): RedirectResponse
    {
        $userDto = UserRequestDtoFactory::fromRequest($request);
        $service->update($userDto, $user);
        return redirect()->route('dashboard');
    }

    public function destroy(User $user, UserService $service): RedirectResponse
    {
        $service->destroy($user);
        return redirect()->route('dashboard');
    }

    public function standings(UserService $service, BreakfastSupportService $breakfastSupportService, UsersParticipateAverageService $usersParticipateAverageService, UserSupportService $userSupport): Factory|View|Application
    {
        return view('standings', ['users' => $service->standing($breakfastSupportService), 'usersAverage' => $usersParticipateAverageService->participateAverage(), 'avatar' => $userSupport->viewAvatar(Auth::id())]);
    }

}
