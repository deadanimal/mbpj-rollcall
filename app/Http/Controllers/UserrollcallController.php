<?php

namespace App\Http\Controllers;

use App\Models\Userrollcall;
use Illuminate\Http\Request;

class UserrollcallController extends Controller
{
    public function index() {  

        // $userrollcalls = Userrollcalls::all();
        // return view ('rollcall.edit',[
        //     'userrollcalls'=>$userrollcalls
        //     ]);
        $userrollcalls = Userrollcall::all();
        return view('rollcall.edit',[
            'userrollcalls'=> $userrollcalls,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Userrollcall.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'addMoreInputFields.*.penguatkuasa_id' => 'required'

        // ]);
        // dd($request);
        $userrollcall = new Userrollcall;
        $userrollcall->roll_id = $request['roll_id'];
        $userrollcall->penguatkuasa_id = $request->penguatkuasa_id;

        $userrollcall -> save();

        if( $request->addMoreInputFields) {
            foreach ($request->addMoreInputFields as $key => $value) {

                $userrollcall = new Userrollcall;
                
                $userrollcall->roll_id = $request->roll_id;
                $userrollcall->penguatkuasa_id = $value['penguatkuasa_id'];
    
                $userrollcall -> save();            
            }
        } 
        return back()->with('success', 'Kakitangan Berjaya Ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Userrollcall  $userrollcall
     * @return \Illuminate\Http\Response
     */
    public function show(Userrollcall $userrollcall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Userrollcall  $userrollcall
     * @return \Illuminate\Http\Response
     */
    public function edit(Userrollcall $userrollcall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Userrollcall  $userrollcall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userrollcall $userrollcall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Userrollcall  $userrollcall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Userrollcall $userrollcall)
    {
     
        if($userrollcall)
        {
            if($userrollcall->delete()){

              $redirected_url= '/rollcalls/';
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
