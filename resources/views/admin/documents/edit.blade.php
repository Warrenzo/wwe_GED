@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Modifier Document</h1>
    <form action="{{ route('documents.update', $document->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $document->title }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="classification_id">Repertoire</label>
            <select class="form-control" id="classification_id" name="classification_id" required>
                @foreach($classifications as $classification)
                <option value="{{ $classification->id }}" @if($document->classification_id == $classification->id) selected @endif>{{ $classification->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="content">Contenu</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $document->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>
@endsection
