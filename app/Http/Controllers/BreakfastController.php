<?php

namespace App\Http\Controllers;

use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\StoreBreakfastRequest;
use App\Services\BreakfastService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use function redirect;
use function view;

class BreakfastController extends Controller
{
    public function index(BreakfastService $service): Factory|View|Application
    {
        return view('dashboard', ['breakfasts' => $service->index()]);
    }

    public function create(BreakfastService $service): Factory|View|Application
    {
        return view('breakfast-create', ['users' => $service->create()]);
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

    public function edit($breakfastId, BreakfastService $service): Factory|View|Application|RedirectResponse
    {
        $editedBreakfast = $service->edit($breakfastId);
        if($editedBreakfast === false) {
            return  redirect()->route('dashboard');
        }
        return view('breakfast-update', ['breakfast' => $editedBreakfast["breakfast"], 'users' => $editedBreakfast['users']]);
    }

    public function update(BreakfastUpdateRequest $request, $breakfastId, BreakfastService $service): RedirectResponse
    {
        $service->update($request, $breakfastId);
        return redirect()->route('dashboard');
    }

}
