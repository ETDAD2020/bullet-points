<?php

namespace App\Http\Controllers;

use App\Color;
use App\Customizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomizersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->id;
        Auth::loginUsingId($user_id, $remember = true);
        if(Auth::check()){
            $settings = Customizer::where('store_id', Auth::user()->id)->first();
            return view('customizer.index')->with('settings', $settings);
        }else{
            dd(Auth::check());
        }

    }

    public function showInstructions(Request $request) {
        $user_id = $request->user_id;
        Auth::loginUsingId($user_id, $remember = true);
        return view('customizer.instructions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        Auth::loginUsingId($user_id, $remember = true);

        if(Customizer::where('store_id', Auth::user()->id)->exists()) {
            $settings_updated = Customizer::where('store_id', Auth::user()->id)->first();
            $settings = Customizer::find($settings_updated->id);
        }
        else {
            $settings = new Customizer();
        }

        $settings->color = $request->color;
        $settings->icon = $request->icon;
        $settings->emoji = $request->emoji;
        $settings->store_id = Auth::user()->id;
        $settings->save();

        return redirect()->back()->with('success', 'Settings saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
