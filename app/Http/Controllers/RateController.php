<?php

namespace App\Http\Controllers;

use App\Dtos\Request\RateRequestDtoFactory;
use App\Http\Requests\StoreRateRequest;
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

class RateController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function create(
        Breakfast          $breakfsatvote,
        RateService        $service,
        UserSupportService $userSupportService
    ): Factory|View|Application
    {
        $this->authorize('canVote', $breakfsatvote->id);
        return view('vote', [
                'breakfast' => $service->create($breakfsatvote),
                'avatar' => $userSupportService->viewAvatar(Auth::user())
            ]
        );
    }


    /**
     * @throws AuthorizationException
     */
    public function store(
        Breakfast        $breakfsatvote,
        StoreRateRequest $request,
        RateService      $service
    ): RedirectResponse
    {
        $requestDto = RateRequestDtoFactory::fromRequest($request);
        $this->authorize('canVote', $breakfsatvote->id);
        $service->store($requestDto, $breakfsatvote);
        return redirect()->route('dashboard');
    }

}



