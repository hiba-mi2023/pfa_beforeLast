<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Notes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playwrite+NZ:wght@100..400&display=swap');
    </style>
</head>
<body>
    <header id="header">
        <div class="logo"><img class="logo"src="{{ asset('images/notes/Design sans titre (56).png') }}"></div>
        <div class="icons">
            <div class="user-icon">
                <a href="{{ route('notes.display-user', ['id' => Auth::user()->id]) }}">
                    <i class="fas fa-user"></i>
                </a>
            </div>
            <div class="logout-icon">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </header>

    <div class="search-container">
        <input type="text" id="search-input" placeholder="Search..." oninput="searchNotes()">
        <i class="fas fa-search"></i>
    </div>

    <div><a href="{{ route('notes.add') }}" id="add-note-btn" class="add-note-btn">Add Note</a></div>
    
    <div class="container">
    <div class="content">
        <div id="notes-container">
            @foreach($notes as $note)
            @if ($note->is_approved)
            <div class="note-link">
            <a href="{{ route('notes.detail', ['id' => $note->id]) }}" >
                <div class="note" data-topic="{{ $note->topic->name }}">
                    <div class="note-container">
                        
                         <div class="user-info">
                            <div class="user-img">
                                @if ($note->user->photo_de_profil)
                                    <img  src="{{ asset('storage/' . $note->user->photo_de_profil) }}" alt="Photo de profil de {{ $note->user->first_name }}">
                                @endif
                            </div>
                            <p class="user-namee">
                            @if ($note->user)
                            <a href="{{ route('user.profile', ['id' => $note->user->id]) }}" class="name">
                             {{ $note->user->first_name }} {{ $note->user->family_name }}
                            </a>
                            @endif
                            </p>
                            <div class="note-on">
                                <p class="note-published-at">{{ $note->created_at }}</p>
                            </div>
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
                        <p class="note-topic-id">Topic : {{ $note->topic->name }}</p>
                    </div>
                    
                    <div class="image-container">
                       <img src="{{ asset('' . $note->photo) }}" alt="Photo de la note">
                    </div>
                    
                    {{-- <div class="more-details">
                       
                        <button class="see-more-button">
                            See More<i class="fas fa-arrow-right"></i>
                        </button> 
                        
                    </div>  --}}
                    <div class="flex">
                        <div class="keywords">
                            <p class="keywords">{{ $note->keywords }}</p>
                        </div>
                    
                        <div class="more-details">
                            <button onclick="redirectToDetail({{ $note->id }})" class="see-more-button">
                                See More <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </a>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    
    
    <script>
        function redirectToDetail(id) {
    window.location.href = "{{ route('notes.detail', ['id' => ':id']) }}".replace(':id', id);
}

       // JavaScript for rating functionality
       document.querySelectorAll('.note-rating i').forEach(star => {
       star.addEventListener('click', () => {
       const rating = parseInt(star.getAttribute('data-rating'));

       // Remove the 'star-filled' class from all stars
       document.querySelectorAll('.note-rating i').forEach(star => {
       star.classList.remove('star-filled');
       });

       // Add the 'star-filled' class for the clicked star and its following siblings
       for (let i = rating; i > 0; i--) {
       document.querySelector(`.note-rating i[data-rating="${i}"]`).classList.add('star-filled');
       }

       // If the clicked star is the first star, remove the 'star-filled' class if it has one
       if (rating === 1) {
       star.classList.toggle('star-filled');
       }
       });
       });

        // Prevent redirection when clicking on icons, rating, or user elements
       document.querySelectorAll('.note-rating i, .note-actions i, .user-info i, .user-info .user-name').forEach(element => {
       element.addEventListener('click', (event) => {
       event.preventDefault(); // Prevent the default behavior
       });
       });

        
       
         // JavaScript for toggling the submit button
        const textarea = document.querySelector('.comment-textarea');
        const submitButton = document.querySelector('.comment-submit-button');
        textarea.addEventListener('input', () => {
        if (textarea.value.length > 0) {
            submitButton.style.display = 'block';
        } else {
            submitButton.style.display = 'none';
        }
        });
        
       
       
     
    // JavaScript for search functionality by topic, title, and keywords
    function searchNotes() {
        const searchTerm = document.getElementById('search-input').value.toLowerCase();
        const notes = document.querySelectorAll('.note');

        notes.forEach(note => {
            const title = note.querySelector('.note-title').textContent.toLowerCase();
            const topic = note.querySelector('.note-topic-id').textContent.toLowerCase();
            const name = note.querySelector('.user-namee').textContent.toLowerCase();
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

    


    </script>
</body>
</html>