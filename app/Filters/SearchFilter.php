<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter
{
    /**
     * @param Builder $builder
     * @param $value
     *
     * @return mixed
     */
    public function filter(Builder $builder, $value)
    {
        return $builder
            ->where(function (Builder $builder) use ($value) {
                $builder
                    ->where('name', 'like', '%' . $value . '%')
                    ->orWhere('cvr', 'like', '%' . $value . '%')
                    ->orWhere('address', 'like', '%' . $value . '%')
                    ->orWhere('postcode', 'like', '%' . $value . '%')
                    ->orWhere('city', 'like', '%' . $value . '%');
            });
    }
}