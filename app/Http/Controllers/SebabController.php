<?php

namespace App\Http\Controllers;

use App\Models\Sebab;
use Illuminate\Http\Request;

class SebabController extends Controller
{
 
    public function index()
    {
        $sebab = Sebab::all();
        return view ('sebab.index',[
            'sebab'=>$sebab
    ]);

    }
    public function create()
    {
        return view('sebab.create');
    }


    public function store(Request $request)
    {
        $sebab = new Sebab;
        $sebab->sebab = $request-> sebab;
        $sebab->save();

        $redirected_url= '/sebab/';
        return redirect($redirected_url);
    }


    public function show(Sebab $sebab)
    {
        //
    }


    public function edit(Sebab $sebab)
    {
        return view('sebab.edit',[
            'sebab'=>$sebab,

        ]);

    }

    public function update(Request $request, Sebab $sebab)
    {
        $sebab->sebab = $request->sebab;
        $sebab->save();

        $redirected_url= '/sebab/';
        return redirect($redirected_url); 
    }


    public function destroy(Sebab $sebab,Request $request)
    {
     
        if($sebab)
        {
            if($sebab->delete()){


              $redirected_url= '/sebab/';
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
