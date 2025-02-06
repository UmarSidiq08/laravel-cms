@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Postingan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}" required>
        </div>
        <div class="form-group">
            <label for="body">Konten</label>
            <textarea name="body" class="form-control" id="body" rows="5" required>{{ $post->body }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Gambar (opsional)</label>
            <input type="file" name="image" class="form-control" id="image" accept="image/*">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Gambar Post" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        </div>
        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection