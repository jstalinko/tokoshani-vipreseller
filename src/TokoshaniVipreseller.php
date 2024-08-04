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

    public function generateSign()
    {
        $apiId = config('tokoshani-vipreseller.api_id');
        $apiKey = config('tokoshani-vipreseller.api_key');
        return md5($apiId . $apiKey);
    }

    public function getProfile()
    {

        
        $response = $this->client->request('POST', 'profile', [
            'form_params' => [
                'key' => config('tokoshani-vipreseller.api_key'),
                'sign' => $this->generateSign()
            ]
        ]);


        return $response->getBody()->getContents();
    }

    public function getPrepaid()
    {
        // $response = $this->client->request('POST','prepaid',
        // [
        //     'forms_params' => [
        //         'key' => config('tokoshani-vipreseller.api_key'),
        //         'sign' => $this->generateSign(),

        //     ]
        // ])
    }
}
