<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:expense-list|expense-create|expense-edit|expense-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:expense-create', ['only' => ['create','store']]);
        $this->middleware('permission:expense-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:expense-destroy', ['only' => ['destroy']]);
    }
    //
    public function index(){
        $items = new Employee();
        if(request('name')){
            $items = $items->where('name', 'like', '%' . request('name') . '%');
        }
        if(request('type') != null){
            $items = $items->where('type', request('type') );
        }        
        $items = $items->latest()->paginate(15);
        return view('admin.employee.index',compact('items'));
    }

    public function create(){
        return view('admin.employee.create');

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required',
        ]);
        $niceNames = [
            'name' => 'الاسم ',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        $new=Employee::create($input);
        return r_back();
    }

    public function edit($id)
    {
        $item=Employee::find($id);
        return view('admin.employee.edit',compact('item'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required',
        ]);
        $niceNames = [
            'name' => 'الاسم ',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        $new = Employee::find($id);
        $new->update($input);
        $new->save();
        return r_back();

    }

    public function destroy($id)
    {
        $item=Employee::find($id);
        if(isset($item)){
            Employee::destroy($id);
        }
        return r_back();
    }
}
