<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Kumpulan;
use App\Models\Rollcall;
use App\Models\User;
use App\Models\Userrollcall;
use Illuminate\Http\Request;

class UserrollcallController extends Controller
{
    public function index()
    {

        $userrollcalls = Userrollcall::all();
        return view('rollcall.edit', [
            'userrollcalls' => $userrollcalls,

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

        // dd($request);
        // $request->validate([
        //     'addMoreInputFields.*.penguatkuasa_id' => 'required'

        // ]);
        // dd($request);
        // $userrollcall = new Userrollcall;
        // $userrollcall->roll_id = $request['roll_id'];
        // $userrollcall->penguatkuasa_id = $request->penguatkuasa_id;

        // $userrollcall -> save();
        if ($request->penguatkuasa_id) {
            $penguatkuasa_id = explode(',', $request->penguatkuasa_id);
            foreach ($penguatkuasa_id as $value) {
                $userPenguatkuasa = User::find($value);

                if ($userPenguatkuasa->user_kumpulan != null) {
                    $kumpulan = Kumpulan::find($userPenguatkuasa->user_kumpulan->id_kumpulan);
                }

                $userrollcall = new Userrollcall;

                $userrollcall->roll_id = $request->roll_id;
                $userrollcall->penguatkuasa_id = $value;
                $userrollcall->pegawai_sokong_id = $kumpulan->pegawai_sokong_id ?? 0;
                $userrollcall->pegawai_lulus_id = $kumpulan->pegawai_lulus_id ?? 0;

                $userrollcall->save();
                // Audit trail
                $audit = new Audit;
                $audit->user_id = $request->user()->id;
                $audit->name = $request->user()->name;
                $audit->peranan = $request->user()->role;
                $audit->nric = $request->user()->nric;
                $audit->description = 'Tambah Kakitangan: ' . $userrollcall->penguatkuasa->name;
                $audit->save();
            }
        }

        // Audit trail
        $audit = new Audit;
        $audit->user_id = $request->user()->id;
        $audit->name = $request->user()->name;
        $audit->peranan = $request->user()->role;
        $audit->nric = $request->user()->nric;
        $audit->description = 'Tambah Kakitangan: ' . $userrollcall->penguatkuasa->name;
        $audit->save();

        return back()->with('success', 'Kakitangan Berjaya Ditambah.');

    }

    public function show(Userrollcall $userrollcall)
    {
        //
    }

    public function edit(Userrollcall $userrollcall)
    {
        //
    }

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
    public function destroy(Request $request, Userrollcall $userrollcall)
    {

        if ($userrollcall) {
            if ($userrollcall->delete()) {

                // Audit trail
                $audit = new Audit;
                $audit->user_id = $request->user()->id;
                $audit->name = $request->user()->name;
                $audit->peranan = $request->user()->role;
                $audit->nric = $request->user()->nric;
                $audit->description = 'Hapus Kakitangan: ' . $userrollcall->penguatkuasa->name;
                $audit->save();

                $redirected_url = '/rollcalls/';
                return redirect($redirected_url)->with('buang');
            } else {
                return "something wrong";
            }
        } else {
            return "roll call not exist";
        }
    }
    public function simpan_sebab(Request $request)
    {

        // dd($request);
        // $sebab = Userrollcall::where('id','=',$id)->first();
        $sebab = Userrollcall::find($request->id);
        $sebab->keterangan = $request->keterangan;

        $path = $request->file('file_path')->store('public/sebab');

        $actualPath = explode('/', $path);

        $sebab->file_path = "/sebab/" . $actualPath[2];

        // $sebab->file_path = $request->file_path;

        $sebab->save();

        $redirected_url = '/rollcalls/';
        return redirect($redirected_url);

        // $req->validate([
        //     'file' => 'required|mimes:png,PNG,jpg,PDF,pdf|max:2048'
        // ]);

        // $fileModel = new Manual;

        // if($req->file()) {

        // $fileName = time().'_'.$req->file->getClientOriginalName();
        // $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

        // $fileModel->notis = $req-> notis;
        // $fileModel->name = time().'_'.$req->file->getClientOriginalName();
        // $fileModel->file_path = '/storage/' . $filePath;

        // $fileModel->save();

    }
}
