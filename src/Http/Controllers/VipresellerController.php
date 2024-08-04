<?php

namespace Jstalinko\TokoshaniVipreseller\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jstalinko\TokoshaniVipreseller\TokoshaniVipreseller;

class VipresellerController extends Controller
{
    protected $vipreseller;

    public function __construct(TokoshaniVipreseller $vipreseller)
    {
        $this->vipreseller = $vipreseller;
    }

    public function getProfile()
    {
        $profile = $this->vipreseller->getProfile();
        return response()->json(json_decode($profile, true));
    }

    public function getGameFeatureServices(): JsonResponse
    {
        $profile = $this->vipreseller->getGameFeatureServices();
        return response()->json(json_decode($profile, true));
    }
    public function getPrepaidServices(): JsonResponse
    {

        $profile = $this->vipreseller->getPrepaidServices();
        return response()->json(json_decode($profile, true));
    }
}
