<form action="{{ route('annee_academique.store') }}" method="post">
    @csrf
    <label for=""><b>Nom du departement</b> </label>
    <input type="text" name="departement" placeholder="Departement" required>
    <label for=""><b>Date de fin de l'annee</b></label>
    <input type="date" name="date_debut">
    <label for=""><b>>Date de debut de l'annee</b></label>
    <input type="date" name="date_fin">

    @foreach ($semestres as $i => $semestre)
        <h4>Semestre {{ $i}}</h4>
        <input type="text" name="semesters[{{ $i}}][nom_semestre" value="S{{$i}}" required>
    


        <input type="date" name="semesters[{{ $i}}][date_debut]" required>
        <select name="semesters[{{ $i - 1 }}][nbSemaines]" id="" required>
            @for ($j = 8; $j <= 12; $j++)
                <option value="{{ $j }}">{{ $j }}</option>
            @endfor
        </select>
     @endforeach

     <button type="submit"><a href="{{route('anne_academique.gantt_Dhtmls')}}">generer le diagramme</a></button>
</form>