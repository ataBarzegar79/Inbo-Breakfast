<?php

namespace App\Dtos\Pagination;


use App\Dtos\User\UserDto;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;


class UserPaginationDto extends Pagination
{
    #[CastWith(ArrayCaster::class, itemType: UserDto::class)]
    public array $data;
}
