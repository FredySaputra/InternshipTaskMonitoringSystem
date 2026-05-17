@extends('admin/layout/main')

@section('title', 'Edit Data Lab')

@section('content')

<div class="row">
    <div class="col-md-8 col-lg-6"> <div class="d-flex align-items-center mb-4">
            <h2 class="mb-0">Edit Data Lab</h2>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('lab.update',$lab->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Lab</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$lab->name) }}" placeholder="Contoh: Lab Komputer 1">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category" class="form-label fw-bold">Kategori Lab</label>
                        <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                            <option value="">-- Pilih Kategori Lab --</option>
                            <option value="Programming" {{ old('category',$lab->category) == 'Programming' ? 'selected' : '' }}>Programming</option>
                            <option value="Design" {{ old('category',$lab->category) == 'Design' ? 'selected' : '' }}>Design</option>
                            <option value="Artificial Intelegent" {{ old('category',$lab->category) == 'Artificial Intelegent' ? 'selected' : '' }}>Artificial Intelegent</option>
                            <option value="Networking" {{ old('category',$lab->category) == 'Networking' ? 'selected' : '' }}>Networking</option>
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
