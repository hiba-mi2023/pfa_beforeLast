
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="note-detailed">

        <div class="note-container">
            
            <div class="user-info">
                <div class="user-img">
                    @if ($note->user->photo_de_profil)
                        <img  src="{{ asset('storage/' . $note->user->photo_de_profil) }}" >
                    @endif
                    </div>
                @if ($note->user)
                <p> {{ $note->user->first_name }} {{ $note->user->family_name }}</p>
                @endif
                <div>
                    <p class="note-published-at">{{ $note->created_at }}</p>
                </div>
            </div>
             
            <div class="note-rating">
               
            </div>

            <div class="note-actions">
                <i class="fa-regular fa-floppy-disk"></i>
            </div>

        </div>

        <hr/>

        <div class="note-details">

            <h3 class="note-title">{{ $note->title }}</h3>
            <div class="note-details-1">
                <p class="note-topic-name">Topic:{{ $note->topic->name }} </p>
                @if($note->topic)
                @if($note->topic->discipline->discipline)
                    <p class="note-discipline">Discipline: {{ $note->topic->discipline->discipline }}</p>
                @endif
                @endif
            </div>

        </div>

        <div class="image-container">
         <img src="{{ asset('' . $note->photo) }}" alt="Photo de la note">

        </div>

        <div class="another-details">

            <p class="note-description">Description:{{ $note->description }}</p>
            <p class="note-keywords">Keywords: {{ $note->keywords }}</p>

        </div>

        <div class="note-buttons">

            <button class="like-note-button"><i class="fa-regular fa-heart"></i> Like<span id="like-count">{{ $note->likes_count }}</span></button>
            <button class="comment-button" id="comment-button" name="comment-button"><i class="fa-regular fa-comment"></i> Comment</button>  
        
        </div>

        <div class="comment-section" id="comment-section" style="display: none;">
            <form class="comment-section" id="comment-form" action="{{ route('notes.commentaires.store', ['id' => $note->id]) }}" method="POST">
                <div class="comment">
                    <div class="comment-user">
                        @csrf    
                        <div class="user-img">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <input type="hidden" name="ID_note" value="{{ $note->id }}">
                        <textarea  id="comment-input" name="Contenu" placeholder="Write a comment..." rows="1"></textarea>
                        
                    </div>
                </div>
                        <button type="submit" id="publish-button" style="display: none;">publish</button>
                </div>
            </form>

            <div id="existing-comments" style="display: none;">
              
                @foreach ($note->commentaires as $commentaire) 
                
                <div class="user-img">
                    @if ($commentaire->utilisateur->photo_de_profil)
                        <img src="{{ asset('storage/' . $commentaire->utilisateur->photo_de_profil) }}"  class="profile-picture">
                    @else
                        <img src="{{ asset('storage/default-profile-picture.png') }}"  class="profile-picture">
                    @endif
                </div>

                <div class ="comments">
                    
                    <div class="comment-header">

                        <span>{{ $commentaire->utilisateur->first_name }} {{ $commentaire->utilisateur->family_name }}</span>
                        <small class="note-published-at">{{ $commentaire->created_at }}</small>
                    
                    </div>
                    
                    <p>{{ $commentaire->Contenu }}</p>

                </div>
                @endforeach
            </div>
        </div>



    </div>
        
    <!-- Inclure jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var commentInput = document.getElementById('comment-input');
            var publishButton = document.getElementById('publish-button');
    
            commentInput.addEventListener('input', function() {
                // Show the publish button when the user starts typing
                if (commentInput.value.trim() !== '') {
                    publishButton.style.display = 'inline-block';
                } else {
                    publishButton.style.display = 'none';
                }
            });
        });

        $(document).ready(function() {
            $('#comment-button').click(function() {
                $('#comment-section').toggle(); // Toggle comment section visibility
                $('#existing-comments').toggle(); // Toggle existing comments visibility
            });
    
            $('#comment-input').on('input', function() {
                // Show the publish button when the user starts typing
                if ($(this).val().trim() !== '') {
                    $('#publish-button').show();
                } else {
                    $('#publish-button').hide();
                }
            });
        });

        $(document).ready(function() {
            $('.like-note-button').click(function() {
                var noteId = $(this).data('note-id');
                var likeButton = $(this);
                $.ajax({
                    url: "{{ route('notes.like', ['id' => $note->id]) }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        note_id: noteId
                    },
                    success: function(response) {
                        if (response.success) {
                            var likeCount = $('#like-count');
                            likeCount.text(response.likes_count);
                            if (response.liked) {
                                likeButton.find('i').removeClass('fa-regular').addClass('fa-solid');
                            } else {
                                likeButton.find('i').removeClass('fa-solid').addClass('fa-regular');
                            }
                        }
                    }
                });
            });
        });
    </script>
    
    


</body>