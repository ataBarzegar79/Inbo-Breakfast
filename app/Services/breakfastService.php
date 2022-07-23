<?php
namespace App\Services ;

use App\Dtos\BreakfastDto;
use App\Dtos\UserBreakfastDto;

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
     * @return BreakfastDto[]
     */
    public function edit(int $breakfast_id):array;


    /**
     * @param  int $breakfast_id
     * @param storeBreakfastRequest $request
     * @return
     */
    public function update(storeBreakfastRequest $request ,int $breakfast_id):void ;



    /**
     * @param int $breakfast_id
     */
    public function destroy(int $breakfast_id):void ;

}

