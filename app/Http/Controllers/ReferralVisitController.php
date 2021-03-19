<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\ReferralDiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReferralVisitController extends Controller
{
    public function index(Request $request, $referral_code)
    {
        $referral = new Referral;
        $referral_discount_code = new ReferralDiscountCode;

        $get_referral = $referral->where('name', $referral_code)->first();
        // dd($get_referral);
        $referral_id = $get_referral->id;

        $referral_discount = $referral_discount_code->where('referral_id', $referral_id)->first();
        // dd($referral_discount);
        $discount_code = $referral_discount->discount_code;
        $store_url = "https://".$referral_discount->shop_name."?referral-code=".$discount_code;
        return Redirect::to($store_url);
        // dd($referral_code);
    }
}
