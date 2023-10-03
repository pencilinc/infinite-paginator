<?php

namespace Pencilinc\InfinitePaginator;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

class InfinitePaginatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: InfinitePaginator::resolveCurrentPage($pageName);

            return new InfinitePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => InfinitePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
