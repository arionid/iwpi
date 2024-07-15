<?php

namespace App\Http\Controllers;

use App\Models\AnggotaIWPI;
use App\Models\PaymentDetail;
use App\Models\PendaftaranAnggota;
use App\Models\User;
use App\Notifications\AnggotaRegisterNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class MidtransController extends Controller
{
    public function waitingPayment() {
        return view('payment.unfinish');
    }

    public function paymentSuccess() {
        return view('payment.success');

    }

    public function paymentError() {
        return view('payment.error');
    }


    public function notificationHandler(Request $request) {
        $validated = $request->validate( [
            'order_id' => 'nullable',
            'transaction_status' => 'required',
            'fraud_status' => 'required',
            'payment_type' => 'required',
            'gross_amount' => 'required',
        ]);

        if( !$validated )
        {
            return response()->json(['errors'=>$validated]);
        }

        try {
            $query = PaymentDetail::with(['profile', 'anggota'])->where('status','!=','settlement');

            $query->where(function ($query) use ($request, $validated)
            {
                $query->where('order_id','LIKE', "%".$validated['order_id'])
                ->orWhere('payment_link_id','like', "%".$request->metadata['extra_info']['payment_link_id']."%");
                if(!empty($request->custom_field3)){
                    $query->orWhere('pendaftaran_id', $request->custom_field3);
                }
               
            });

            $detailPayment = $query->first();
        } catch (\Throwable $th) {
            throw $th;
            Log::critical("gagal kosong di pembayaran");
        }

        $descMsg =  "";
        if ($request->transaction_status == 'capture') {
            if ($request->payment_type == 'credit_card'){
                if($request->fraud_status == 'accept'){
                // TODO set payment status in merchant's database to 'Success'
                $descMsg =  "Berhasil melakukan pembayaran senilai Rp.".\number_format($request->gross_amount)." menggunakan ".$request->payment_type;
                // echo "Transaction order_id: " . $request->order_id ." successfully captured using " . $request->payment_type;
                }
            }
        }elseif ($request->transaction_status == 'settlement'){

            // TODO set payment status in merchant's database to 'Settlement'
            $descMsg =  "Pembayaran berhasil divalidasi oleh system midtrans menggunakan ".$request->payment_type. " senilai Rp.".\number_format($request->gross_amount);
            // echo "Transaction order_id: " . $request->order_id ." successfully transfered using " . $request->payment_type;
        }
            /* else if($request->transaction_status == 'pending'){
            // TODO set payment status in merchant's database to 'Pending'
            echo "Waiting customer to finish transaction order_id: " . $request->order_id . " using " . $request->payment_type;
            }
            else if ($request->transaction_status == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $request->payment_type . " for transaction order_id: " . $request->order_id . " is denied.";
            }
            else if ($request->transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            echo "Payment using " . $request->payment_type . " for transaction order_id: " . $request->order_id . " is expired.";
            }
            else if ($request->transaction_status == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $request->payment_type . " for transaction order_id: " . $request->order_id . " is canceled.";
            } */

            // update data anggota
            PaymentDetail::where('id', $detailPayment->id)->update([
                'status' => $request->transaction_status,
                'payment_type' => $request->payment_type,
                'updated_at'    => Carbon::now()
            ]);

            if($request->transaction_status == "settlement" || $request->transaction_status == 'capture'){
                try {
                    $notifyParam=[
                        'title'     =>'TEST Pembayaran Registrasi Anggota',
                        'message'   =>"*".$detailPayment->profile->fullname."* ".$descMsg."\n".
                        "NPWP : ".$detailPayment->profile->npwp."\n".
                        "Perusahaan : ".$detailPayment->profile->perusahaan."\n".
                        "Layanan : ".$detailPayment->anggota->layanan."\n".
                        "E-MAIL : ".$detailPayment->profile->email."\n".
                        "No.Tlp : ".$detailPayment->profile->phone."\n",
                    ];
                    Notification::route('telegram', \config('nnd.telegram_id_chat_admin'))
                                ->notify(new AnggotaRegisterNotification(str_replace("_","-",$notifyParam)));
                } catch (\Throwable $th) {
                    throw $th;
                    \Log::error("Notifikasi Telegram Error");
                }

                if($detailPayment->anggota->status == 'Menunggu Pembayaran'){
                    // update masa aktif status
                    AnggotaIWPI::where('pendaftaran_id', $detailPayment->pendaftaran_id)->update([
                        'nomor_anggota' =>  $detailPayment->profile->village_id.".".sprintf( '%04d', $detailPayment->profile->id ),
                        'status'    => 'Pembayaran Valid',
                        'tgl_mulai' => Carbon::now(),
                        'tgl_akhir' => Carbon::now()->addYear(),
                        'keterangan'    => "Midtrans ".$request->payment_type,
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }elseif($request->transaction_status == 'expire'){
                AnggotaIWPI::where([['pendaftaran_id', $detailPayment->pendaftaran_id], ['']])->update([
                    'status'    => 'Link Pembayaran Expired',
                ]);
            }
        return \response()->json(["data" => $detailPayment]);

            return response()->json(['success' => true], 200);

    }
    //
}
