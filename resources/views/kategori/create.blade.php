@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Kategori</h3>
    </div>
    
    <div class="card-body">
        <form method="POST" action="{{ url('/category') }}" class="form-horizontal">
            @csrf
            
            <!-- Level Kategori -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Kode Kategori</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="category_code" name="category_code" value="{{ old('category_code') }}" required>
                    @error('category_code')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Nama Kategori -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Nama Kategori</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="category_name" name="category_name" value="{{ old('category_name') }}" required>
                    @error('category_name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('category') }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection