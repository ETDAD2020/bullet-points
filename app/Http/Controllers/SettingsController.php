<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class SettingsController extends Controller
{
    public function update_email_setting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'max:1000',
        ]);
        $user = Auth::user();

        $email_logo = $request->file('email-logo-file');
        $email_html = $request->post('email');
        if($email_logo != null){
            $destinationPath = 'upload';
            $image_content = $email_logo->move($destinationPath,$email_logo->getClientOriginalName());
            $file_pathname = $image_content->getPathname();
        }else{
            $file_pathname = null;
        }

        $app_setting = new AppSetting;
        $check_settings = $app_setting->where('shop_name', $user->name)->first();
        if($check_settings != null){
            $app_setting = $app_setting->find($check_settings->id);
        }
        $app_setting->user_id = $user->id;
        $app_setting->shop_name = $user->name;
        $app_setting->email_logo = $file_pathname;
        $app_setting->email_template_html = $email_html;
        $save = $app_setting->save();

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

    public function update_app_setting(Request $request)
    {
        $user = Auth::user();
        $setting_type = $request->post('setting_type');
        $store_name = $request->post('store_name');
        $check = $request->post('check');

        $app_setting = new AppSetting;
        $check_settings = $app_setting->where('shop_name', $user->name)->first();
        if($check_settings != null){
            $app_setting = $app_setting->find($check_settings->id);
        }

        if($setting_type == "all_website"){
            if($check == 1){
                $app_setting->popup_all_website = "";
            }else{
                $app_setting->popup_all_website = $setting_type;
            }
        }

        if($setting_type == "order_status"){
            if($check == 1){
                $app_setting->popup_order_status = "";
            }else{
                $app_setting->popup_order_status = $setting_type;
            }
        }

        if($setting_type == "fixed" || $setting_type == "percentage"){
            $app_setting->referrer_settings = $setting_type;
        }

        if($setting_type == "app_live"){
            $app_setting->app_live = $check;
        }

        $save = $app_setting->save();

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

    public function settings()
    {
        $user = Auth::user();
        $app_settings = new AppSetting;
        $settings = $app_settings->where('shop_name', $user->name)->first();
        dd($settings);
        if($settings == null){
            $app_settings->user_id = $user->id;
            $app_settings->shop_name = $user->name;
            $app_settings->save();
        }
        return view('store_owner.settings-view', ["app_settings" => $settings]);
    }

    public function get_app_setting(Request $request)
    {
        $shop_name = $request->post('shop_name');
        $app_settings = new AppSetting;
        $settings = $app_settings->where('shop_name', $shop_name)->first();
        return $settings;
    }

    public function update_amount(Request $request)
    {
        $user = Auth::user();

        $discount_type = $request->post('type');
        $discount_amount = $request->post('amount');

        $app_setting = new AppSetting;
        $check_settings = $app_setting->where('shop_name', $user->name)->first();
        if($check_settings != null){
            $app_setting = $app_setting->find($check_settings->id);
            $app_setting->amount = $discount_amount;
            $save = $app_setting->save();
            if($save){
                return response()->json(array(
                    'success' => true,
                ), 200);
            }else{
                return response()->json(array(
                    'success' => false,
                ), 200);
            }
        }
    }
}
