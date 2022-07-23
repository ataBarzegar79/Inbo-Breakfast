<?php
namespace App\Services ;


use App\Dtos\BreakfastDtoFactory;
use App\Dtos\RateDtoFactory;
use App\Dtos\UserBreakfastDtoFactory;
use App\Models\Breakfast;
use App\Models\User;

class  BreakfastCrudServise implements  breakfastService{
    public function index():array
    {
     $user = auth()->user() ;
     $breakfasts = Breakfast::all() ;
     $breakfast_dtos = [];
     foreach ($breakfasts as $breakfast ){
         $rates = $breakfast->rates ;
         $flag = 0 ;
         foreach ($rates as $rate){
             if ($rate->user->id == $user->id ){
                $user_rate = $rate ;
                 $flag = 1 ;
             }
         }
         if ($flag == 0){
             $user_rate = null ;
         }
         $breakfast_factory = new BreakfastDtoFactory() ;
         $breakfast_dtos[] =  $breakfast_factory->fromModel($breakfast  , $user_rate);
     }

     return  $breakfast_dtos ;
    }

    public function create(): array
    {
        $users = User::all();
        $users_dto = [];
        foreach ($users as $user) {
            $factory = new UserBreakfastDtoFactory($user) ;
            $users_dto[] = $factory->fromModel($user);
        }
        return $users_dto;
    }

    public function edit(int $breakfast_id): array
    {
        // TODO: Implement edit() method.
    }

    public function store(storeBreakfastRequest $request): void
    {
        // TODO: Implement store() method.
    }

    public function update(storeBreakfastRequest $request, int $breakfast_id): void
    {
        // TODO: Implement update() method.
    }

    public function destroy(int $breakfast_id): void
    {
        // TODO: Implement destroy() method.
    }
}
