<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\AcademicPeriode;
use App\Services\HolidayICSService;
use Illuminate\Support\Facades\Cache;


class AcademiquePeriodeService {
        protected $googleCalendarService;

    // Changez la signature pour recevoir une instance de HolidayICSService
    public function __construct(HolidayICSService $holidayService)
    {
        $this->holidayService = $holidayService;
    }
    /**
     * calculer la date de fin effective en partant d'une date de debut et
     * d'un nombre de semaines, em excluant les jours mortes
     * 
     * @param string $dateDebut
     * @param int $semaine
     * @param array $holidays Liste des dates fériées (format Y-m-d)
     * @return string Date de fin effective
     **/
    public function calculDateFinEffective(string $dateDebut, int $semaine, array $holidays){
        $debut = Carbon::parse($dateDebut);
        // date sans ajustement
        $dateFinTheotique = $debut->copy()->addWeeks($semaine);

        $daysToSkip = 0;
        //itteration sur chaque de la periode et comptabilise les jours feries
        $periode = new \DatePeriode($debut, new \DateInterval('PID'), $dateFinTheotique->copy());
        foreach ($periode as $date) {
            if (in_array($date->format('Y-m-d'), $holidays)) {
                $daysToSkip++;
            }
        }

        //reporter la date final en ajoutant les jpurs feries
        $finEffective = $dateFinTheotique->copy()->addDays($daysToSkip);
        return $finEffective->toDateString();
    }
     /**
     * Récupère les dates fériées pour la période allant de startDate à startDate + weeks.
     *
     * @param string $dateDebut
     * @param int $semaine
     * @return array Liste des dates fériées (format Y-m-d)
     */
    public function getHolidayDatesForPeriode(String $dateDebut, int $semaine): array {
        $debut = Carbon::parse($dateDebut);
        $fin = $debut->copy()->addWeeks($semaine);

        // Recuperer la date mise a jours
        $holidayDate = Cache::get('senegal_holidays', []);

        //returne les jours qui sont compris entre les date
        return array_filter($holidayDate, function($holidays) use ($debut, $fin){
            $holidayDate = Carbon::paerse($holidays);
            return $holidayDate->between($debut, $fin);
        });
    }

      /**
     * Crée une période académique. (La logique de calcul est déléguée à l'observer lors de la création.)
     *
     * @param array $data
     * @return AcademicPeriod
     */
    public function createAcademicPeriode(array $data): AcademicPeriode
    {
        return AcademicPeriode::create($data);
    }

}