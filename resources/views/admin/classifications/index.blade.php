@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Répertoire</h1>
    <a href="{{ route('classifications.create') }}" class="btn btn-primary mb-3">Créer un répertoire</a>

    @if($classifications->isEmpty())
        <p>Pas de répertoire sélectionné.</p>
    @else
        <ul class="list-group">
            @foreach($classifications as $classification)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $classification->name }}</strong>
                        </div>
                        <div>
                            <a href="{{ route('classifications.documents', $classification->id) }}" class="btn btn-info btn-sm">
                                Voir les documents
                            </a>
                        </div>
                    </div>

                    {{-- Afficher les sous-classifications de manière récursive --}}
                    @include('admin.classifications._classification_row', ['classification' => $classification])
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
