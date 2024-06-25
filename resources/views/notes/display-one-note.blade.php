
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styling for comment section */
        .comment-section {
            margin-top: 20px;
        }
    
        /* Styling for comment user section */
        .comment-user {
            display: flex;
            align-items: center;
        }
    
        /* Styling for user image */
        .comment-user .user-img {
            margin-right: 10px;
        }
    
        .comment-user .user-img i {
            font-size: 24px;
            color: #555;
        }
    
        .comment-user .user-img img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    
        /* Styling for comment input */
        #comment-input {
            flex: 1;
            min-height: 40px;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }
    
        /* Styling for publish button */
        #publish-button {
            background-color: #6c5ce7;
            color: #fff;
            border: none;
            border-radius: 15px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            margin-top:4px;
            margin-left: 50px;
        }
    
        #publish-button:hover {
            background-color: #a29bfe;
        }
    
        /* Styling for existing comments */
        #existing-comments {
            margin-top: 20px;
        }
    
        /* Styling for user image in existing comments */
        #existing-comments .user-img {
            margin-right: 10px;
        }
    
        #existing-comments .user-img img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    
        /* Styling for comments */
        #existing-comments .comments {
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
    
        #existing-comments .comments .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
    
        #existing-comments .comments .comment-header span {
            font-weight: bold;
            margin-right: 10px;
        }
    
        #existing-comments .comments .comment-header small {
            color: #777;
        }
    
        #existing-comments .comments p {
            margin: 0;
        }
    </style>
    
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
                <div class="user-name"><p> {{ $note->user->first_name }} {{ $note->user->family_name }}</p></div>
                @endif
                <div class="pub">
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
        <h3 class="note-title">{{ $note->title }}</h3>
        <div class="notee">
            <div class="note-details">
        
                
                <div class="note-details-1">
                    <p class="note-topic-name">Topic :{{ $note->topic->name }} </p>
                    @if($note->topic)
                    @if($note->topic->discipline->discipline)
                        <p class="note-discipline">Discipline : {{ $note->topic->discipline->discipline }}</p>
                    @endif
                    @endif
                </div>

            </div>
            <div class="another-details">

                <p class="note-description">Description :{{ $note->description }}</p>
                <p class="note-keywords">Keywords : {{ $note->keywords }}</p>

            </div>
        
        </div>
        <div class="image-container">
         <img src="{{ asset('' . $note->photo) }}" alt="Photo de la note">

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