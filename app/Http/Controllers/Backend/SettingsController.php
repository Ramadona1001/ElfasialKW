<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Setting;
use Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_settings'))
            abort(403);

        $setting = Setting::findOrfail(1);
        return view('backend.pages.setting.index',compact('setting'));
    }

    public function update(Request $request)
    {

        $title       = $request->title;
        $description      = $request->description;
        $phone_number     = $request->phone_number;
        $currency     = $request->currency;
        $email     = $request->email;
        $ar_terms     = $request->ar_terms_conditions;
        $en_terms     = $request->en_terms_conditions;



        $setting = Setting::findOrfail(1);
        $setting ->title = $title;
        $setting->description = $description;
        $setting->phone_number = $phone_number;
        $setting->email = $email;
        $setting->currency = $currency;
        $setting->ar_terms_conditions = $ar_terms;
        $setting->en_terms_conditions = $en_terms;


        if($request->hasFile('logo')){
            $imageName = time().'.'.request()->logo->getClientOriginalExtension();
            request()->logo->move(public_path('logo'), $imageName);
            $logo = $imageName;
            $setting->logo = $logo;


        }

        $setting->save();

        return back();
    }
}
