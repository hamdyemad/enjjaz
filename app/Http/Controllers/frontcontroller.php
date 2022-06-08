<?php

namespace App\Http\Controllers;

use App\Order;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class frontcontroller extends Controller
{
    //

    public function index(){
        $setting=Setting::first();
        return view('front.index',compact('setting'));
    }

    public function order($status){
        $items=Order::where([['customer_id',authid()->id],['status',$status]])->paginate(f_page());
        $data=view('front.order',compact('items'))->render();
        return response()->json(['status' => true,'html'=>$data]);
    }

    public function order_show($id){
        $item=Order::where([['customer_id',authid()->id],['id',$id]])->first();
        $data=view('front.order_show',compact('item'))->render();
        return response()->json(['status' => true,'html'=>$data]);
    }

    public function postIndex(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'password' => 'required|string',
        ]);
        $username = $request->get('name');
        $password = $request->get('password');

        $admin['name'] = $username;
        $admin['password'] = $password;
        $admin['isadmin']=0;

        if (Auth::guard('web')->attempt($admin))
        {
            return r_back();
        }
        else
        {
            return r_backerror('لديس لديك صلاحية الدخول');
        }
    }

    public function update_profile(Request $request){
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255|unique:users,name,'.authid()->id,
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,'.authid()->id,
            'phone' => 'required|string|max:255|unique:users,phone,'.authid()->id,
        ]);

        $niceNames = [
            'name' => 'اسم المستخدم',
            'full_name' => 'الاسم كامل',
            'email' => 'الايميل',
            'phone' => 'رقم الهاتف',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        $input = Arr::except($input,array('name','full_name'));

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        $user = User::find(authid()->id);
        $user->update($input);
        $user->save();
        return r_back();

    }
}
