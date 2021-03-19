<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PopupSettingController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $app_settings = new AppSetting;
        $settings = $app_settings->where('shop_name', $user->name)->first();
        return view('store_owner.popup-setting-view', ["app_settings" => $settings, "success" => 0]);
    }

    public function update_popup_setting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'max:1000',
        ]);
        $user = Auth::user();

        $popup_side_image = $request->file('popup-file');
        $popup_heading = $request->post('popup_heading');
        $popup_description = $request->post('popup_description');
        $referral_help_text = $request->post('referral_help_text');

        if($popup_side_image != null){
            $destinationPath = 'upload';
            $image_content = $popup_side_image->move($destinationPath,$popup_side_image->getClientOriginalName());
            $file_pathname = $image_content->getPathname();
        }else{
            $file_pathname = null;
        }

        $app_setting = new AppSetting;
        $check_settings = $app_setting->where('shop_name', $user->name)->first();
        if($check_settings != null){
            $app_setting = $app_setting->find($check_settings->id);
        }
        $app_setting->popup_image = $file_pathname;
        $app_setting->popup_heading = $popup_heading;
        $app_setting->popup_description = $popup_description;
        $app_setting->referral_link_help_text = $referral_help_text;
        $save = $app_setting->save();

        if($save){
            $settings = $app_setting->where('shop_name', $user->name)->first();
            return view('store_owner.popup-setting-view', ["app_settings" => $settings, "success" => 1]);
        }else{
            return response()->json(array(
                'success' => false,
            ), 500);
        }
    }
}
