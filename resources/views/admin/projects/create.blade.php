@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <h1>Inserisci un nuovo progetto</h1>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name_project" class="form-label">Nome del progetto*</label>
                <input type="text" class="form-control @error('name_project') is-invalid @enderror" id="name_project"
                    name="name_project" value="{{ old('name_project') }}" required>
            </div>
            @error('name_project')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror

            <div class="mb-3">
                <label for="type_id" class="form-label">Tipo di progetto</label>
                <select class="form-select" name="type_id" id="type_id">
                    <option value="">Nessun tipo di progetto</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('type_id')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror

            <div class="mb-3">
                <label for="description">Riassunto*</label>
                <textarea class="form-control @error('summary') is-invalid @enderror " rows="2"
                    placeholder="Due righe sul progetto.." id="summary" name="summary">{{ old('summary') }}</textarea>
            </div>
            @error('summary')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror

            <div class="mb-3">
                <label for="client" class="form-label">Cliente*</label>
                <input type="text" class="form-control @error('client') is-invalid @enderror" id="client"
                    name="client" value="{{ old('client') }}" required>
            </div>
            @error('client')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror

            <div class="mb-3">
                <label for="shipped_at" class="form-label">Data creazione*</label>
                <input type="date" class="form-control @error('shipped_at') is-invalid @enderror" id="shipped_at"
                    name="shipped_at" value="{{ old('shipped_at') }}" required>
            </div>
            @error('shipped_at')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror

            <img id="output" width="100" class="mb-2" />
            <div class="mb-3">
                <label for="project_logo_img" class="form-label">Logo del progetto</label>
                <input type="file" class="form-control @error('project_logo_img') is-invalid @enderror"
                    id="project_logo_img" name="project_logo_img" value="{{ old('project_logo_img') }}"
                    onchange="loadFile(event)">
            </div>
            @error('project_logo_img')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror

            <div class="mb-3">
                <label for="doc_project" class="form-label">Dettagli</label>
                <input type="file" class="form-control @error('doc_project') is-invalid @enderror" id="doc_project"
                    name="doc_project" value="{{ old('doc_project') }}">
            </div>
            @error('doc_project')
                <div class="alert alert-danger">{{ $message }} </div>
            @enderror

            <button type="submit" class="btn btn-primary">Crea</button>
            <a href="{{ route('admin.projects.index') }}"class="btn btn-secondary">Torna alla lista dei progetti</a>
        </form>
    </div>
@endsection
