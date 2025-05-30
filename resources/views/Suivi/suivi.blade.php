 
<div class="container mt-4">
    <h2>Suivi des cours par niveau, semestre et module</h2>

    @foreach ($resultats as $niveau)
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Niveau : {{ $niveau['niveau'] }}</h4>
            </div>

            <div class="card-body">
                @foreach ($niveau['semestres'] as $semestre)
                    <h5 class="text-primary mt-3">Semestre : {{ $semestre['semestre'] }}</h5>

                    @foreach ($semestre['ues'] as $ue)
                        <h6 class="text-secondary">Module (UE) : {{ $ue['ue'] }}</h6>

                        <table class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>Cours</th>
                                    <th>Heure totale</th>
                                    <th>Heure suivie</th>
                                    <th>Heure restante</th>
                                    <th>Progression</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ue['cours'] as $cours)
                                    <tr>
                                        <td>{{ $cours['Cours'] }}</td>
                                        <td>{{ $cours['Heure_total'] }}</td>
                                        <td>{{ $cours['Heure_suivie'] }}</td>
                                        <td>{{ $cours['Heure_restante'] }}</td>
                                        <td>{{ $cours['Progression'] }}%</td>
                                        <td>
                                            <span class="badge {{ $cours['Statut'] === 'Terminé' ? 'Terminer' : 'En cours' }}">
                                                {{ $cours['Statut'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
</div>
<div>@if ($user)
    @if ($user->hasRole('admin'))
        <a href="{{ route('admin.dashboard') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-full shadow">
            Retour au tableau de bord
        </a>
    @elseif ($user->hasRole('chef_departement'))
        <a href="{{ route('chef_departement.dashboard2') }}"
           class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-full shadow">
            Retour à l'espace Chef de Département
        </a>
    @elseif ($user->hasRole('chef_filliere'))
        <a href="{{ route('chef_filliere.dashboard1') }}"
           class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-full shadow">
            Retour à l'espace Chef de Filière
        </a>
    @elseif ($user->hasRole('assistant'))
        <a href="{{ route('assistant.dashboard3') }}"
           class="bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-full shadow">
            Retour à l'espace Assistant
        </a>
    @endif
@endif</div>
 
