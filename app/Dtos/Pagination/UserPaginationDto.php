<?php

namespace App\Dtos\Pagination;


use App\Dtos\User\UserDto;


class UserPaginationDto extends Pagination
{
    #[CastWith(ArrayCaster::class, itemType: UserDto::class)]
    public array $data;
}
