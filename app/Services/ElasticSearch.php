<?php

namespace App\Services;

use App\Configuration;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class ElasticSearch extends Client
{
    /**
     * @var string
     */
    protected $initialUrl;

    /**
     * @var string
     */
    protected $subsequentUrl;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var array
     */
    protected $fields;

    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var array
     */
    protected $addresses = [];

    /**
     * ElasticSearch constructor.
     *
     * @param string $initialUrl
     * @param string $subsequentUrl
     * @param int $size
     * @param array $fields
     * @param array $config
     */
    public function __construct(string $initialUrl, string $subsequentUrl, int $size, array $fields = [], array $config = [])
    {
        parent::__construct($config);

        $this->initialUrl = $initialUrl;
        $this->subsequentUrl = $subsequentUrl;
        $this->size = $size;
        $this->fields = $fields;
    }

    /**
     * @param Configuration $configuration
     */
    public function applyConfiguration(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param string $branch
     *
     * @return array
     */
    public function getCompanies(string $branch)
    {
        $result = $this->sendInitialRequest($branch);

        $companies = [];

        $hits = $this->getHits($result);

        while (true) {
            foreach ($hits as $hit) {
                if ($this->shouldReject($hit)) {
                    continue;
                }

                $companies[] = $hit;
                $this->addresses[] = $this->getProperty($hit, $this->fields['name']);
            }

            $result = $this->sendSubsequentRequest($result->_scroll_id);

            $hits = $this->getHits($result);

            if (count($hits) === 0) {
                break;
            }
        }

        return $companies;
    }


    /**
     * @param $company
     *
     * @return bool
     */
    protected function shouldReject($company)
    {
        if (!$this->configuration) {
            return false;
        }

        $name = strtolower($this->getProperty($company, $this->fields['name']));
        $address = strtolower($this->getProperty($company, $this->fields['address']));

        if ($this->configuration->rejectDuplicates() && in_array($address, $this->addresses)) {
            return true;
        }

        if (Str::contains($name, $this->configuration->getWhitelistAsArray())) {
            return false;
        }

        if (Str::contains($name, $this->configuration->getBlacklistAsArray())) {
            return true;
        }

        return false;
    }

    /**
     * @param string $branch
     *
     * @return mixed
     */
    protected function sendInitialRequest(string $branch)
    {
        return json_decode($this->get($this->initialUrl, [
            'json' => $this->initialRequestPayload($branch)
        ])->getBody());
    }

    /**
     * @param string $scrollId
     *
     * @return mixed
     */
    protected function sendSubsequentRequest(string $scrollId)
    {
        return json_decode($this->get($this->subsequentUrl, [
            'json' => $this->subsequentRequestPayload($scrollId)
        ])->getBody());
    }

    /**
     * @param string $branch
     *
     * @return array
     */
    protected function initialRequestPayload(string $branch)
    {
        return [
            'size' => $this->size,
            '_source' => array_values($this->fields),
            'query' => [
                'term' => [
                    $this->fields['branch'] => $branch
                ]
            ]
        ];
    }

    /**
     * @param string $scrollId
     *
     * @return array
     */
    protected function subsequentRequestPayload(string $scrollId)
    {
        return [
            'scroll' => '1m',
            'scroll_id' => $scrollId
        ];
    }

    /**
     * @param $result
     *
     * @return mixed
     */
    protected function getHits($result)
    {
        return get_property($result, 'hits.hits', []);
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