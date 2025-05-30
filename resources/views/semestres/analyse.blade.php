<!DOCTYPE html>
<html>
<head>
    <title>Insights</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <style>
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #f5f5f5;
        }
        .rose {
            background-color: #ffc0cb;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Diagramme des nombres de semaines par semestre</h2>
    <div id="chart-container" style="width: 90%; margin: auto;"></div>

    <script>
        Highcharts.chart('chart-container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Nombre de semaines par semestre'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Semestre'
                }
            },
            yAxis: {
                title: {
                    text: 'Nombre de semaines'
                }
            },
            series: [{
                name: 'Semaines',
                data: @json($semestresChart)
            }]
        });
    </script>

    <h2 style="text-align: center;">Tableau des semestres avec nbSemaine ≤ 8 en rose</h2>
    <table>
        <thead>
            <tr>
                <th>Semestre</th>
                <th>Niveau</th>
                <th>Nb de semaines</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semestres as $sem)
                <tr class="{{ $sem->nbSemaines <= 8 ? 'rose' : '' }}">
                    <td>{{ $sem->nom_semestre ?? 'Semestre '.$sem->id }}</td>
                    <td>{{ $sem->niveau->nom_niveau ?? 'N/A' }}</td>
                    <td>{{ $sem->nbSemaines }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Progression des semestres par niveau</h2>
    <table>
        <thead>
            <tr>
                <th>Semestre</th>
                <th>Niveau</th>
                <th>Nb semaines prévues</th>
                <th>Nb semaines écoulées</th>
                <th>Progression</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semestres as $sem)
                @php
                    // Simulation : on suppose que le semestre a commencé il y a X semaines
                    $debut = $sem->created_at ?? now()->subWeeks(rand(1, $sem->nbSemaine));
                    $nbPassees = now()->diffInWeeks($debut);
                    $progression = $sem->nbSemaines > 0
                        ? min(round(($nbPassees / $sem->nbSemaines) * 100, 1), 100)
                        : 0;
                @endphp
                <tr>
                    <td>{{ $sem->nom_semestre ?? 'Semestre '.$sem->id }}</td>
                    <td>{{ $sem->niveau->nom_niveau ?? 'N/A' }}</td>
                    <td>{{ $sem->nbSemaines }}</td>
                    <td>{{ $nbPassees }}</td>
                    <td>{{ $progression }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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

</body>
</html>
