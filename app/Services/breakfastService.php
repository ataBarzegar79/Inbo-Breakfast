<?php
namespace App\Services ;

use App\Dtos\BreakfastDto;
use App\Dtos\UserBreakfastDto;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\storeBreakfastRequest;

//fixme start class names with uppercase letter
//todo use consistent naming conventions through the application
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
    //fixme do not pass Request objects to service layer; ****
    public function store(storeBreakfastRequest $request):void ;


    /**
     * @param int $user_id
     * @return UserBreakfastDto[]
     * @return BreakfastDto
     **/
    //fixme update documents according to functions
    //fixme use camelcase for function parameters
    public function edit(int $breakfast_id);


    /**
     * @param  int $breakfast_id
     * @param storeBreakfastRequest $request
     *
     */
    //fixme update documents according to functions
    //fixme use camelcase for function parameters
    public function update(BreakfastUpdateRequest $request ,int $breakfast_id) ;


    /**
     * @param int $breakfast_id
     */
    //fixme use camelcase for function parameters
    public function destroy(int $breakfast_id):void ;

}

