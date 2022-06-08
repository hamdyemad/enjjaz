<?php

namespace App\Http\Controllers\admin;

use App\Deal;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Hamcrest\Core\Set;
use Illuminate\Validation\Rule;

class DealController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:deal-list|deal-create|deal-edit|deal-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:deal-create', ['only' => ['create','store']]);
        $this->middleware('permission:deal-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:deal-destroy', ['only' => ['destroy']]);
    }
    public function index() {
        $deals = Deal::latest()->paginate(15);
        if(request('id')) {
            $deals = Deal::latest()->where('id', '=', request('id'))->paginate(15);
        }
        if(request('name')) {
            $deals = Deal::latest()->where('name', 'like', request('name').'%')->paginate(15);
        }
        if(request('phone')) {
            $deals = Deal::latest()->where('phone', 'like', request('phone').'%')->paginate(15);
        }
        if(request('benefit')) {
            $deals = Deal::latest()->where('benefit', 'like', request('benefit').'%')->paginate(15);
        }
        if(request('beneficiary_name')) {
            $deals = Deal::latest()->where('beneficiary_name', 'like', request('beneficiary_name').'%')->paginate(15);
        }
        if(request('price')) {
            $deals = Deal::latest()->where('price', 'like', request('price').'%')->paginate(15);
        }
        if(request('count')) {
            $deals = Deal::latest()->where('price', 'like', request('price').'%')->paginate(request('count'));
        }
        return view('admin.deal.index', ['deals' => $deals]);
    }

    // return the deal create view
    public function create() {
        return view('admin.deal.create');
    }

    // store the deal
    public function store() {
        $attributes = request()->validate([
            'name' => ['required'],
            'beneficiary_name' => ['required'],
            'price' => ['required'],
            'benefit' => ['required'],
            'phone' => 'required'
        ], [
            'name.required' => 'حقل أسم الصفقة مطلوب ادخاله',
            'price.required' => 'حقل السعر مطلوب ادخاله',
            'benefit.required' => 'حقل الفائدة مطلوب ادخاله',
            'phone.required' => 'حقل الهاتف مطلوب ادخاله',
            'beneficiary_name.required' => 'حقل أسم المستفيد مطلوب ادخاله'
        ]);
        $attributes['notes'] = request()->notes;
        Deal::create($attributes);
        return redirect()->back()->with('success', 'تم أضافة الصفقة بنجاح');

    }

    // get edit information
    public function edit(Deal $deal) {
        return view('admin.deal.edit', ['item' => $deal]);
    }

    // update the edit information

    public function update(Deal $deal) {
        $attributes = request()->validate([
            'name' => ['required', Rule::unique('deals', 'name')->ignore($deal->id)],
            'beneficiary_name' => ['required'],
            'price' => ['required'],
            'benefit' => ['required'],
            'phone' => 'required'
        ], [
            'name.required' => 'حقل أسم الصفقة مطلوب ادخاله',
            'name.unique' => 'هذا الأسم تم أستخدامه من قبل',
            'price.required' => 'حقل السعر مطلوب ادخاله',
            'benefit.required' => 'حقل الفائدة مطلوب ادخاله',
            'phone.required' => 'حقل الهاتف مطلوب ادخاله',
            'beneficiary_name.required' => 'حقل أسم المستفيد مطلوب ادخاله'
        ]);
        $deal->update($attributes);
        return redirect()->back()->with('success', 'تم التعديل بنجاح !');
    }

    public function show(Deal $deal) {
        return view('admin.deal.show', ['item' => $deal]);
    }

    // destroy the deal
    public function destroy(Deal $deal) {
        $deal->delete();
        return redirect()->back()->with(['success' => "تم ازالة $deal->name بنجاح", 'id' => $deal->id]);
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
           $header=view('admin.deal.pdf.header')->__toString();
           $hd->WriteHTML($header,true,0,true,0);
       });
       $lg=Array();
       $lg['a_meta_charset']='UTF-8';
       $lg['a_meta_dir']='rtl';
       $lg['a_meta_language']='ar';
       $lg['w_page']='page';
       $pdf::SetFont('freeserif','',16);
       $pdf::SetLanguageArray($lg);
       $pdf::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, 4);
       $pdf::SetHeaderMargin(PDF_MARGIN_HEADER);
       $pdf::SetPrintHeader(true);
       $pdf::SetPrintFooter(true);
       $pdf::SetAutoPageBreak(True,PDF_MARGIN_BOTTOM);

       $items=Deal::whereIn('id',$pdf_list)->orderby('id','desc')->get();
        $pdf::AddPage();
        $view=view('admin.deal.pdf.index',compact('items'))->__toString();
        $pdf::WriteHTML($view,true,0,true,0);
          $pdf::Output('deals-' . date('Y-M-D-h-m-s') . '.pdf');
    }
}
