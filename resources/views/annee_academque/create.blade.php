<form action="{{ route('annee_academiques.store') }}" method="post">
    @csrf
    <input type="text" name="departement" placeholder="Departement" required>
    <input type="date" name="date_debut">
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

     <button type="submit">generer le diagramme</button>
</form>