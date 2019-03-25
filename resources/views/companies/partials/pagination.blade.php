<div class="d-flex">
    <div style="flex-basis: 25%; font-size: 13px">
        Side {{$companies->currentPage()}} ud af {{$companies->lastPage()}}
    </div>
    <div class="d-flex justify-content-end" style="flex-basis: 75%;">
        {{$companies->appends([
            'branch' => $branch,
            'segment' => $segment,
            'search' => $search
        ])->links()}}
    </div>
</div>