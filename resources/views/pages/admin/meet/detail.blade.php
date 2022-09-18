@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rapat</h1>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5>
            Detail Rapat
        </h5>

        <a href="{{ route('dashboard.meet.scan', $data->id) }}" class="btn btn-info">Scan</a>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-lg-7">
                <label><strong>Nama Rapat :</strong></label>
                <p>{{ $data->nama }}</p>

                <label><strong>Tanggal Jam :</strong></label>
                <p>
                    {{ Carbon\Carbon::parse($data['tanggal'])->isoFormat('dddd, d MMMM Y') }} -
                    {{ Carbon\Carbon::parse($data['waktu'])->format('H:i:s') }} WIB
                </p>

                <label><strong>Tempat Rapat :</strong></label>
                <p>{{ $data->tempat }}</p>



            </div>

            <div class="col-lg-5">
                <label><strong>Jenis Rapat :</strong></label>
                <p>{{ $data->jenis }}</p>

                <label><strong>Dibuat Oleh :</strong></label>
                <p>{{ $data->user->name }}</p>

                <label><strong>Deskripsi Produk :</strong></label>
                {!! $data->deskripsi !!}
            </div>

        </div>

    </div>
</div>

@endsection
