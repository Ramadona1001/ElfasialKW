<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Setting;
use App\SoicalMedia;
use Illuminate\Http\Request;
use Auth;

class SocialMediasController extends Controller
{
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_social_media'))
            abort(403);

        $SoicalMedia = SoicalMedia::findOrfail(1);
        return view('backend.pages.socialmedia.index' ,compact('SoicalMedia'));

    }
    public function update(Request $request)
    {
        $twitter        = $request->twitter;
        $facebook       = $request->facebook;
        $instagram      = $request->instagram;


        $SoicalMedia = SoicalMedia::findOrfail(1);
        $SoicalMedia ->twitter = $twitter;
        $SoicalMedia->facebook = $facebook;
        $SoicalMedia->instagram = $instagram;

        $SoicalMedia->save();

        return back();
    }
}
