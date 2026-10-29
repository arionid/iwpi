<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\AnggotaIWPI;
use App\Models\PendaftaranAnggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    private const STATUS = ['Waiting', 'Approve', 'Decline', 'Blacklist', 'Overdue'];
    private const LAYANAN = ['Perseorangan', 'Badan Usaha'];

    private function query()
    {
        return PendaftaranAnggota::select(
                'pendaftaran_anggota.*',
                'anggota_iwpi.nomor_anggota',
                'anggota_iwpi.layanan',
                'anggota_iwpi.layanan_nominal',
                'anggota_iwpi.tgl_mulai',
                'anggota_iwpi.tgl_akhir',
                'anggota_iwpi.status as status_pembayaran',
                'provinsi.nama as provinsi_nama'
            )
            ->leftJoin('provinsi', 'pendaftaran_anggota.province_id', 'provinsi.kode')
            ->leftJoin('anggota_iwpi', 'pendaftaran_anggota.id', 'anggota_iwpi.pendaftaran_id');
    }

    /**
     * Daftar + pencarian member. Parameter `q` adalah alias dari `search`.
     */
    public function index(Request $request)
    {
        $request->validate([
            'status'      => ['nullable', Rule::in(self::STATUS)],
            'layanan'     => ['nullable', Rule::in(self::LAYANAN)],
            'province_id' => ['nullable', 'string', 'max:4'],
            'search'      => ['nullable', 'string', 'max:100'],
            'q'           => ['nullable', 'string', 'max:100'],
            'sort'        => ['nullable', 'in:id,fullname,created_at,date_active'],
            'dir'         => ['nullable', 'in:asc,desc'],
            'per_page'    => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $q = $this->query();

        if ($request->filled('status')) {
            $q->where('pendaftaran_anggota.status', $request->status);
        }
        if ($request->filled('layanan')) {
            $q->where('anggota_iwpi.layanan', $request->layanan);
        }
        if ($request->filled('province_id')) {
            $q->where('pendaftaran_anggota.province_id', $request->province_id);
        }

        $s = $request->input('search', $request->input('q'));
        if (filled($s)) {
            $q->where(function ($w) use ($s) {
                $w->where('pendaftaran_anggota.fullname', 'like', "%{$s}%")
                  ->orWhere('pendaftaran_anggota.email', 'like', "%{$s}%")
                  ->orWhere('pendaftaran_anggota.npwp', 'like', "%{$s}%")
                  ->orWhere('pendaftaran_anggota.nik', 'like', "%{$s}%")
                  ->orWhere('anggota_iwpi.nomor_anggota', 'like', "%{$s}%");
            });
        }

        $q->orderBy('pendaftaran_anggota.' . $request->input('sort', 'id'), $request->input('dir', 'desc'));

        return MemberResource::collection($q->paginate($request->input('per_page', 15))->withQueryString());
    }

    public function show($id)
    {
        return new MemberResource($this->find($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'layanan'      => ['required', Rule::in(self::LAYANAN)],
            'email'        => ['required', 'email', 'max:191', 'unique:pendaftaran_anggota,email'],
            'nik'          => ['required', 'string', 'min:15', 'max:30', 'unique:pendaftaran_anggota,nik'],
            'npwp'         => ['required', 'string', 'min:15', 'max:191', 'unique:pendaftaran_anggota,npwp'],
            'perusahaan'   => ['nullable', 'string', 'max:191'],
            'fullname'     => ['required', 'string', 'max:191'],
            'city_born'    => ['required', 'string', 'max:191'],
            'born'         => ['required', 'date'],
            'province_id'  => ['required', 'string', 'max:4'],
            'regency_id'   => ['required', 'string', 'max:8'],
            'district_id'  => ['required', 'string', 'max:12'],
            'village_id'   => ['required', 'string', 'max:18'],
            'address'      => ['required', 'string'],
            'phone'        => ['required', 'string', 'max:20'],
            'gender'       => ['required', Rule::in(['Perempuan', 'Laki-Laki'])],
            'perkawinan'   => ['required', Rule::in(['Belum Menikah', 'Menikah', 'Pernah Menikah'])],
            'jabatan'      => ['nullable', 'string', 'max:50'],
            'file_ktp'     => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'file_npwp'    => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        $member = DB::transaction(function () use ($request, $data) {
            $m = new PendaftaranAnggota();
            $this->fillProfile($m, $data);
            $m->perusahaan = $data['perusahaan'] ?? 'Perseorangan';
            $m->jabatan    = $data['jabatan'] ?? 'Anggota';
            $m->file_ktp   = $request->hasFile('file_ktp')
                ? saveAndResizeImage($request->file('file_ktp'), 'pendaftaran', 'ktp', 850, 450)
                : '';
            $m->file_npwp  = $request->hasFile('file_npwp')
                ? saveAndResizeImage($request->file('file_npwp'), 'pendaftaran', 'npwp', 850, 450)
                : null;
            $m->user_agent = $request->userAgent();
            $m->ip_client_register = $request->ip();
            $m->save();

            AnggotaIWPI::create([
                'pendaftaran_id'  => $m->id,
                'nomor_anggota'   => $m->village_id . '.' . sprintf('%04d', $m->id),
                'layanan'         => $data['layanan'],
                'layanan_nominal' => $this->nominal($data['layanan']),
                'status'          => 'Menunggu Pembayaran',
            ]);

            return $m;
        });

        return (new MemberResource($this->find($member->id)))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $member = PendaftaranAnggota::findOrFail($id);

        $data = $request->validate([
            'layanan'      => ['sometimes', Rule::in(self::LAYANAN)],
            'email'        => ['sometimes', 'email', 'max:191', Rule::unique('pendaftaran_anggota', 'email')->ignore($member->id)],
            'nik'          => ['sometimes', 'string', 'min:15', 'max:30', Rule::unique('pendaftaran_anggota', 'nik')->ignore($member->id)],
            'npwp'         => ['sometimes', 'string', 'min:15', 'max:191', Rule::unique('pendaftaran_anggota', 'npwp')->ignore($member->id)],
            'perusahaan'   => ['sometimes', 'nullable', 'string', 'max:191'],
            'fullname'     => ['sometimes', 'string', 'max:191'],
            'city_born'    => ['sometimes', 'string', 'max:191'],
            'born'         => ['sometimes', 'date'],
            'province_id'  => ['sometimes', 'string', 'max:4'],
            'regency_id'   => ['sometimes', 'string', 'max:8'],
            'district_id'  => ['sometimes', 'string', 'max:12'],
            'village_id'   => ['sometimes', 'string', 'max:18'],
            'address'      => ['sometimes', 'string'],
            'phone'        => ['sometimes', 'string', 'max:20'],
            'gender'       => ['sometimes', Rule::in(['Perempuan', 'Laki-Laki'])],
            'perkawinan'   => ['sometimes', Rule::in(['Belum Menikah', 'Menikah', 'Pernah Menikah'])],
            'jabatan'      => ['sometimes', 'nullable', 'string', 'max:50'],
            'status'       => ['sometimes', Rule::in(self::STATUS)],
            'file_ktp'     => ['sometimes', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'file_npwp'    => ['sometimes', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        DB::transaction(function () use ($request, $data, $member) {
            $this->fillProfile($member, $data);

            foreach (['perusahaan', 'jabatan'] as $f) {
                if (array_key_exists($f, $data)) {
                    $member->{$f} = $data[$f];
                }
            }
            if ($request->hasFile('file_ktp')) {
                $member->file_ktp = saveAndResizeImage($request->file('file_ktp'), 'pendaftaran', 'ktp', 850, 450, $member->file_ktp ?: null);
            }
            if ($request->hasFile('file_npwp')) {
                $member->file_npwp = saveAndResizeImage($request->file('file_npwp'), 'pendaftaran', 'npwp', 850, 450, $member->file_npwp ?: null);
            }

            $anggota = AnggotaIWPI::where('pendaftaran_id', $member->id)->first();

            if (isset($data['layanan']) && $anggota) {
                $anggota->layanan = $data['layanan'];
                $anggota->layanan_nominal = $this->nominal($data['layanan']);
            }

            if (isset($data['status'])) {
                $this->applyStatus($member, $anggota, $data['status']);
            }

            $member->save();
            $anggota?->save();
        });

        return new MemberResource($this->find($member->id));
    }

    private function find($id)
    {
        return $this->query()->where('pendaftaran_anggota.id', $id)->firstOrFail();
    }

    private function nominal(string $layanan): int
    {
        return $layanan === 'Badan Usaha' ? 150000 : 50000;
    }

    private function fillProfile(PendaftaranAnggota $m, array $data): void
    {
        foreach (['email', 'nik', 'npwp', 'fullname', 'city_born', 'province_id', 'regency_id', 'district_id',
                  'village_id', 'address', 'phone', 'gender', 'perkawinan'] as $f) {
            if (array_key_exists($f, $data)) {
                $m->{$f} = $data[$f];
            }
        }
        if (isset($data['born'])) {
            $m->born = Carbon::parse($data['born'])->format('Y-m-d');
        }
    }

    /**
     * Sama dengan alur admin (PendaftaranAnggotaController@updateStatusAggota).
     */
    private function applyStatus(PendaftaranAnggota $member, ?AnggotaIWPI $anggota, string $status): void
    {
        if ($anggota) {
            if ($status === 'Approve' && $anggota->status === 'Menunggu Validasi') {
                $anggota->nomor_anggota = $member->village_id . '.' . sprintf('%04d', $member->id);
                $anggota->status        = 'Pembayaran Valid';
                $anggota->tgl_mulai     = Carbon::now();
                $anggota->tgl_akhir     = Carbon::now()->addYear();
            } elseif ($status === 'Decline') {
                $anggota->status = 'Pembayaran Tidak Valid';
            }
        }

        $member->status = $status;
        if (in_array($status, ['Approve', 'Decline', 'Blacklist', 'Overdue'], true)) {
            $member->date_active = Carbon::now()->addYear();
        }
    }
}
