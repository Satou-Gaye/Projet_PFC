<!DOCTYPE html>
<html>
<head>
    <title> </title>
</head>
<body>
    <h1>Page d’accueil</h1>
    <header>@include('layouts.navigation')</header>
    <a href="{{ route('login') }}">Se connecter</a>
    <main>
    </main>
    <div>@include('profile.partials.footer')</div>
</body>
</html>
