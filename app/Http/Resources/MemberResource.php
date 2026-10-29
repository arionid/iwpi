<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'nomor_anggota'    => $this->nomor_anggota,
            'fullname'         => $this->fullname,
            'email'            => $this->email,
            'nik'              => $this->nik,
            'npwp'             => $this->npwp,
            'phone'            => $this->phone,
            'gender'           => $this->gender,
            'perkawinan'       => $this->perkawinan,
            'city_born'        => $this->city_born,
            'born'             => $this->born,
            'address'          => $this->address,
            'province_id'      => $this->province_id,
            'province'         => $this->provinsi_nama,
            'jabatan'          => $this->jabatan,
            'status'           => $this->status,
            'date_active'      => $this->date_active,
            'layanan'          => $this->layanan,
            'layanan_nominal'  => $this->layanan_nominal,
            'status_pembayaran' => $this->status_pembayaran,
            'tgl_mulai'        => $this->tgl_mulai,
            'tgl_akhir'        => $this->tgl_akhir,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }
}
