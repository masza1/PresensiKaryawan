<div class="row">
    <input type="hidden" id="edt_id" name="id" title="id" value="{{ $employee->id }}" readonly>
    <div class="col-md-4 mb-3">
        <label for="NIP" class="form-label">NIP</label>
        <input type="text" id="NIP" name="NIP" aria-describedby="nameHelp" value="{{ $employee->NIP }}" class="form-control @error('NIP') is-invalid @enderror">
        @error('NIP')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" id="name" name="name" aria-describedby="nameHelp" value="{{ $employee->name }}" class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="gender" class="form-label">Jenis Kelamin</label>
        <select class="form-select" id="gender" name="gender" aria-describedby="positionHelp" class="form-control">
            <option value="Laki-laki" {{ $employee->gender == "Laki-laki" ? " selected" : ""}}>Laki-laki</option>
            <option value="perempuan" {{ $employee->gender == "Perempuan" ? " selected" : ""}}>Perempuan</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label for="tLahir" class="form-label">Tempat Lahir</label>
        <input type="text"  id="tLahir" name="place_of_birth" aria-describedby="pobHelp" value="{{ $employee->place_of_birth }}" class="form-control @error('place_of_birth') is-invalid @enderror">
        @error('place_of_birth')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="taLahir" class="form-label">Tanggal Lahir</label>
        <input type="date"  id="taLahir" name="birthdate" aria-describedby="dobHelp" value="{{ $employee->birthdate }}" class="form-control @error('birthdate') is-invalid @enderror">
        @error('birthdate')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="position" class="form-label">Jabatan</label>
        <input type="text"  id="position" name="position_name" value="{{ $employee->position_name }}" class="form-control @error('position') is-invalid @enderror">
        @error('position')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="salary" class="form-label">Gaji Pokok</label>
        <input type="text"  id="salary" name="basic_salary" aria-describedby="bsHelp" value="{{ $employee->basic_salary }}" class="form-control @error('basic_salary') is-invalid @enderror">
        @error('basic_salary')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="allowance" class="form-label">Tunjangan</label>
        <input type="text"  id="allowance" name="allowance" aria-describedby="allowanceHelp" value="{{ $employee->allowance }}" class="form-control @error('allowance') is-invalid @enderror">
        @error('allowance')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<input type="submit" class="btn btn-primary" value="{{ $submit ?? 'Simpan' }}">