<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class settingcont extends Controller
{
    //

    function __construct()
    {
        $this->middleware('permission:setting-edit', ['only' => ['edit','terms_update','about_us','terms','privacy','update']]);
    }

    public function edit(){
        $item=Setting::first();
        return view('admin.setting.edit',compact('item'));
    }

    public function update(Request $request,Setting $setting)
    {
        $val=Validator::make($request->all(),$setting->rule());
        if($val->passes()) {
            $input = $request->all();

            $service = Setting::first();
            $service->update($input);
            $service->save();

            return r_back();
        }
        $error=$val->errors()->first();
        return r_backerror($error);
    }

    public function terms(){
        $item=Setting::first();
        return view('admin.setting.terms',compact('item'));
    }

    public function privacy(){
        $item=Setting::first();
        return view('admin.setting.privacy',compact('item'));
    }

    public function about_us(){
        $item=Setting::first();
        return view('admin.setting.about_us',compact('item'));
    }

    public function terms_update(Request $request)
    {
        $input = $request->all();
        $service = Setting::first();
        $service->update($input);
        $service->save();
        return r_back();
    }
}
