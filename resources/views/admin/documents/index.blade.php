@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Documents</h1>
    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Créer un Document</a>

    @if($documents->isEmpty())
        <p>Aucun Document Disponible.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Répertoire</th>
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
                           <a href="{{ route('documents.download', $document->id) }}" class="btn btn-info btn-sm">Télécharger</a>
                          @else
                         Aucun Fichier
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline-block;">
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
