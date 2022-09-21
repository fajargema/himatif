<div class="modal fade edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Edit Pengurus</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.finance.edit-paparan', $item->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="finances_id" value="{{ $data->id }}">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Satuan</label>
                            <input type="text" class="form-control" name="satuan"
                                value="{{ old('satuan') ?? $item->satuan }}" placeholder="Satuan">
                        </div>

                        <div class="col-sm-6">
                            <label>Kuantitas</label>
                            <input type="number" class="form-control" name="qty" value="{{ old('qty') ?? $item->qty }}"
                                placeholder="Kuantitas">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga"
                            value="{{ old('harga') ?? $item->harga }}" placeholder="Harga">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" placeholder="Keterangan"
                            rows="5">{{ old('keterangan') ?? $item->keterangan }}</textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-secondary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
