<?php

namespace App\Http\Controllers;

use App\Models\Kumpulan;
use Illuminate\Http\Request;

class KumpulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kumpulan = Kumpulan::all();
        return view ('kumpulan.index',[
            'kumpulan'=>$kumpulan,
    ]);

    }

    public function create()
    {
        return view('kumpulan.create');
    }


    public function store(Request $request)
    {
        $kumpulan = new Kumpulan;
        $kumpulan->nama_kumpulan = $request-> nama_kumpulan;
        $kumpulan->save();

        $redirected_url= '/kumpulan/';
        return redirect($redirected_url);
    }

    public function show(Kumpulan $kumpulan)
    {
        //
    }


    public function edit(Kumpulan $kumpulan)
    {
        return view('kumpulan.edit',[
            'kumpulan'=>$kumpulan,

        ]);

    }

    public function update(Request $request, Kumpulan $kumpulan)
    {
        $kumpulan->nama_kumpulan = $request->nama_kumpulan;
        $kumpulan->save();

        $redirected_url= '/kumpulan/';
        return redirect($redirected_url); 
    }


    public function destroy(Kumpulan $kumpulan,Request $request)
    {
     
        if($kumpulan)
        {
            if($kumpulan->delete()){


              $redirected_url= '/kumpulan/';
              return redirect($redirected_url)->with('buang');;  
              }
         else{
            return "something wrong";
             }     
                }
            else{
                return "roll call not exist";
                }    
                   
    }
}
