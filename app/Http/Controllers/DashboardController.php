<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;
use App\Models\Rollcall;
use App\Models\Userrollcall;
use Illuminate\Support\Facades\DB;


use App\Models\User;

use Carbon\Carbon;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;
        $status =$user->status;
        
        if ($status == 'aktif') {

        if ($role == 'penguatkuasa') {

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
            return view ('dashboard.penguatkuasa_dashboard',[              
                'rollcalls'=>$rollcalls,  
                
            ]);
            // return view ('dashboard.penguatkuasa_dashboard');
        } elseif ($role == 'pentadbir_sistem') {

            $harini = date("Y-m-d");
            $harini =date_create($harini);

            $limabelasharisebelum = date_sub($harini, date_interval_create_from_date_string("3 days"));
            $audits = Audit::where('created_at', '>=', $limabelasharisebelum)->orderBy('created_at','DESC')->get();

            // Card status
            $bilp = DB::table('users')
            ->where('role','=','penguatkuasa')
            ->count();

            $bilt = DB::table('users')
            ->where('role','=','pentadbir_sistem')
            ->count();

            $bilp = DB::table('users')
            ->where('role','=','penyelia')
            ->count();

            $biln = DB::table('users')
            ->where('role','=','naziran')
            ->count();

            $bilkb = DB::table('users')
            ->where('role','=','ketua_bahagian')
            ->count();

            $bilkj = DB::table('users')
            ->where('role','=','ketua_jabatan')
            ->count();


            return view ('dashboard.pentadbir_dashboard',[
                'audits' => $audits,
                'bils' => $bilp,
                'bilt' => $bilp,
                'biln' => $bilp,
                'bilkj' => $bilp,
                'bilkb' => $bilp,
                'bilp' => $bilp,                

            ]);     

            return view ('dashboard.pentadbir_dashboard');
        } elseif ($role == 'penyelia') {

            //Dashboard 
            $rollcalljumlah = DB::table('rollcalls')
            ->count();
            // 
            $rollcallproses = DB::table('rollcalls')
            ->where('status','=','ditangguh')
            ->orwhere('status','=','dibuka')
            ->count();
            // 
            $rollcallselesai = DB::table('rollcalls')
            ->where('status','=','ditutup')
            ->count();


            return view ('dashboard.penyelia_dashboard',[
            'rollcalljumlah'=>$rollcalljumlah,
            'rollcallproses'=>$rollcallproses,
            'rollcallselesai'=>$rollcallselesai
            ]);

        } elseif ($role == 'ketua_bahagian') {
            return view ('dashboard.ketua_bahagian_dashboard');
        } elseif ($role == 'ketua_jabatan') {
            return view ('dashboard.ketua_jabatan_dashboard');
        } elseif ($role == 'naziran') {

            $rollcalls = Rollcall::all();
            
            //Dashboard 
            $rollcalljumlah = DB::table('rollcalls')
            ->count();
            // 
            $rollcallproses = DB::table('rollcalls')
            ->where('status','=','ditangguh')
            ->orwhere('status','=','dibuka')
            ->count();
            // 
            $rollcallselesai = DB::table('rollcalls')
            ->where('status','=','ditutup')
            ->count();


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
            return view ('dashboard.naziran_dashboard',[              
                'rollcalls'=>$rollcalls, 
                'rollcalljumlah'=>$rollcalljumlah,
                'rollcallproses'=>$rollcallproses,
                'rollcallselesai'=>$rollcallselesai

 
                
            ]);
        }   

       }
        else {
            Auth::logout();
            return view('dashboard.inactive');
        }
    }
    
}
