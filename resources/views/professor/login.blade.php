<!-- resources/views/professor/login.blade.php -->

@extends('layouts.app')

@section('title', 'Connexion Professeur')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white text-center">
                <h4>Connexion Professeur</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('professor.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email_prof" class="form-label">Email</label>
                        <input type="email" name="email_prof" id="email_prof" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
