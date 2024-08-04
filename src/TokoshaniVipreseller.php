<?php

namespace Jstalinko\TokoshaniVipreseller;

use GuzzleHttp\Client;

class TokoshaniVipreseller
{
    public $client;
    public const NICKNAMECHECK  = [
        'mobile-legends',
        'hago',
        'zepeto',
        'lords-mobile',
        'marvel-super-war',
        'ragnarok-m-eternal-love-big-cat-coin',
        'speed-drifters',
        'laplace-m',
        'higgs-domino',
        'point-blank',
        'dragon-raja',
        'league-of-legends-wild-rift',
        'free-fire',
        'free-fire-max',
        'tom-and-jerry-chase',
        '8-ball-pool',
        'auto-chess',
        'bullet-angel',
        'arena-of-valor',
        'call-of-duty-mobile',
        'genshin-impact',
        'domino-gaple-qiuqiu-boyaa'
    ];

    /**
     * Constructor to initialize Guzzle HTTP client with base URI.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://vip-reseller.co.id/api/']);
    }

    /**
     * Generate an API signature using the API ID and API key from the config.
     * 
     * @return string The generated MD5 signature.
     */
    public function generateSign(): string
    {
        $apiId = config('tokoshani-vipreseller.api_id');
        $apiKey = config('tokoshani-vipreseller.api_key');
        return md5($apiId . $apiKey);
    }

    /**
     * Retrieve the profile information from the API.
     * 
     * @return string The profile data as a JSON string.
     */
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

    /**
     * Retrieve game feature services with optional filters.
     * 
     * @param string|null $filter_type  The type of filter (optional).
     * @param string|null $filter_value The value of the filter (optional).
     * @param string|null $filter_status The status of the filter (optional).
     * @return string The game feature services data as a JSON string.
     */
    public function getGameFeatureServices(?string $filter_type = null, ?string $filter_value = null, ?string $filter_status = null): string
    {
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

        if ($filter_status !== null) {
            $formParams['filter_status'] = $filter_status;
        }

        $response = $this->client->request('POST', 'game-feature', [
            'form_params' => $formParams,
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Place an order for a game feature.
     * 
     * @param string $serviceCode The service code.
     * @param string|int $data1 The first data parameter.
     * @param string|int $data2 The second data parameter (optional).
     * @return string The order response as a JSON string.
     */
    public function getGameFeatureOrder(string $serviceCode, string|int $data1, string|int $data2): string
    {
        $formParams = [
            'key' => config('tokoshani-vipreseller.api_key'),
            'sign' => $this->generateSign(),
            'type' => 'order',
            'service' => $serviceCode,
            'data_no' => $data1,
        ];

        if ($data2 !== null) {
            $formParams['data_zone'] = $data2;
        }

        $response = $this->client->request('POST', 'game-feature', [
            'form_params' => $formParams,
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Retrieve prepaid services with optional filters.
     * 
     * @param string|null $filter_type  The type of filter (optional).
     * @param string|null $filter_value The value of the filter (optional).
     * @return string The prepaid services data as a JSON string.
     */
    public function getPrepaidServices(?string $filter_type = null, ?string $filter_value = null): string
    {
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

        $response = $this->client->request('POST', 'prepaid', [
            'form_params' => $formParams,
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Place an order for a prepaid service.
     * 
     * @param string|int $serviceCode The service code.
     * @param string|int $data The data parameter.
     * @return string The order response as a JSON string.
     */
    public function getPrepaidOrder(string|int $serviceCode, string|int $data): string
    {
        $formParams = [
            'key' => config('tokoshani-vipreseller.api_key'),
            'sign' => $this->generateSign(),
            'type' => 'order',
            'service' => $serviceCode,
            'data_no' => $data,
        ];

        $response = $this->client->request('POST', 'prepaid', [
            'form_params' => $formParams,
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Retrieve the nickname for a game using the type and target parameters.
     * 
     * @param string $type The game type.
     * @param string|int $target The target parameter.
     * @param string|int|null $additional_target The additional target parameter (optional).
     * @return string The nickname data as a JSON string.
     */
    public function getNickname(string $type, string|int $target, string|int|null $additional_target): string
    {
        if (!in_array($type, self::NICKNAMECHECK)) return false;

        $formParams = [
            'key' => config('tokoshani-vipreseller.api_key'),
            'sign' => $this->generateSign(),
            'type' => 'get-nickname',
            'code' => $type,
            'target' => $target
        ];

        if ($additional_target !== null) {
            $formParams['additional_target'] = $additional_target;
        }

        $response = $this->client->request('POST', 'game-feature', [
            'form_params' => $formParams,
        ]);

        return $response->getBody()->getContents();
    }
}
