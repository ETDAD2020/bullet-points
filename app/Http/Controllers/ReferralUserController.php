<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\AppSetting;
use App\Models\ReferralDiscountCode;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Log;

class ReferralUserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        $referral = new Referral;
        $referral_info = $referral->where('email', $user->email)->first();
        // dd($referral_info);
        $discount_code = new ReferralDiscountCode;
        $referral_discount_code = $discount_code->where("referral_id", $referral_info->id)->first();

        $orders = new Orders;
        $referral_orders = $orders->where("discount_code", $referral_discount_code->discount_code)->get();
        $number_of_orders = count($referral_orders);
// dd($referral_orders);
        $total_order_amount = DB::table('orders')
        ->where("discount_code", $referral_discount_code->discount_code)
        ->whereIn('order_status', ['1', '0'])
        // ->where("order_status", 0)
        // ->orWhere('order_status', 1)
        ->sum('orders.total_price');

        $total_earned_amount = DB::table('orders')
        ->where("discount_code", $referral_discount_code->discount_code)
        ->where("order_status", 1)
        ->groupBy('discount_code')
        ->sum('orders.total_discount');

        $total_withdrawal_available = DB::table('orders')
        ->where("discount_code", $referral_discount_code->discount_code)
        ->where("order_status", 1)
        ->where("withdrawal_status", 0)
        ->groupBy('discount_code')
        ->sum('orders.total_discount');

        $total_withdrawal = DB::table('withdrawal_requests')
        ->where("referral_id", $referral_info->id)
        ->where("withdrawal_status", 0)
        ->groupBy('referral_id')
        ->sum('withdrawal_requests.withdrawal_amount');

        return view('referrals.referral-dasboard-view',["referral_info" => $referral_info,
            "referral_discount_code" => $referral_discount_code,
            "referral_orders" => $referral_orders,
            "number_of_orders" => $number_of_orders,
            "total_order_amount" => $total_order_amount,
            "total_earned_amount" => $total_earned_amount,
            "total_withdrawal_available" => $total_withdrawal_available,
            "total_withdrawal" => $total_withdrawal
        ]);
    }
}
