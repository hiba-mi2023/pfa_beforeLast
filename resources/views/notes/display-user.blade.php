<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="{{ asset('css/app1.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="user-info-container">
        <div class="background-image">
            <img src="{{ asset('images/notes/photodecouverture.jpg') }}" alt="Profile Image">
            <div class="profile-image-container" onclick="openUploadWindow()">
                <img src="{{ $user->photo_de_profil ? asset('storage/' . $user->photo_de_profil) : asset('images/notes/photodeprofile.png') }}" alt="Profile Image">

            </div>
            
        </div>
        <div class="pencil-icon" onclick="toggleEditForm()">
            <img src="{{ asset('images/notes/icone_modification_profile.png') }}" alt="Edit Icon">
            @if (Auth::check())
                 <a href="{{ route('notes.display-note') }}">Voir les notes</a>
           @endif
        </div>
        <div class="profile-infos">
            <div class="profile-name">
                <h1>{{ $user->first_name }}</h1>
                <h1>{{ $user->family_name }}</h1>
            </div>
            <div class="infos">
                <div class="profile-university">
                    <p>{{ $user->university }}</p>
                </div>
                <div class="profile-filiére">
                    <p>{{ $user->study_field }}</p>
                </div>
                <div class="profile-niveau-d'étude">
                    <p>{{ $user->study_level }}</p>
                </div>
                <div class="profile-coordonées">
                    <p>{{ $user->phone }}</p>
                </div>
                <div class="profile-email">
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit form (hidden by default) -->
    <div id="edit-form" class="edit-form" style="display: none;">
        <!-- Edit form elements -->
        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <label>Nom:</label>
            <input type="text" name="first_name" value="{{ $user->first_name }}" required><br>
            <label>Prénom:</label>
            <input type="text" name="family_name" value="{{ $user->family_name }}" required><br>
            <label for="email">Email:</label><br>
            <input type="email" name="email" value="{{ $user->email }}" required><br>
            <label>Numéro de téléphone:</label><br>
            <input type="text" name="phone" value="{{ $user->phone }}"><br>
            <label>Université:</label><br>
            <input type="text" name="university" value="{{ $user->university }}"><br>
            <label>filiere:</label><br>
            <input type="text" name="study_field" value="{{ $user->study_field }}"><br>
            <input type="file" name="profile_image" accept="image/*" required>
            
       
            <button type="submit">Enregistrer les modifications</button>
        </form>
    </div>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search...">
        <button onclick="search()"><i class="fas fa-search"></i></button>
    </div>
    <script>
        function search() {
            var searchInput = document.getElementById("searchInput").value;
            var searchResults = document.getElementById("searchResults");
            searchResults.innerHTML = "<p>Search results for: " + searchInput + "</p>";
        }

        function openUploadWindow() {
            var modal = document.getElementById("upload-modal");
            modal.style.display = "block";
        }

        function closeUploadWindow() {
            var modal = document.getElementById("upload-modal");
            modal.style.display = "none";
        }

        function toggleEditForm() {
            var editForm = document.getElementById('edit-form');
            if (editForm.style.display === 'none' || editForm.style.display === '') {
                editForm.style.display = 'block';
            } else {
                editForm.style.display = 'none';
            }
        }
    </script>
</body>
</html>
