<?php namespace App\Jobs;

use App\ErrorLog;
use App\Product;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use stdClass;

class ProductsUpdateJob implements ShouldQueue
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
     * @param string   $shopDomain The shop's myshopify domain
     * @param stdClass $data    The webhook data (JSON decoded)
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
        try{
            $shop = User::where('name', $this->shopDomain)->first();
            if (Product::where('id', $this->data->id)->exists()) {
                $p = Product::find($this->data->id);
            } else {
                $p = new Product();
            }

            $p->id = $this->data->id;
            $p->title = $this->data->title;
            $p->image = json_encode($this->data->image);
            $p->store_id = $shop->id;
            $p->save();
        }
        catch(\Exception $e) {
            $log = new ErrorLog();
            $log->message = $e->getMessage();
            $log->save();
        }
    }
}
