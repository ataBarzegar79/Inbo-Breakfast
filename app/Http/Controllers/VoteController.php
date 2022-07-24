<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeVoteRequest;
use App\Models\Breakfast;
use App\Models\Rate;
use App\Services\RateService;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

class VoteController extends Controller
{

    public function create($breakfast_id , RateService $service)
    {
        $this->authorize('canVote', $breakfast_id) ;
        return view('vote', ['breakfast' => $service->create($breakfast_id)]);
    }

    public function store($breakfast_id,storeVoteRequest $request , RateService $service)
    {
        $this->authorize('canVote', $breakfast_id) ;
        $service->store($request , $breakfast_id);
        return redirect()->route('dashboard');
    }
}



