<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="{{ asset('css/app1.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playwrite+NZ:wght@100..400&display=swap');
    </style>
</head>
<body>
    <div class="user-info-container">
        <div class="background-image">
            
            <img src="{{ asset('images/notes/images (1).jpg') }}" alt="Profile Image">
            @if (Auth::check())
            <div class="home-link-container">
                <i class="fa-solid fa-house"></i>
                <a href="{{ route('notes.display-note') }}"  class="home-link">Home</a>
            </div>
            @endif
            <div class="profile-image-container" onclick="openUploadWindow()">
                <img src="{{ $user->photo_de_profil ? asset('storage/' . $user->photo_de_profil) : asset('images/notes/photodeprofile.png') }}" alt="Profile Image">

            </div>
            
        </div>
        <div class="pencil-icon" onclick="toggleEditForm()">
            <img src="{{ asset('images/notes/5607283.png') }}" alt="Edit Icon">
            
        </div>
        
        <div class="profile-infos">
            <div class="profile-name">
                <h1>{{ $user->first_name }} {{ $user->family_name }}</h1>
                
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
        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <label>Family Name:</label>
            <input type="text" name="first_name" value="{{ $user->first_name }}" required><br>
            <label>First Name:</label>
            <input type="text" name="family_name" value="{{ $user->family_name }}" required><br>
            <label for="email">Email:</label><br>
            <input type="email" name="email" value="{{ $user->email }}" required><br>
            <label>Phone Number:</label><br>
            <input type="text" name="phone" value="{{ $user->phone }}"><br>
            <label>University:</label><br>
            <input type="text" name="university" value="{{ $user->university }}"><br>
            <label>Study Field:</label><br>
            <input type="text" name="study_field" value="{{ $user->study_field }}"><br>
            <input type="file" name="profile_image" accept="image/*">
            <button type="submit">Save Changes</button>
        </form>
    </div>    

    <div class="search-container">
        <input type="text" id="search-input" placeholder="Search..." oninput="searchNotes()">
        <button onclick="searchNotes()"><i class="fas fa-search"></i></button>
    </div>



    
    <div class="user-saved-notes">
        <h2 class="titles">Saved Notes :</h2>
        <div class="container">
            <div class="content">
                <div id="notes-container">
                    @foreach($savedNotes as $savedNote)
                    <div class="note-link">
                    <a href="{{ route('notes.detail', ['id' => $savedNote->note->id]) }}">
                        
                        <div class="note">

                            <div class="note-container">

                                <div class="user-info">
                        
                                    <div class="user-img">
                                        @if ($savedNote->note->user->photo_de_profil)
                                            <img src="{{ asset('storage/' . $savedNote->note->user->photo_de_profil) }}" alt="Photo de profil de {{ $savedNote->note->user->first_name }}">
                                        @endif
                                    </div>
                                    <p class="user-name">
                                        
                                        @if ($savedNote->note->user)
                                        <a href="{{ route('user.profile', ['id' => $savedNote->note->user->id]) }}" class="name">
                                            {{ $savedNote->note->user->first_name }} {{ $savedNote->note->user->family_name }}
                                        </a>
                                        @endif
                                        
                                    </p>
                                </div> 
                                <div class="note-rating">        
                                </div>

                                <div class="note-actions">
                                    <form action="{{ route('saved-notes.destroy', ['id' => $savedNote->note->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                                        
                                    </form>
                                    
                                </div> 
                            </div>

                            <hr/>

                            
                            <div class="note-details">
                                <h3 class="note-title">{{ $savedNote->note->title }}</h3>
                                <p class="note-topic-id">Topic: {{ $savedNote->note->topic->name }}</p>
                                {{-- <p>Date: {{ $savedNote->note->created_at->format('d-m-Y') }}</p> --}}
                            </div>

                            <div class="image-container">
                                <img src="{{ asset('' . $savedNote->note->photo) }}" alt="Note Image">
                            </div>

                            <div class="flex">
                                <div class="keywords">
                                    <p class="keywords">{{ $savedNote->note->keywords }}</p>
                                </div>
                            
                                <div class="more-details">
                                    <button onclick="redirectToDetail({{ $savedNote->note->id }})" class="see-more-button">
                                        See More <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            

                            {{-- <form action="{{ route('saved-notes.destroy', ['id' => $savedNote->note->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form> --}}
                            
                        
                        </div>
                    </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <div class="user-notes">
        <h2 class="titles">Shared Notes :</h2>
        <div class="container">
            <div class="content">
                <div id="notes-container">
                    @foreach($notes as $note)
                    @if ($note->is_approved)
                        <a href="{{ route('notes.detail', ['id' => $note->id]) }}" class="note-link">
                            <div class="note" data-topic="{{ $note->topic->name }}">
                                <div class="note-container">
                                    <div class="user-info">
                                        @if ($note->user)
                                            <p class="user-name">{{ $note->user->first_name }} {{ $note->user->family_name }}</p>
                                        @endif
                                    </div>

                                    <div class="note-rating">
                                       
                                    </div>

                                    <div class="note-actions">
                                   
                                    </div>
                                </div>
                                <hr/>

                                <div class="note-details">
                                    <h3 class="note-title">{{ $note->title }}</h3>
                                    <p class="note-topic-id">Topic: {{ $note->topic->name }}</p>
                                    
                                </div>
                                <div class="image-container">
                                    @if ($note->photo)
                                        <img src="{{ asset($note->photo) }}" alt="Photo de la note">
                                    @endif
                                </div>
                                
                                <div class="flex">
                                    <div class="keywords">
                                        <p class="keywords">{{ $note->keywords }}</p>
                                    </div>
                                
                                    <div class="more-details">
                                        <button class="see-more-button">
                                            See More<i class="fas fa-arrow-right"></i>
                                        </button> 
                                    </div>
                                </div>
                                
                                
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>

        function redirectToDetail(id) {
            window.location.href = "{{ route('notes.detail', ['id' => ':id']) }}".replace(':id', id);
        }

        function search() {
            var searchInput = document.getElementById("searchInput").value;
            var searchResults = document.getElementById("searchResults");
            searchResults.innerHTML = "<p>Search results for: " + searchInput + "</p>";
        }

        // JavaScript for search functionality by topic, title, and keywords
        function searchNotes() {
        const searchTerm = document.getElementById('search-input').value.toLowerCase();
        const notes = document.querySelectorAll('.note');

        notes.forEach(note => {
            const title = note.querySelector('.note-title').textContent.toLowerCase();
            const topic = note.querySelector('.note-topic-id').textContent.toLowerCase();
            const name = note.querySelector('.user-name').textContent.toLowerCase();
            const keywords = note.querySelector('.keywords').textContent.toLowerCase();
            // You can add more selectors for other attributes like keywords if needed

            if (title.includes(searchTerm) || topic.includes(searchTerm) || name.includes(searchTerm) || keywords.includes(searchTerm)) {
                note.style.display = 'block';
            } else {
                note.style.display = 'none';
            }
        });
        }
    
        document.getElementById('search-input').addEventListener('input', searchNotes);

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
