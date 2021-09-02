<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;
use App\Models\Rollcall;
use Carbon\Carbon;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;
        if ($role == 'penguatkuasa') {
            return view ('dashboard.penguatkuasa_dashboard');
        } elseif ($role == 'pentadbir_sistem') {

            $harini = date("Y-m-d");
            $harini =date_create($harini);

            $limabelasharisebelum = date_sub($harini, date_interval_create_from_date_string("3 days"));
            $audits = Audit::where('created_at', '>=', $limabelasharisebelum)->orderBy('created_at','DESC')->get();

            return view ('dashboard.pentadbir_dashboard',[
                'audits' => $audits
            ]);     

            return view ('dashboard.pentadbir_dashboard');
        } elseif ($role == 'penyelia') {
            return view ('dashboard.penyelia_dashboard');
        } elseif ($role == 'ketua_bahagian') {
            return view ('dashboard.ketua_bahagian_dashboard');
        } elseif ($role == 'ketua_jabatan') {
            return view ('dashboard.ketua_jabatan_dashboard');
        } elseif ($role == 'naziran') {

            $rollcalls = Rollcall::all();

            if($request->ajax()) {
                $datas = Rollcall::all();
                $array = [];
                foreach ($datas as $data) {
                    array_push($array, [
                        'id' => $data->id,
                        'lokasi' => $data->lokasi,
                        'title' => $data->tajuk_rollcall,
                        'start' => $data->mula_rollcall->format('Y-m-d'),
                        'end' => $data->akhir_rollcall->format('Y-m-d')
                    ]);
                }    
                return response()->json($array);
            }
            return view ('dashboard.naziran_dashboard',[              
                'rollcalls'=>$rollcalls,  
            ]);
        }    
    }
    
}
