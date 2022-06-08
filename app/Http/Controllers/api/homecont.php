<?php

namespace App\Http\Controllers\api;

use App\User;
use App\Product;
use App\Order;
use App\Setting;
use App\OrderProduct;
use App\OrderSold;
use App\OrderPayment;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\OrderProductResource;
use App\Http\Resources\OrderSoldResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Elibyy\TCPDF\Facades\TCPDF;

class homecont extends Controller
{
    //
   
    public function setting(){
        $item=Setting::first();
        return apisuccess($item);
    }

    public function index()
    {
        $pending=Order::where('voice_status','1')->count();
        $finish=Order::where('voice_status','4')->count();
        $refus=Order::where('voice_status','3')->count();
        $item=[
            'pending'=>$pending,
            'finish'=>$finish,
            'refus'=>$refus
        ];
        return apisuccess($item);
    }

    public function customers(){
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
        $items = $items->latest()->paginate(f_page());

        return apisuccess($items);
    }


    public function orders(){
        $items = new Order();
        $pages=f_page();
        if(request('order_id')){
            $items = $items->where('id',  request('order_id'));
        }
        if(request('customer_id')){
            $items = $items->where('customer_id',  request('customer_id'));
        }
        if(request('count')){
            $pages = request('count');
        }
        if(request('address')){
            $items = $items->wherehas('customer', function($q){
                $q->where('address', 'like', '%' . request('address') . '%');
            });
        }
        if(request('name')){
            $items = $items->wherehas('customer', function($q){
                $q->where('name', 'like', '%' . request('name') . '%');
            });
        }
        if(request('status') != ''){
            if(in_array(request('status') ,[0,2])){
                $items = $items->where('status', request('status'));
            }
                if(in_array(request('status') ,[1,3,4])){

            $items = $items->where('voice_status', request('status'));
                }
        }
        $items = $items->latest()->paginate($pages);
        $resources=OrderResource::collection($items);
        return apisuccess($resources);
    }

    public function customer($id){
        $item=User::where([['isadmin',0],['id',$id]])->first();
        return apisuccess($item);
    }

    public function listProduct(){
        $products=Product::get(['id','name']);
        return apisuccess($products);
    }

    public function listUser(){
        $users=User::where('isadmin',0)->get(['id','name']);
        return apisuccess($users);
    }

    public function add_order(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'customer_id' => 'required',
        ]);

        $niceNames = [
            'customer_id' => 'اسم المستخدم',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return validation($errors);
        }
        $new=new Order();
        $new->customer_id=request('customer_id');
        $new->notes=request('notes');
        $new->status='0';
        $new->from=0;
        $new->user_id=authid()->id;
        $new->save();
        $pro=request('product_id');
        $cou=request('count');
        $products=explode(",",$pro);
        $counts=explode(",",$cou);
        foreach ($products as $k=>$f){
            if (isset($f)) {
                $op=OrderProduct::where([['product_id',$f],['order_id',$new->id]])->first();
                $p=Product::find($f);
                $c=(int)$counts[$k] > 0 ? (int)$counts[$k]: 1;
                if (isset($op)){
                    $op->count += $c;
                    $op->price_total += ($p->price * $c);
                    $op->save();
                }else {
                    $no = new OrderProduct();
                    $no->product_id = $f;
                    $no->count = $c;
                    $no->price = $p->price;
                    $no->price_total = $p->price * $c;
                    $no->order_id = $new->id;
                    $no->save();
                }
            }
        }
        return success();
    }

    public function payments(){
        $id=request('order_id');
        $item=Order::find($id);
        $tt=0;
        $items=$item->payments()->get();
        foreach($items as $it){
            $it['remaining']=$item->total_price() - $item->total_price_recieve() - ($tt+=$it->price);
        }
         $resources=PaymentResource::collection($items);
        return apisuccess($resources);
    }

    public function order_products(){
        $id=request('order_id');
        $item=Order::find($id);
        $items=$item->products()->get();
         $resources=OrderProductResource::collection($items);
        return apisuccess($resources);
    }

    public function order_solds(){
        $id=request('order_id');
        $item=Order::find($id);
        $items=$item->solds()->get();
         $resources=OrderSoldResource::collection($items);
        return apisuccess($resources);
    }

    public function products(){
        $items=Product::all();
         $resources=ProductResource::collection($items);
        return apisuccess($resources);
    }


    public function pdf(){
       $pdf=new TCPDF();
       $pdf::setHeaderCallback(function($hd){
           $hd->SetFont('almohanad','B',22);
           $header=view('admin.order.pdf.header')->__toString();
           $hd->WriteHTML($header,true,0,true,0);
       });

       $pdf::setFooterCallback(function ($fo){
           $setting=Setting::first();
           $fo->SetY(-38);
          $fo->SetFont('almohanad','B',22);
           $footer=view('admin.order.pdf.footer',compact('fo','setting'))->__toString();
           $fo->WriteHTML($footer,true,0,true,0);
       });

       $lg=Array();
       $lg['a_meta_charset']='UTF-8';
       $lg['a_meta_dir']='rtl';
       $lg['a_meta_language']='ar';
       $lg['w_page']='page';

       $pdf::SetFont('almohanad','',16);

       $pdf::SetLanguageArray($lg);

       $pdf::SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
       $pdf::SetHeaderMargin(PDF_MARGIN_HEADER);
       $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);
       $pdf::SetPrintHeader(true);
       $pdf::SetPrintFooter(true);
       $pdf::SetAutoPageBreak(True,PDF_MARGIN_BOTTOM);


       $items = new Order();
       $pages=f_page();
       if(request('order_id')){
           $items = $items->where('id',  request('order_id'));
       }
       if(request('customer_id')){
           $items = $items->where('customer_id',  request('customer_id'));
       }
       if(request('count')){
           $pages = request('count');
       }
       if(request('address')){
           $items = $items->wherehas('customer', function($q){
               $q->where('address', 'like', '%' . request('address') . '%');
           });
       }
       if(request('name')){
           $items = $items->wherehas('customer', function($q){
               $q->where('name', 'like', '%' . request('name') . '%');
           });
       }
       if(request('status') != ''){
           if(in_array(request('status') ,[0,2])){
               $items = $items->where('status', request('status'));
           }
               if(in_array(request('status') ,[1,3,4])){

           $items = $items->where('voice_status', request('status'));
               }
       }
       $items = $items->latest()->paginate($pages);
        foreach($items as $item){
       if(isset($item)){
       $pdf::AddPage('L');

       $view=view('admin.order.pdf.index',compact('item'))->__toString();
       $pdf::WriteHTML($view,true,0,true,0);
   }
}

$pdf::Output($item->id.'.pdf');
}

public function note(){
    $id=request('id');
    $item=Order::find($id);
    $item->notes=request('notes');
    $item->save();
    return success();
}

public function add_payment(){
    $id=request('id');
    $validator =Validator::make(request()->all(),[
        'price' => 'required|numeric',
    ]);
    $niceNames = [
        'price' => 'القيمة',
    ];
    $validator->setAttributeNames($niceNames);
    if ($validator->fails()){
        $err=$validator->errors()->first();
        return validation($err);
    }

    $order=Order::find($id);
    if (isset($order)){

        $new=new OrderPayment();
        $new->order_id=$id;
        $new->price=\request('price');
        $new->admin_id=authid()->id;
        $new->save();
        return success();
    }
    return validation('خطا في رقم الطلب');
}

public function add_sold(){
    $id=request('id');
    $order=Order::find($id);
    if (isset($order)){
        $product_id=\request('product_id');
        $count=\request('count') > 0 ? \request('count'):1;
        $c=\request('count') > 0 ? \request('count'):1;
        $product_o=OrderProduct::where([['order_id',$id],['product_id',$product_id]])->first();
        $product_s=OrderSold::where([['order_id',$id],['product_id',$product_id]])->first();

       // dd($this->remaining_count($product_o->id));

        if(isset($product_o)){
            if (isset($product_s)){
                $count +=$product_s->count;
            }
            if($this->remaining_count($product_o->id) >= $c) {
                if (isset($product_s)) {
                    $product_s->count= $count;
                    $product_s->price_total += ($product_s->price * $c);
                    $product_s->save();
                }
                else {
                    $new = new OrderSold();
                    $new->order_id=$id;
                    $new->product_id = $product_id;
                    $new->count = $c;
                    $new->price = $product_o->price;
                    $new->price_total = $product_o->price * $c;
                    $new->save();
                }
                return success();
            }
            return validation('لا يمكن اضافة كمية اكبر من الكمية المتبقية في الطلب');
        }
        return validation('لا يمكن اضافة كتب غير موجودة في الطلب الاساسي');
    }
    return validation('يوجد خطا في الطلب');
}

public function destroy_prodcut()
{
    $id=request('id');
    $validator =Validator::make(request()->all(),[
        'count' => 'required|numeric',
    ]);

    $niceNames = [
        'count' => 'الكمية',
    ];
    $validator->setAttributeNames($niceNames);
    if ($validator->fails()){
        $err=$validator->errors()->first();
        return validation($err);
    }
    $item=OrderProduct::find($id);
    $o=Order::find($item->order_id);
        if ($o->voice_status == 3){
        return validation('لا يمكن التعديل على الكمية، والحالة الحالية للفاتورة ملغية');
    }
    if ($o->voice_status == 4){
        return validation('لا يمكن التعديل على الكمية، والحالة الحالية للفاتورة مدفوعة');
    }
    if(request('count') == 0 ){
        OrderProduct::destroy($id);
    }
    else{
    $item->count=request('count');
    $item->price_total=$item->price * $item->count;
    $item->save();
    }
    return success();
}

public function add_remaining(){
    $id=\request('id');
    $no=\request('count');
    $validator =Validator::make(request()->all(),[
        'count' => 'required|numeric',
    ]);

    $niceNames = [
        'count' => 'الكمية',
    ];
    $validator->setAttributeNames($niceNames);
    if ($validator->fails()){
        $err=$validator->errors()->first();
        return validation($err);
    }
    $o_p=OrderProduct::find($id);
    if (isset($o_p)) {
        if ($no <= $this->remaining_count($id) ){
            $product_s=OrderSold::where([['order_id',$o_p->order_id],['product_id',$o_p->product_id]])->first();
            if (isset($product_s)) {
                $product_s->count+= ($this->remaining_count($id)-$no);
                $product_s->price_total += ($product_s->price * ($this->remaining_count($id)-$no));
                $product_s->save();
            }
            else {
                $new = new OrderSold();
                $new->order_id=$o_p->order_id;
                $new->product_id = $o_p->product_id;
                $new->count = ($this->remaining_count($id)-$no);
                $new->price = $o_p->price;
                $new->price_total = $o_p->price * ($this->remaining_count($id)-$no);
                $new->save();
            }
            return success();

        }
        return validation('لا يمكن وضع كمية اكثر من الكمية المتبقية في الطلب');
    }
    return validation('يوجد خطا في الطلب');
}

public function add_product(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'img'=>'required'
        ]);
        $niceNames = [
            'name' => 'اسم الكتاب',
            'price' => 'سعر الكتاب',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return validation($err);
        }
        $input= $request->all();
        if($request->hasFile('img')){
            $input['img'] = img_thum($request,'img',600,600);
        }

        $new=Product::create($input);
        return success();
    }


public function remaining_count($id){
    $o_p=OrderProduct::find($id);
    $sold=OrderSold::where([['product_id',$o_p->product_id],['order_id',$o_p->order_id]])->first();
    $c_s=isset($sold) ? $sold->count :0;
    $recieve=OrderRecieve::where([['product_id',$o_p->product_id],['order_id',$o_p->order_id]])->first();
    $c_r=isset($recieve) ? $recieve->count :0;
    return $o_p->count - $c_s - $c_r;
}


}
