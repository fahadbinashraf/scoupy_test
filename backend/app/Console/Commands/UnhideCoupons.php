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

    $response = Http::withHeaders($this->getHeaders())
      ->get('https://api2.scoupy.nl/v10/coupon/list', ['type' => 'cashback', 'hidden' => true]);
    if ($response->ok()) {
      $this->info("Response Ok");
      $list = $response['list'];
      if (sizeof($list) == 0) {
        $this->info("No hidden coupons");
        return;
      }
      $this->info(sizeof($list) . " hidden coupons.");

      $couponIds = array_map(function ($item) {
        return $item['id_coupon'];
      }, $list);

      $this->info("Requesting scoupy api to unhide coupons...");

      $response = Http::withHeaders($this->getHeaders())
        ->post('https://api2.scoupy.nl/v1/coupon/unhide', ['coupon_ids' => $couponIds]);

      if ($response->ok()) {
        $this->info("Success!");
      } else {
        $this->error($response['error']);
      }
    }
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