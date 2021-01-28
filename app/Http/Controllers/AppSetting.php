<?php

namespace App\Http\Controllers;

use DB;
use App\Models\AppSettings;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppSetting extends Controller
{
    public function disable_settings(Request $request)
    {
        $user = Auth::user();
        if($request->disable_right_click){
            $key = "disable_right_click";
            $value =  $request->disable_right_click;
        }

        if($request->disable_f12){
            $key = "disable_f12";
            $value =  $request->disable_f12;
        }

        if($request->disable_copy){
            $key = "disable_copy";
            $value =  $request->disable_copy;
        }

        if($request->disable_ctrl_shift_i){
            $key = "disable_ctrl_shift_i";
            $value =  $request->disable_ctrl_shift_i;
        }

        if($request->disable_ctrl_anykey){
            $key = "disable_ctrl_anykey";
            $value =  $request->disable_ctrl_anykey;
        }
        if($request->disable_text_image_selection){
            $key = "disable_text_image_selection";
            $value =  $request->disable_text_image_selection;
        }

        $update_app_settings = DB::table('app_settings')
        ->where('shopify_name', $user->name)
        ->update([$key => $value]);

        return redirect()->route('home');
    }

    public function get_app_settings()
    {
        $shop = $_GET['shop_name'];
        $data = AppSettings::where('shopify_name', $shop)->get();
        return $data;
    }
}
