<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use App\OrderRecieve;
use App\OrderSold;
use App\Product;
use App\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-destroy', ['only' => ['destroy']]);
    }
    //
    public function index(){
        $items = new Product();
        if(request('name')){
            $items = $items->where('name', 'like', '%' . request('name') . '%');
        }
        if(request('price')){
            $items = $items->where('price', request('price') );
        }
        $items = $items->orderBy('order_number')->paginate(15);
        return view('admin.product.index',compact('items'));
    }


    public function about(Product $product) {
        if(request('voice_status')) {
            $pagination = 50;
            $ordersIds = $product->orders()->where('voice_status', request('voice_status'))->pluck('orders.id');
            $productOrdersAmount =  OrderProduct::where('product_id', $product->id)->whereIn('order_id', $ordersIds)->get();
            // Get The remeining of amount and the total price
            foreach ($productOrdersAmount as $productOrderAmount) {
                $sold=OrderSold::where([['product_id',$productOrderAmount->product_id],['order_id',$productOrderAmount->order_id]])->first();
                $c_s=isset($sold) ? $sold->count :0;
                $recieve=OrderRecieve::where([['product_id',$productOrderAmount->product_id],['order_id',$productOrderAmount->order_id]])->first();
                $c_r=isset($recieve) ? $recieve->count :0;
                $productOrderAmount->count = $productOrderAmount->count - $c_s - $c_r;
                $productOrdersAmount->price_total = $productOrderAmount->count * $productOrderAmount->price;
            }
            $productOrdersPriceTotal =  OrderProduct::where('product_id', $product->id)->whereIn('order_id', $ordersIds)->get()->pluck('price_total')->sum();
            $productOrdersAmount = $productOrdersAmount->pluck('count')->sum();
            $orders = $product->orders()->where('voice_status', request('voice_status'))->paginate($pagination);
            if(request('name')) {
                $users = User::where('name', 'like', '%' . request('name') . '%')->pluck('id');
                $orders = $product->orders()->whereIn('customer_id', $users)->where('voice_status', request('voice_status'))->paginate($pagination);
            }
            if(request('phone')) {
                $users = User::where('phone', 'like', request('phone') . '%')->pluck('id');
                $orders = $product->orders()->whereIn('customer_id', $users)->where('voice_status', request('voice_status'))->paginate($pagination);
            }
            if(request('address')) {
                $users = User::where('address', 'like', '%' . request('address') . '%')->pluck('id');
                $orders = $product->orders()->whereIn('customer_id', $users)->where('voice_status', request('voice_status'))->paginate($pagination);
            }
            $orders->appends(['voice_status' => request('voice_status')]);
            return view('admin.product.about', compact(
                'product', 'orders', 'productOrdersAmount','productOrdersPriceTotal','ordersIds'
            ));

        } else {
            return redirect()->back();
        }
    }

    public function create(){
        return view('admin.product.create');

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'wholePrice' => 'numeric'
        ]);
        $niceNames = [
            'name' => 'اسم الكتاب',
            'price' => 'سعر الكتاب',
            'wholePrice' => 'سعر الجملة'
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        if($request->hasFile('img')){
            $input['img'] = img_thum($request,'img',600,600);
        }

        $new=Product::create($input);
        return r_back();
    }

    public function edit($id)
    {
        $item=Product::find($id);
        return view('admin.product.edit',compact('item'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'wholePrice' => 'numeric'
        ]);
        $niceNames = [
            'name' => 'اسم الكتاب',
            'price' => 'سعر الكتاب',
            'wholePrice' => 'سعر الجملة'
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        if($request->hasFile('img')){
            $input['img'] = img_thum($request,'img',600,600);

        }else{
            $input = Arr::except($input,array('img'));
        }
        $new = Product::find($id);
        $new->update($input);
        $new->save();
        return r_back();

    }

    public function destroy($id)
    {
        $item=Product::find($id);
        if(isset($item)){
            Product::destroy($id);
        }
        return r_back();
    }
}
