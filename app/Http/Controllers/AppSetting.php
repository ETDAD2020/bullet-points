<?php

namespace App\Http\Controllers;

use App\Models\AppSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppSetting extends Controller
{
    public function app_set_product(Request $request)
    {
        $user = Auth::user();
        $product =  null; //setting check variable if button show on product page
        $data_save;

        //Calling App Settings table
        $appSettings = new AppSettings;
        $appSettings->shopify_name = $user->name;
        $appSettings2 =  $appSettings->where("shopify_name", $user->name)->get();

        //Assigning Values of the data
        if($request->product == "true")
        {
            $product = $request->product;
            $appSettings->product_page = $product;
        }

        if(count($appSettings2) > 0)
        {
            $data_save = AppSettings::where('shopify_name', $user->name)
            ->update([ 'product_page' => $product]);
        }else{
            $data_save = $appSettings->save();
        }
        //Returning home
        if($data_save)
        {
            return redirect()->route('home');
        }else{
            return redirect()->route('home');
        }
    }

    public function app_set_cart(Request $request)
    {
        $user = Auth::user();
        $cart = null; //Setting check vairables if button show on cart page
        $data_save;

        //Calling App Settings table
        $appSettings = new AppSettings;
        $appSettings->shopify_name = $user->name;
        $appSettings2 =  $appSettings->where("shopify_name", $user->name)->get();

        //Assigning Values of the data
        if($request->cart == "true")
        {
            $cart = $request->cart;
            $appSettings->cart_page = $cart;
        }

        if(count($appSettings2) > 0)
        {
            $data_save = AppSettings::where('shopify_name', $user->name)
            ->update(['cart_page' =>  $cart ]);
        }else{
            $data_save = $appSettings->save();
        }

        //Returning home
        if($data_save)
        {
            return redirect()->route('home');
        }else{
            return redirect()->route('home');
        }
    }

    public function notification_setting(Request $request)
    {
        $user = Auth::user();
        $notification = null; //Setting check vairables if button show on cart page
        $data_save;

        //Calling App Settings table
        $appSettings = new AppSettings;
        $appSettings->shopify_name = $user->name;
        $appSettings2 =  $appSettings->where("shopify_name", $user->name)->get();

        //Assigning Values of the data
        if(isset($request->notification_type))
        {
            $notification = $request->notification_type;
            $appSettings->notification_type = $notification;
        }else{
            $notification = null;
            $appSettings->notification_type = $notification;
        }

        if(count($appSettings2) > 0)
        {
            $data_save = AppSettings::where('shopify_name', $user->name)
            ->update(['notification_type' =>  $notification ]);
        }else{
            $data_save = $appSettings->save();
        }

        //Returning home
        if($data_save)
        {
            return redirect()->route('home');
        }else{
            return redirect()->route('home');
        }
    }

    public function get_app_settings()
    {
        $shop = $_GET['shop_name'];
        $data = AppSettings::where('shopify_name', $shop)->get();
        return $data;
    }
}
