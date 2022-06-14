<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Userrollcall;
use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    public function scanQr(Request $request)
    {
        $user = User::where('nric', $request->nric)->first();

        $userRoll = Userrollcall::where('penguatkuasa_id', $user->id)->first();

        if ($userRoll->masuk === null) {
            Userrollcall::where([['penguatkuasa_id', $user->id], ['roll_id', $request->rollcall_id]])->update([
                'masuk' => now(),
            ]);
        } else {
            Userrollcall::where([['penguatkuasa_id', $user->id], ['roll_id', $request->rollcall_id]])->update([
                'keluar' => now(),
            ]);
        }
        return response()->json();
    }
}
