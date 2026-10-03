<div class="grid-2">
    <div class="field">
        <label for="nis">NIS</label>
        <input id="nis" name="nis" value="{{ old('nis', $siswa->nis ?? '') }}" required>
        @error('nis')<div class="field-error">{{ $message }}</div>@enderror
    </div>
    <div class="field">
        <label for="nama">Nama lengkap</label>
        <input id="nama" name="nama" value="{{ old('nama', $siswa->nama ?? '') }}" required>
        @error('nama')<div class="field-error">{{ $message }}</div>@enderror
    </div>
</div>
<div class="grid-2">
    <div class="field">
        <label for="jenis_kelamin">Jenis kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="">— Pilih —</option>
            <option value="L" @selected(old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'L')>Laki-laki</option>
            <option value="P" @selected(old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'P')>Perempuan</option>
        </select>
        @error('jenis_kelamin')<div class="field-error">{{ $message }}</div>@enderror
    </div>
    <div class="field">
        <label for="kelas">Kelas</label>
        <input id="kelas" name="kelas" value="{{ old('kelas', $siswa->kelas ?? '') }}" placeholder="Contoh: X IPA 1" required>
        @error('kelas')<div class="field-error">{{ $message }}</div>@enderror
    </div>
</div>
<div class="field">
    <label for="tanggal_lahir">Tanggal lahir</label>
    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', isset($siswa) && $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('Y-m-d') : '') }}">
    @error('tanggal_lahir')<div class="field-error">{{ $message }}</div>@enderror
</div>
<div class="field">
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" rows="3">{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
    @error('alamat')<div class="field-error">{{ $message }}</div>@enderror
</div>
