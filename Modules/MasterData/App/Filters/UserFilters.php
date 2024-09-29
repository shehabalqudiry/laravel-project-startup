<?php

namespace Modules\MasterData\App\Filters;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Builder;

class UserFilters
{
    public static function apply($model)
    {
        return QueryBuilder::for($model)
            ->allowedFilters([
                'name',
                AllowedFilter::callback('recent_added', function (Builder $query) {
                    $query->latest('created_at');
                }),
            ]);
    }
}
