@extends('layouts.admin.admin')

@section('content')
    <div class="container text-center">
        <h1>{{ $technology->name }}</h1>
        @if ($technology->projects->isNotEmpty())
            <ul>
                @foreach ($technology->projects as $project)
                    <li><a href="{{ route('admin.projects.show', $project) }}">{{ $project->name_project }}</a></li>
                @endforeach
            </ul>
        @else
            <h3>Nessuna tipologia associata</h3>
        @endif
        <a href="{{ route('admin.technologies.index') }}"class="btn btn-primary">Torna alla lista delle tipologie</a>
    @endsection
