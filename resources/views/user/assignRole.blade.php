<form action="{{ route('users.assignRole', $user->id) }}" method="POST">
    @csrf
    <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
    <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md">
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
        <option value="chef_departement" {{ $user->role == 'chef_departement' ? 'selected' : '' }}>Chef de département</option>
        <option value="chef_filliere" {{ $user->role == 'chef_filliere' ? 'selected' : '' }}>Chef de filière</option>
        <option value="assistant" {{ $user->role == 'assistant' ? 'selected' : '' }}>Assistant</option>
    </select>
    <button type="submit" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Mettre à jour le rôle
    </button>
</form>
