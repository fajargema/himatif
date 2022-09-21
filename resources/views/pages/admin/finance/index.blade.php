@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Keungan</h1>
    <h4>Saldo Terakhir : {{ rupiah($data->first()->saldo) }}</h4>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('dashboard.finance.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Laporan
        </a>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Judul</th>
                        <th>Jumlah</th>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                        <th>Pembuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Carbon\Carbon::parse($item['tgl_waktu'])->isoFormat('dddd, D MMMM Y') }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ rupiah($item->jumlah) }}</td>
                        <td>
                            @if ($item->jenis == "Pemasukan")
                            <span class="badge badge-success">{{ $item->jenis }}</span>
                            @elseif ($item->jenis == "Pengeluaran")
                            <span class="badge badge-info">{{ $item->jenis }}</span>
                            @endif
                        </td>
                        <td>
                            {!! $item->keterangan !!}
                        </td>
                        <td>{{ $item->user->name }}</td>
                        <td>
                            <a href="{{ route('dashboard.finance.show', $item->id) }}" class="btn btn-info btn-sm mr-1">
                                <i class="fas fa-book-open"></i>
                            </a>
                            <a href="{{ route('dashboard.finance.edit', $item->id) }}"
                                class="btn btn-primary btn-sm mr-1">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form method="POST" style="display:inline;"
                                action="{{ route('dashboard.finance.destroy', $item->id) }}">
                                @csrf
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
