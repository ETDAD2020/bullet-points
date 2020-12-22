<?php

namespace App\Http\Controllers;

use App\Models\InsuranceOrders;
use App\Models\AppSettings;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PDO;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $settings = AppSettings::where('shopify_name', $user->name)->get();

        if(count($settings) == 0)
        {
            $appSettings = new AppSettings;
            $appSettings->shopify_name = $user->name;
            $appSettings->notification_type = "button_type";

            /* Generating Products on the Shopify Store */
            $shop = User::where('name', $user->name)->first();
            $response = $shop->api()->rest('POST', '/admin/products.json', [
                'product' => [
                    'title' => 'StoreKs Shipping Insurance',
                    'body_html' => '<h1>Buy this insurance for the safety of your parcels</h1>',
                    'vendor' => 'StoreKs',
                    'product_type' => 'Insurance',
                    "variants" => [
                        "option1"=> "Insurance Product",
                        "price"=> "10.00",
                        "sku"=> "StoreKs-1234"
                        ]
                        ]
                        ]);
                        $variant_id = $response['body']['product']['variants'][0]['id'];
                        $product_id = $response['body']['product']['variants'][0]['product_id'];
                        /* End Product Generation */

                        $appSettings->variant_id =  $variant_id;
                        $appSettings->product_id =  $product_id;

                        $appSettings->save();
                        $settings = AppSettings::where('shopify_name', $user->name)->get();
                    }

                    if($user->user_role == "child")
                    {
                        $orders = InsuranceOrders::where('shopify_name', $user->name)->get();
                        return Inertia::render('Home', [
                            'orders_list' => $orders->map(function($order){
                                return [
                                    'id' => $order->id,
                                    'order_id' => $order->order_id,
                                    'product_id' => $order->product_id,
                                    'price' => $order->price,
                                    'order_details' => $order->order_details,
                                    'status' => $order->status,
                                ];
                            }),
                            'app_settings' => $settings->map(function($setting){
                                return [
                                    'cart_page' => $setting->cart_page,
                                    'product_page' => $setting->product_page,
                                    'notification_type' => $setting->notification_type,
                                    'variant_id' => $setting->variant_id,
                                    'product_id' => $setting->product_id,
                                ];
                            })
                            ]);
                        }else{

                            return Inertia::render('Home_Parent', [
                                'orders_list' => InsuranceOrders::paginate()
                                    ->transform(function ($order) {
                                        return [
                                            'id' => $order->id,
                                            'shopify_name' => $order->shopify_name,
                                            'order_id' => $order->order_id,
                                            'order_name' => $order->order_name,
                                            'product_id' => $order->product_id,
                                            'price' => $order->price,
                                            'order_details' => $order->order_details,
                                            'status' => $order->status,
                                        ];
                                    }),
                            ]);
                            // $orders = InsuranceOrders::paginate(3);
                            // return Inertia::render('Home_Parent', [
                            //     'orders_list' => $orders->map(function($order){
                            //         return [
                            //             'id' => $order->id,
                            //             'shopify_name' => $order->shopify_name,
                            //             'order_id' => $order->order_id,
                            //             'order_number' => $order->order_number,
                            //             'product_id' => $order->product_id,
                            //             'price' => $order->price,
                            //             'order_details' => $order->order_details,
                            //             'status' => $order->status,
                            //         ];
                            //     })
                            // ]);
                    }
    }

    public function privacy_policy()
    {
        return view('privacy_policy');
    }
}
