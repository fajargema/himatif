@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Keuangan</h1>
    <h4>Saldo Terakhir : {{ rupiah($saldo) }}</h4>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 align="left">
            Detail Laporan Keuangan
        </h5>

    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-lg-7">
                <label><strong>Judul Laporan :</strong></label>
                <p>{{ $data->judul }}</p>

                <label><strong>Tanggal Laporan :</strong></label>
                <p>
                    {{ Carbon\Carbon::parse($data['tanggal'])->isoFormat('dddd, D MMMM Y') }}
                </p>

                <label><strong>Jumlah Uang :</strong></label>
                <p>{{ rupiah($data->jumlah) }}</p>
            </div>

            <div class="col-lg-5">
                <label><strong>Jenis Laporan :</strong></label>
                <p>{{ $data->jenis }}</p>

                <label><strong>Dibuat Oleh :</strong></label>
                <p>{{ $data->user->name }}</p>

                <label><strong>Keterangan Laporan :</strong></label>
                {!! $data->keterangan !!}
            </div>

        </div>

    </div>
</div>

@endsection
