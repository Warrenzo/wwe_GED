{{-- resources/views/admin/classifications/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Creer un repertoire</h1>
    <form action="{{ route('classifications.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mt-3">
            <label for="parent_id">Repertoire parent</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">Aucun repertoire selectionné</option>
                @foreach($classifications as $classification)
                    @include('admin.classifications._classification_option', ['classification' => $classification, 'level' => 0])
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Créer</button>
    </form>
</div>
@endsection
