<?php
namespace App\Services ;


use App\Dtos\BreakfastDtoFactory;
use App\Dtos\UserDtoFactory;
use App\Models\User;

class  BreakfastCrudServise implements  breakfastService{

    function create(): array
    {
        $users = User::all();
        $users_dto = [];
        foreach ($users as $user) {
            $factory = new UserDtoFactory($user) ;
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
