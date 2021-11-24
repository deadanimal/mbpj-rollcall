<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Userrollcall;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Auth;
use PDF;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user()->id;

        $null_kehadiran = Userrollcall::whereNull('keluar')
                    ->select(DB::raw('count(keluar) as jumlah_tidak_hadir'), DB::raw("CONCAT_WS('-',MONTHNAME(created_at),YEAR(created_at)) as monthname"))
                    ->groupBy('monthname')
                    ->where('penguatkuasa_id', $current_user)
                    ->get();

        $kehadiran = Userrollcall::where('penguatkuasa_id', $current_user)
                    ->select(DB::raw('count(*) as jumlah'), DB::raw("CONCAT_WS('-',MONTHNAME(created_at),YEAR(created_at)) as monthname"))
                    ->groupBy('monthname')
                    ->get();

        $kehadiran_diterima = Userrollcall::where([
            ['sokong', '1'], ['lulus', '1']
        ])->where('penguatkuasa_id', $current_user)
        ->select(DB::raw('count(sokong) as kehadiran_diterima'), DB::raw("CONCAT_WS('-',MONTHNAME(created_at),YEAR(created_at)) as monthname"))
        ->groupBy('monthname')
        ->get();

        $kehadiran_ditolak = Userrollcall::where('sokong', '0')->whereOr('lulus', '0')->where('penguatkuasa_id', $current_user)
        ->select(DB::raw('count(keluar) as kehadiran_ditolak'), DB::raw("CONCAT_WS('-',MONTHNAME(created_at),YEAR(created_at)) as monthname"))
        ->groupBy('monthname')
        ->get();

        $arraykehadiran = [];
        foreach ($kehadiran as $kehadirans) {
            $arraykehadiran[] = ['monthname' => $kehadirans->monthname, 'semua kehadiran' => $kehadirans->jumlah, 'kehadiran diterima' => $kehadirans->jumlah, 'kehadiran ditolak' => $kehadirans->jumlah, 'kehadiran tidak hadir' => $kehadirans->jumlah, ];
        }
        
        // dd($arraykehadiran);


        //Laporan Kehadiran
        // get User kehadiran untuk P,KB,KJ
        $lapor_hadir=Userrollcall::All();
        $user_hadir=User::All();

        return view ('laporan.index', [
            'kehadiran'=>$arraykehadiran,
            'lapor_hadir'=>$lapor_hadir,
            'user_hadir'=>$user_hadir,
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
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
    public function filter_laporan_hadir(Request $request, $id)
    {

        $tajuk_rollcall = UserRollcall::where('penguatkuasa_id', $id)->get();
        $kakitangan = User::where('id', $id)->first();
        $hadir = count(UserRollcall::where('penguatkuasa_id',$id)->where('lulus', 1)->get());
        $tidak_hadir = count(UserRollcall::where('penguatkuasa_id',$id)->where('lulus', 0)->get());
        $belum_hadir = count(UserRollcall::where('penguatkuasa_id',$id)->where('lulus', null)->get());

        $currentdate = Carbon::now()->format('Y-m-d ');

        //cetakan
        $pdf = PDF::loadView('laporan.report', [
            "kakitangan" => $kakitangan,
            "hadir" => $hadir,
            "tidak_hadir" => $tidak_hadir,
            "belum_hadir" => $belum_hadir,
            "report_ind" => $tajuk_rollcall,
            "currentdate"=>$currentdate,

        ])->setPaper('a4');

        $pdf->save('report.pdf');

        return view('laporan.pdf_viewer', [
            "url"=> '/report.pdf'
        ]);

    
    }
}
