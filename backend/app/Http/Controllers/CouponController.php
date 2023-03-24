<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CouponController extends Controller
{
    //
    public function list(): JsonResponse
    {
        $response = Http::withHeaders($this->getHeaders())
            ->get('https://api2.scoupy.nl/v10/coupon/list', ['type' => 'cashback']);

        $list = [];
        // the response list contains other types of coupons as well so filtering for cashback coupons
        if ($response->ok()) {
            $list = array_values(array_filter($response['list'], function ($item) {
                return $item['coupon_type'] === "cashback";
            }));

        }

        return response()->json([
            'status' => $response->ok(),
            'list' => $list
        ])->setStatusCode($response->status());
    }

    public function hide(Request $request): JsonResponse
    {
        $request->validate([
            'id' => ['required']
        ]);

        $response = Http::withHeaders($this->getHeaders())
            ->post('https://api2.scoupy.nl/v1/coupon/hide', ['coupon_ids' => [$request->id]]);

        return response()->json([
            'status' => $response->ok(),
            'data' => $response->json()
        ])->setStatusCode($response->status());
    }

    public function getHeaders()
    {
        //TODO: refactor keys to .env file
        return [
            'x-scoupy-key' => '9l1axyfab609l67p5f2j8nlu83ls3m2zv9xt004r39',
            'x-scoupy-user' => '63ea4953ky3w3s53cai4a2ojkuh98v7wpvabt5dkq3',
            'x-scoupy-version' => '50000'
        ];
    }
}