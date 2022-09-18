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
    <h1 class="h3 mb-0 text-gray-800">Tambah Rapat</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">

        <form action="{{ route('dashboard.meet.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Nama Rapat</label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama') }}"
                        placeholder="Nama Rapat">
                </div>

                <div class="col-sm-6">
                    <label>Tempat Rapat</label>
                    <input type="text" class="form-control" name="tempat" value="{{ old('tempat') }}"
                        placeholder="Tempat Rapat">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Tanggal Rapat</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ old('date') }}">
                </div>
                <div class="col-sm-6">
                    <label>Jam Rapat</label>
                    <input type="time" class="form-control" name="waktu" value="{{ old('waktu') }}">
                </div>
            </div>
            <div class="form-group">
                <label>Deskripsi Rapat</label>
                <textarea name="deskripsi" class="form-control"
                    placeholder="Deskripsi Produk">{!! old('deskripsi') !!}</textarea>
            </div>
            <div class="form-group">
                <label>Jenis Rapat</label>
                <select class="form-control" name="jenis">
                    <option selected>------Pilih Jenis------</option>

                    <option value="Online">Online</option>
                    <option value="Offline">Offline</option>
                </select>
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
