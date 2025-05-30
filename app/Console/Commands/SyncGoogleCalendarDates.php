<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\GoogleCalendar\Event;
use App\Models\DateMorte;
use Carbon\Carbon;

class SyncGoogleCalendarDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-google-calendar-dates';

    /**
     * The console command description.
     *
     * @var string
     */ 
    protected $description = 'Synchronise les dates mortes depuis Google Calendar';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $events = Event::get();

        foreach ($events as $event) {
            DateMorte::updateOrCreate(
                [
                    'titre' => $event->name,
                    'date_debut' => Carbon::parse($event->startDate),
                    'date_fin' => Carbon::parse($event->endDate),
                ],
                [
                    'annee_academique_id' => 1, // Remplacez par la logique appropriée
                ]
            );
        }

        $this->info('Dates mortes synchronisées avec succès.');
    }
    }


   

