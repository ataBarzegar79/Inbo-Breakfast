<?php
namespace App\Services ;

use App\Dtos\BreakfastDto;
use App\Dtos\UserBreakfastDto;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\storeBreakfastRequest;

interface breakfastService{

    /**
     * @return BreakfastDto[]
     */
    public function index():array ;


    /**
     * @return UserBreakfastDTO[]
     */
    public function create():array ;

    /**
     * @param storeBreakfastRequest $request
     * @return void
     */
    public function store(storeBreakfastRequest $request):void ;


    /**
     * @param int $user_id
     * @return UserBreakfastDto[]
     * @return BreakfastDto
     **/
    public function edit(int $breakfast_id);


    /**
     * @param  int $breakfast_id
     * @param storeBreakfastRequest $request
     *
     */
    public function update(BreakfastUpdateRequest $request ,int $breakfast_id) ;


    /**
     * @param int $breakfast_id
     */
    public function destroy(int $breakfast_id):void ;

}

