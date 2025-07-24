<?php
namespace App\Traits;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;

trait MidtransTrait
{
    public function createPaymentLinkApi($anggota) {
        $order_id = time()."-".$anggota->pendaftaran_id."-".\Str::slug($anggota->profile->village_id);
        $client = new Client();
            $headers = [
            'Authorization' => 'Basic '.\config('nnd.midtrans_server_key'),
            'Content-Type' => 'application/json'
            ];
            $body = array(
                "transaction_details" => [
                        "order_id" => $order_id,
                        "gross_amount" => 150000,
                        "payment_link_id" => "iwpi-".fUrlGenerator($anggota->pendaftaran_id)
                    ],
                "customer_required" => true,
                "usage_limit" => 1,
                "exp"
            );

        $parameter = [
        "transaction_details" => [
                "order_id" => $order_id,
                "gross_amount" => $anggota->layanan_nominal,
                "payment_link_id" => fUrlGenerator($anggota->pendaftaran_id)
            ],
        "customer_required" => true,
        "usage_limit" => 5,
        "expiry" => [
                    // "start_time" => Carbon::now()->addDay()->format('YYYY-MM-DD HH:mm:ss ZZ'),
                    "duration" => 3,
                    "unit" => "days"
                ],
        "item_details" => [
                    [
                        "id" => Str::slug($anggota->layanan),
                        "name" => "Pendaftaran Anggota ".$anggota->layanan,
                        "price" => $anggota->layanan_nominal,
                        "quantity" => 1,
                    ]
                    ],
        "customer_details" => [
                            "first_name" => $anggota->profile->fullname,
                            "phone" => $anggota->profile->phone,
                            "notes" => "Nomor NPWP terdaftar adalah ".$anggota->profile->npwp,
        ],
        "custom_field1" => $anggota->profile->npwp,
        "custom_field2" => $anggota->profile->perusahaan,
        "custom_field3" => $anggota->pendaftaran_id
        ];

        $body = json_encode($parameter);
        $request = new Request('POST', \config('nnd.midtrans_link')."/v1/payment-links", $headers, $body);
        $res = $client->sendAsync($request)->wait();

        return json_decode($res->getBody());
        // return json_decode($res->getBody(), true);

    }
}
