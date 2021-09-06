<?php

namespace App\Http\Controllers;

use App\Models\Jadual;
use App\Models\Rollcall;
use Carbon\Carbon;


use Illuminate\Http\Request;


class JadualController extends Controller
{

    public function index(Request $request)
    {
        $rollcalls = Rollcall::all();

        if($request->ajax()) {
            $datas = Rollcall::all();
            $array = [];
            foreach ($datas as $data) {
                array_push($array, [
                    'id' => $data->id,
                    // 'lokasi' => $data->lokasi,
                    'maklumat'=> $data->maklumat,
                    'title' => $data->tajuk_rollcall,
                    'start' => $data->mula_rollcall->format('Y-m-d'),
                    'end' => $data->akhir_rollcall->format('Y-m-d')
                ]);
            }    
            return response()->json($array);
        }
        return view ('jadual.index',[              
            'rollcalls'=>$rollcalls,  
        ]);        
            
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    
    public function show(Jadual $jadual)
    {
        //
    }
 
    public function edit(Jadual $jadual)
    {
        //
    }

    public function update(Request $request, Jadual $jadual)
    {
        //
    }

    public function destroy(Jadual $jadual)
    {
        //
    }
}
