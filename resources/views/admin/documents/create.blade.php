@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Creer un Document</h1>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="classification_id">Repertoires</label>
            <select class="form-control" id="classification_id" name="classification_id" required>
                <option value="">Selectionner un Repertoire</option>
                @foreach($classifications as $classification)
                    @include('admin.classifications._classification_option', ['classification' => $classification, 'level' => 0])
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="file">Modifier un ficher</label>
            <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Créer</button>
    </form>
</div>
@endsection
