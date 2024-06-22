<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs non approuvés</title>
    <!-- Ajoutez vos liens vers les fichiers CSS ici -->
</head>
<body>
    <div class="container">
        <h1>Utilisateurs non approuvés</h1>
        <ul>
            @foreach ($users as $user)
                <li>
                    {{ $user->first_name }} {{ $user->family_name }} - {{ $user->email }}
                    <form action="{{ route('admin.approve-user', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Approuver</button>
                    </form>
                    <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- Ajoutez vos liens vers les fichiers JavaScript ici -->
</body>
</html>
