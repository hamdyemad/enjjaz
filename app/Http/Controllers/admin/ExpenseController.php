<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Expense;
use App\Employee;
use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\Validator;
use Elibyy\TCPDF\Facades\TCPDF;

class ExpenseController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('permission:expense-list|expense-create|expense-edit|expense-destroy', ['only' => ['index','store','home']]);
        $this->middleware('permission:expense-create', ['only' => ['create','store']]);
        $this->middleware('permission:expense-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:expense-destroy', ['only' => ['destroy']]);
    }
    //

    public function home(){
        return view('admin.expense.home');
    }

    public function index(){
        if(request()->has('type')) {
            $items = Expense::where('type', request('type'))->paginate(15);
            if(request('title')){
                $items =  Expense::where('title', 'like', request('title') . '%')->paginate(15);
            }
            if(request('employee_id')){
                $items =  Expense::where('employee_id', 'like', request('employee_id'). '%')->paginate(15);
            }
            if(request('count')) {
            $items = Expense::where('type', request('type'))->paginate(request('count'));

            }
            $employees0=Employee::where('type','0')->pluck('name','id')->all();
            $employees1=Employee::where('type','1')->pluck('name','id')->all();
            $items->appends(['type' => request('type')]);
            return view('admin.expense.index',compact('items','employees0','employees1'));
        } else {
            return redirect()->back();
        }
    }

    public function create(){
        $employees0=Employee::where('type','0')->pluck('name','id')->all();
        $employees1=Employee::where('type','1')->pluck('name','id')->all();
        return view('admin.expense.create',compact('employees0','employees1'));

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'title' => 'required',
            'date' => 'required',
            'price' => 'required|numeric',
        ]);
        $niceNames = [
            'title' => 'نوع المكافأة ',
            'price' => 'الميزانية ',
            'date' => 'التاريخ ',
        ];
        if($request->month_iteration > 0 || $request->month_iteration !== null) {
            for($num = 0; $num < $request->month_iteration; $num++) {
                $newDate =  date('Y-m-d' ,strtotime($request->date . " +". "$num" ."month"));
                Expense::create([
                    'type' => $request->type,
                    'title' => $request->title,
                    'price' => $request->price,
                    'notes' => $request->notes,
                    'month_iteration' => 0,
                    'date' => $newDate
                ]);
            }
            $validator->setAttributeNames($niceNames);
            if ($validator->fails()){
                $err=$validator->errors()->first();
                return r_backerror($err);
            }
            return r_back();
        }
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        Expense::create($input);
        return r_back();
    }

    public function edit($id)
    {
        $item=Expense::find($id);
        $employees0=Employee::where('type','0')->pluck('name','id')->all();
        $employees1=Employee::where('type','1')->pluck('name','id')->all();
        return view('admin.expense.edit',compact('item','employees0','employees1'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'title' => 'required',
            'date' => 'required',
            'price' => 'required|numeric',
        ]);
        $niceNames = [
            'title' => 'نوع المكافأة ',
            'price' => 'الميزانية ',
            'date' => 'التاريخ ',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        $new = Expense::find($id);
        $new->update($input);
        $new->save();
        return r_back();

    }

    public function destroy($id)
    {
        $item=Expense::find($id);
        if(isset($item)){
            Expense::destroy($id);
        }
        return r_back();
    }

    public function pdfAllExpense() {
        $employeeCountPrice=Expense::where('type','0')->pluck('price')->sum();
        $designersCountPrice = Expense::where('type','1')->pluck('price')->sum();
        $monthCountPrice = Expense::where('type','2')->pluck('price')->sum();
        $relatedCountPrice = Expense::where('type','3')->pluck('price')->sum();
        $counted = $employeeCountPrice + $designersCountPrice + $monthCountPrice + $relatedCountPrice;
        $expenses = [
            [
                "expenseOwner" => "مصروفات الموظفين",
                "expense" => $employeeCountPrice
            ],
            [
                "expenseOwner" => "مصروفات المصممين",
                "expense" => $designersCountPrice
            ],
            [
                "expenseOwner" => "التزامات شهرية",
                "expense" => $monthCountPrice
            ],
            [
                "expenseOwner" => "مصروفات اخرى",
                "expense" => $relatedCountPrice
            ]
        ];
        ini_set('max_execution_time', 0);
       $pdf=new TCPDF();
       $pdf::setHeaderCallback(function($hd){
           $hd->SetFont('freeserif','B',22);
           $header=view('admin.expense.pdf-all.header')->__toString();
           $hd->WriteHTML($header,true,0,true,0);
       });

       $pdf::setFooterCallback(function ($fo){
           $setting=Setting::first();
        //    $fo->SetY(-50);
           $fo->SetFont('freeserif','B',14);
           $footer=view('admin.expense.pdf-all.footer',compact('fo','setting'))->__toString();
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
        $view=view('admin.expense.pdf-all.index',compact('expenses', 'counted'))->__toString();
        $pdf::WriteHTML($view,true,0,true,0);
        $pdf::Output('all-expenses-' . date('Y-M-D-h-m-s') . '.pdf');
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
           $header=view('admin.expense.pdf.header', ['type' => request('type')])->__toString();
           $hd->WriteHTML($header,true,0,true,0);
       });

       $pdf::setFooterCallback(function ($fo){
           $setting=Setting::first();
        //    $fo->SetY(-50);
           $fo->SetFont('freeserif','B',14);
           $footer=view('admin.expense.pdf.footer',compact('fo','setting'))->__toString();
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

       $items=Expense::whereIn('id',$pdf_list)->orderby('id','desc')->get();
       $type = request('type');
        $pdf::AddPage();
        $view=view('admin.expense.pdf.index',compact('items', 'type'))->__toString();
        $pdf::WriteHTML($view,true,0,true,0);
        $pdf::Output('expenses-' . date('Y-M-D-h-m-s') . '.pdf');
    }
}
