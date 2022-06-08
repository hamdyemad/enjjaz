<?php

namespace App\Http\Controllers\admin;

use App\AdminLog;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class admin_logcont extends Controller
{
    //

    function __construct()
    {
        $this->middleware('permission:log-list');
    }

    public function index($id){
        $user=User::find($id);
        $items=AdminLog::where('user_id',$id)->orderby('id','desc')->paginate(c_page());
        return view('admin.admin_log.index',compact('items','user','id'));
    }

    public function search(Request $request,$id){
        $user=User::find($id);
        $fromdate=$request->get('from');
        $todate=$request->get('to');
        $stfrom=strtotime($fromdate);
        $stto=strtotime($todate);

        if ($fromdate != ''){
            $from=date('Y-m-d',$stfrom);
        }
        if ($todate != ''){
            $to=date('Y-m-d',$stto);
        }
        if (isset($from) && isset($to)){
            $items=AdminLog::where('user_id',$id)->whereBetween('created_at',[$from,$to])->orderby('id','desc')->paginate(c_page());
        }

        if (isset($from) && !isset($to)){
            $items=AdminLog::where('user_id',$id)->where('created_at','>=',$from)->orderby('id','desc')->paginate(c_page());
        }

        if (!isset($from) && isset($to)){
            $items=AdminLog::where('user_id',$id)->where('created_at','<=',$to)->orderby('id','desc')->paginate(c_page());
        }

        return view('admin.admin_log.index',compact('items','user','id','fromdate','todate'));
    }
}
