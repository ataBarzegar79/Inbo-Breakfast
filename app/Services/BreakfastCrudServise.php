<?php
namespace App\Services ;


use App\Dtos\BreakfastDtoFactory;
use App\Dtos\RateDtoFactory;
use App\Dtos\UserBreakfastDtoFactory;
use App\Http\Requests\storeBreakfastRequest;
use App\Models\Breakfast;
use App\Models\User;
use Morilog\Jalali\Jalalian;

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
        $persian_date = explode("/" , $request->date) ;
        $created_at =(new Jalalian((int)$persian_date[0], (int)$persian_date[1], (int)$persian_date[2], 0, 0, 0))->toCarbon() ;

        $breakfast = Breakfast::create(
            [
                'name' => $request->name ,
                'description'=>$request->description ,
                'created_at' => $created_at ,
            ]
        );
        $breakfast->users()->sync($request->users) ;

    }

    public function update(storeBreakfastRequest $request, int $breakfast_id): void
    {
        // TODO: Implement update() method.
    }

    public function destroy(int $breakfast_id): void
    {
        $deleted_breakfast = Breakfast::find( $breakfast_id);
        $deleted_breakfast->delete() ;
    }
}
