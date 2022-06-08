<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class usercont extends Controller
{
    //
    public function login()
    {
        $credentials = request(['name', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return unauthjs();
                    }
        $user = User::where([['email', \request('email')],['isadmin',1]])->firstorfail();
        if (isset($user)){
            return $this->respondWithToken($token,$user);
        }
        return unsuccess();
    }

    public function authuser()
    {
        $items = auth('api')->user();
        if (isset($items->id)) {
            return apisuccess($items);
        } else return unauthjs();
    }

    public function resetpassword(Request $request){
        $val = Validator::make($request->all(), [
            'email' =>'required',
        ]);

        if ($val->passes()) {
        $user=User::where('email',$request->get('email'))->first();
        if (isset($user)){
            $rand=rand(100000,999999);
            $user->password=Hash::make($rand);
            $user->save();
            return apisuccess($rand);
        }
        return validation('email error');
        }
        $errors = $val->errors()->first();
        return validation($errors);
    }

    public function update(Request $request, User $user)
    {
        $val = Validator::make($request->all(), $user->rule_u(auth('api')->user()->id));
        if ($val->passes()) {
            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = Arr::except($input,array('password'));
            }
            $user = User::where('id',authid()->id)->first();
            $user->update($input);
            $user->save();
            return apisuccess($user);
        }
        $errors = $val->errors()->first();
        return validation($errors);
    }


    public function customer(Request $request){
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255|unique:users,name',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $niceNames = [
            'name' => 'اسم المكتبة',
            'full_name' => 'الاسم كامل',
            'phone' => 'رقم الهاتف',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
           return validation($err);
        }
        $input= $request->all();
        $input['password'] = Hash::make($input['password']);
        $new=User::create($input);
        return success();
    }

    protected function respondWithToken($token,$user)
    {
        return response()->json([
            'status' => true,
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Carbon::now()->addDays(350)->timestamp
        ]);
    }
}
