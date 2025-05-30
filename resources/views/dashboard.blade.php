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
            <h1 class="text-xl font-bold">Page Admin</h1>
            <div>
                <a href="{{ route('admin_chefD.planning') }}" class="hover:underline">Planning</a>
                <a href="{{ route('Suivi.suiv') }}" class="hover:underline">Suivi</a>
                <a href="{{ route('Reproting.suivi_cours') }}" class="hover:underline">Reporting</a>
                <a href="{{ route('semestres.analyse') }}" class="hover:underline">Insights</a>
                <a href="{{ route('welcome') }}" class="hover:underline">Se deconnecter</a>
                
            </div>
        </div>
    </nav>

    
    <main class="container mx-auto py-10">
        <div class="container max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-10">
    <h3 class="text-2xl font-bold mb-6 text-center text-gray-800">Gestion des utilisateurs</h3>

    <div class="flex flex-col space-y-4">
        <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-gray-200 text-white py-3 px-6 rounded-full text-center font-semibold shadow border-l-4 border-purple-600 transition">
            Ajouter un utilisateur
        </a>

        <a href="{{ route('user.index') }}" class="bg-green-600 hover:bg-gray-200 text-white py-3 px-6 rounded-full text-center font-semibold shadow border-l-4 border-blue-700 transition">
            Liste des utilisateurs
        </a>

        <a href="{{ route('use.index') }}" class="bg-purple-600 hover:bg-gray-200 text-white py-3 px-6 rounded-full text-center font-semibold shadow border-l-4 border-green-700  transition">
            Gérer les rôles
        </a>
    </div>
</div>
 
    </main>

     
    @include('partials.footer')

</body>
</html>
