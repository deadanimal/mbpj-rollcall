<?php

namespace App\Http\Controllers;

use App\Models\Kumpulan;
use App\Models\User;
use App\Models\UserKumpulan;
use Illuminate\Http\Request;

class UserKumpulanController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {

        $kumpulan = Kumpulan::all();
        $user = User::orderBy('name', 'ASC')
            ->where('department_code', 'like', '11%')
            ->get();
        // $user = User::all();

        return view('userkumpulan.create', [
            'kumpulan' => $kumpulan,
            'user' => $user,

        ]);

    }

    public function store(Request $request)
    {

        foreach ($request->id_user as $iduser) {
            $userkumpulan = new UserKumpulan;
            $userkumpulan->id_kumpulan = $request->id_kumpulan;
            $userkumpulan->id_user = $iduser;
            $userkumpulan->save();

        }

        $redirected_url = '/kumpulan/';
        return redirect($redirected_url);
    }

    public function show(UserKumpulan $userKumpulan)
    {
        //
    }

    public function edit(UserKumpulan $userKumpulan, Request $request)
    {

        // $id_kumpulan = 1;
        // $userKumpulan = UserKumpulan::Where('id','=',$id_kumpulan)->first();
        // dd($userKumpulan);
        return view('userkumpulan.edit', [
            'userkumpulan' => $userKumpulan,

        ]);

    }

    public function update(Request $request, UserKumpulan $userKumpulan)
    {
        foreach ($request->id_user as $iduser) {
            $userKumpulan->id_kumpulan = $request->id_kumpulan;
            $userKumpulan->id_user = $iduser;
            $userKumpulan->save();

        }

        $redirected_url = '/kumpulan/';
        return redirect($redirected_url);
    }

    public function destroy(UserKumpulan $userKumpulan)
    {
        //
    }

    public function delete_pengguna_kumpulan(Request $request, $id_user, $id_kumpulan)
    {
        $userKumpulan = UserKumpulan::where('id_user', $id_user)->where('id_kumpulan', $id_kumpulan)->first();
        $userKumpulan->delete();
        return redirect('/kumpulan');
    }
}
