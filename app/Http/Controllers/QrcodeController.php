<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Userrollcall;
use Illuminate\Http\Request;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    public function scanQr(Request $request)
    {
        if (strlen($request->nric) != 12) {
            $nric = explode('/', $request->nric);
            $user = User::where('nric', $nric[1])->first();
        } else {
            $user = User::where('nric', $request->nric)->first();
        }

        $userRoll = Userrollcall::where('penguatkuasa_id', $user->id)->first();

        if ($userRoll->masuk === null) {
            Userrollcall::where([['penguatkuasa_id', $user->id], ['roll_id', $request->rollcall_id]])->update([
                'masuk' => now(),
            ]);
        } else if ($userRoll->keluar === null) {
            Userrollcall::where([['penguatkuasa_id', $user->id], ['roll_id', $request->rollcall_id]])->update([
                'keluar' => now(),
                'sokong' => 1,
                'lulus' => 1,
                'tarikh_sokong' => now(),
                'tarikh_lulus' => now(),
            ]);
        }
        return response()->json();
    }

    public function printqr($nric)
    {
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));
        $pdf = PDF::loadView('rollcall.printqr', compact('qrcode'));
        return $pdf->stream();

    }
}
