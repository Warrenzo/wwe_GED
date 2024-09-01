{{-- resources/views/admin/users/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier un utilisateur</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Laisser le champ vide pour garder le mot de passe actuel.</small>
        </div>

        <div class="form-group mt-3">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group mt-3">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role">
                <option value="user" @if($user->role == 'user') selected @endif>Utilisateur</option>
                <option value="admin" @if($user->role == 'admin') selected @endif>Administrateur</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Modifier Utilisateur</button>
    </form>
</div>
@endsection
