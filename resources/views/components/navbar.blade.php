<!-- resources/views/components/navbar.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo et nom de l’établissement -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
            <img src="{{ asset('images/Logo Lmd.jpg') }}" alt="LMD Exam Logo" height="70" style="max-height: 70px;" class="me-2">
            <span class="fw-bold text-primary">CFP Les Métiers du Digital</span>
        </a>

        <!-- Bouton pour affichage mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    @if (session()->has('etudiant'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.dashboard') }}">Tableau de bord étudiant</a>
                        </li>
                    @elseif (session()->has('professeur'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('professor.dashboard') }}">Tableau de bord enseignant</a>
                        </li>
                    @elseif (session()->has('admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Administration</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Déconnexion</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.login') }}">Connexion Étudiant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('professor.login') }}">Connexion Enseignant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">Connexion Admin</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
