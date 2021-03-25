<?php namespace App\Jobs;

use App\Customizer;
use App\ErrorLog;
use App\Product;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use stdClass;
use DB;
use Log;

class AppUninstalledJob implements ShouldQueue
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
		Log::info('dddddd');
Log::info($this->shopDomain->toNative());
            $shop = User::where('name', $this->shopDomain->toNative())->first();
            Product::where('store_id', $shop->id)->delete();
            Customizer::where('store_id', $shop->id)->delete();
$user = DB::table('users')->where('name',$this->shopDomain->toNative())->delete();
        }
        catch (\Exception $e) {
            $log = new ErrorLog();
            $log->message = $e->getMessage();
            $log->save();
        }

    }
}
