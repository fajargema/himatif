@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rapat</h1>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 align="left">
            Detail Rapat
        </h5>

        <a align="right" href="{{ route('dashboard.meet.scan', $data->id) }}" class="btn btn-info">Scan</a>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-lg-7">
                <label><strong>Nama Rapat :</strong></label>
                <p>{{ $data->nama }}</p>

                <label><strong>Tanggal Jam :</strong></label>
                <p>
                    {{ Carbon\Carbon::parse($data['tanggal'])->isoFormat('dddd, D MMMM Y') }} -
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5>
            Absensi
        </h5>

    </div>
    <div class="card-body">

        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Semester</th>
                    <th>Absen</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nim }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>
                        {{-- Cek absen --}}
                        @php
                        $cek = $item->absents->where('meets_id', $data->id)->count();
                        @endphp

                        {{-- Kondisi absen --}}
                        @if ($cek == 0)
                        <span class="badge badge-warning">Belum Absen</span>
                        @elseif ($cek >= 1)

                        {{-- Ambil Jam Absen --}}
                        @foreach ($item->absents->where('meets_id', $data->id) as $val)
                        {{-- Cek perbandingan Jam Absen --}}
                        @php
                        $waktu = Carbon\Carbon::parse($data['waktu']);
                        $tgl_meet = Carbon\Carbon::parse($data['tanggal']);
                        $absen = Carbon\Carbon::parse($val['created_at']);

                        $menit = $waktu->diffInMinutes($absen);
                        $jam = $waktu->diffInHours($absen);
                        $tgl = $tgl_meet->diffInDays($absen);

                        $denda = $menit / 5;
                        $hd = ceil($denda) * 1000;
                        @endphp

                        {{-- Kondii Jam Absen --}}
                        @if ($jam == 0)
                        <span class="badge badge-success">Sudah Absen</span> <br>
                        {{ Carbon\Carbon::parse($val['created_at'])->format('H:i:s') }} WIB <br>
                        Terlambat = {{ $menit }} Menit <b>(Denda : {{ rupiah($hd) }})</b>
                        @elseif ($tgl > 1)
                        <span class="badge badge-danger">Tidak Absen</span>
                        @elseif ($jam >= 1)
                        <span class="badge badge-danger">Belum Absen</span>
                        {{ Carbon\Carbon::parse($val['created_at'])->format('H:i:s') }} WIB
                        @endif

                        @endforeach

                        @endif
                    </td>
                </tr>
                @empty

                @endforelse
                <tr></tr>
            </tbody>
        </table>

    </div>
</div>

@endsection
