@extends('layouts.admin')

@section('content')

@if ($errors->any())
<div class="row mb-3">
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
@endif

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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-lg-6">
                <h5>Paparan</h5>
            </div>
            <div class="col-lg-6 text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                    <i class="fas fa-plus"></i>
                    Tambah Paparan
                </button>
            </div>
        </div>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Keterangan</th>
                        <th>Satuan</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Dibuat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($detail as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ rupiah($item->harga) }}</td>
                        <td>{{ rupiah($item->total) }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>
                            <button type="button" class="btn btn-primary shadow btn-sm mr-1" data-toggle="modal"
                                data-target=".edit{{ $item->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            @include('pages.admin.finance.edit-detail')

                            <form method="POST" style="display:inline;"
                                action="{{ route('dashboard.finance.delete-paparan', $item->id) }}">
                                @csrf
                                <input type="hidden" name="finances_id" value="{{ $data->id }}">
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger shadow btn-sm show_confirm"
                                    style="display:inline;" data-toggle="tooltip" title='Delete'>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Data tidak ada</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>


</div>

{{-- Modal Add --}}
@include('pages.admin.finance.add-detail')

{{-- Delete --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    var $ = jQuery;
    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Apakah Anda yakin menghapus data ini?`,
              text: "Jika Anda menghapus data ini, data tidak bisa kembali.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>

@endsection
