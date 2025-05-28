<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annee cademqiue</title>
     <link rel="stylesheet" href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css">
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <style>
            html, body { height: 100%; margin: 0; padding: 0; }
    </style>
</head>
<body>
    <h3>Planification - {{ $academicYear->departement }} ({{ $academicYear->start_date }} à {{ $academicYear->end_date }})</h3>
     <div id="gantt_here"></div>
     <script>
         gantt.config.json_date = "%Y-%m-%d";
         gantt.init("gantt_here");
         gantt.parse({
            data: [
                @foreach ($academicYear->semestres as $semester)
                id{
                    id: {{ $semester->id }},
                    text: "{{ $semester->nom_semestre }} ({{ $semester->niveau->nom }})",
                    start_date: "{{ $semester->dateExtreme->date_debut }}",
                    end_date: "{{ $semester->dateExtreme->date_fin }}",
                    color: "#3c8dbc"
                },{
                    id: "exam-{{ $semester->id }}",
                    text: "Examens ({{ $semester->nom_semestre }})",
                    start_date: "{{ $semester->dateExtreme->debut examen }}",
                    end_date: "{{ $semester->dateExtreme->date_fin }}",
                    color: "#dd4b39"
                },
                @endforeach

                @foreach ($deadDates as $i => $date)
                {
                    id: "dead-{{ $i }}",
                    text: "Date morte",
                    start_date: "{{ $date }}",
                    end_date: "{{ $date }}",
                    type: gantt.config.types.milestone,
                    color: "#6c757d"
                },
                @endforeach
            ]
         });
     </script>
    
</body>
</html>