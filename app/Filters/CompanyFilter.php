<?php

namespace App\Filters;

class CompanyFilter extends AbstractFilter
{
    protected $filters = [
        'branch' => BranchFilter::class,
        'search' => SearchFilter::class,
        'segment' => SegmentFilter::class,
    ];
}