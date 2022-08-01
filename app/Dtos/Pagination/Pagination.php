<?php

namespace App\Dtos\Pagination ;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\DataTransferObject\DataTransferObject;


class Pagination extends DataTransferObject
{

    public PaginationLinks $links;
    public array $data;
    public PaginationMeta $meta;

    public static function fromModelPaginatorAndData(LengthAwarePaginator $paginator, array $data): Pagination
    {

        return new self([
            'links' => PaginationLinks::fromPaginator($paginator),
            'data' => $data,
            'meta' => PaginationMeta::fromPaginator($paginator),
        ]);
    }
}