<?php

namespace App\Http\Controllers;

use App\Dtos\Request\UserRequestDtoFactory;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\User\UserCrudService;
use App\Services\User\UsersParticipateAverageService;
use App\Services\User\UserViewAvatarService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

class UserController extends Controller
{
    public function index
    (
        UserCrudService       $service,
        UserViewAvatarService $userViewAvatarService
    ): Factory|View|Application
    {
        return view('users', [
                'users' => $service->index(),
                'avatar' => $userViewAvatarService->viewAvatar(Auth::user())
            ]
        );
    }


    public function store(UserCrudService $service, StoreUserRequest $request): RedirectResponse
    {
        $userDto = UserRequestDtoFactory::fromRequest($request);
        $service->store($userDto);
        return redirect()->route('users.index');
    }


    public function edit
    (
        User                  $user,
        UserCrudService       $service,
        UserViewAvatarService $userViewAvatarService
    ): Factory|View|Application|RedirectResponse
    {
        $updateUser = $service->edit($user);
        if ($updateUser === false) {
            return redirect()->route('dashboard');
        }
        return view('update-user', [
                'update_user' => $updateUser,
                'avatar' => $userViewAvatarService->viewAvatar(Auth::user())
            ]
        );
    }


    public function update(UserCrudService $service, UpdateUserRequest $request, User $user): RedirectResponse
    {
        $userDto = UserRequestDtoFactory::fromRequest($request);
        $service->update($userDto, $user);
        return redirect()->route('users.index');
    }


    public function destroy(User $user, UserCrudService $service): RedirectResponse
    {
        $service->destroy($user);
        return redirect()->route('users.index');
    }


    public function standings
    (
        UserCrudService                $service,
        UsersParticipateAverageService $usersParticipateAverageService,
        UserViewAvatarService          $userViewAvatarService
    ): Factory|View|Application
    {
        return view('standings', [
                'users' => $service->standing(),
                'usersAverage' => $usersParticipateAverageService->participateAverage(),
                'avatar' => $userViewAvatarService->viewAvatar(Auth::user())
            ]
        );
    }

}
