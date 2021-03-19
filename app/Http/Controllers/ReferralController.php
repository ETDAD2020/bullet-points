<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\AppSetting;
use App\Models\ReferralDiscountCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Log;

class ReferralController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $referral_name = $request->referral_name;
        $referral_email = $request->referral_email;
        $verification_code =  time();
        $url = "https://app.shareall.com/referral/".$referral_name;

        $referral = new Referral;
        $referral_info = $referral->where('email', $referral_email)->first();

        if($referral_info != null){
            return response()->json(array(
                'success' => false,
                'updated' => true,
                'referral_id' => $referral_info->id,
                'referral_name' => $referral_info->name,
                'referral_email' => $referral_info->email,
                'referral_url' => $referral_info->url,
                'referral_verification_code' => $referral_info->verification_code
            ), 200);
        }else{
            $referral->user_id = $user->id;
            $referral->name = $referral_name;
            $referral->email = $referral_email;
            $referral->url = $url;
            $referral->verification_code = $verification_code;
            $save = $referral->save();
            $referrals_information = $referral->where("verification_code", $verification_code)->first();
            if($save){
                $app_setting = new AppSetting;
                $get_settings = $app_setting->where('shop_name', $user->name)->first();
                $discount_type = $get_settings->referrer_settings;
                $amount = $get_settings->amount;
                $referral_id = $referrals_information->id;
                $store_id = $user->id;
                $this->create_discount($discount_type, $amount, $referral_id, $user->name, $user->id, $referral_name);
                $this->register_referral_user($referral_name, $referral_email, $referral_name. $user->id);
                return response()->json(array(
                    'success' => true,
                    'updated' => false,
                    'referral_id' => $referrals_information->id,
                    'referral_name' => $referral_name,
                    'referral_email' => $referral_email,
                    'created_at' => $referrals_information->created_at,
                    'referral_url' => $url,
                ), 200);
            }
        }
    }

    public function referral_manager()
    {
        $user = Auth::user();
        $referral_list = new Referral;
        $list_referrals = $referral_list->where('user_id', $user->id)->get();
        return view('store_owner.referral-manager', ['referrals' => $list_referrals]);
    }

    public function check_referral(Request $request)
    {
        $referral_name = $request->post('referral_name');
        $referral_list = new Referral;
        $list_referrals = $referral_list->where('name', $referral_name)->first();
        if($list_referrals != null){
            return response()->json(array(
                'success' => false
            ), 200);
        }else{
            return response()->json(array(
                'success' => true
            ), 200);
        }
    }

    public function generate_referral_url(Request $request)
    {
        /*
            This function generates referral url for the user who
            signed up from the frontend of the website
        */
        $referral_name = $request->get('referral-name');

        //Referral Name Check
        $referral_list = new Referral;
        $list_referrals = $referral_list->where('name', $referral_name)->first();
        if($list_referrals != null){
            return response()->json(array(
                'success' => false,
                'message' => "Name already available. Please try another one"
            ), 200);
        }
        //End Referral Name Check

        $referral_email = $request->get('referral-email');
        $store_name = $request->get('store-name');

        $verification_code =  time();

        $user_detail = new User;
        $user = $user_detail->where('name', $store_name)->first();

        $url = env('APP_URL')."/referral/".$referral_name;

        $referral = new Referral;
        $referral_info = $referral->where('email', $referral_email)->first();

        if($referral_info != null){
            return response()->json(array(
                'success' => false,
                'updated' => true,
                'referral_id' => $referral_info->id,
                'referral_name' => $referral_info->name,
                'referral_email' => $referral_info->email,
                'referral_url' => $referral_info->url,
                'referral_verification_code' => $referral_info->verification_code
            ), 200);
        }else{
            $referral->shopify_name = $user->name;
            $referral->user_id = $user->id;
            $referral->name = $referral_name;
            $referral->email = $referral_email;
            $referral->url = $url;
            $referral->verification_code = $verification_code;
            $save = $referral->save();
            $referrals_information = $referral->where("email", $referral_email)->first();
            if($save){
                $app_setting = new AppSetting;
                $get_settings = $app_setting->where('shop_name', $store_name)->first();
                $discount_type = $get_settings->referrer_settings;
                $amount = $get_settings->amount;
                $referral_id = $referrals_information->id;
                $store_id = $user->id;
                $this->create_discount($discount_type, $amount, $referral_id, $store_name, $store_id, $referral_name);
                $this->register_referral_user($referral_name, $referral_email, $referral_name. $user->id);
                return response()->json(array(
                    'success' => true,
                    'updated' => false,
                    'referral_id' => $referrals_information->id,
                    'referral_name' => $referral_name,
                    'referral_email' => $referral_email,
                    'referral_url' => $referrals_information->url,
                    'created_at' => $referrals_information->created_at,
                ), 200);
            }
        }
    }

    public function create_discount($discount_type, $amount, $referral_id, $shop_name, $shop_id, $discount_code)
    {
        if($discount_type == "fixed"){
            $discount_type = "fixed_amount";
        }else{
            $discount_type = "percentage";
        }
        $shop = User::where('name', $shop_name)->first();
        // Log::info($discount_type);
        $ruleData = [
            'title' => $discount_code,
            'target_type' => "line_item",
            'target_selection' => "all",
            'allocation_method' => "across",
            'value_type' => "$discount_type",
            'value' => "-".$amount,
            'customer_selection' => "all",
            'starts_at' => '2021-01-19T17:59:10Z',
        ];
        // Creating Price Rule
        $response = $shop->api()->rest('POST',
            '/admin/api/price_rules.json',
            ['price_rule' => $ruleData]
        );
        // Log::info($shop);
        // return $response;

        if(!isset($response['body']['price_rule']['id']))
        {
            // Log::info($response['body']);
            return response()->json(array(
                'status' => $response['statuscode'],
                'message' => $response['body']
            ), 200);
        }

        $price_rule = $response['body']['price_rule']['id'];
        // Log::info($response['body']['price_rule']['id']);

        //Discount Code Declaration
        $discount_code_data = [
            'code' => $discount_code
        ];
        try {
            // Using Pricerule id to create Discount
            $discount_register = $shop->api()->rest('POST',
                '/admin/api/2020-10/price_rules/'.$price_rule.'/discount_codes.json',
                ['discount_code' => $discount_code_data]
            );
            // dd($discount_register);
            if(isset($discount_register['body']['discount_code']))
            {
                Log::info(json_encode($discount_register['body']));
                $discount_code = $discount_register['body']['discount_code']['code'];
                $discount_code_id = $discount_register['body']['discount_code']['id'];
                $price_rule_id = $discount_register['body']['discount_code']['price_rule_id'];

                Log::info($price_rule_id);

                $referral_discount_code = new ReferralDiscountCode;
                $referral_discount_code->referral_id = $referral_id;
                $referral_discount_code->shop_name = $shop_name;
                $referral_discount_code->discount_code = $discount_code;
                $referral_discount_code->discount_code_id = $discount_code_id;
                $referral_discount_code->price_rule_id = $price_rule_id;
                $save = $referral_discount_code->save();
                if($save){
                    Log::info($save);
                    return $save;
                }
            }else{
                $error_msg = $discount_register['body']['code'][0];
                return response()->json(array(
                    'success' => false,
                    'message' => $error_msg
                ), 500);
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function register_referral_user($user_name, $user_email, $user_password){
        $userData = [
            'name' => $user_name,
            'email' => $user_email,
            'password' => bcrypt('12345678')
        ];
        $create_user = User::create($userData);
        return $create_user;
    }
}
