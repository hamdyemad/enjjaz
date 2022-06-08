<?php

namespace App\Http\Controllers\admin;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class authcont extends Controller
{
    //

    public function index()
    {
        $new=Order::where('status','0')->count();
        $pending=Order::where('voice_status','1')->count();
        $finish=Order::where('voice_status','4')->count();
        $refus=Order::where('voice_status','3')->count();
        return view('admin.home',compact('new','pending','finish','refus'));
    }

    public function edit()
    {
        $user = User::where('id',authid()->id)->first();
        return view('admin.profile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,User $user)
    {
        $val=Validator::make($request->all(),$user->rule_u(authid()->id));
        if($val->passes()) {
            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = Arr::except($input,array('password'));
            }
            $user = User::where('id',authid()->id)->first();
            $user->update($input);
            $user->save();

            return r_back();
        }
        $error=$val->errors()->first();
        return r_backerror($error);
    }


    public function login(){
        return view('admin.login');
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
        //$admin['isactive']=1;
        if (Auth::guard('web')->attempt($admin))
        {
            return redirect('/admin');
        }
        else
        {
            return r_backerror('لديس لديك صلاحية الدخول');
        }
    }

    public function getLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
