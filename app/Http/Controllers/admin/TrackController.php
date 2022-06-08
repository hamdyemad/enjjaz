<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Setting;
use App\Track;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
class TrackController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:track-list|track-create|track-edit|track-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:track-create', ['only' => ['create','store']]);
        $this->middleware('permission:track-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:track-destroy', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home() {
        return view('admin.tracks.home');
    }
    public function index() {
        if(request('type') == 0) {
            $tracks = Track::where('type', '0')->latest()->paginate(15);
            if(request('id')) {
                $tracks = Track::where('type', '0')->where('id', request('id'))->latest()->paginate(15);
            }
            if(request('before') && request('count')) {
                $tracks = Track::whereBetween('date', [request('before'), now()])->latest()->paginate(request('count'));
            }
            if(request('count')) {
                $tracks = Track::latest()->paginate(request('count'));
            }
            if(request('number')) {
                $tracks = Track::where('number', 'like' , request('number') . '%')->latest()->paginate(15);
            }
            if(request('address')) {
                $tracks = Track::where('address', 'like' , request('address') . '%')->latest()->paginate(15);
            }
            if(request('before') && request('after') && request('count')) {
                $tracks = Track::whereBetween('date', [request('before'), request('after')])->latest()->paginate(request('count'));
            }
            if(request('client')) {
                $tracks = Track::where('type', '0')->where('client', 'like',request('client') . '%')->latest()->paginate(15);
            }
            return view('admin.tracks.index', ['tracks' => $tracks]);
        }
        if(request('type') == 1) {
            $tracks = Track::where('type', '1')->latest()->paginate(15);
            if(request('count')) {
                $tracks = Track::latest()->paginate(request('count'));
            }
            if(request('id')) {
                $tracks = Track::where('type', '1')->where('id', request('id'))->latest()->paginate(15);
            }
            if(request('client')) {
                $tracks = Track::where('type', '1')->where('client', 'like',request('client') . '%')->latest()->paginate(15);
            }
            return view('admin.tracks.index', ['tracks' => $tracks]);
        }
    }

    // return the deal create view
    public function create() {
        if(request()->has('type')) {
            return view('admin.tracks.create');
        } else {
            return redirect()->back();
        }
    }

    // store the deal
    public function store() {
        if(request()->has('type')) {
            $attributes = request()->validate([
                'client' => ['required'],
                'price' => ['required','numeric']
            ], [
                'client.required' => 'حقل أسم الشركة مطلوب ادخاله',
                'price.required' => 'حقل السعر مطلوب ادخاله'
            ]);
            $attributes['notes'] = request('notes');
            $attributes['shipping'] = request('shipping');
            $attributes['type'] = request('type');
            if(request('type') == 0) {
                $attributes['number'] = request('number');
                $attributes['count'] = request('count');
                $attributes['address'] = request('address');
                $attributes['date'] = request('date');
            } else if(request('type') == 1) {
                $attributes['days_count'] = request('days_count');
                $attributes['about_period'] = request('about_period');
            }
            Track::create($attributes);
            return redirect()->back()->with('success', 'تم أضافة الطلب بنجاح');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        if(request()->has('type')) {
            return view('admin.tracks.show', ['item' => $track]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        return view('admin.tracks.edit', ['item' => $track]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function update(Track $track)
    {
        if(request()->has('type')) {
            $attributes = request()->validate([
                'client' => ['required'],
                'price' => ['required', 'numeric']
            ], [
                'client.required' => 'حقل أسم الشركة مطلوب ادخاله',
                'price.required' => 'حقل السعر مطلوب ادخاله'
            ]);
            $attributes['notes'] = request('notes');
            $attributes['shipping'] = request('shipping');
            $attributes['type'] = request('type');
            if(request('type') == 0) {
                $attributes['number'] = request('number');
                $attributes['count'] = request('count');
                $attributes['address'] = request('address');
                $attributes['date'] = request('date');
            } else if(request('type') == 1) {
                $attributes['days_count'] = request('days_count');
                $attributes['about_period'] = request('about_period');
            }
            $track->update($attributes);
            return redirect()->back()->with('success', 'تم التعديل بنجاح !');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        $track->delete();
        return redirect()->back()->with(['success' => "تم ازالة $track->name بنجاح", 'id' => $track->id]);
    }

    // pdf
    public function pdf(){
        ini_set('max_execution_time', 0);
        $pdf_list=request('pdf_list');
        if(!isset($pdf_list)){
            return r_backerror('يجب اختيار طلب واحد على الاقل');
        }
        $pdf=new TCPDF();
        $pdf::setHeaderCallback(function($hd){
            $hd->SetFont('freeserif','B',22);
            $header=view('admin.tracks.pdf.header')->__toString();
            $hd->WriteHTML($header,true,0,true,0);
        });

        $pdf::setFooterCallback(function ($fo){
            $setting=Setting::first();
            // $fo->SetY(-50);
            $fo->SetFont('freeserif','B',14);
            $footer=view('admin.tracks.pdf.footer',compact('fo','setting'))->__toString();
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
        $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf::SetPrintHeader(true);
        $pdf::SetPrintFooter(true);
        $pdf::SetAutoPageBreak(True,PDF_MARGIN_BOTTOM);


        $items=Track::whereIn('id',$pdf_list)->orderby('id','desc')->get();
        $pdf::AddPage();
        $view=view('admin.tracks.pdf.index',compact('items'))->__toString();
        $pdf::WriteHTML($view,true,0,true,0);

        if($items->count() == 1) {
        $pdf::Output($items[0]->id . '.pdf');
        } else {
            $pdf::Output('tracks-' . date('Y-M-D-h-m-s') . '.pdf');
        }
    }
}
