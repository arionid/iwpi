<style>:root{font-size:14px}*,*:before,*:after{box-sizing:border-box}p{margin:0}p:not(:last-child){margin-bottom:1.5em}.name-anggota{color:#900;font-size:21px;font-weight:900;letter-spacing:5px;text-transform:uppercase;padding:0 1.8em;margin:0;line-height:1}body{font:1em/1.618 Inter,sans-serif;display:flex;justify-content:center;font-weight:700;min-height:100vh;padding:30px;margin:0;color:#224;background-image:linear-gradient(-225deg,#3a0000 0%,#9e0909 29%,#91113c 67%,#920e0e 100%)}.red{color:#990000!important}.card{min-height:200px;display:flex;flex-direction:column;justify-content:space-between;max-width:600px;height:350px;width:800px;padding:10px;border:1px solid rgb(255 255 255 / .25);border-radius:20px;background-color:rgb(255 255 255 / .75);box-shadow:0 0 10px 1px rgb(0 0 0 / .25);backdrop-filter:blur(15px);box-shadow:0 0 10px 1px rgb(0 0 0 / .25);background-image:url("{{ url('/adm-assets/images/2-kartu-anggota-partai-x.jpg') }}");background-position:center;background-size:630px 400px}.header h2{font-size:2em;text-align:center}.card-footer{font-size:.65em;color:#446}.biodata{vertical-align:middle;display:block;float:left}ul.datadiri{width:350px;display:table}ul.datadiri>li{display:table-row}ul.datadiri>li>*{display:table-cell}ul.datadiri>li>span:before{content:": "}.desc{display:inline-block;margin-top:-15px;padding-top:0}.qrcode{position:absolute;display:inline;text-align:center}.img-qrcode{display:block;margin-left:auto;margin-right:auto;width:60%}.date{font-size:13px;line-height:1.2;text-align:right}.date>b{color:#900}.ket-kartu{color:#fff;font-size:9px;padding:0 20px}</style>
<div class="card">
    <div class="header">
        <h2>KARTU TANDA ANGGOTA</h2>
    </div>
    <div class="biodata">
        <h4 class="name-anggota">{{ $user->fullname }}</h4>
        <div class="desc">
            <ul class="datadiri">
                <li>
                    <div>NO. ANGGOTA</div>
                    <span class="red">{{ $user->nomor_anggota }}</span>
                </li>
                <li>
                    <div>Jabatan</div>
                    <span>{{ $user->jabatan }}</span>
                </li>
                <li>
                    <div>Provinsi</div>
                    <span>{{ $user->provinces_name }}</span>
                </li>
                <li>
                    <div>Kota/Kabupaten</div>
                    <span>{{ $user->regency_name }}</span>
                </li>
                <li>
                    <div>Kecamatan</div>
                    <span>{{ $user->village_name }}</span>
                </li>
                <li>
                    <div>Kelurahan</div>
                    <span>{{ $user->village_name }}</span>
                </li>
                <li>
                    <div>Anggota Sejak</div>
                    <span class="red">{{ \Carbon\Carbon::parse($user->date_active)->format('d/m/Y') }}</span>
                </li>
            </ul>
        </div>
        <div class="qrcode">
            <img src="{{ asset('logo-kartu-anggota-partaix.png') }}" class="img-qrcode">
        </div>
    </div>
    <div class="ket-kartu">
        Kartu ini merupakan kartu tanda anggota partai yang dikeluarkan resmi oleh Partai X.<br>
        Untuk validasi pastikan data tersebut sesuai dengan dengan KTP Elektronik Indonesia
    </div>
    {{-- <p class="card-footer">Created by partaix.id</p> --}}
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
             e.keyCode === 86 ||
             e.keyCode === 85 ||
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};

document.addEventListener('keydown', function() {
    if (event.keyCode == 123) {
      return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
      return false;
    } else if (event.ctrlKey && event.keyCode == 85) {
      return false;
    }
  }, false);

  if (document.addEventListener) {
    document.addEventListener('contextmenu', function(e) {
      e.preventDefault();
    }, false);
  } else {
    document.attachEvent('oncontextmenu', function() {
      window.event.returnValue = false;
    });
  }
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});
</script>
