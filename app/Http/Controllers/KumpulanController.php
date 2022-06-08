<?php

namespace App\Http\Controllers;

use App\Models\Kumpulan;
use App\Models\User;
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
        $kumpulan = Kumpulan::all()->sortByDesc('created_at');
        return view('kumpulan.index', [
            'kumpulan' => $kumpulan,
        ]);

    }

    public function create()
    {
        $pegawaiSokong = User::whereIn('role', ['penyelia', 'ketua_bahagian'])->get();
        $pegawaiLulus = User::whereIn('role', ['ketua_bahagian', 'ketua_jabatan'])->get();

        return view('kumpulan.create', compact('pegawaiSokong', 'pegawaiLulus'));
    }

    public function store(Request $request)
    {
        $kumpulan = new Kumpulan;
        $kumpulan->nama_kumpulan = $request->nama_kumpulan;
        $kumpulan->pegawai_sokong_id = $request->pegawai_sokong;
        $kumpulan->pegawai_lulus_id = $request->pegawai_lulus;
        $kumpulan->save();

        $redirected_url = '/kumpulan/';
        return redirect($redirected_url);
    }

    public function show(Kumpulan $kumpulan)
    {
        //
    }

    public function edit(Kumpulan $kumpulan)
    {
        $pegawaiSokong = User::whereIn('role', ['penyelia', 'ketua_bahagian'])->get();
        $pegawaiLulus = User::whereIn('role', ['ketua_bahagian', 'ketua_jabatan'])->get();

        return view('kumpulan.edit', compact('kumpulan', 'pegawaiLulus', 'pegawaiSokong'));

    }

    public function update(Request $request, Kumpulan $kumpulan)
    {
        $kumpulan->nama_kumpulan = $request->nama_kumpulan;
        $kumpulan->pegawai_sokong_id = $request->pegawai_sokong;
        $kumpulan->pegawai_lulus_id = $request->pegawai_lulus;
        $kumpulan->save();

        $redirected_url = '/kumpulan/';
        return redirect($redirected_url);
    }

    public function destroy(Kumpulan $kumpulan, Request $request)
    {

        if ($kumpulan) {
            if ($kumpulan->delete()) {

                $redirected_url = '/kumpulan/';
                return redirect($redirected_url)->with('buang');
            } else {
                return "something wrong";
            }
        } else {
            return "roll call not exist";
        }

    }
}
