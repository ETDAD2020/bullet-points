<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AppSettings;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PDO;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $settings = AppSettings::where('shopify_name', $user->name)->get();

        if($settings->count() == 0){
            $app_setting = new AppSettings;
            $app_setting->shopify_name = $user->name;
            $app_setting->save();
            $settings = AppSettings::where('shopify_name', $user->name)->get();
        }

        return Inertia::render('Home', [
            'app_settings' => $settings->map(function($setting){
                return [
                    'disable_right_click' => $setting->disable_right_click,
                    'disable_f12' => $setting->disable_f12,
                    'disable_copy' => $setting->disable_copy,
                    'disable_ctrl_shift_i' => $setting->disable_ctrl_shift_i,
                    'disable_ctrl_anykey' => $setting->disable_ctrl_anykey,
                    'disable_text_image_selection' => $setting->disable_text_image_selection,
                ];
            })
        ]);
    }

    public function privacy_policy()
    {
        return view('privacy_policy');
    }
}
