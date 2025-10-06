{{-- resources/views/categories/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Data Categori')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            
            <div>
                <h3 class="text-center my-4">DATA KATEGORI</h3>
                <p class="text-center text-muted">Masukkan kategori barang</p>
                <hr>
            </div>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">

                    {{-- Hanya admin yang bisa tambah kategori --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('categories.create') }}" class="btn btn-md btn-success mb-3">+ Tambah Kategori</a>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <thead style="background-color:coral">
                                <tr>
                                    <th>ID</th>
                                    <th>NAMA</th>
                                    <th>DESKRIPSI</th>
                                    <th>DIBUAT</th>
                                    @if(auth()->user()->role === 'admin')
                                        <th style="width: 25%">AKSI</th>
                                    @else
                                        <th style="width: 15%">AKSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ strip_tags($category->description) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                {{-- Semua user bisa lihat --}}
                                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                                
                                                {{-- Hanya admin bisa edit & hapus --}}
                                                @if(auth()->user()->role === 'admin')
                                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    <form onsubmit="return confirm('Yakin ingin hapus?');" 
                                                          action="{{ route('categories.destroy', $category->id) }}" 
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ auth()->user()->role === 'admin' ? 5 : 4 }}" 
                                            class="text-center text-danger">
                                            Data kategori belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($categories->hasPages())
                        <div class="mt-3 d-flex justify-content-end">
                            {{ $categories->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
