<?php

namespace Jstalinko\TokoshaniVipreseller\Http\Controllers;

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
}
