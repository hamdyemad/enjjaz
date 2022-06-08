<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Setting;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

     function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-destroy', ['only' => ['destroy']]);
    }
    //
    public function index(){
        $items = new User();
        if(request('name')){
            $items = $items->where('name', 'like', '%' . request('name') . '%');
        }
        if(request('phone')){
            $items = $items->where('phone', 'like', '%' . request('phone') . '%');
        }
        if(request('email')){
            $items = $items->where('email', 'like', '%' . request('email') . '%');
        }
        if(request('address')){
            $items = $items->where('address','like', '%' . request('address') . '%');
        }
        $items = $items->where('isadmin',0);
        $items = $items->latest()->paginate(15);

        return view('admin.customer.index',compact('items'));
    }

    public function create(){
        return view('admin.customer.create');

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255|unique:users,name',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users,phone',
        ]);

        $niceNames = [
            'name' => 'اسم المستخدمة',
            'full_name' => 'الاسم كامل',
            'phone' => 'رقم الهاتف',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
           return r_backerror($err);
        }
        $input= $request->all();
        $input['password'] = Hash::make($input['password']);
        $new=User::create($input);
        return r_back();
    }

    public function edit($id)
    {
        $item=User::find($id);
        return view('admin.customer.edit',compact('item'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255|unique:users,name,'.$id,
            'full_name' => 'required|string|max:255',
            //'email' => 'required|string|max:255|unique:users,email,'.$id,
            'phone' => 'required|string|max:255|unique:users,phone,'.$id,
        ]);

        $niceNames = [
            'name' => 'اسم المستخدم',
            'full_name' => 'الاسم كامل',
           // 'email' => 'الايميل',
            'phone' => 'رقم الهاتف',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
           return r_backerror($err);
        }
        $input= $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        $user->save();
        return r_back();

    }

    public function destroy($id)
    {
        $item=User::find($id);
        if(isset($item)){
            User::destroy($id);
        }
        return r_back();
    }

    public function pdf(){

        $pdf=new TCPDF();
        $pdf::setHeaderCallback(function($hd){
            $hd->SetFont('freeserif','B',22);
            $header=view('admin.customer.pdf.header')->__toString();
            $hd->WriteHTML($header,true,0,true,0);
        });

        $pdf::setFooterCallback(function ($fo){
            $setting=Setting::first();
            $fo->SetY(-22);
            $fo->SetFont('freeserif','B',22);
            $footer=view('admin.customer.pdf.footer',compact('fo','setting'))->__toString();
            $fo->WriteHTML($footer,true,0,true,0);
        });

        $lg=Array();
        $lg['a_meta_charset']='UTF-8';
        $lg['a_meta_dir']='rtl';
        $lg['a_meta_language']='ar';
        $lg['w_page']='page';

        $pdf::SetFont('freeserif','',16);

        $pdf::SetLanguageArray($lg);

        $pdf::SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
        $pdf::SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf::SetPrintHeader(true);
        $pdf::SetPrintFooter(true);
        $pdf::SetAutoPageBreak(True,PDF_MARGIN_BOTTOM);


        $items = new User();
        if(request('name')){
            $items = $items->where('name', 'like', '%' . request('name') . '%');
        }
        if(request('phone')){
            $items = $items->where('phone', 'like', '%' . request('phone') . '%');
        }
        if(request('address')){
            $items = $items->where('address','like', '%' . request('address') . '%');
        }
        $items = $items->where('isadmin',0);
        $items = $items->latest()->get();
        $pdf::AddPage();
        $view=view('admin.customer.pdf.index',compact('items'))->__toString();
        $pdf::WriteHTML($view,true,0,true,0);
        $random=rand('100000','999999');
        $pdf::Output('customers-'.date('Y-M-D-h-m-s').'.pdf');
    }

}
