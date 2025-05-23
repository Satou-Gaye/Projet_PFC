@extends('layouts.app')

@section('title', 'Suivi complet des cours')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Suivi</h2>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Statut</th>
                <th>Niveau</th>
                <th>Semestre</th>
                <th>Cours</th>
                <th>Progression</th> 
                <th>Date Terminaison</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ecs as $ec)
                @php
                    $reste = max(0, $ec->nbHeureTotal - $ec->nbHeureSuivi);
                    $progress = $ec->nbHeureTotal > 0 ? round(($ec->nbHeureSuivi / $ec->nbHeureTotal) * 100, 2) : 0;
                    $termine = $ec->nbHeureSuivi >= $ec->nbHeureTotal;
                    $statut = $termine ? 'Terminé' : 'En cours';
                @endphp
                <tr>
                    <td>{{ $statut }}</td>
                    <td>{{ $ec->semestre->niveau->nom_niveau ?? 'N/A' }}</td>
                    <td>{{ $ec->semestre->nom_semestre ?? 'N/A' }}</td>
                    <td>{{ $ec->Intitule }}</td> 
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%;">
                                {{ $progress }}%
                            </div>
                        </div>
                    </td>
                   <td>{{ $termine ?  'Non définie' : '-' }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
