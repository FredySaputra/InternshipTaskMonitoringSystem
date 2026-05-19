@extends('admin/layout/main')

@section('title', 'Tambah Data Lab')

@section('content')

<div class="row">
    <div class="col-md-8 col-lg-6"> <div class="d-flex align-items-center mb-4">
            <h2 class="mb-0">Tambah Data Lab</h2>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('lab.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Lab<span style="color: red">*</span> : </label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Lab Komputer 1" maxlength="40" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category" class="form-label fw-bold">Kategori Lab<span style="color: red">*</span> : </label>
                        <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" maxlength="40" required>
                            <option value="">-- Pilih Kategori Lab --</option>
                            <option value="Programming" {{ old('category') == 'Programming' ? 'selected' : '' }}>Programming</option>
                            <option value="Design" {{ old('category') == 'Design' ? 'selected' : '' }}>Design</option>
                            <option value="Artificial Intelegent" {{ old('category') == 'Artificial Intelegent' ? 'selected' : '' }}>Artificial Intelegent</option>
                            <option value="Networking" {{ old('category') == 'Networking' ? 'selected' : '' }}>Networking</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                        <a href="{{ route('lab.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
