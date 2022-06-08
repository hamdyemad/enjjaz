<?php

namespace App\Http\Controllers\admin;

use App\Expense;
use App\Http\Controllers\Controller;
use App\Publication;
use App\Product;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Elibyy\TCPDF\Facades\TCPDF;

class PublicationController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:publication-list|publication-create|publication-edit|publication-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:publication-create', ['only' => ['create','store']]);
        $this->middleware('permission:publication-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:publication-destroy', ['only' => ['destroy']]);
    }
    //

    public function home() {
        return view('admin.publication.home');
    }

    public function getPublication($type = '0', $product = true) {
        $items = Publication::orderBy('order_number')->where('type', $type)->paginate(15);
        if($product) {
            if(request('product_id')){
                $items = Publication::orderBy('order_number')->where('type', $type)->where('product_id',request('product_id'))->paginate(15);
            }
        } else {
            if(request('product_id')){
                $items = Publication::orderBy('order_number')->where('type', $type)->where('product_id','like',request('product_id') . '%')->paginate(15);
            }
        }
        if(request('count')) {
            $items = Publication::orderBy('order_number')->where('type', $type)->where('product_id','like',request('product_id') . '%')->paginate(request('count'));
        }
        if($type == 2) {
            if(request('client_name')) {
                $items = Publication::orderBy('order_number')->where('type', $type)->where('client_name','like',request('client_name') . '%')->paginate(15);
            }
        }
        $items->appends(['type' => request('type')]);
        $products=Product::orderBy('order_number')->get();
        return view('admin.publication.index',compact('items','products'));
    }
    public function index(){
        if(request()->has('type')) {
            if(request('type') == '0') {
                return $this->getPublication('0');
            } else if (request('type') == '1') {
                return $this->getPublication('1', false);
            } else if(request('type') == '2') {
                return $this->getPublication('2');
            }
        }

    }

    public function create(){
        if(request()->has('type')) {
            $products=Product::orderBy('order_number')->get();
            if(request('type') == 0 || request('type') == 2) {
                return view('admin.publication.create',compact('products'));
            } else if(request('type') == 1) {
                return view('admin.publication.create');
            }
        } else {
            return redirect()->back();
        }

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
           // 'product_id' => 'required',
            'price' => 'required|numeric',
            'date' => 'required'
        ], [
            'date.required' => 'حقل التاريخ مطلوب'
        ]);
        $niceNames = [
           // 'product_id' => 'اسم الكتاب',
            'price' => 'سعر الطبعة',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        if(request('product_id') == null){
            $input['product_id']=request('product_id2');
        }
        Publication::create($input);
        return r_back();
    }

    public function edit($id)
    {
        $item=Publication::find($id);
        $products=Product::orderBy('order_number')->get();
        return view('admin.publication.edit',compact('item','products'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'product_id' => 'required',
            'price' => 'required|numeric',
        ]);
        $niceNames = [
            'product_id' => 'اسم الكتاب',
            'price' => 'سعر الطبعة',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();

        $new = Publication::find($id);
        $new->update($input);
        $new->save();
        return r_back();

    }

    public function destroy($id)
    {
        $item=Publication::find($id);
        if(isset($item)){
            Publication::destroy($id);
        }
        return r_back();
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
            $header=view('admin.publication.pdf.header')->__toString();
            $hd->WriteHTML($header,true,0,true,0);
        });

        $pdf::setFooterCallback(function ($fo){
            $setting=Setting::first();
            //    $fo->SetY(-50);
            $fo->SetFont('freeserif','B',14);
            $footer=view('admin.publication.pdf.footer',compact('fo','setting'))->__toString();
            $fo->WriteHTML($footer,true,0,true,0);
        });
        $lg=Array();
        $lg['a_meta_charset']='UTF-8';
        $lg['a_meta_dir']='rtl';
        $lg['a_meta_language']='ar';
        $lg['w_page']='page';
        $pdf::SetFont('freeserif','',16);
        $pdf::SetLanguageArray($lg);

        $pdf::SetMargins(2,PDF_MARGIN_TOP,2,2);
        $pdf::SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf::SetPrintHeader(true);
        $pdf::SetPrintFooter(true);
        $pdf::SetAutoPageBreak(True,PDF_MARGIN_BOTTOM);

        $items=Publication::whereIn('id',$pdf_list)->orderby('order_number')->get();
            $pdf::AddPage();
            $view=view('admin.publication.pdf.index',compact('items'))->__toString();
            $pdf::WriteHTML($view,true,0,true,0);
            $pdf::Output('publication-' . date('Y-M-D-h-m-s') . '.pdf');
    }

    public function pdfAllExpense() {
            $publicationsAboutBooks=Publication::where('type','0')->pluck('total_price')->sum();
            $otherPublications=Publication::where('type','1')->pluck('total_price')->sum();
            $clientPublications=Publication::where('type','2')->pluck('total_price')->sum();
            $counted = $publicationsAboutBooks + $otherPublications + $clientPublications;
            $publicationExpenses = [
                [
                    "expenseOwner" => "السعر الكلى لمطبوعات الكتب",
                    "expense" => $publicationsAboutBooks
                ],
                [
                    "expenseOwner" => "السعر الكلى للمطبوعات الأخرى",
                    "expense" => $otherPublications
                ],
                [
                    "expenseOwner" => "السعر الكلى لمطبوعات العملاء",
                    "expense" => $clientPublications
                ]
            ];
            ini_set('max_execution_time', 0);
           $pdf=new TCPDF();
           $pdf::setHeaderCallback(function($hd){
               $hd->SetFont('freeserif','B',22);
               $header=view('admin.publication.pdf.header')->__toString();
               $hd->WriteHTML($header,true,0,true,0);
           });

           $pdf::setFooterCallback(function ($fo){
               $setting=Setting::first();
            //    $fo->SetY(-50);
               $fo->SetFont('freeserif','B',14);
               $footer=view('admin.publication.pdf.footer',compact('fo','setting'))->__toString();
               $fo->WriteHTML($footer,true,0,true,0);
           });
           $lg=Array();
           $lg['a_meta_charset']='UTF-8';
           $lg['a_meta_dir']='rtl';
           $lg['a_meta_language']='ar';
           $lg['w_page']='page';
           $pdf::SetFont('freeserif','',16);
           $pdf::SetLanguageArray($lg);

           $pdf::SetMargins(2,PDF_MARGIN_TOP,2,2);
           $pdf::SetHeaderMargin(PDF_MARGIN_HEADER);
           $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);
           $pdf::SetPrintHeader(true);
           $pdf::SetPrintFooter(true);
           $pdf::SetAutoPageBreak(True,PDF_MARGIN_BOTTOM);
            $pdf::AddPage();
            $view=view('admin.publication.pdf.pdf-all',compact('publicationExpenses', 'counted'))->__toString();
            $pdf::WriteHTML($view,true,0,true,0);
            $pdf::Output('all-publications-' . date('Y-M-D-h-m-s') . '.pdf');
    }


}
