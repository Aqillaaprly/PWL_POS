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
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <td>{{ $category->category_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode Kategori</th>
                        <td>{{ $category->category_code }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kategori</th>
                        <td>{{ $category->category_name }}</td>
                    </tr>
                </table>

                <a href="{{ url('/category') }}" class="btn btn-secondary mt-3">Kembali</a>
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