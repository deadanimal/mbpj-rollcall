<?php

namespace App\Http\Controllers;

use App\Models\Rollcall;
use Illuminate\Http\Request;

class RollcallController extends Controller
{
 
    public function index()
    {
        $rollcalls = Rollcall::all();
        return view ('rollcall.index',['rollcalls'=>$rollcalls]);
    }


    public function create()
    {
        return view('rollcall.create');
    }

    public function store(Request $request)
    {
        $rollcall = new Rollcall;

        $mula_rollcall = date("Y-m-d H:i:s", strtotime($request->mula_rollcall));  
        $akhir_rollcall = date("Y-m-d H:i:s", strtotime($request->akhir_rollcall));  
        // $rollcall->staffno = $request-> $staffno;
        $rollcall->mula_rollcall = $mula_rollcall;
        $rollcall->akhir_rollcall = $akhir_rollcall;
        $rollcall->tajuk_rollcall = $request-> tajuk_rollcall; 
        $rollcall->lokasi = $request-> lokasi;
        $rollcall->catatan = $request-> catatan;
        $rollcall->status = $request-> status;
        $rollcall->pegawai_sokong_id = $request-> pegawai_sokong_id;
        $rollcall->pegawai_lulus_id = $request-> pegawai_lulus_id;

        $rollcall->save();

        $redirected_url= '/rollcalls/';
        return redirect($redirected_url);
    }


  
    public function show(Rollcall $rollcall)
    {
        return view('rollcall.edit',[
            'rollcall'=> $rollcall,
        ]);
    }

    public function edit(Rollcall $rollcall)
    {
        return view('rollcall.edit',[
            'rollcall'=> $rollcall,
        ]);
    }

    public function update(Request $request, Rollcall $rollcall)
    {
        if($request->mula_rollcall) {
            $mula_rollcall = $request->mula_rollcall;    
            $rollcall->mula_rollcall = date("Y-m-d H:i:s", strtotime($request->mula_rollcall));  
        }

        if($request->akhir_rollcall) {
            $akhir_rollcall = $request->akhir_rollcall;    
            $rollcall->akhir_rollcall = date("Y-m-d H:i:s", strtotime($request->akhir_rollcall));  
        }        
        // $rollcall->staffno = $request-> staffno;
        $rollcall->tajuk_rollcall = $request-> tajuk_rollcall;
        $rollcall->lokasi = $request-> lokasi;
        $rollcall->catatan = $request-> catatan;
        $rollcall->status = $request-> status;
        $rollcall->pegawai_sokong_id = $request-> pegawai_sokong_id;
        $rollcall->pegawai_lulus_id = $request-> pegawai_lulus_id;

        $rollcall->save();

        $redirected_url= '/rollcalls/';
        return redirect($redirected_url);        
    }


    public function destroy(Rollcall $rollcall)
    {
        //
    }
}
