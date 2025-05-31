<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion du planning</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{-- Si Tailwind est compilé --}}
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- ✅ Navigation --}}
    <nav class="bg-blue-700 text-white px-6 py-4 shadow-md">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <h1 class="text-xl font-bold mb-2 md:mb-0">Gestion du Planning</h1>

        <div class="text-sm space-x-4">
            @if (auth()->check())
                @if (auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline hover:text-gray-300 transition">
                        Retour au tableau de bord
                    </a>
                @elseif (auth()->user()->hasRole('chef_departement'))
                    <a href="{{ route('chef_departement.dashboard2') }}" class="hover:underline hover:text-gray-300 transition">
                        Retour à l'espace Chef de Département
                    </a>
                @endif
            @endif
        </div>
    </div>
</nav>


    {{-- ✅ Corps de page (inclus depuis create.blade.php) --}}
    <main class="container mx-auto py-10">
        @include('anne_academique.create')
    </main>

    {{-- ✅ Footer (inclus depuis footer.blade.php) --}}
    @include('partials.footer')

</body>
</html>
