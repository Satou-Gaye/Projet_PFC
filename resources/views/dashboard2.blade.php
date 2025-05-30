<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>page admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">  
</head>
<body class="bg-gray-100 text-gray-900">

     
    <nav class="bg-blue-700 text-white px-6 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Page chefD</h1>
            <div>
                <a href="{{ route('admin_chefD.planning') }}" class="hover:underline">Planning</a>
                <a href="{{ route('dashboard') }}" class="hover:underline">Suivi</a>
                <a href="{{ route('dashboard') }}" class="hover:underline">Reporting</a>
                <a href="{{ route('dashboard') }}" class="hover:underline">Insights</a>
                <a href="{{ route('welcome') }}" class="hover:underline">Se deconnecter</a>
                
            </div>
        </div>
    </nav>

    
    <main class="container mx-auto py-10">
        <div class="container max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-10">
    <h3 class="text-2xl font-bold mb-6 text-center text-gray-800">Gestion des utilisateurs</h3>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md text-gray-800">
    <div class="flex items-center space-x-6 mb-4">
        <img src="{{ asset('images/logo_ut.png') }}" alt="Logo Université de Thiès" class="w-20 h-20 object-contain">
        <h2 class="text-3xl font-bold text-purple-700">Département Informatique - Université Iba Der Thiam de Thiès</h2>
    </div>

    <p class="text-lg leading-relaxed">
        Le Département d’Informatique de l’Université de Thiès a pour mission de former des professionnels compétents dans les domaines des technologies de l’information et de la communication.
        Il propose des formations de qualité en Licence et en Master, axées sur la programmation, les systèmes d’information, les bases de données, le développement web et mobile, ainsi que l’intelligence artificielle et la cybersécurité.

        Grâce à un corps enseignant qualifié et des partenariats académiques et professionnels, le département favorise l’innovation, la recherche et l’insertion professionnelle de ses étudiants dans un environnement technologique en constante évolution.
    </p>
</div>

</div>
 
    </main>

     
    @include('partials.footer')

</body>
</html>
