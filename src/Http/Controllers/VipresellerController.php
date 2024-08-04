<?php

namespace Jstalinko\TokoshaniVipreseller\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jstalinko\TokoshaniVipreseller\TokoshaniVipreseller;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

class VipresellerController extends Controller
{
    protected $vipreseller;

    public function __construct(TokoshaniVipreseller $vipreseller)
    {
        $this->vipreseller = $vipreseller;
    }

    public function buildResponse(bool $success, int $code, array|stdClass $data): JsonResponse
    {
        $response['success'] = $success;
        $response['code'] = $code;
        $response['shnData'] = $data;
        $response['x-api'] = "jstalinko/tokoshani-vipreseller";

        return response()->json($response, $code, [], JSON_PRETTY_PRINT);
    }

    public function getProfile()
    {
        try {
            $profile = $this->vipreseller->getProfile();
            return $this->buildResponse(true, 200, json_decode($profile,true));
        } catch (Exception $e) {
            return $this->buildResponse(false, 500, ['errors' => $e]);
        }
    }

    public function getGameFeatureServices(Request $request): JsonResponse
    {
        try {
            $filterType = $request->filter_type ?? null;
            $filterValue = $request->filter_value ?? null;
            $filterStatus = $request->filter_status ?? null;

            $games = $this->vipreseller->getGameFeatureServices($filterType, $filterValue, $filterStatus);
            return $this->buildResponse(true, 200, json_decode($games,true));
        } catch (Exception $e) {
            return $this->buildResponse(false, 500, ['errors' => $e]);
        }
    }
    public function getPrepaidServices(Request $request): JsonResponse
    {

        try {
            $filterType = $request->filter_type ?? null;
            $filterValue = $request->filter_value ?? null;
            $prepaid = $this->vipreseller->getPrepaidServices($filterType, $filterValue);
            return $this->buildResponse(true, 200, json_decode($prepaid,true));
        } catch (Exception $e) {
            return $this->buildResponse(false, 500, ['errors' => $e]);
        }
    }
}
