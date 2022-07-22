<?php
namespace App\Services ;

interface breakfastService{
/**
 * @return UserDTO[]
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

