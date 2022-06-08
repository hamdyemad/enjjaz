<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderPayment;
use App\OrderProduct;
use App\OrderRecieve;
use App\OrderSold;
use App\OrderStatus;
use App\Product;
use App\User;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PDF;

class OrderController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('permission:order-list|order-create|order-edit|order-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:order-create', ['only' => ['create','store']]);
        $this->middleware('permission:order-edit', ['only' => ['edit','update','add_product','destroy_prodcut']]);
        $this->middleware('permission:order-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:order-status', ['only' => ['status']]);
        $this->middleware('permission:order-editprice', ['only' => ['editprice']]);
        $this->middleware('permission:order-add_recieve', ['only' => ['add_recieve']]);
        $this->middleware('permission:order-add_payment', ['only' => ['add_payment']]);
        $this->middleware('permission:order-add_remaining', ['only' => ['add_remaining']]);
    }
    //
    public function index(){
        $items = new Order();
        $pages=15;
        if(request('customer_id')){
            $items = $items->where('customer_id',  request('customer_id'));
        }
        if(request('address')){
            $items = $items->wherehas('customer', function($q){
                $q->where('address', 'like', '%' . request('address') . '%');
            });
        }
        if(request('count')){
            $pages = request('count');
        }
        if(request('status') != ''){
            if(in_array(request('status') ,[0,2])){
                $items = $items->where('status', request('status'));
            }
            if(in_array(request('status') ,[1,3,4])){
                $items = $items->where('voice_status', request('status'));
            }
        }
        $users=User::where('isadmin',0)->get();
        $items = $items->latest()->with('customer')->whereHas('customer', function(Builder $query) {
            if(request('phone')) {
                $query->where('phone', 'like', request('phone') . '%');
            }
        })->paginate($pages)->appends(request()->query());
        return view('admin.order.index',compact('items','users'));
    }

    public function create(){
        if(request()->has('price')) {
            $products=Product::orderBy('order_number')->pluck('name','id')->all();
            $users=User::where('isadmin',0)->pluck('name','id')->all();
            return view('admin.order.create',compact('products','users'));
        } else {
            return redirect(route('order.index'));
        }
    }

    public function store(Request $request)
    {

        if($request->has('price')) {
            $validator =Validator::make(request()->all(),[
                'customer_id' => 'required',
            ]);

            $niceNames = [
                'customer_id' => 'اسم المستخدم',
            ];
            $validator->setAttributeNames($niceNames);
            if ($validator->fails()){
                $err=$validator->errors()->first();
                return r_backerror($err);
            }
            $new=new Order();
            $new->customer_id=request('customer_id');
            $new->notes=request('notes');
            $new->status='0';
            $new->from=0;
            $new->user_id=authid()->id;
            $new->save();
            $products=request('product_id');
            $counts=request('count');
            foreach ($products as $k=>$f){
                if (isset($f)) {
                    $op=OrderProduct::where([['product_id',$f],['order_id',$new->id]])->first();
                    $p=Product::find($f);
                    $c=$counts[$k] > 0 ? $counts[$k]: 1;
                    if (isset($op)){
                        $op->count += $c;
                        if(request('price') == 0) {
                            $op->price_total += ($p->price * $c);
                        }
                        if(request('price') == 1) {
                            $op->price_total += ($p->wholePrice * $c);
                        }
                        $op->save();
                    }else {
                        $no = new OrderProduct();
                        $no->product_id = $f;
                        $no->count = $c;
                        if(request('price') == 0) {
                            $no->price = $p->price;
                            $no->price_total = $p->price * $c;
                        }
                        if(request('price') == 1) {
                            $no->price = $p->wholePrice;
                            $no->price_total = $p->wholePrice * $c;
                        }
                        $no->order_id = $new->id;
                        $no->save();
                    }
                }
            }
            return r_back();

        } else {
            return redirect()->back();
        }
    }

    public function add_product($id){
        $order=Order::find($id);
        $add_productsFiltered = array_filter(request()->add_products, function($obj) {
            if($obj['count'] > 0) {
                return $obj;
            }
        });
        if (isset($order)){
            if(count($add_productsFiltered) > 0) {
                foreach ($add_productsFiltered as $add_product) {
                    $op=OrderProduct::where([
                        ['product_id',$add_product['product_id']],
                        ['order_id',$id]
                        ])->first();
                        $p=Product::where('id', $add_product['product_id'])->first();
                        if (isset($op)){
                            $op->count += $add_product['count'];
                            $op->price_total = number_format(($op->price * $op->count), 2);
                            $op->save();
                        }else {
                            $no = new OrderProduct();
                            $no->product_id = $add_product['product_id'];
                            $no->count = $add_product['count'];
                            $no->price = $p->price;
                            $no->price_total = number_format($p->price * $add_product['count'], 2);
                            $no->order_id = $id;
                            $no->save();
                        }
                }
                return r_back();
            } else {
                return error_back();
            }
        } else {
            return error_back();
        }
    }

    public function edit($id)
    {

        $item=Order::find($id);
        $allProductsRemaininCount = [];
        foreach ($item->products as $product) {
            array_push($allProductsRemaininCount, $product->remaining_count());
        }
        if(count($allProductsRemaininCount) > 0) {
            $allProductsRemaininCount =  array_reduce($allProductsRemaininCount, function($acc, $curr) {
                return $acc + $curr;
            });
        }
        $products=Product::orderBy('name')->get();
        $table=[
            'تفاصيل الفاتورة'
            ,'الاجمالي'
            ,'المدفوعات'
            ,'الكتب المطلوبة'
            ,'الكتب المباعة'];
        return view('admin.order.edit',compact('item','products','table', 'allProductsRemaininCount'));

    }

    public function update(Request $request,$id)
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
            return r_backerror($err);
        }
        $input= $request->all();
        $new= Order::update($input);
        return r_back();

    }

    public function destroy($id)
    {
        $item=Order::find($id);
        if(isset($item)){
            Order::destroy($id);
        }
        return r_back();
    }

    public function status($id,$status){
        $item=Order::find($id);
        if (isset($item)){
            if(in_array($status,[0,2])){
            $item->status = $status;
            }
            if(in_array($status,[1,3,4])){
                $item->voice_status = $status;
            }
            $item->save();

            $new=new OrderStatus();
            $new->admin_id=authid()->id;
            $new->order_id=$id;
            $new->status=$status;
            $new->save();
            return r_back();
        }
        return error_back();
    }

    public function editprice(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'price' => 'required|numeric',
        ]);

        $niceNames = [
            'price' => 'السعر',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $item=OrderProduct::find($id);
        $product_s=OrderSold::where([['order_id',$item->order_id],['product_id',$item->product_id]])->first();
        $o=Order::find($item->order_id);
        if ($o->status == 2){
            return r_backerror('لا يمكن التعديل على السعر، والحالة الحالية تم التسليم');
        }
        if ($o->voice_status == 3){
            return r_backerror('لا يمكن التعديل على السعر، والحالة الحالية للفاتورة ملغية');
        }
        if ($o->voice_status == 4){
            return r_backerror('لا يمكن التعديل على السعر، والحالة الحالية للفاتورة مدفوعة');
        }
        $item->price=request('price');
        $item->price_total=number_format(request('price') * $item->count, 2);
        $item->save();
        if($product_s) {
            $product_s->price=request('price');
            $product_s->price_total=number_format(request('price') * $item->count, 2);
            $product_s->save();
        }
        $o->touch();

        return r_back();

    }

    public function add_sold($id){
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
                        $product_s->price_total += number_format(($product_s->price * $c), 2);
                        $product_s->save();
                    }
                    else {
                        $new = new OrderSold();
                        $new->order_id=$id;
                        $new->product_id = $product_id;
                        $new->count = $c;
                        $new->price = $product_o->price;
                        $new->price_total = number_format($product_o->price * $c, 2);
                        $new->save();
                        $order->touch();
                    }
                    return r_back();
                }
                return r_backerror('لا يمكن اضافة كمية اكبر من الكمية المتبقية في الطلب');
            }
            return r_backerror('لا يمكن اضافة كتب غير موجودة في الطلب الاساسي');
        }
        return error_back();
    }

    public function add_recieve($id){
        $order=Order::find($id);
        if (isset($order)){
            $product_id=\request('product_id');
            $count=\request('count') > 0 ? \request('count'):1;
            $c=\request('count') > 0 ? \request('count'):1;
            $product_o=OrderProduct::where([['order_id',$id],['product_id',$product_id]])->first();
            $product_r=OrderRecieve::where([['order_id',$id],['product_id',$product_id]])->first();

            if(isset($product_o)){
                if (isset($product_r)){
                    $count +=$product_r->count;
                }
                if($this->remaining_count($product_o->id) >= $c) {
                    if (isset($product_r)) {
                        $product_r->count= $count;
                        $product_r->price_total += ($product_r->price * $c);
                        $product_r->save();
                    }
                    else {
                        $new = new OrderRecieve();
                        $new->order_id=$id;
                        $new->product_id = $product_id;
                        $new->count = $c;
                        $new->price = $product_o->price;
                        $new->price_total = $product_o->price * $c;
                        $new->save();
                        $order->touch();
                    }
                    return r_back();
                }
                return r_backerror('لا يمكن اضافة كمية اكبر من الكمية المتبقية في الطلب');
            }
            return r_backerror('لا يمكن اضافة كتب غير موجودة في الطلب الاساسي');
        }
        return error_back();
    }


    public  function add_payment($id){
        $validator =Validator::make(request()->all(),[
            'price' => 'required|numeric'
        ]);
        $niceNames = [
            'price' => 'القيمة',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $order=Order::find($id);
        if (isset($order)){

            $new=new OrderPayment();
            $new->order_id=$id;
            $new->price=\request('price');
            $new->admin_id=authid()->id;
            if(request('date')) {
                $new->created_at = date('Y-m-d h:m:s', strtotime(request()->date));
                $new->updated_at = date('Y-m-d h:m:s', strtotime(request()->date));
            }
            $new->save();
            $order->touch();
            return r_back();
        }
        return error_back();
    }
    public  function update_payment($id){
        $order_p=OrderPayment::find($id);
        if (isset($order_p)){
            if(request('date')) {
                $order_p->created_at = date('Y-m-d h:m:s', strtotime(request()->date));
                $order_p->updated_at = date('Y-m-d h:m:s', strtotime(request()->date));
            }
            if(request('price')) {
                $order_p->price = request()->price;
            }
            $order_p->save();
            return r_back();
        } else {
            return error_back();
        }
    }

    public function delete_payment($id) {
        $order_p=OrderPayment::find($id);
        if (isset($order_p)){
            $order_p->delete();
            return r_back();
        } else {
            return error_back();
        }
    }

    public function add_remaining($id){
        if(request('ids')) {
            $ids = explode(',', trim(request('ids'), '[]'));
            $orders_p=OrderProduct::where('order_id', $id)->get();
            $no = request('no');
            for($i = 0; $i < count($orders_p->toArray()); $i++) {
                if (isset($orders_p[$i])) {
                    if($orders_p[$i]->count >= $no[$i]) {
                        $product_s=OrderSold::where([
                        ['order_id',$orders_p[$i]->order_id],
                        ['product_id',$orders_p[$i]->product_id]])->first();
                        if($product_s) {
                            $product_s->update([
                                'count' => $orders_p[$i]->count - $no[$i],
                                'price_total' => number_format($product_s->price * ($orders_p[$i]->count - $no[$i]), 2)
                            ]);
                            if($product_s->count == 0) {
                                $product_s->destroy($product_s->id);
                            }
                        } else {
                            if(($this->remaining_all_count($id,$orders_p[$i]->product_id)-$no[$i]) > 0) {
                                $new = new OrderSold();
                                $new->order_id=$id;
                                $new->product_id = $orders_p[$i]->product_id;
                                $new->count = ($this->remaining_all_count($id,$orders_p[$i]->product_id)-$no[$i]);
                                $new->price = $orders_p[$i]->price;
                                $new->price_total = number_format( $orders_p[$i]->price * ($this->remaining_all_count($id,$orders_p[$i]->product_id)-$no[$i]), 2);
                                $new->save();
                            }
                        }
                    } else {
                        return error_back();
                    }
                }
            }
            return r_back();
        } else {
            $no=\request('no');
            $o_p=OrderProduct::find($id);
            if (isset($o_p)) {
                if($o_p->count >= $no) {
                    $product_s=OrderSold::where([['order_id',$o_p->order_id],['product_id',$o_p->product_id]])->first();
                    if (isset($product_s)) {
                        $product_s->count+= ($this->remaining_count($id)-$no);
                        $product_s->price_total += ($product_s->price * ($this->remaining_count($id)-$no));
                        $product_s->save();
                        if($product_s->count == 0) {
                            $product_s->destroy($product_s->id);
                        }
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
                    return r_back();
                } else {
                    return error_back();
                }
            }
            return error_back();
        }
    }

    public function update_amount($id){
        if(request('ids')) {
            $validator =Validator::make(request()->all(),[
                'no.*' => 'required|numeric',
            ]);
            $niceNames = [
                'no.*' => 'الكمية',
            ];
            $validator->setAttributeNames($niceNames);
            if ($validator->fails()){
                $err=$validator->errors()->first();
                return r_backerror($err);
            }
            $idsOfProducts = explode(',', trim(request('ids'), '[]'));
            $orders_p=OrderProduct::where('order_id', $id)->get();
            for($i = 0; $i < count($orders_p->toArray()); $i++) {
                $o=Order::find($orders_p[$i]->order_id);
                if ($o->voice_status == 3){
                    return r_backerror('لا يمكن التعديل على الكمية، والحالة الحالية للفاتورة ملغية');
                }
                if ($o->voice_status == 4){
                    return r_backerror('لا يمكن التعديل على الكمية، والحالة الحالية للفاتورة مدفوعة');
                }
                if(request('no')[$i] == 0 ){
                    OrderProduct::destroy($id);
                } else{
                    $orders_p[$i]->count=request('no')[$i];
                    $orders_p[$i]->price_total=$orders_p[$i]->price * $orders_p[$i]->count;
                    $orders_p[$i]->save();
                }
            }
            return r_back();
        } else {
            $validator =Validator::make(request()->all(),[
                'count' => 'required|numeric',
            ]);

            $niceNames = [
                'count' => 'الكمية',
            ];
            $validator->setAttributeNames($niceNames);
            if ($validator->fails()){
                $err=$validator->errors()->first();
                return r_backerror($err);
            }
            $item=OrderProduct::find($id);
            $o=Order::find($item->order_id);
                if ($o->voice_status == 3){
                return r_backerror('لا يمكن التعديل على الكمية، والحالة الحالية للفاتورة ملغية');
            }
            if ($o->voice_status == 4){
                return r_backerror('لا يمكن التعديل على الكمية، والحالة الحالية للفاتورة مدفوعة');
            }
            if(request('count') == 0 ){
                OrderProduct::destroy($id);
            } else{
                $item->count=request('count');
                $item->price_total=$item->price * $item->count;
                $item->save();
            }
            return r_back();
        }
    }

	public function pdf(){
        ini_set('max_execution_time', 0);
        $pdf_list=request('pdf_list');
        if(!isset($pdf_list)){
             return r_backerror('يجب اختيار طلب واحد على الاقل');
        }
        $pdf=new TCPDF();
        $pdf::setHeaderCallback(function($hd){
            $hd->SetFont('freeserif','B',22);
            $header=view('admin.order.pdf.header')->__toString();
            $hd->WriteHTML($header,true,0,true,0);
        });

        $pdf::setFooterCallback(function ($fo){
            $setting=Setting::first();
            $fo->SetY(-40);
            $fo->SetFont('freeserif','B',14);
            $footer=view('admin.order.pdf.footer',compact('fo','setting'))->__toString();
            $fo->WriteHTML($footer,true,0,true,0);
        });
        $lg=Array();
        $lg['a_meta_charset']='UTF-8';
        $lg['a_meta_dir']='rtl';
        $lg['a_meta_language']='ar';
        $lg['w_page']='page';
        $pdf::SetFont('freeserif','',16);
        $pdf::SetLanguageArray($lg);
        $pdf::SetMargins(5,PDF_MARGIN_TOP);
        $pdf::SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf::SetFooterMargin(PDF_MARGIN_FOOTER );
        $pdf::SetPrintHeader(true);
        $pdf::SetPrintFooter(true);
        $pdf::SetAutoPageBreak(True,40);
        $items=Order::whereIn('id',$pdf_list)->orderby('id','desc')->get();
        foreach($items as $item){
            $allProductsRemaininCount = [];
            foreach ($item->products as $product) {
                array_push($allProductsRemaininCount, $product->remaining_count());
            }
            if(count($allProductsRemaininCount) > 0) {
                $allProductsRemaininCount =  array_reduce($allProductsRemaininCount, function($acc, $curr) {
                    return $acc + $curr;
                });
            }
            if(isset($item)){
                $pdf::AddPage();
                $view=view('admin.order.pdf.index',compact('item', 'allProductsRemaininCount'))->__toString();
                $pdf::WriteHTML($view,true,0,true,0);
            }
        }
        if($items->count() == 1) {
        $pdf::Output($items[0]->id . '.pdf');
        } else {
            $pdf::Output('orders-' . date('Y-M-D-h-m-s') . '.pdf');
        }
    }

    public function note($id){
        $item=Order::find($id);
        $item->notes=request('notes');
        $item->save();
        return success();
    }

    public function remaining_all_count($id, $product_id){
        $o_p=OrderProduct::where('order_id', $id)->where('product_id', $product_id)->first();
        $sold=OrderSold::where([['product_id',$product_id],['order_id',$id]])->first();
        $sold_count=isset($sold) ? $sold->count :0;
        $recieve=OrderRecieve::where([['product_id',$product_id],['order_id',$id]])->first();
        $c_r=isset($recieve) ? $recieve->count :0;
        return $o_p->count - $sold_count - $c_r;
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
