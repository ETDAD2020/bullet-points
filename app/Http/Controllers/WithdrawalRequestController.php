<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\AppSetting;
use App\Models\ReferralDiscountCode;
use App\Models\User;
use App\Models\WithdrawalRequest;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Log;

class WithdrawalRequestController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->post('name');
        $user = User::where('name', $name)->first();
        $referral = Referral::where('name', $user->name)->first();
        $referral_discount_code = ReferralDiscountCode::where('referral_id', $referral->id)->first();
        $discount_code = $referral_discount_code->discount_code;
        $orders = Orders::where('discount_code', $discount_code)->where('order_status', 1)->where('withdrawal_status', 0)->get();
        $withdrawal_amount = 0;
        foreach($orders as $order){
            $withdrawal_amount = $order->total_discount + $withdrawal_amount;
            $update_order = Orders::find($order->id);
            $update_order->withdrawal_status = 1;
            $update_order->save();
        }

        $withdrawal_request = new WithdrawalRequest;
        $withdrawal_request->referral_id = $referral->id;
        $withdrawal_request->withdrawal_amount = $withdrawal_amount;
        $withdrawal_request->withdrawal_status = 0;
        $save = $withdrawal_request->save();

        if($save){
            return response()->json(array(
                'success' => true,
            ), 200);
        }else{
            return response()->json(array(
                'success' => false,
            ), 500);
        }

    }
}
