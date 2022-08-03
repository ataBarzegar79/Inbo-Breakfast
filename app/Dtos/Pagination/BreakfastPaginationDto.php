<?php

namespace App\Dtos\Pagination;

use App\Dtos\Breakfast\BreakfastDto;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;

class BreakfastPaginationDto extends Pagination
{
    #[CastWith(ArrayCaster::class, itemType: BreakfastDto::class)]
    public array $data;
}
