<div class="modal fade edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Edit Pengurus</h2>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.user.update', $item->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>NIM*</label>
                        <input type="text" readonly class="form-control" name="nim" value="{{ $item->nim }}">
                    </div>
                    <div class="form-group">
                        <label>Nama Pengurus*</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') ?? $item->name }}">
                    </div>

                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role[]" class="form-control {{ $errors->has('role') ? 'is-invalid':'' }}"
                            required>
                            <option value="">Pilih</option>
                            @foreach ($jabatan as $row)
                            <option value="{{ $row->name }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger">{{ $errors->first('role') }}</p>
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
