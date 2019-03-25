<?php

namespace App\Filters;

class BranchFilter
{
    public function filter($builder, $value)
    {
        return $builder->whereBranch($value);
    }
}