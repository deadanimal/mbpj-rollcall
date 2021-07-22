<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // $user_id = $request->user()->id;   

        // $permohonans = User::find($user_id)->permohonans()->get();
        // // $permohonans = UserPermohonan::where('user_id', $user_id)->get();
        // $permohonan_disokongs = Permohonan::where('pegawai_sokong_id', $user_id)->get();

        // $user = User::where('id', $user_id)->get();

        // return view('permohonan.index',[
        //     'permohonans'=> $permohonans,
        //     'permohonan_disokongs'=> $permohonan_disokongs,
        //     'user'=>$user
        // ]);

        // $user_id = $request->user()->id;   
        // $users = User::find($user_id)->users()->get();
        // $user = User::where('id', $user_id)->get();

        // return view('pentadbir_sistem.index',[
        //     'users'=> $users,
        //     'user'=>$user,
        //     'user_id'=>$user_id
        //]);
        
        $users = User::all();
        return view ('pentadbir_sistem.index',[
            'users'=>$users
            ]);

    }
    public function kemaskini() {

    }

    public function tukar_kata_laluan() {
        
    }
}
