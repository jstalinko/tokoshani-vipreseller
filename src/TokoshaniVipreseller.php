<?php

namespace Jstalinko\TokoshaniVipreseller;
use GuzzleHttp\Client;
class TokoshaniVipreseller
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://vip-reseller.co.id/api/']);
    }
    public function getProfile()
    {
        
    }
}
