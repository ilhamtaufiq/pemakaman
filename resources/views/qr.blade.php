<style>
    @media print {
        #printPageButton {
            display: none;
        }
    }
</style>
<img src="data:image/png;base64, {!! base64_encode(
    //format('png')->color(255, 0, 0)->size(200)->generate('' . env('APP_URL') . '/makam/info?kode_registrasi=' . $data->registrasi->kode_registrasi . ''),
    QrCode::format('png')->size(300)->generate('' . env('APP_URL') . '/makam/info?id=' . $data->id),
) !!} ">
<br>
<br>
<button id="printPageButton" onclick="window.print()">Print</button>
