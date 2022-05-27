<?php 
namespace App\Http\Responses;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationResponse{

    public static function getPagination(LengthAwarePaginator $pagination): array{
        return [
            'current_page' => $pagination->currentPage(),
            'last_page' => $pagination->lastPage(),
            'per_page' => $pagination->perPage(),
            'total' => $pagination->total(),
        ];
    }
}