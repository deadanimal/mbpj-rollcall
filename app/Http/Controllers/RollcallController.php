<?php

namespace App\Http\Controllers;

use App\Models\Rollcall;
use App\Models\Userrollcall;
use App\Models\Audit;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;



use Illuminate\Http\Request;

class RollcallController extends Controller
{

    public function index(Request $request , Rollcall $rollcall)
    {
        $users = User::all();

        // Card status
        $dibuka = DB::table('rollcalls')
        ->where('status','=','dibuka')
        ->count();
        // Card status
        $ditangguh = DB::table('rollcalls')
        ->where('status','=','ditangguh')
        ->count();
        // Card status
        $ditutup = DB::table('rollcalls')
        ->where('status','=','ditutup')
        ->count();

        $harini = date("Y-m-d");
        $harini =date_create($harini);
        $hari = date_sub($harini, date_interval_create_from_date_string("30 days"));

        // Kakitangan 
        //rollcall sokong --------------------------------------------------------------------------------
        $user_id = $request->user()->id;  

        // $rollcall_sokong = Userrollcall::where('pegawai_sokong_id', $user_id)
        // ->orderByDesc("created_at")
        // ->get();

        $rollcall_sokong_baru = Rollcall::join('userrollcalls','rollcalls.id','=','userrollcalls.roll_id')
        ->select('rollcalls.*', 'userrollcalls.*')
        ->where('userrollcalls.pegawai_sokong_id', $user_id)
        ->get();

        //cari nama pegawai dekat KJ and KB
        foreach ($rollcall_sokong_baru as $psn){
            $rollcall_sokong_name = User::where("id", $psn ->pegawai_sokong_id)->first()->name;
            $psn->pegawai_sokong_name = $rollcall_sokong_name;
            $pemohon = User::where("id", $psn ->penguatkuasa_id)->first()->name;
            $psn->nama_pemohon = $pemohon;
        }

        foreach ($rollcall_sokong_baru as $pln){
            $rollcall_sokong_name = User::where("id", $pln ->pegawai_lulus_id)->first()->name;
            $pln->pegawai_lulus_name = $rollcall_sokong_name;
            $pemohon = User::where("id", $pln ->penguatkuasa_id)->first()->name;
            $pln->nama_pemohon = $pemohon;
        }

        //rollcall lulus --------------------------------------------------------------------------------
        // $rollcall_lulus = Userrollcall::where('pegawai_lulus_id', $user_id)
        // ->orderByDesc("created_at")
        // ->get();

        $rollcall_lulus_baru = Rollcall::join('userrollcalls','rollcalls.id','=','userrollcalls.roll_id')
        ->select('rollcalls.*', 'userrollcalls.*')
        ->where('userrollcalls.pegawai_lulus_id', $user_id)
        ->get();

        foreach ($rollcall_lulus_baru as $psn){
            $rollcall_lulus_name = User::where("id", $psn ->pegawai_sokong_id)->first()->name;
            $psn->pegawai_sokong_name = $rollcall_sokong_name;
            $pemohon = User::where("id", $psn ->penguatkuasa_id)->first()->name;
            $psn->nama_pemohon = $pemohon;
        }

        foreach ($rollcall_lulus_baru as $pln){
            $rollcall_lulus_name = User::where("id", $pln ->pegawai_lulus_id)->first()->name;
            $pln->pegawai_lulus_name = $rollcall_lulus_name;
            $pemohon = User::where("id", $pln ->penguatkuasa_id)->first()->name;
            $pln->nama_pemohon = $pemohon;

        }

        // dd($rollcall_sokong);

        $rollcalls = Rollcall::where('created_at', '>=', $hari)
        ->orderBy('created_at','DESC')
        ->get();

         //cari nama pegawai dekat KJ and KB
        foreach ($rollcalls as $ps){
            $pegawai_sokong = User::where("id", $ps ->pegawai_sokong_id)->first()->name;
            $ps->pegawai_sokong = $pegawai_sokong;
        }

        foreach ($rollcalls as $ps){
            $pegawai_lulus = User::where("id", $ps ->pegawai_lulus_id)->first()->name;
            $ps->pegawai_lulus = $pegawai_lulus;
        }
        // foreach ($rollcalls as $gk){
        //     $userrollcall = Userrollcall::where("id", $gk ->roll_id)->first();
        //     $gk->roll_id = $roll_id;
        // }

        // $roll_id = $request->$userrollcall->roll_id;  
        
        $rollcallsnew = Rollcall::join('userrollcalls','rollcalls.id','=','userrollcalls.roll_id')
        ->select('rollcalls.*', 'userrollcalls.*')
        // ->where('rollcalls.id', $roll_id)
        ->get();

        foreach ($rollcallsnew as $gpn){
            $penguatkuasa = User::where("id", $gpn ->penguatkuasa_id)->first()->name;
            $gpn->penguatkuasa = $penguatkuasa;
        }
        

        // dd($rollcallsnew);


        //get waktu masuk keluar dari phone
        $rollcall_id = Userrollcall::where('penguatkuasa_id', Auth::user()->id)->get();
        $userrollcalls = [];

        // dd($rollcallObj);
        foreach($rollcall_id as $rid) {
            //array_push($userrollcalls, RollCall::where('id', $rid->roll_id)->first());
            $rollcallObj = RollCall::where('id', $rid->roll_id)->first();
            $rollcallObj->userrollcall_id = $rid->id;

            // dd($rollcallObj);
            $rollcallObj->masuk = $rid->masuk;
            $rollcallObj->keluar = $rid->keluar;
            //  Create pegawai name
            $rollcallObj->pegawai_sokong_name = User::where('id',$rollcallObj->pegawai_sokong_id)->first()->name;
            $rollcallObj->pegawai_lulus_name = User::where('id',$rollcallObj->pegawai_lulus_id)->first()->name;
            //get status
            $rollcallObj->sokong = $rid->sokong;
            $rollcallObj->lulus = $rid->lulus;

            //get status
            $rollcallObj->keterangan = $rid->keterangan;
                    // dd($rollcallObj);


            //  keterangan
            try {
                $rollcallObj->keterangan= Userrollcall::where('id',$rollcallObj->id)->first()->keterangan;
                $rollcallObj->lampiran = Userrollcall::where('id',$rollcallObj->id)->first()->file_path;
            } catch (Exception $e) {
            }

            array_push($userrollcalls, $rollcallObj);
        }

        //dd($userrollcalls);
    

        return view ('rollcall.index',[
            'rollcalls'=>$rollcalls, 
            'rollcallsnew'=>$rollcallsnew,  
 
            'users'=>$users,
            'dibuka'=>$dibuka,
            'ditangguh'=>$ditangguh,
            'ditutup'=>$ditutup,

            'userrollcalls'=>$userrollcalls,    
            // 'rollcall_sokong'=> $rollcall_sokong,
            // 'rollcall_lulus'=> $rollcall_lulus,
            'rollcall_lulus_baru'=>$rollcall_lulus_baru,
            'rollcall_sokong_baru'=>$rollcall_sokong_baru,


         
 
    ]);

    }

    public function create()
    {

        $pegawai = User::whereIn('role', array('penyelia','ketua_bahagian','ketua_jabatan'))->get();     

        return view('rollcall.create',[
            'pegawai'=>$pegawai,

        ]);
    
    }

    public function store(Request $request)
    {
        $rollcall = new Rollcall;
        $mula_rollcall = date("Y-m-d H:i:s", strtotime($request->mula_rollcall));  
        $akhir_rollcall = date("Y-m-d H:i:s", strtotime($request->akhir_rollcall));  
        $rollcall->mula_rollcall = $mula_rollcall;
        $rollcall->akhir_rollcall = $akhir_rollcall;
        $rollcall->tajuk_rollcall = $request-> tajuk_rollcall; 
        $rollcall->lokasi = $request-> lokasi;
        $rollcall->catatan = $request-> catatan;
        $rollcall->status = $request-> status;
        $rollcall->pegawai_sokong_id = $request-> pegawai_sokong_id;
        $rollcall->pegawai_lulus_id = $request-> pegawai_lulus_id;
        $rollcall->maklumat = $request-> maklumat;
        $rollcall->save();

        // Audit trail
        $audit = new Audit;
        $audit->user_id = $request->user()->id;
        $audit->name = $request->user()->name;
        $audit->peranan = $request->user()->role;
        $audit->nric =$request->user()->nric;
        $audit->description = 'Tambah Roll Call Tajuk: '.$rollcall->tajuk_rollcall;
        $audit->save(); 

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

        // Create  option on select penguatkuasa in tambah
        $kakitangan = User::whereIn('role', array('penguatkuasa'))->get(); 

        // Create  option on select penguatkuasa addmore
        $users = User::whereIn('role', array('penguatkuasa'))->get();     
 
        // Create  option on select pegawai 
        $pegawai = User::whereIn('role', array('penyelia','ketua_bahagian','ketua_jabatan'))->get(); 

        //  Create pegawai name
        $pegawai_sokong = User::where('id',$rollcall->pegawai_sokong_id)->first();   
        $rollcall -> pegawai_sokong_name = $pegawai_sokong -> name;  

        $pegawai_lulus = User::where('id',$rollcall->pegawai_lulus_id)->first();   
        $rollcall -> pegawai_lulus_name = $pegawai_lulus -> name;  

        $userrollcalls = Userrollcall::where('roll_id','=',$rollcall->id)->get();

        $status = [
            "dibuka" => "Dibuka",
            "ditutup" => "Tutup",
            "ditangguh" => "Tangguh"

        ];
        return view('rollcall.edit',[
            'rollcall'=> $rollcall,
            'status' => $status, 
            'userrollcalls'=> $userrollcalls,
            'users'=> $users,
            'pegawai_sokong' => $pegawai_sokong,
            'pegawai_lulus' => $pegawai_lulus,
            'kakitangan'=> $kakitangan,
            'pegawai'=> $pegawai,

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
        $rollcall->maklumat = $request-> maklumat;
        $rollcall->save();

         // Audit trail
         $audit = new Audit;
         $audit->user_id = $request->user()->id;
         $audit->name = $request->user()->name;
         $audit->peranan = $request->user()->role;
         $audit->nric =$request->user()->nric;
         $audit->description =  'Kemaskini Roll Call Tajuk: '.$rollcall->tajuk_rollcall;
         $audit->save(); 

        $redirected_url= '/rollcalls/';
        return redirect($redirected_url); 
    }


    public function destroy(Request $request,Rollcall $rollcall)
    {
     
        if($rollcall)
        {
            if($rollcall->delete()){

                 // Audit trail
                $audit = new Audit;
                $audit->user_id = $request->user()->id;
                $audit->name = $request->user()->name;
                $audit->peranan = $request->user()->role;
                $audit->nric =$request->user()->nric;
                $audit->description =  'Hapus Roll Call Tajuk: '.$rollcall->tajuk_rollcall;
                $audit->save(); 

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

    public function get_data(Request $request, $id) {
        if ($request->ajax()) {
            $rollcall = Rollcall::with('pegawai_sokong', 'pegawai_lulus', 'user_rollcall.penguatkuasa')->find($id)->toArray();
            return response()->json($rollcall);
        }
    }

    public function masuk(Request $request, $id) {
        $userrollcall = Userrollcall::Where('id','=',$id)->first();
        $userrollcall->masuk = $request->masuk;
        $userrollcall->save();
    }
    public function keluar(Request $request, $id) {
        $userrollcall = Userrollcall::Where('id','=',$id)->first();
        $userrollcall->keluar = $request->keluar;
        $userrollcall->save();
    }
    public function sokong($id)
    {
        $userrollcall = Userrollcall::find($id);
        $userrollcall-> sokong = true;
        $userrollcall-> tarikh_sokong = Carbon::now()->format('Y-m-d H:i:s');
        $userrollcall->save();

        $redirected_url= '/rollcalls/';
        return redirect($redirected_url);        
    }
    public function tolak_sokong(Request $request)
    {
        $userrollcall = Userrollcall::find($request->id);
        $userrollcall-> sokong = false;
        $userrollcall-> tarikh_sokong = Carbon::now()->format('Y-m-d H:i:s');
        $userrollcall-> sokong_sebab = $request-> sokong_sebab;

        $userrollcall->save();

        $redirected_url= '/rollcalls/';
        return redirect($redirected_url);        
    }
    public function lulus($id)
    {
        $userrollcall = Userrollcall::find($id);
        $userrollcall-> lulus = true;
        $userrollcall-> tarikh_lulus = Carbon::now()->format('Y-m-d H:i:s');
        $userrollcall->save();

        $redirected_url= '/rollcalls/';
        return redirect($redirected_url);        
    }
    public function tolak_lulus(Request $request)
    {
        $userrollcall = Userrollcall::find($request->id);
        $userrollcall-> lulus = false;
        $userrollcall-> tarikh_lulus = Carbon::now()->format('Y-m-d H:i:s');
        $userrollcall-> lulus_sebab = $request-> lulus_sebab;

        $userrollcall->save();

        $redirected_url= '/rollcalls/';
        return redirect($redirected_url);        
    }
}
