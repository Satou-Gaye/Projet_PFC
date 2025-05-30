<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use App\Models\Semestre;
use App\Models\Niveau;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;
use App\Http\Requests\StoreAnneeAcademiqueRequest;
use App\Http\Requests\UpdateAnneeAcademiqueRequest;

class AnneeAcademiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::all();
        $semestres = Semestre::all();
        return view('annee_academique.create', compact('niveaux', 'semestres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnneeAcademiqueRequest $request)
    {
        $data = $request->validate([
            'departement' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'semestres' => 'required|array',
            'semestres.*.nom_semestre' => 'required|string',
            'niveaux.*.semestre_id' => 'required|exists:semestre,id',
            'semestres.*.date_debut' => 'required|date',
            'semestres.*.nbSemaines' => 'required|integer|min:8|max:12'

        ]);
        // creer une nouvelle annees acamique
        $academicYear = AnneeAcademique::create($data);

        // recuperer les dates mortes content dans l'intervalle date debut et finn de l'annee academque
        $dateMorte = Event::get(
            Carbon::parse($data['date_debut']),
            Carbon::parse($data['date_fin']),
        )->map(fn($event) => $event->starDate->toDateString())->toArray();

        foreach ($data['semestres'] as $semesterData) {
             $week = (int)  $semesterData['nbSemaines'];
          
            $semester = Semestres::create([
                'annee_academique_id' => $academicYear->id,
                'nom' => $semesterData['nom_semestre'],
                'niveau_id' => $semesterData['nivau_id'],
                'nbSemaines' => $weeks
            ]);

            $start =Carbon::parse($semesterData['date_debut']);
             $daysAdded = 0;

            while ($daysAdded < $week * 7) {
                if (!in_array($current->toDateString(), $deadDates)) {
                    $daysAdded++;
                }
                $current->addDay();
            }



            $endDate =$current->subDay();
            $examsStart = $endDate->copy()->subdays(14);

            DateExtremes::create([
                'semestre_id' => $semester->id,
                'date_debut' => $semesterData['start_date'],
                'date_fin' => $endDate,
                'debut_examen' => $examStart
                
            ]);
        }
         return redirect()->route('annee_acadeique.gantt_dhtmlx', $academicYear->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(AnneeAcademique $annee_academique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnneeAcademique $annee_academique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnneeAcademiqueRequest $request, AnneeAcademique $annee_academique)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnneeAcademique $annee_academique)
    {
        //
    }


     public function ganttDhtmls($id)
    {
        if (!auth()->check()) {
        abort(403, 'Vous devez etre connecté');
    }
            try {
            $academicYear = AnneeAcademique::with('semestres.dateExtreme.niveau')->findOrAll($id);
            $deadDates = Event::get(
                Carbon::parse($academicYear->date_debut),
                Carbon::parse($academicYear->date_fin)
            )->map(fn($event) => $event->starDate->toDateString());
        } catch (\Exception $e) {
        abort(403, 'Erreur accès Google Calendar : ' . $e->getMessage());
        }
        return view('annee_academique.gantt_dhtmlx', compact('anneeAcademiques', 'dateMortes'));
    }
}
