<?php

namespace App\Http\Controllers;

use App\Models\AnggotaIWPI;
use App\Models\PendaftaranAnggota;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MidtransController extends Controller
{
    public function waitingPayment() {

        dd(fUrlGenerator());
        return view('payment.unfinish');
    }

    public function paymentSuccess() {
        return view('payment.success');

    }

    public function paymentError() {
        return view('payment.error');
    }

    //
}
