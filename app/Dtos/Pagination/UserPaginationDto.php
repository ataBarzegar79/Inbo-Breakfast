<?php

namespace App\Dtos\Pagination;


use App\Dtos\UserDto;


class UserPaginationDto extends Pagination
{
    #[CastWith(ArrayCaster::class, itemType: UserDto::class)]
    public array $data;
}
