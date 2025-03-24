@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($category)
            <form method="POST" action="{{ url('/category/' . $category->category_id) }}" class="form-horizontal">
                @csrf
                @method('PUT')

                <!-- Input Level Kategori -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Kategori Kode</label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="category_code" value="{{ $category->category_code }}" required>
                        @error('category_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Pilihan Nama Kategori -->
                <div class="form-group row">
                    <label class="col-3 col-form-label">Nama Kategori</label>
                    <div class="col-9">
                        <select class="form-control" name="category_name" required>
                            <option value="">- Pilih Nama Kategori -</option>
                            @foreach($kategoriOptions as $option)
                                <option value="{{ $option->category_name }}" 
                                    @if($option->category_name == $category->category_name) selected @endif>
                                    {{ $option->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_name')
                            <small class="text-danger">{{ $__messageOriginal }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="form-group row">
                    <label class="col-3 col-form-label"></label>
                    <div class="col-9">
                        <button type="submit" class="btn btn-primary">Update Kategori</button>
                        <a href="{{ url('/category') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        @else
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                Data kategori tidak ditemukan.
            </div>
            <a href="{{ url('/category') }}" class="btn btn-default mt-2">Kembali</a>
        @endif
    </div>
</div>
@endsection