@component('mail::message')
<h2>Pemberitahuan! ,</h2>
<p>Registrasi Anggota Kehormatan Ikatan Wajib Pajak Indonesia atas nama <strong>{{$data->fullname}}</strong><br>
dengan nomor NPWP <strong>{{ $data->npwp }}</strong> Telah Berhasil.<br />
Berikut kami lampirkan Kartu Anggota Kehormatan sebagai bukti keanggotaan Ikatan Wajib Pajak Indonesia.
</p>
@component('mail::button', ['url' => config('nnd.link-online').($data->kta_files)])
Download KTA
@endcomponent

<p>Hubungi Admin IWPI dan kirimkan KTA anda agar dapat bergabung dengan Grup WhatsApp Anggota IWPI</p><br />
Salam Hormat,<br>
{{ config('app.name') }}
@endcomponent
