<?php namespace App\Jobs;

use Log;
use App\Models\User;
use App\Models\Orders;
use App\Models\ReferralDiscountCode;
use App\Models\AppSettings;
use App\Models\InsuranceOrders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use stdClass;

class OrdersFulFilledJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param ShopDomain $shopDomain The shop's myshopify domain
     * @param stdClass   $data       The webhook data (JSON decoded)
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Do what you wish with the data
        // Access domain name as $this->shopDomain->toNative()
        $user = User::where('name', $this->shopDomain->toNative())->first();

        $order = $this->data;

        $order_id = $order->id;
        $order_number = $order->order_number;
        $order_email = $order->email;
        $total_discount = $order->total_discounts;
        $total_price = $order->total_price;
        $discount_codes = $order->discount_codes;

        foreach($discount_codes as $discount_code){
            $discount_code_check = $discount_code->code;
        }

        $order = new Orders;
        $order_detail = $order->where('order_id', $order_id)->first();

        if($order_detail == null){
            return response()->json(array(
                'success' => true
            ), 200);
        }

        $update_order = $order->find($order_detail->id);
        $update_order->order_status = 1;
        $save = $update_order->save();

        if($save){
            return response()->json(array(
                'success' => true
            ), 200);
        }else{
            return response()->json(array(
                'success' => true
            ), 500);
        }
    }
}
