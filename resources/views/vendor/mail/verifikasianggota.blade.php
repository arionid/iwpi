@component('mail::message')
<h2>Pemberitahuan! ,</h2>
<p>Registrasi Member Ikatan Wajib Pajak Indonesia atas nama <strong>{{$data['nama']}}</strong><br>
dengan nomor NPWP <strong>{{ $data['npwp'] }}</strong> Telah Berhasil.<br />
Selanjutnya Lakukan pembayaran registrasi anggota sebesar <strong>{{ $data['tagihan'] }}</strong><br>
ke Rekening Tujuan : <br>
<strong>Bank Mandiri 144-00-2772888-7 a/n PERKUMPULAN IKATAN WAJIB PAJAK INDONESIA</strong>
</p>
@component('mail::button', ['url' => url('/cara-pembayaran')])
Petunjuk Cara Pembayaran
@endcomponent

Salam Hormat,<br>
{{ config('app.name') }}
@endcomponent
