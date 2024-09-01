@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Documents pour le repertoire  : {{ $classification->name }}</h1>
    <a href="{{ route('classifications.index') }}" class="btn btn-secondary mb-3">Retour aux répertoires</a>

    @if($documents->isEmpty())
        <p>Aucun document associé à cet repertoires et ses sous-epertoires.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Classification</th>
                    <th>Fichier</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                <tr>
                    <td>{{ $document->title }}</td>
                    <td>{{ $document->classification->name }}</td>
                    <td>
                        @if($document->file_path)
                            <a href="{{ Storage::url($document->file_path) }}" target="_blank">Télécharger</a>
                        @else
                            Aucun Fichier
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce document ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
