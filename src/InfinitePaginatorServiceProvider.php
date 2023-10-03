<?php

namespace Pencilinc\InfinitePaginator;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Traits\EnumeratesValues;

class InfinitePaginatorServiceProvider extends ServiceProvider
{
    use EnumeratesValues;
    public function boot()
    {
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page', $sectionField = 'section') {
            $page = $page ?: InfinitePaginator::resolveCurrentPage($pageName);
            return new InfinitePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => InfinitePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                    'sectionField' => $sectionField,
                ]
            );
        });
    }
}
