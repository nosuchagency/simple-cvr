<?php

namespace App\Services;

use App\Company;

class CompanyService
{

    /**
     * @var PostcodeService
     */
    protected $postcodeService;

    /**
     * CompanyService constructor.
     *
     * @param PostcodeService $postcodeService
     */
    public function __construct(PostcodeService $postcodeService)
    {
        $this->postcodeService = $postcodeService;
    }

    /**
     * @param string $segment
     * @param string $branch
     * @param $company
     *
     * @return Company
     */
    public function create(?string $segment, string $branch, $company)
    {
        $fields = Company::$elasticFields;

        $name = $this->getProperty($company, $fields['name']);
        $cvr = $this->getProperty($company, $fields['cvr']);
        $attention = $this->getProperty($company, $fields['attention']);
        $address = $this->getProperty($company, $fields['address']);
        $number = $this->getProperty($company, $fields['number']);
        $postcode = $this->getProperty($company, $fields['postcode']);
        $city = $this->postcodeService->getCityFromPostcode($postcode);

        return Company::insertOnDuplicateKey([
            'name' => $name,
            'cvr' => $cvr,
            'attention' => $attention,
            'address' => "{$address}  {$number}",
            'postcode' => $postcode,
            'city' => $city,
            'segment' => $segment,
            'branch' => $branch,
            'expires_at' => now()->addMonth()->format('Y-m-d'),
            'terminates_at' => now()->addMonths(3)->format('Y-m-d')
        ]);
    }

    /**
     * @param $object
     * @param $property
     *
     * @return mixed
     */
    public function getProperty($object, $property)
    {
        return get_property($object, '_source.' . $property);
    }
}