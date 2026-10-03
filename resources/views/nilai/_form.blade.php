<div class="field">
    <label for="siswa_id">Siswa</label>
    <select id="siswa_id" name="siswa_id" required>
        <option value="">— Pilih siswa —</option>
        @foreach ($siswas as $s)
            <option value="{{ $s->id }}" @selected(old('siswa_id', isset($nilai) ? $nilai->siswa_id : request('siswa_id')) == $s->id)>
                {{ $s->nis }} — {{ $s->nama }} ({{ $s->kelas }})
            </option>
        @endforeach
    </select>
    @error('siswa_id')<div class="field-error">{{ $message }}</div>@enderror
</div>
<div class="grid-2">
    <div class="field">
        <label for="mata_pelajaran">Mata pelajaran</label>
        <input id="mata_pelajaran" name="mata_pelajaran" value="{{ old('mata_pelajaran', isset($nilai) ? $nilai->mata_pelajaran : '') }}" required>
        @error('mata_pelajaran')<div class="field-error">{{ $message }}</div>@enderror
    </div>
    <div class="field">
        <label for="semester">Semester</label>
        <input type="number" id="semester" name="semester" min="1" max="12" value="{{ old('semester', isset($nilai) ? $nilai->semester : 1) }}" required>
        @error('semester')<div class="field-error">{{ $message }}</div>@enderror
    </div>
</div>
<div class="field">
    <label for="nilai">Nilai (0–100)</label>
    <input type="number" step="0.01" id="nilai" name="nilai" min="0" max="100" value="{{ old('nilai', isset($nilai) ? $nilai->nilai : '') }}" required>
    @error('nilai')<div class="field-error">{{ $message }}</div>@enderror
</div>
