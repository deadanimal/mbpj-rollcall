<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Rollcall;

use App\Models\User;
use App\Models\Userrollcall;

use Illuminate\Http\Request;
date_default_timezone_set("Asia/Kuala_Lumpur");
class CheckinController extends Controller
{

    public function index()
    {
        // return'test';
        $rollcall = Rollcall::all();
        return $rollcall;
    }


    public function create()
    {
        //
    }

    // public function show(Request $request)
    // {
    // }


    public function store(Request $request)
    {
    //   return $request->data;

        $k=preg_replace('/\s+/', '',$request->data);

        //data = {"data": data}
        $datas = json_decode($k, true);
        // return $datas;

        // $data = $data[0]["IC_NUMBER"];

        //$data = json_decode($request);
        //$data = json_decode($data);
        //$data = json_decode($data);
        //$data = var_dump($request);

        
        foreach($datas as $data) {


        if ($request->check === '1') {


            $checkin = new Checkin;
            $checkin->name = $data["NAME"];
            $checkin->nric = $data["IC_NUMBER"];
            $checkin->gender =  $data["GENDER"];
            $checkin->race =  $data["RACE"];
            $checkin->religion = $data["RELIGION"];
            $checkin->birthdate =  $data["BIRTH_DATE"];
       

            $checkin->checkintime = date('Y/m/d  H:i:s');     
            $checkin->rollcall = $request->rollcall;
            $checkin->save(); 


            //TODO
            //GET
            
            //$user_id = User:where('ic', $checking->nric)->first()->id
            //$ur = userrolcall::where(penguatkuasa_id=user_id)->where('roll_id", $request->rollcall)->first()


            $user_id = User::where('nric', $checkin->nric)->first()->id;
            $ur = Userrollcall::where('penguatkuasa_id','=', $user_id)->where('roll_id',$request->rollcall)->first();

            //UPdate checking time
            $ur->masuk = $checkin->checkintime;
            $ur->save();


        }

        if ($request->check === '2') {
            $checkin = Checkin::where('nric', $data["IC_NUMBER"])->where('rollcall', $request->rollcall)->first();
            $checkin->checkouttime = date('Y/m/d  H:i:s'); 
            $checkin->save();

            
            $user_id = User::where('nric', $checkin->nric)->first()->id;
            $ur = Userrollcall::where('penguatkuasa_id','=', $user_id)->where('roll_id',$request->rollcall)->first();

            //UPdate checking time
            $ur->keluar = $checkin->checkouttime;
            $ur->save();
        }

     }
        
        return $datas;
        // return 'test';

     }

}
