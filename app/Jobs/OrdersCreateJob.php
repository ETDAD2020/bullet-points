<?php namespace App\Jobs;

use Log;
use App\Models\User;
use App\Models\AppSettings;
use App\Models\InsuranceOrders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use stdClass;

class OrdersCreateJob implements ShouldQueue
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
        $user = User::where('name', $this->shopDomain->toNative())->first();
        $app_settings =  AppSettings::where('shopify_name', $user->name)->first();
        Log::info($user);
        Log::info($app_settings);

        $insurance_variant_id =  $app_settings->variant_id;
        $insurance_product_id =  $app_settings->product_id;

        $order = $this->data;
        $line_items  = $order->line_items;
        $order_entry = false;
        foreach($line_items as $line_item)
        {
            if($line_item->variant_id == $insurance_variant_id || $line_item->id == $insurance_product_id )
            {
                $order_entry = true;
            }
        }

        if($order_entry)
        {
            $insurance_order = new InsuranceOrders;
            $insurance_order->order_id = $order->id;
            $insurance_order->order_number = $order->number;
            $insurance_order->shopify_name = $user->name;
            $insurance_order->product_id = $insurance_product_id;
            $insurance_order->price = $order->subtotal_price;
            $insurance_order->status = '1';
            $insert_order = $insurance_order->save();
            if($insert_order){
                Log::info('Order Created');
                return true;
            }else{
                Log::info('Error');
                return true;
            }
        }
    }
}
