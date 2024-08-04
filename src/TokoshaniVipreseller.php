<?php

namespace Jstalinko\TokoshaniVipreseller;

use GuzzleHttp\Client;

class TokoshaniVipreseller
{
    public $client;
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://vip-reseller.co.id/api/']);
    }

    public function generateSign(): string
    {
        $apiId = config('tokoshani-vipreseller.api_id');
        $apiKey = config('tokoshani-vipreseller.api_key');
        return md5($apiId . $apiKey);
    }

    public function getProfile(): string
    {


        $response = $this->client->request('POST', 'profile', [
            'form_params' => [
                'key' => config('tokoshani-vipreseller.api_key'),
                'sign' => $this->generateSign()
            ]
        ]);


        return $response->getBody()->getContents();
    }


    public function getGameFeatureServices(?string $filter_type = null, ?string $filter_value = null, ?string $filter_status = null): string
    {
        // Base form parameters
        $formParams = [
            'key' => config('tokoshani-vipreseller.api_key'),
            'sign' => $this->generateSign(),
            'type' => 'service',
        ];

        // Add optional filter parameters if they are provided
        if ($filter_type !== null) {
            $formParams['filter_type'] = $filter_type;
        }

        if ($filter_value !== null) {
            $formParams['filter_value'] = $filter_value;
        }

        if ($filter_status !== null) {
            $formParams['filter_status'] = $filter_status;
        }

        // Make the HTTP request
        $response = $this->client->request('POST', 'game-feature', [
            'form_params' => $formParams,
        ]);

        return $response->getBody()->getContents();
    }

    /** 
    * @method getPrepaidServices
    * @var $filter_type  type | brand
    * @var $filter_value 
    */
    public function getPrepaidServices(?string $filter_type = null , ?string $filter_value = null): string
    {
         // Base form parameters
         $formParams = [
            'key' => config('tokoshani-vipreseller.api_key'),
            'sign' => $this->generateSign(),
            'type' => 'service',
        ];
        if ($filter_type !== null) {
            $formParams['filter_type'] = $filter_type;
        }

        if ($filter_value !== null) {
            $formParams['filter_value'] = $filter_value;
        }
        // Make the HTTP request
        $response = $this->client->request('POST', 'prepaid', [
            'form_params' => $formParams,
        ]);

        return $response->getBody()->getContents();
    }

}
