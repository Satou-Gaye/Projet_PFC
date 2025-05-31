<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>page admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">  
</head>
<body class="bg-gray-100 text-gray-900">

     
    <nav class="bg-blue-700 text-white px-6 py-4 shadow-md">
  <div class="container mx-auto flex flex-wrap md:flex-nowrap justify-between items-center">
    <h1 class="text-xl font-bold tracking-wide">Page Admin</h1>
    <div class="mt-3 md:mt-0 flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6 text-sm font-semibold">
      <a href="{{ route('admin_chefD.planning') }}" class="hover:underline hover:text-gray-300 transition">Planning</a>
      <a href="{{ route('Suivi.suiv') }}" class="hover:underline hover:text-gray-300 transition">Suivi</a>
      <a href="{{ route('Reproting.suivi_cours') }}" class="hover:underline hover:text-gray-300 transition">Reporting</a>
      <a href="{{ route('semestres.analyse') }}" class="hover:underline hover:text-gray-300 transition">Insights</a>
      <a href="{{ route('welcome') }}" class="hover:underline hover:text-red-300 transition">Se déconnecter</a>
    </div>
  </div>
</nav>


    
    <main class="container mx-auto py-10">
        <div class="container max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-10">
    <h3 class="text-2xl font-bold mb-6 text-center text-gray-800">Gestion des utilisateurs</h3>

    <div class="flex flex-col space-y-4">
        <div class="bg-white shadow-lg rounded-xl p-6 w-fit hover:shadow-xl transition">
    <a href="{{ route('user.create_user') }}"
       class="text-black font-semibold text-lg flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Ajouter un utilisateur
    </a>
</div>
    
    <div class="bg-white shadow-lg rounded-xl p-6 w-fit hover:shadow-xl transition">
    <a href="{{ route('user.index') }}"
       class="text-black font-semibold text-lg flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Liste des utilisateurs
    </a>
</div> 
        </a>
    </div>
</div>
 
    </main>

     
    @include('profile.partials.footer')

</body>
</html>
