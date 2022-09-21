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
    <h1 class="h3 mb-0 text-gray-800">Tambah Laporan</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">

        <form action="{{ route('dashboard.finance.store') }}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Judul Laporan</label>
                    <input type="text" class="form-control" name="judul" value="{{ old('judul') }}"
                        placeholder="Judul Laporan">
                </div>

                <div class="col-sm-6">
                    <label>Tanggal Laporan</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Jumlah</label>
                    <input type="int" class="form-control" name="jumlah" value="{{ old('jumlah') }}"
                        placeholder="Jumlah Uang">
                </div>
                <div class="col-sm-6">
                    <label>Jenis Laporan</label>
                    <select class="form-control" name="jenis">
                        <option selected>------Pilih Jenis------</option>

                        <option value="Pemasukan">Pemasukan</option>
                        <option value="Pengeluaran">Pengeluaran</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Keterangan Laporan</label>
                <textarea name="keterangan" class="form-control"
                    placeholder="Keterangan Laporan">{!! old('keterangan') !!}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'keterangan' );
</script>

@endsection
