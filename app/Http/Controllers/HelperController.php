<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    public function getShop() {
        $shop=Auth::user();

        return $shop;
    }
}
