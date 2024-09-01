{{-- resources/views/admin/classifications/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Modifier un repertoire</h1>
    <form action="{{ route('classifications.update', $classification->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $classification->name }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="parent_id">Repertoire parent</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">Aucun repertoire disponible</option>
                @foreach($classifications as $classificationOption)
                    @include('admin.classifications._classification_option', ['classification' => $classificationOption, 'level' => 0])
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>
@endsection
