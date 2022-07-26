<?php
namespace App\Services ;


use App\Dtos\BreakfastDtoFactory;
use App\Dtos\RateDtoFactory;
use App\Dtos\UserBreakfastDtoFactory;
use App\Http\Requests\BreakfastUpdateRequest;
use App\Http\Requests\StoreBreakfastRequest;
use App\Models\Breakfast;
use App\Models\User;
use Illuminate\View\View;
use Morilog\Jalali\Jalalian;//fixme cleanup unused imports

//fixme fix misspells
class  BreakfastCrudServise implements  breakfastService{
    public function index():array
    {
     $user = auth()->user() ;
     $breakfasts = Breakfast::all() ;
     $breakfast_dtos = [];//fixme use camelcase for variable names
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
        $users_dto = [];//fixme use camelcase for variable names
        foreach ($users as $user) {
            $factory = new UserBreakfastDtoFactory($user) ;
            $user_dto = $factory->fromModel($user);
            $users_dto_average[] = [$user_dto->average , $user_dto];
        }
        sort($users_dto_average) ;

        foreach ($users_dto_average as $item){
            $users_dto[] = $item[1] ;
        }

        return $users_dto;
    }

    //fixme define return type for functions
    public function edit(int $breakfast_id)
    {
        if(!$breakfast = Breakfast::find($breakfast_id) ){
            return redirect()->route('dashboard') ;
        }

        $breakfast = Breakfast::find($breakfast_id);
        $new_breakfast_factory = new BreakfastDtoFactory() ;//fixme use camelcase for variable names
        $breakfast_dto = $new_breakfast_factory->fromModel($breakfast , null) ;

        $users = User::all();
        $dto_users = [] ;
        $new_user_factory = new UserBreakfastDtoFactory() ;
        foreach ($users as $user){
            $new_user_dto = $new_user_factory->fromModel($user) ;
            $dto_users[] = $new_user_dto ;

        }

        return ['users'=>$dto_users ,"breakfast" => $breakfast_dto] ;



    }

    public function store(StoreBreakfastRequest $request): void
    {
        $persian_date = explode("/" , $request->date) ;//todo use Jalaian format service to format Jalali strings
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

    //fixme define return type for functions
    //fixme use camelcase for function parameters
    public function update(BreakfastUpdateRequest $request, int $breakfast_id)
    {

        if(!$breakfast = Breakfast::find($breakfast_id) ) {//fixme use camelcase for variable names
            return redirect()->route('dashboard');//fixme redirect !!!!
        }

        $breakfast ->name = $request->name ;
        $breakfast->description = $request->description ;
        $breakfast->save() ;

        $breakfast->users()->sync($request->users) ;

    }

    //fixme use camelcase for function parameters
    public function destroy(int $breakfast_id): void
    {
        $deleted_breakfast = Breakfast::find( $breakfast_id);//fixme use camelcase for variable names
        $deleted_breakfast->delete() ;
    }
}
