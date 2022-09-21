@extends('layouts.admin')

@section('content')

@if ($errors->any())
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <span class="badge badge-lg light badge-danger mb-2">There's something wrong!</span>

            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-lg-12">
                            <ul class="list-icons">
                                @foreach ($errors->all() as $error)
                                <li>
                                    <span class="align-middle mr-2"><i class="ti-angle-right"></i></span> {{ $error }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Rapat</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">

        <form action="{{ route('dashboard.meet.update', $data->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Nama Rapat</label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama') ?? $data->nama }}"
                        placeholder="Nama Rapat">
                </div>
                <div class="col-sm-6">
                    <label>Tempat Rapat</label>
                    <input type="text" class="form-control" name="tempat" value="{{ old('tempat') ?? $data->tempat }}"
                        placeholder="Tempat Rapat">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Tanggal Rapat</label>
                    <input type="datetime-local" class="form-control" name="tgl_waktu"
                        value="{{ old('tgl_waktu') ?? Carbon\Carbon::parse($data['tgl_waktu'])->format('Y-m-d H:i') }}">
                </div>
                <div class="col-sm-6">
                    <label>Jenis Rapat</label>
                    <select class="form-control" name="jenis">
                        <option>------Pilih Jenis------</option>
                        <option selected value="{{ $data->jenis }}">{{ $data->jenis }} - <i>(Jenis Sekarang)</i>
                        </option>
                        <option value="Online">Online</option>
                        <option value="Offline">Offline</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi Rapat</label>
                <textarea name="deskripsi" class="form-control">{{ old('deskripsi') ?? $data->deskripsi }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'deskripsi' );
</script>

@endsection
