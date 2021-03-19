<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Referral;
use App\Models\AppSetting;
use App\Models\ReferralDiscountCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Log;

class OrderController extends Controller
{
    public function orders()
    {
        $user = Auth::user();
        $shop_name = $user->name;

        $order = new Orders;
        $order_list = $order->where("shop_name", $shop_name)->get();

        return view('store_owner.orders-view', ["orders" => $order_list]);
    }
}
