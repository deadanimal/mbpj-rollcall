<?php

namespace App\Http\Controllers;

use App\Models\Rekod;
use App\Models\Checkin;
use App\Models\Rollcall;

date_default_timezone_set("Asia/Kuala_Lumpur");


use Illuminate\Http\Request;

class RekodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekod = Checkin::all();

        //cari nama pegawai dekat KJ and KB
        foreach ($rekod as $nr){
            $nama_rollcall = Rollcall::where("id", $nr ->rollcall)->first()->tajuk_rollcall;
            $nr->nama_rollcall = $nama_rollcall;

        }

        return view ('kedatangan.show',[
        'rekod'=>$rekod,

        ]);  
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
     * @param  \App\Models\Rekod  $rekod
     * @return \Illuminate\Http\Response
     */
    public function show(Rekod $rekod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rekod  $rekod
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekod $rekod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rekod  $rekod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekod $rekod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rekod  $rekod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $checkin)
    {

            $checkin = Checkin::where('id','=',$checkin)->first();
        {
           
           
            if($checkin)
            {
                if($checkin->delete()){
    
                        // Audit trail
                        $audit = new Audit;
                        $audit->user_id = $request->user()->id;
                        $audit->name = $request->user()->name;
                        $audit->peranan = $request->user()->role;
                        $audit->nric =$request->user()->nric;
                        $audit->description = 'Hapus Kakitangan: '.$rekod->penguatkuasa->name;
                        $audit->save(); 
                        
    
                  $redirected_url= '/rekod/';
                  return redirect($redirected_url);  
                  }
             else{
                return "something wrong";
                 }     
                    }
                else{
                    return " not exist";
                    }       
        }
    }
}
