@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between p-5">
            <h1>Lista delle tecnologie:</h1>
            <a href="{{ route('admin.technologies.create') }}" class="btn btn-warning" data-bs-toggle="popover"
                title="Clicca qui per inserire una nuova tipologia" data-bs-trigger="hover">Inserisci una nuova tecnologia</a>
        </div>
        @if (session('message'))
            <div class="alert alert-success my-2">
                {{ session('message') }}
            </div>
        @endif
        {{-- toast --}}
        @if (session('message'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="show toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Attenzione!</strong>
                        <small>{{ \Carbon\Carbon::now()->diffForHumans() }}</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        @endif
        <table class="table text-center table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome della tecnologia</th>
                    <th scope="col">N.progetti</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technologies as $technology)
                    <tr>
                        <td>{{ $technology->id }}</td>
                        <td>{{ $technology->name }}</td>
                        <td>{{ count($technology->projects) }}</td>
                        <td>{{ $technology->slug }}</td>
                        <td>
                            <a href="{{ route('admin.technologies.show', $technology) }}" class="btn btn-info"
                                role="button" title="Clicca qui per i dettagli" data-bs-trigger="hover">D</a>
                            <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-warning"
                                title="Clicca qui per modificare" data-bs-trigger="hover">M</a>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#ModalDelete{{ $technology->id }}" data-bs-toggle="popover"
                                title="Clicca qui per i cancellare" data-bs-trigger="hover">C</a>
                            <!-- Delete Warning Modal -->

                            <div class="modal fade" id="ModalDelete{{ $technology->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h5 class="text-center">Sei sicuro di cancellare
                                                {{ $technology->name }}?
                                            </h5>
                                            <form action="{{ route('admin.technologies.destroy', $technology->slug) }}"
                                                method="POST" class="d-flex justify-content-center">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annulla</button>
                                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete Modal -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('[data-bs-toggle="popover"]').popover();
            });
        </script>
    @endsection
</div>
