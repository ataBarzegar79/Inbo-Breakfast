<?php
namespace App\Dtos\Pagination ;


use Illuminate\Contracts\Pagination\LengthAwarePaginator ;


class BreakfastPaginationDto extends Pagination
{
    #[CastWith(ArrayCaster::class, itemType: CategoryResponseDto::class)]
    public array $data;

    public static function fromModelPaginator(
        LengthAwarePaginator $paginator
    ): Pagination
    {
        return static::fromModelPaginatorAndData(
            $paginator,
            array_map(
                [CategoryResponseDto::class, 'fromCategoryModel'],
                $paginator->items()
            )
        );
    }
}
