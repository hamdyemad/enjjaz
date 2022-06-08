<?php

namespace App\Http\Controllers\admin;

use App\Receipt;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Hamcrest\Core\Set;
use Illuminate\Validation\Rule;
use Spipu\Html2Pdf\Html2Pdf;

class ReceiptController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:receipt-list|receipt-create|receipt-edit|receipt-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:receipt-create', ['only' => ['create','store']]);
        $this->middleware('permission:receipt-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:receipt-destroy', ['only' => ['destroy']]);
    }

    public function home() {
        return view('admin.receipt.home');
    }
    public function index() {
        if(request('type') == 0) {
            $receipts = Receipt::where('type', '0')->latest()->paginate(15);
            if(request('id')) {
                $receipts = Receipt::where('type', '0')->where('id', request('id'))->latest()->paginate(15);
            }
            if(request('client_name')) {
                $receipts = Receipt::where('type', '0')->where('client_name', 'like',request('client_name') . '%')->latest()->paginate(15);
            }
            return view('admin.receipt.index', ['receipts' => $receipts]);
        }
        if(request('type') == 1) {
            $receipts = Receipt::where('type', '1')->latest()->paginate(15);
            if(request('id')) {
                $receipts = Receipt::where('type', '1')->where('id', request('id'))->latest()->paginate(15);
            }
            if(request('client_name')) {
                $receipts = Receipt::where('type', '1')->where('client_name', 'like',request('client_name') . '%')->latest()->paginate(15);
            }
            return view('admin.receipt.index', ['receipts' => $receipts]);
        }
        if(request('type') == 2) {
            $receipts = Receipt::where('type', '2')->latest()->paginate(15);
            if(request('id')) {
                $receipts = Receipt::where('type', '2')->where('id', request('id'))->latest()->paginate(15);
            }
            if(request('client_name')) {
                $receipts = Receipt::where('type', '2')->where('client_name', 'like',request('client_name') . '%')->latest()->paginate(15);
            }
            return view('admin.receipt.index', ['receipts' => $receipts]);
        }
    }

    // return the deal create view
    public function create() {
        if(request()->has('type')) {
            return view('admin.receipt.create');
        } else {
            return redirect()->back();
        }
    }

    // store the deal
    public function store() {
        if(request('type') == 0) {
            $attributes = request()->validate([
                'client_name' => ['required'],
                'price_kind' => ['required'],
                'about' => ['required'],
                'price' => ['required']
            ], [
                'client_name.required' => 'حقل أسم الأيصال مطلوب ادخاله',
                'price_kind.required' => 'حقل نوع االعملية مطلوب ادخاله',
                'about.required' => 'حقل عن الأيصال مطلوب ادخاله',
                'price.required' => 'حقل السعر مطلوب ادخاله'
            ]);
            $attributes['all_price'] = request('all_price');
            $attributes['paid_price'] = request('paid_price');
            $attributes['remain_price'] = request('remain_price');
            $attributes['date'] = request('date');
            $attributes['type'] = request('type');
            Receipt::create($attributes);
            return redirect()->back()->with('success', 'تم أضافة الأيصال بنجاح');
        } else if(request('type') == 1) {
            $attributes = request()->validate([
                'client_name' => ['required'],
                'price' => ['required']
            ], [
                'client_name.required' => 'حقل أسم الأيصال مطلوب ادخاله',
                'price.required' => 'حقل السعر مطلوب ادخاله'
            ]);
            $attributes['publication_color'] = request('publication_color');
            $attributes['publication_address'] = request('publication_address');
            $attributes['publication_pages_count'] = request('publication_pages_count');
            $attributes['publication_type'] = request('publication_type');
            $attributes['publication_size'] = request('publication_size');
            $attributes['book_heel'] = request('book_heel');
            $attributes['paper_size'] = request('paper_size');
            $attributes['publication_amount'] = request('publication_amount');
            $attributes['paid_price'] = request('paid_price');
            $attributes['remain_price'] = request('remain_price');
            $attributes['publication_time'] = request('publication_time');
            $attributes['publication_other'] = request('publication_other');
            $attributes['type'] = request('type');
            Receipt::create($attributes);
            return redirect()->back()->with('success', 'تم أضافة الأيصال بنجاح');
        } else if(request('type') == 2) {
            $attributes = request()->validate([
                'client_name' => ['required'],
                'about' => ['required'],
            ], [
                'client_name.required' => 'حقل أسم الأيصال مطلوب ادخاله',
                'about.required' => 'حقل محتوى الأيصال مطلوب ادخاله',
            ]);
            $attributes['date'] = request('date');
            $attributes['type'] = request('type');
            Receipt::create($attributes);
            return redirect()->back()->with('success', 'تم أضافة الأيصال بنجاح');
        }

    }

    // get edit information
    public function edit(Receipt $receipt) {
        if(request()->has('type')) {
            return view('admin.receipt.edit', ['item' => $receipt]);
        } else {
            return redirect()->back();
        }
    }

    // update the edit information

    public function update(Receipt $receipt) {
        if(request()->has('type')) {
            if(request('type') == 0) {
                $attributes = request()->validate([
                    'client_name' => ['required'],
                    'price_kind' => ['required'],
                    'about' => ['required'],
                    'price' => ['required']
                ], [
                    'client_name.required' => 'حقل أسم الأيصال مطلوب ادخاله',
                    'price_kind.required' => 'حقل نوع االعملية مطلوب ادخاله',
                    'about.required' => 'حقل عن الأيصال مطلوب ادخاله',
                    'price.required' => 'حقل السعر مطلوب ادخاله'
                ]);
                $attributes['all_price'] = request('all_price');
                $attributes['paid_price'] = request('paid_price');
                $attributes['remain_price'] = request('remain_price');
                $attributes['date'] = request('date');
                $receipt->update($attributes);
                return redirect()->back()->with('success', 'تم التعديل بنجاح !');
            } else if(request('type') == 1) {
                $attributes = request()->validate([
                    'client_name' => ['required'],
                    'price' => ['required']
                ], [
                    'client_name.required' => 'حقل أسم الأيصال مطلوب ادخاله',
                    'price.required' => 'حقل السعر مطلوب ادخاله'
                ]);
                $attributes['publication_color'] = request('publication_color');
                $attributes['publication_address'] = request('publication_address');
                $attributes['publication_pages_count'] = request('publication_pages_count');
                $attributes['publication_type'] = request('publication_type');
                $attributes['publication_size'] = request('publication_size');
                $attributes['book_heel'] = request('book_heel');
                $attributes['paper_size'] = request('paper_size');
                $attributes['publication_amount'] = request('publication_amount');
                $attributes['paid_price'] = request('paid_price');
                $attributes['remain_price'] = request('remain_price');
                $attributes['publication_time'] = request('publication_time');
                $attributes['publication_other'] = request('publication_other');
                $receipt->update($attributes);
                return redirect()->back()->with('success', 'تم التعديل بنجاح !');
            } else if(request('type') == 2) {
                $attributes = request()->validate([
                    'client_name' => ['required'],
                    'about' => ['required'],
                ], [
                    'client_name.required' => 'حقل أسم الأيصال مطلوب ادخاله',
                    'about.required' => 'حقل محتوى الأيصال مطلوب ادخاله',
                ]);
                $attributes['date'] = request('date');
                $receipt->update($attributes);
                return redirect()->back()->with('success', 'تم التعديل بنجاح !');
            }
        } else {
            return redirect()->back();
        }
    }

    public function show(Receipt $receipt) {
        if(request()->has('type')) {
            return view('admin.receipt.show', ['item' => $receipt]);
        } else {
            return redirect()->back();
        }
    }

    // destroy the deal
    public function destroy(Receipt $receipt) {
        $receipt->delete();
        return redirect()->back()->with(['success' => "تم ازالة $receipt->name بنجاح", 'id' => $receipt->id]);
    }
    public function pdf(){
        ini_set('max_execution_time', 0);
        $pdf_list=request('pdf_list');
        if(!isset($pdf_list)){
            return r_backerror('يجب اختيار طلب واحد على الاقل');
            }
        $items=Receipt::whereIn('id',$pdf_list)->latest()->get();
        return view('admin.receipt.pdf.index', ['items' => $items]);
    }

}
