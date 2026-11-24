{{-- Form Shared Component (_form.blade.php) --}}
<div class="form-grid">
    {{-- Kode Barang --}}
    <div class="form-group">
        <label for="kode" class="form-label">
            Kode Barang <span class="required">*</span>
        </label>
        <input type="text"
               id="kode"
               name="kode"
               class="form-control @error('kode') is-invalid @enderror"
               placeholder="Contoh: BRG-005"
               value="{{ old('kode', $barang['kode'] ?? '') }}"
               {{ isset($barang) ? 'readonly' : 'required' }}>
        @error('kode')
            <div class="form-error">{{ $message }}</div>
        @else
            @if(isset($barang))
                <div class="form-help">Kode barang merupakan kunci unik dan tidak dapat diubah.</div>
            @else
                <div class="form-help">Kode unik pengenal aset (huruf & angka).</div>
            @endif
        @enderror
    </div>

    {{-- Nama Barang --}}
    <div class="form-group">
        <label for="nama" class="form-label">
            Nama Barang <span class="required">*</span>
        </label>
        <input type="text"
               id="nama"
               name="nama"
               class="form-control @error('nama') is-invalid @enderror"
               placeholder="Contoh: Monitor Dell UltraSharp 24 inch"
               value="{{ old('nama', $barang['nama'] ?? '') }}"
               required>
        @error('nama')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>

    {{-- Kategori --}}
    <div class="form-group">
        <label for="kategori" class="form-label">
            Kategori <span class="required">*</span>
        </label>
        @php $curKat = old('kategori', $barang['kategori'] ?? ''); @endphp
        <select id="kategori" name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Elektronik" {{ $curKat === 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
            <option value="Furniture" {{ $curKat === 'Furniture' ? 'selected' : '' }}>Furniture</option>
            <option value="Perangkat Jaringan" {{ $curKat === 'Perangkat Jaringan' ? 'selected' : '' }}>Perangkat Jaringan</option>
            <option value="Alat Tulis Kantor" {{ $curKat === 'Alat Tulis Kantor' ? 'selected' : '' }}>Alat Tulis Kantor</option>
            <option value="Peralatan Multimedia" {{ $curKat === 'Peralatan Multimedia' ? 'selected' : '' }}>Peralatan Multimedia</option>
        </select>
        @error('kategori')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>

    {{-- Lokasi Penempatan --}}
    <div class="form-group">
        <label for="lokasi" class="form-label">
            Lokasi Penempatan <span class="required">*</span>
        </label>
        <input type="text"
               id="lokasi"
               name="lokasi"
               class="form-control @error('lokasi') is-invalid @enderror"
               placeholder="Contoh: Lab Jaringan Komputer Lt. 2"
               value="{{ old('lokasi', $barang['lokasi'] ?? '') }}"
               required>
        @error('lokasi')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>

    {{-- Jumlah Unit --}}
    <div class="form-group">
        <label for="jumlah" class="form-label">
            Jumlah Unit Fisik <span class="required">*</span>
        </label>
        <input type="number"
               id="jumlah"
               name="jumlah"
               min="1"
               class="form-control @error('jumlah') is-invalid @enderror"
               value="{{ old('jumlah', $barang['jumlah'] ?? 1) }}"
               required>
        @error('jumlah')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>

    {{-- Kondisi Fisik --}}
    <div class="form-group">
        <label for="kondisi" class="form-label">
            Kondisi Fisik <span class="required">*</span>
        </label>
        @php $curKondisi = old('kondisi', $barang['kondisi'] ?? 'Baik'); @endphp
        <select id="kondisi" name="kondisi" class="form-control @error('kondisi') is-invalid @enderror" required>
            <option value="Baik" {{ $curKondisi === 'Baik' ? 'selected' : '' }}>Baik (Siap Pakai)</option>
            <option value="Rusak Ringan" {{ $curKondisi === 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan (Perlu Servis)</option>
            <option value="Rusak Berat" {{ $curKondisi === 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat (Afkir / Rusak Total)</option>
        </select>
        @error('kondisi')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>

    {{-- Deskripsi / Keterangan --}}
    <div class="form-group col-span-2">
        <label for="deskripsi" class="form-label">Deskripsi / Keterangan Tambahan</label>
        <textarea id="deskripsi"
                  name="deskripsi"
                  rows="3"
                  class="form-control @error('deskripsi') is-invalid @enderror"
                  placeholder="Nomor seri, spesifikasi teknis, atau riwayat pengadaan...">{{ old('deskripsi', $barang['deskripsi'] ?? '') }}</textarea>
        @error('deskripsi')
            <div class="form-error">{{ $message }}</div>
        @enderror
    </div>
</div>
