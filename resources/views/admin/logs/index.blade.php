@extends('layouts.app')
@section('title', 'Journal d’activité - Admin')

@section('content')
<div class="container mt-5">
    <h2>Journal d’activité</h2>
    <p class="text-muted mb-4">Toutes les actions réalisées dans le système sont enregistrées ici.</p>

    <table class="table table-dark table-striped table-sm mt-3">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Description</th>
                <th>Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                    <td><code>{{ $log->type }}</code></td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->user_type }} #{{ $log->user_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mt-3">← Retour au tableau de bord</a>
</div>
@endsection
