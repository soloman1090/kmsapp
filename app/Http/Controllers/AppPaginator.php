<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class  AppPaginator{
    public function paginate($items, $path, $perPage = 50, $page = null )
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => url($path)]);
    }
}
