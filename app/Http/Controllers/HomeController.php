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
use PDO;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $referral_orders = Orders::where("shop_name", $user->name)->get();

        $total_order_amount = DB::table('orders')
        ->where("shop_name", $user->name)
        ->whereIn('order_status', ['1', '0'])
        ->sum('orders.total_price');

        $number_of_orders = DB::table('orders')
        ->where("shop_name", $user->name)
        ->whereIn('order_status', ['1', '0'])
        ->count();

        $total_earned_amount = DB::table('orders')
        ->where("shop_name", $user->name)
        ->where("order_status", 1)
        ->sum('orders.total_discount');


        $total_referrals = DB::table('referral_manager')
        ->where("shopify_name", $user->name)
        ->count();

        $withdrawals_requested = DB::table('referral_manager')
        ->join('withdrawal_requests', 'referral_manager.id', '=', 'withdrawal_requests.referral_id')
        ->where("referral_manager.shopify_name", $user->name)
        ->where("withdrawal_requests.withdrawal_status", 1)
        ->sum('withdrawal_requests.withdrawal_amount');

        return view('store_owner.dashboard', [
            "total_order_amount" => $total_order_amount, 
            "number_of_orders" => $number_of_orders,
            "total_referral_earned" => $total_earned_amount,
            "total_referrals" => $total_referrals,
            "withdrawals_requested" => $withdrawals_requested,
        ]);
    }

    public function login(Request $request) {
        if (Auth::attempt ( array (
                'email' => $request->get ( 'email' ),
                'password' => $request->get ( 'password' ) 
        ))) {
            session ( [ 
                    'email' => $request->get ( 'email' ) 
            ] );
            return redirect()->route('referral-dashboard');
            // dd(Auth::user());
            dd("Authenticated");
        } else {
            // Session::flash ( 'message', "Invalid Credentials , Please try again." );
            // return Redirect::back ();
            dd("not");
        }
    }
}
