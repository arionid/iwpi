<style>
    :root {
        font-size: 14px;
    }
    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }
    p {
        margin: 0;
    }
    p:not(:last-child) {
        margin-bottom: 1.5em;
    }
    .name-anggota {
        color: #990000;
        font-size: 21px;
        font-weight: 900;
        letter-spacing: 5px;
        text-transform: uppercase;
        padding: 0 1.8em 0.5em 1.8em;
        margin: 0;
        line-height: 1;
    }
    body {
        font: 1em/1.618 Inter, sans-serif;
        font-weight: bold;
        background-repeat: no-repeat;
        width: 2.8em;
    }
    .red {
        color: #990000 !important;
    }
    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        max-width: 630px;
        height: 400px;
        min-height: 400px;
        width: 630px;
        padding: 5px;
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: 20px;
        /* background-color: rgba(255, 255, 255, 0.75); */
        box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.25);
        background-image: url("{{ url('/adm-assets/images/1-kartu-anggota-partai-x.jpg') }}");
        background-position: center;
        background-size: 630px 400px;
    }
    .header {}
    .header h2 {
        font-size: 2em;
        text-align: center
    }
    .card-footer {
        font-size: 0.65em;
        color: #446;
    }
    .biodata {
        vertical-align: middle;
        display: block;
        float: left;
    }
    ul.datadiri {
        width: 350px;
        display: table;
    }
    ul.datadiri>li {
        display: table-row;
    }
    ul.datadiri>li>* {
        display: table-cell;
    }
    .desc {
        display: inline-block;
        margin-top: -15px;
        padding-top: 0px;
    }
    .qrcode {
        position: absolute;
        display: inline;
        text-align: center;
        width: 300px;
    }
    .img-qrcode {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .date {
        font-size: 13px;
        line-height: 1.2;
        text-align: right;
    }
    .date>b {
        color: #990000;
    }
    .ket-kartu {
        color: #fff;
        font-size: 9px;
        padding: 0 20px;
    }
    .download {
        padding: 2em;
    }
    .btn-download {
        position: absolute;
        top: 1em;
        left: 1em;
        background-color: #990000;
        /* Green */
        border: none;
        color: white;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
    }
</style>
<div class="download">
    <button class="btn-download" id="saveReport">DOWNLOAD KARTU ANGGOTA</button>
</div>
<div class="card page">
    <div class="header">
        <h2>KARTU TANDA ANGGOTA</h2>
    </div>
    <div class="biodata">
        <h4 class="name-anggota">{{ $user->fullname }}</h4>
        <div class="desc">
            <ul class="datadiri">
                <li>
                    <div>NIK</div>
                    <span class="red">: {{ $user->nik }}</span>
                </li>
                <li>
                    <div>Jabatan</div>
                    <span>: {{ \Str::upper($user->jabatan) }}</span>
                </li>
                <li>
                    <div>Provinsi</div>
                    <span>: {{ $user->provinces_name }}</span>
                </li>
                <li>
                    <div>Kota/Kabupaten</div>
                    <span>: {{ $user->regency_name }}</span>
                </li>
                <li>
                    <div>Kecamatan</div>
                    <span>: {{ $user->village_name }}</span>
                </li>
                <li>
                    <div>Kelurahan</div>
                    <span>: {{ $user->village_name }}</span>
                </li>
                <li>
                    <div>Anggota Sejak</div>
                    <span>: {{ \Carbon\Carbon::parse($user->date_active)->format('d/m/Y') }}</span>
                </li>
            </ul>
        </div>
        <div class="qrcode">
            <img src="data:image/png;base64, {!! base64_encode($qrcode) !!}" class="img-qrcode">
            <small style="color:#fff;">www.partaix.id</small>
        </div>
    </div>
    <div class="ket-kartu">
        &copy;Kartu ini merupakan kartu tanda anggota partai yang dikeluarkan resmi oleh Partai X,
        Untuk validasi pastikan data tersebut sesuai dengan dengan KTP Elektronik Indonesia.
        Scan Barcode untuk mengetahui status dan kebenaran kartu anggota ini.
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script>
    $(document).ready(function(){
			var element = $('.page');
			$('#saveReport').on('click', function(){
				html2canvas(element, {
					background: '#ffffff',
					onrendered: function(canvas){
						var a = document.createElement('a');
						a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
						a.download = 'KTA-{{ $user->fullname }}.jpg';
						a.click();
					}
				});
			});
		});
</script>
