<?php

namespace App\Http\Controllers;

use App\Dtos\VoteRequestDtoFactory;
use App\Http\Requests\StoreVoteRequest;
use App\Models\Breakfast;
use App\Services\Rate\RateService;
use App\Services\User\UserSupportService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

//fixme cleanup unused imports *done

class VoteController extends Controller
{
    //fixme use camelcase for function parameters *done
    //fixme define return type for functions *done
    /**
     * @throws AuthorizationException
     */
    public function create(Breakfast $breakfsatvote, RateService $service, UserSupportService $userSupportService): Factory|View|Application
    {
        $this->authorize('canVote', $breakfsatvote->id);
        //fixme add none runtime exceptions to function document with @throw annotation *done
        return view('vote', ['breakfast' => $service->create($breakfsatvote), 'avatar' => $userSupportService->viewAvatar(Auth::id())]);
    }

    //fixme use camelcase for function parameters *done
    //fixme define return type for functions *done
    /**
     * @throws AuthorizationException
     */
    public function store(Breakfast $breakfsatvote, StoreVoteRequest $request, RateService $service): RedirectResponse
    {
        $requestDto = VoteRequestDtoFactory::fromRequest($request);
        $this->authorize('canVote', $breakfsatvote->id);
        //fixme add none runtime exceptions to function document with @throw annotation *done
        $service->store($requestDto, $breakfsatvote);
        return redirect()->route('dashboard');//fixme use route method for paths *done
    }

}



