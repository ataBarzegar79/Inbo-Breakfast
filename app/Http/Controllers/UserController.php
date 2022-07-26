<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use function redirect;
use function view;

//fixme remove unused imports *done

class UserController extends Controller
{
    public function index(UserService $service): Factory|View|Application
    {
        return view('users', ['users' => $service->index()]);
    }

    //fixme define return type for functions *done
    public function store(UserService $service,  StoreUserRequest $request): RedirectResponse
    {
        $service->store($request);
        return redirect()->route('dashboard');
    }

    //fixme define return type for functions *done
    public function edit(int $id, UserService $service): Factory|View|Application|RedirectResponse
    {
        $updateUser = $service->edit($id);
        //fixme use camelcase for variable names *done
        if($updateUser === false ) {
            return redirect()->route('dashboard');
        }
        return view('update-user', ['update_user' => $updateUser]);
    }

    //fixme define return type for functions *done
    public function update(UserService $service, UpdateUserRequest $request, int $id): RedirectResponse
    {
        $service->update($request, $id);
        return redirect()->route('dashboard');//fixme use route method for paths *done
        //todo use consistent spacings *done
    }

    //fixme define return type for functions *done
    public function destroy($id, UserService $service): RedirectResponse
    {
        $service->destroy($id);
        return redirect()->route('dashboard');//fixme use route method for paths *done
    }

    //fixme define return type for functions *done
    public function standings(UserService $service): Factory|View|Application
    {
        //todo remove unused codes *done
        return view('standings', ['users' => $service->standing()]);
    }

}
