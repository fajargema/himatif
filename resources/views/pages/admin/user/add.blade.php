<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Tambah Pengurus</h2>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.user.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nim">NIM*</label>
                        <input type="number" class="form-control" name="nim" value="{{ old('nim') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Pengurus*</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="nim">Semester*</label>
                        <select name="semester" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">E-Mail*</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
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
