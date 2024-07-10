@component('mail::message')
<h2>Pemberitahuan! ,</h2>
<p>Registrasi Member Ikatan Wajib Pajak Indonesia atas nama <strong>{{$data['nama']}}</strong><br>
dengan nomor NPWP <strong>{{ $data['npwp'] }}</strong> Telah Berhasil.<br />
Selanjutnya Lakukan pembayaran registrasi anggota sebesar <strong>{{ $data['tagihan'] }}</strong><br>
dengan cara klik link dibawah ini.
</p>
@component('mail::button', ['url' => $data['link_pembayaran']])
Bayar Sekarang
@endcomponent
<span>link pembayaran diatas tersebut berlaku 1x24 jam sejak dikirimkan, jika link expired segera hubungi admin.</span><br />
<small>{{ $data['link_pembayaran'] }}</small>

Salam Hormat,<br>
{{ config('app.name') }}
@endcomponent
