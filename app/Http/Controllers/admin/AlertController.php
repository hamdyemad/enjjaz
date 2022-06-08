<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlertController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:alert-list|alert-create|alert-edit|alert-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:alert-create', ['only' => ['create','store']]);
        $this->middleware('permission:alert-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:alert-destroy', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daysDiff = 30;
        if(request('days')) {
            $daysDiff = request('days');
        }

        $selectedArr = ['orders.id', 'customer_id', 'user_id', 'from', 'notes', 'orders.status',
        'orders.voice_status', 'orders.created_at',
         'orders.updated_at', 'orders.deleted_at'];
        $users=User::where('isadmin',0)->pluck('name','id')->all();
        $items = Order::select('orders.*')
        ->leftJoin('order_payments', 'order_payments.order_id', 'orders.id')
        ->leftJoin('order_solds', 'order_solds.order_id', 'orders.id')
        ->leftJoin('order_statuses', 'order_statuses.order_id', 'orders.id')
        ->whereNull('order_payments.order_id')
        ->whereNull('order_solds.order_id')
        ->whereNull('order_statuses.order_id')
        ->where(DB::raw('DATEDIFF(NOW(), orders.updated_at)'), '>' , $daysDiff)
        ->groupBy($selectedArr)->orderBy('orders.id', 'desc');

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
        $items = $items->latest()->paginate(15)->appends(request()->query());
        return view('admin.alerts.index', compact('items', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
