<?php

namespace App\Dtos\Pagination;

use App\Dtos\Breakfast\BreakfastDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BreakfastPaginationDto extends Pagination
{
    #[CastWith(ArrayCaster::class, itemType: BreakfastDto::class)]
    public array $data;
}
