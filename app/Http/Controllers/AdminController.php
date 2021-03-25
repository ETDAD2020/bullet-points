<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function stores() {
        $users = User::where('role', null)->paginate(20);
        return view('admin.stores')->with('users', $users);
    }

    public function plans() {
        $plans = DB::table('plans')->get();

        return view('admin.plans')->with('plans', $plans);
    }

    public function updatePlan(Request $request, $id) {

        $this->validate($request, [
          "name" => "required",
          "type" => "required",
          "price" => "required",
          "interval" => "required",
          "capped_amount" => "required",
          "terms" => 'required',
        ]);

        DB::table('plans')->where('id', $id)->update([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'interval' => $request->interval,
            'capped_amount' => $request->capped_amount,
            'terms' => $request->terms,
        ]);


        return redirect()->back()->with('success', 'Plan Updated Successfully');
    }
}
