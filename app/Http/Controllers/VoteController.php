<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeVoteRequest;
use App\Models\Breakfast;
use App\Models\Rate;
use App\Services\RateService;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;//fixme cleanup unused imports

class VoteController extends Controller
{

    //fixme use camelcase for function parameters
    //fixme define return type for functions
    public function create($breakfast_id , RateService $service)
    {
        $this->authorize('canVote', $breakfast_id) ;
        //fixme add none runtime exceptions to function document with @throw annotation
        return view('vote', ['breakfast' => $service->create($breakfast_id)]);
    }

    //fixme use camelcase for function parameters
    //fixme define return type for functions
    public function store($breakfast_id,storeVoteRequest $request , RateService $service)
    {
        $this->authorize('canVote', $breakfast_id) ;
        //fixme add none runtime exceptions to function document with @throw annotation
        $service->store($request , $breakfast_id);
        return redirect()->route('dashboard');//fixme use route method for paths
    }
}



