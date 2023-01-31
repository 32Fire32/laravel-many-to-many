@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <h1>Inserisci una nuova tipologia</h1>
        <form action="{{ route('admin.types.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome della nuova tipologia*</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" required>
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror

            <button type="submit" class="btn btn-primary">Crea</button>
            <a href="{{ route('admin.types.index') }}"class="btn btn-secondary">Torna alla lista delle tipologie</a>
        </form>
    </div>
@endsection
