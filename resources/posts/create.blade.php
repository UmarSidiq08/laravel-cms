@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Postingan Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>
        <div class="form-group">
            <label for="body">Konten</label>
            <textarea name="body" class="form-control" id="body" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Gambar (opsional)</label>
            <input type="file" name="image" class="form-control" id="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection