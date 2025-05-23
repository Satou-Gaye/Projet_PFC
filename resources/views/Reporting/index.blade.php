@extends('layouts.app') {{-- Utilise ton layout principal si tu en as un --}}

@section('title', 'Reporting')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des EC (Éléments Constitutifs)</h1>

    @if($ecs->isEmpty())
        <p>Aucun élément n’a été trouvé.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Statut</th>
                    <th>Intitulé</th>
                    <th>Nombre d’heures total</th>
                    <th>Nombre d’heures suivies</th>
                    <th>Progression</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ecs as $ec)
                <tr>
                    <td>{{$semestre->nom_semestre. '-' .$niveau->nom_niveau}}</td>
                    <td>{{ $ec->Intitule }}</td>
                    <td>{{ $ec->nbHeureTotal }}</td>
                    <td>{{ $ec->nbHeureSuivi }}</td>
                    <td>
                        @php
                            $pourcentage = ($ec->nbHeureTotal > 0) 
                                ? ($ec->nbHeureSuivi / $ec->nbHeureTotal) * 100 
                                : 0;
                        @endphp
                        {{ round($pourcentage, 2) }} %
                    </td>
                    <td>
                        <a href="{{ route('ecs.show', $ec->id) }}" class="btn btn-info btn-sm">Voir</a>
                         
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
