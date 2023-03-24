<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UnhideCoupons extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:unhide-coupons';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'This will fetch hidden coupons and then make a request to unhide them.';

  /**
   * Execute the console command.
   */
  public function handle(): void
  {
    //
    $this->info("Requesting scoupy api for hidden coupons...");

    $response = $this->getHiddenCoupons();

    if (!$response->ok()) {
      $this->error("Request failed!");
      $this->error($response["error"]);
      return;
    } else {
      $this->info("Response Ok");
    }

    $list = $response['list'];

    if (sizeof($list) == 0) {
      $this->info("No hidden coupons");
      return;
    }

    $this->info(sizeof($list) . " hidden coupons.");
    $this->info("Requesting scoupy api to unhide coupons...");

    $response = $this->unhideCoupons($this->getCouponIdsFromList($list));

    if ($response->ok()) {
      $this->info("Success!");
    } else {
      $this->error($response['error']);
    }
  }

  public function getHiddenCoupons()
  {
    return Http::withHeaders($this->getHeaders())
      ->get('https://api2.scoupy.nl/v10/coupon/list', ['type' => 'cashback', 'hidden' => true]);
  }

  public function unhideCoupons($couponIds)
  {
    return Http::withHeaders($this->getHeaders())
      ->post('https://api2.scoupy.nl/v1/coupon/unhide', ['coupon_ids' => $couponIds]);
  }

  public function getCouponIdsFromList($list)
  {
    return array_map(function ($item) {
      return $item['id_coupon'];
    }, $list);
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