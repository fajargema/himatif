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
        <h2 class="text-center">Arahkan QR Code pada kamera</h2>

        <div class="row">

            <div style="width: 50%; margin-left:auto; margin-right:auto;" id="reader">
                <input type="file" id="qr-input-file" accept="image/*" capture>
            </div>

            <form action="{{ route('dashboard.meet.scan-result') }}" method="post">
                @csrf
                <input type="hidden" name="nim" id="nim" value="20200120037">
                <input type="hidden" name="meets_id" id="meets_id" value="{{ $data->id }}">
                {{-- <button type="submit">simpan</button> --}}
            </form>


        </div>

    </div>
</div>


<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>

{{-- <script>
    const html5QrCode = new Html5Qrcode(/* element id */ "reader");
    // File based scanning
    const fileinput = document.getElementById('qr-input-file');
        fileinput.addEventListener('change', e => {

        if (e.target.files.length == 0) {
            // No file selected, ignore
            return;
        }

        const imageFile = e.target.files[0];
        // Scan QR Code
        html5QrCode.scanFile(imageFile, true)
        .then(decodedText => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // processing ajax request
            let meets_id = $("input[name=meets_id]").val();
            $.ajax({
                url: "{{ route('dashboard.meet.scan-result') }}",
                type: 'POST',
                data: {
                    nonim: decodedText,
                    meets: meets_id
                },
                success:function(resp) {
                    if (resp.success) {
                        swal.fire("Done!", resp.message, "success");
                        location.reload();
                    } else {
                        swal.fire("Error!", resp.message, "error");
                        location.reload();
                    }
                },
                error:function (resp) {
                    swal.fire("Error!", resp.message, "error");
                    location.reload();
                }
            });
        })
        .catch(err => {
            swal.fire("Error!", `Error scanning file. Reason: ${err}`, "error");
        });
    });


</script> --}}

<script>
    const html5QrCode = new Html5Qrcode(/* element id */ "reader");
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
            qrbox: { width: 250, height: 250 }  // Optional, if you want bounded box UI
        },
        (decodedText, decodedResult) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // processing ajax request
            let meets_id = $("input[name=meets_id]").val();
            $.ajax({
                url: "{{ route('dashboard.meet.scan-result') }}",
                type: 'POST',
                data: {
                    nonim: decodedText,
                    meets: meets_id
                },
                success:function(resp) {
                    if (resp.success) {
                        swal.fire("Done!", resp.message, "success");
                        location.reload();
                    } else {
                        swal.fire("Error!", resp.message, "error");
                        location.reload();
                    }
                },
                error:function (resp) {
                    swal.fire("Error!", resp.message, "error");
                    location.reload();
                }
            });
        },
        (errorMessage) => {
            // parse error, ignore it.
        })
        .catch((err) => {
        // Start failed, handle it.
        });
    }
    }).catch(err => {
    // handle err
    });
</script>

@endsection
