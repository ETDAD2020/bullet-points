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

class WithdrawalManagerController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // dd($user->name);
        $withdrawals_requested = DB::table('referral_manager')
        ->join('withdrawal_requests', 'referral_manager.id', '=', 'withdrawal_requests.referral_id')
        ->select('referral_manager.email','referral_manager.name', 'referral_manager.shopify_name', 'withdrawal_requests.id', 'withdrawal_requests.withdrawal_amount', 'withdrawal_requests.withdrawal_status')
        ->where("referral_manager.shopify_name", $user->name)->get();

        return view('store_owner.withdrawal-view', ["withdrawals" => $withdrawals_requested]);
    }

    public function withdrawal_update_status(Request $request)
    {
        $user = Auth::user();
        $withdrawal_id = $request->post('withdrawal_id');

        $withdrawal = new WithdrawalRequest;
        $update_status = $withdrawal->find($withdrawal_id);
        $update_status->withdrawal_status = 1;
        $save = $update_status->save();

        if($save){
            return response()->json(array(
                'success' => true,
            ), 200);
        }

    }
}
