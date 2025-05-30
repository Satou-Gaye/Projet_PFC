 
<div class="container mt-4">
    <h2>Détails du cours</h2>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $ec->Intitule }}</h5>
            
            <p><strong>Nombre d’heures total :</strong> {{ $ec->nbHeureTotal }}</p>
            <p><strong>Cours magistrales :</strong> {{ $ec->nbHeureEc}}</p>
            <p><strong>TD/TP :</strong> {{ $ec->nbHeureTD }}</p>
            <p><strong>Nombre d’heures suivies :</strong> {{ $ec->nbHeureSuivi }}</p>
  
            <p><strong>Statut :</strong> 
                {{ $ec->nbHeureSuivi >= $ec->nbHeureTotal ? 'Terminé' : 'En cours' }}
            </p>
            
            <a class="btn btn-outline-primary" href="{{ 
            route('Reporting.suivi_cours') }}"> Retour</a>  
        </div>
    </div>

    
</div>
 
