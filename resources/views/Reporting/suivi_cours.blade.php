
<div class="container mt-4">
    <h2 class="mb-4 text-center">📊 Reporting Complet des Cours (Vue Unifiée)</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>Niveau</th>
                    <th>Progression Niveau</th>
                    <th>Semestre</th>
                    <th>Progression Semestre</th>
                    <th>Module (UE)</th>
                    <th>
                    <a href=" ">Cours (EC)</a>
                    </th> 
                    <th>Heure totale</th>
                    <th>Heure suivie</th>
                    <th>Heure restante</th>
                    <th>Progression</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $niveau)
    @foreach ($niveau['semestres'] as $semestre)
        @foreach ($semestre['ues'] as $ue)
            @foreach ($ue['cours'] as $cours)
                <tr>
                    <td>{{$niveau['niveau']}}</td>
                    <td class="text-center">{{ $niveau['progression_niveau']}}%</td>
                    <td>{{$semestre['semestre'] }}</td>
                    <td class="text-center">{{ $semestre['progression_semestre'] }}%</td>
                    <td>{{ $ue['module']}}</td>
                    <td><a href="{{route('show')}}">{{ $cours['intitule'] }}</a></td>
                    <td class="text-center">{{ $cours['heure_total'] }}</td>
                    <td class="text-center">{{ $cours['heure_suivie'] }}</td>
                    <td class="text-center">{{ $cours['heure_restante'] }}</td>
                    <td class="text-center">{{ $cours['progression'] }}%</td>
                    <td class="text-center">{{ $cours['statut'] }}</td>
                </tr>
            @endforeach
        @endforeach
    @endforeach
@endforeach

            </tbody>
        </table>
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
     @php
    $user = Auth::user();
@endphp
</div>
