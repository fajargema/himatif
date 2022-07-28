@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Scan QR</h1>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5>
            Scan QR
        </h5>
    </div>
    <div class="card-body">

        <div class="row">

            <div style="width: 50%; margin-left:auto; margin-right:auto;" id="reader"></div>

        </div>

    </div>
</div>


<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>

<script>
    const html5QrCode = new Html5Qrcode(/* element id */ "reader");
    // This method will trigger user permissions
    Html5Qrcode.getCameras().then(devices => {
    /**
     * devices would be an array of objects of type:
     * { id: "id", label: "label" }
     */

    if (devices && devices.length) {
        var cameraId = devices[0].id;
        html5QrCode.start(
        cameraId,
    {
        fps: 10,    // Optional, frame per seconds for qr code scanning
        // Optional, if you want bounded box UI
    },
    (decodedText, decodedResult) => {
        $.ajax({
            url: '/scan/result/'+decodedText,
            type: "GET",
            dataType: "json",
            success:function(data) {
                if(data.status == 0){
                    html5QrCode.stop();
                    $("#detail").css("display","block");
                    $("#nama").val(data.nama);
                    $("#tanggal").val(data.tanggal);
                    $("#id").val(data.id);
                    $("#nama-penghuni").val(data.prisoner.nama);
                    $("#kamar").val(data.prisoner.room.name);
                    $("#block").val(data.prisoner.room.block.name);
                    $('#foto').attr('src', '/storage/penghuni/'+data.prisoner.foto);
                }else{
                    swal({
                        title: `Oops..!`,
                        text: "Qr Code sudah kadaluarsa",
                        icon: "error",
                        showCancelButton: true
                    })
                }

            }
            });
    },
    (errorMessage) => {
        // parse error, ignore it.
    })
    .catch((err) => {
        // handle err
    });

    }
    }).catch(err => {
        // handle err
    });


</script>

@endsection
