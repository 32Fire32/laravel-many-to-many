@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <h1>Modifica il tipo di tecnologia: {{ $technology->name }}</h1>
        <form action="{{ route('admin.technologies.update', $technology) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome tecnologia*</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $technology->name) }}" required>
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror

            <button type="submit" class="btn btn-primary">Modifica</button>
            <a href="{{ route('admin.technologies.index') }}"class="btn btn-secondary">Torna alla lista delle tecnologie</a>
        </form>
    </div>
@endsection
