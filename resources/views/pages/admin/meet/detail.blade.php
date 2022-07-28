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

                <label><strong>Jenis Rapat :</strong></label>
                <p>{{ $data->jenis }}</p>

                <label><strong>Dibuat Oleh :</strong></label>
                <p>{{ $data->user->name }}</p>

                <label><strong>Deskripsi Produk :</strong></label>
                {!! $data->deskripsi !!}

            </div>

            <div class="col-lg-5">
                <a href="https://chart.googleapis.com/chart?cht=qr&chs=400x400&chl={{$data->kode}}&choe=UTF-8"
                    download="https://chart.googleapis.com/chart?cht=qr&chs=400x400&chl={{$data->kode}}&choe=UTF-8">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=400x400&chl={{$data->kode}}&choe=UTF-8"
                        alt="">
                </a>
            </div>

        </div>

    </div>
</div>

@endsection