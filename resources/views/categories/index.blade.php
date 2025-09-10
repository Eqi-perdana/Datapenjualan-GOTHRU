@extends('layouts.app')

@section('title', 'Data Categori')

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="text-center mb-4">
            <h3>Daftar Kategori</h3>
            <p class="text-muted">Masukkan kategori barang</p>
            <hr>
        </div>

        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Tambah Kategori</a>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center" style="background-color:coral">
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>DESKRIPSI</th>
                            <th>DIBUAT</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($categories as $category)
                            <tr>
                                <td class="text-center">{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ strip_tags($category->description) }}</td>
                                <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Yakin ingin hapus?');"
                                        action="{{ route('categories.destroy', $category->id) }}"
                                        method="POST">
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-secondary">Lihat</a>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger">Data kategori belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $categories->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
