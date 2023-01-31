@extends('layouts.admin.admin')

@section('content')
    <div class="container text-center">
        <h1>{{ $project->name_project }}</h1>
        @if ($project->project_logo_img)
            <div>
                <img class="w-25" src="{{ asset("storage/$project->project_logo_img") }}" alt="{{ $project->name_project }}">
            </div>
            <p>{!! $project->summary !!}</p>
        @endif
        @if ($project->doc_project)
            <div>
                <a href="{{ asset("storage/$project->doc_project") }}" download>
                    <i class="fa-solid fa-file-arrow-down"></i> Download File
                </a>
            </div>
            <p>{!! $project->summary !!}</p>
        @endif
        <h4>
            @if ($project->type)
                Tipo di progetto: <a href="{{ route('admin.types.show', $project->type) }}">{{ $project->type->name }}</a>
            @else
                Nessun tipo di progetto
            @endif
        </h4>

        <a href="{{ route('admin.projects.index') }}"class="btn btn-primary">Torna alla lista dei progetti</a>
    @endsection
