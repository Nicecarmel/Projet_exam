<!-- resources/views/student/login.blade.php -->

@extends('layouts.app')

@section('title', 'Connexion Étudiant')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4>Connexion Étudiant</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('student.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="num_mat" class="form-label">Matricule</label>
                        <input type="text" name="num_mat" id="num_mat" class="form-control" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
