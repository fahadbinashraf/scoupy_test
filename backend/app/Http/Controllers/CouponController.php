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
    return [
      'x-scoupy-key' => env("SCOUPY_KEY"),
      'x-scoupy-user' => env("SCOUPY_USER"),
      'x-scoupy-version' => env("SCOUPY_VERSION")
    ];
  }
}