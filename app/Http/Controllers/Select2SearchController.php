<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class Select2SearchController extends Controller
{

    public function index()
    {
        $userrollcalls = Userrollcall::all();
        return view('rollcall.edit',[
            'userrollcalls'=> $userrollcalls,

        ]);
    }

    public function selectSearch(Request $request)
    {
    	$users = [];
        if($request->has('q')){
            $search = $request->q;
            $users =User::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
            		->get();
        }
        return response()->json($users);
    }
}
