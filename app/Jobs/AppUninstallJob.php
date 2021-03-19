<?php namespace App\Jobs;

use Log;
use DB;
use App\Models\User;
use App\Models\AppSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use stdClass;

class AppUninstallJob implements ShouldQueue
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

        $user = DB::table('users')->where('name', $this->shopDomain->toNative())->delete();
        $app_settings = AppSettings::where('shopify_name', $this->shopDomain->toNative())->first();
        AppSettings::destroy($app_settings->id);
        Log::info($user);
        Log::info($app_settings);
        if($user)
        {
            return true;
        }
        // Do what you wish with the data
        // Access domain name as $this->shopDomain->toNative()
    }
}