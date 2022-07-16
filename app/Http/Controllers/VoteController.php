<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeVoteRequest;
use App\Models\Breakfast;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{

    public function create($breakfast_id)
    {
        $this->authorize('canVote', $breakfast_id) ;
        $user = Auth::user();
        $breakfast = Breakfast::where('id', $breakfast_id)->first();
        return view('vote', ['breakfast' => $breakfast]);
    }

    public function store(storeVoteRequest $request, $breakfast_id)
    {
        $this->authorize('canVote', $breakfast_id) ;

        $user = Auth::user();
        $rate = Rate::create([
            'rate' => $request->rate,
            'description' => $request->description,
            'user_id' => $user->id,
            'breakfast_id' => $breakfast_id
        ]);

        return redirect()->route('dashboard');


    }
}



