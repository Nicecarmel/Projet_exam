<!-- resources/views/admin/login.blade.php -->

@extends('layouts.app')

@section('title', 'Connexion Administrateur')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white text-center">
                <h4>Connexion Administrateur</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email_admin" class="form-label">Email</label>
                        <input type="email" name="email_admin" id="email_admin" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="mdp_admin" class="form-label">Mot de passe</label>
                        <input type="password" name="mdp_admin" id="mdp_admin" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
