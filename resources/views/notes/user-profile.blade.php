<!-- resources/views/notes/user-profile.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/app4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Profil de {{ $user->first_name }} {{ $user->family_name }}</title>
</head>
<body>

    <div class="user-info-container">
        
            <div class="background-image">
                <img src="{{ asset('images/notes/images (1).jpg') }}" alt="Profile Image">
                <div class="profile-image-container" >
                    @if ($user->photo_de_profil)
                        <img src="{{ asset('storage/' . $user->photo_de_profil) }}" alt="Photo de profil de {{ $user->first_name }}">
                    @endif
                </div>
            </div>
           
            <div class="profile-infos">
                <div class="profile-name">
                    <h1>{{ $user->first_name }} {{ $user->family_name }}</h1>
                </div>  
                <div class="infos"> 
                    <div class="profile-university">
                        <p class="title-infos">University</p>
                        <p class="user-infos">{{ $user->university }}</p>
                    </div>
                    <div class="profile-filiére">
                        <p class="title-infos">Study Field</p>
                        <p class="user-infos">{{ $user->study_field }}</p>
                    </div>  
                    <div class="profile-niveau-d'étude">
                        <p class="title-infos">Study Level</p>
                        <p class="user-infos"> {{ $user->study_level }}</p>
                    </div>
                    <div class="profile-email">  
                        <p class="title-infos">Email</p>
                        <p class="user-infos">          {{ $user->email }}</p>
                    </div>
                </div>
            </div>

    </div>

    <div class="search-container">
        <input type="text" id="search-input" placeholder="Search..." oninput="searchNotes()">
        <button onclick="searchNotes()"><i class="fas fa-search"></i></button>
    </div>




    <div class="user-notes">
        
        <h2 class="titles">Notes Shared By {{ $user->first_name }} {{ $user->family_name }} :</h2>
        <div class="container">
            <div class="content">
                <div id="notes-container">
                    @foreach($notes as $note)
                    
                    <a href="{{ route('notes.detail', ['id' => $note->id]) }}" class="note-link">

                        <div class="note" data-topic="{{ $note->topic->name }}">
                            <div class="note-container">

                                        <div class="user-info">
                                            {{-- <div class="user-img">
                                                @if ($note->user->photo_de_profil)
                                                    <img  src="{{ asset('storage/' . $note->user->photo_de_profil) }}" alt="Photo de profil de {{ $note->user->first_name }}">
                                                @endif
                                            </div> --}}
                                            
                                            @if ($note->user)
                                            <p class="user-name">{{ $note->user->first_name }} {{ $note->user->family_name }}</p>
                                            @endif
                                        </div>

                                        <div class="note-rating">
                                           
                                        </div>

                                        <div class="note-actionss">
                                            <!-- Formulaire pour sauvegarder la note -->
                                            <form action="{{ route('notes.save', ['id' => $note->id]) }}" method="POST" style="display: inline;">
                                               @csrf
                                               <button type="submit" class="save-button">
                                                   <i class="fa-regular fa-floppy-disk"></i>
                                               </button>
                                           </form>
                                           
                                       </div>

                            </div>

                                        <hr/>

                                        
                                        <div class="note-details">
                                            <h3 class="note-title">{{ $note->title }}</h3>
                                            <p class="note-topic-id">Topic: {{ $note->topic->name }}</p>
                                            
                                            

                                            
                                        </div>
                                        <div class="image-container">
                                            @if ($note->photo)
                                            <img src="{{ asset('' . $note->photo) }}" alt="Photo de la note">
                                            @endif
                                        </div>
                                        <div class="more-details">
                                            <button class="see-more-button">
                                                See More<i class="fas fa-arrow-right"></i>
                                            </button> 
                                        </div>
                            
                        </div>

                    </a>
                   
                    @endforeach
                </div>
            </div>
        </div>
    </div>



  <script>
    // Prevent redirection when clicking on icons, rating, or user elements
    document.querySelectorAll('.note-rating i, .note-actions i, .user-info i, .user-info .user-name').forEach(element => {
       element.addEventListener('click', (event) => {
       event.preventDefault(); // Prevent the default behavior
       });
       });
    // JavaScript for search functionality by topic, title, and keywords
   function searchNotes() {
        const searchTerm = document.getElementById('search-input').value.toLowerCase();
        const notes = document.querySelectorAll('.note');

        notes.forEach(note => {
            const title = note.querySelector('.note-title').textContent.toLowerCase();
            const topic = note.querySelector('.note-topic-id').textContent.toLowerCase();
            const name = note.querySelector('.user-name').textContent.toLowerCase();
            // You can add more selectors for other attributes like keywords if needed

            if (title.includes(searchTerm) || topic.includes(searchTerm) || name.includes(searchTerm)) {
                note.style.display = 'block';
            } else {
                note.style.display = 'none';
            }
        });
    }
    
    document.getElementById('search-input').addEventListener('input', searchNotes);
  </script>
    
</body>
</html>
