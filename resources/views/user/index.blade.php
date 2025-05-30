{{-- resources/views/user/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Utilisateurs</h1>

    @if($users->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role  }}</td>
                    <td>
 
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun utilisateur trouvé.</p>
    @endif
</div>
@endsection
