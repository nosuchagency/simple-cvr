<?php

namespace App\Filters;

class SegmentFilter
{
    public function filter($builder, $value)
    {
        return $builder->whereSegment($value);
    }
}