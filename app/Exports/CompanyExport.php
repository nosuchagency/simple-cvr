<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyExport implements FromCollection, WithHeadings
{
    /**
     * @var
     */
    protected $companies;

    /**
     * CompanyExport constructor.
     *
     * @param $companies
     */
    public function __construct($companies)
    {
        $this->companies = $companies;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->companies;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Cvr',
            'Attention',
            'Addresse',
            'Postnummer',
            'By',
            'Segment',
            'Branch',
            'Udløber',
            'Slettes'
        ];
    }
}
