<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app5.css') }}"/>
</head>
<body>
    <div class="container">
        <div class="sidebar active">
            <div class="menu-btn">
               <i class="ph-bold ph-caret-left"></i>
            </div>
            <div class="head">
               <div class="user-img">
                <img src="{{ asset('images/notes/hiba.jpg') }}"/>
               </div>
               <div class="user-details">
                  <p class="name">mimouni hiba</p>
               </div>
            </div>
            <div class="nav">
               <div class="menu">
                    <p class="title">MAIN</p>
                    <ul>
                        <li>
                            <a href="#dashboard">
                                <i class="icon ph-bold ph-house-simple"></i>
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#users">
                                <i class="icon ph-bold ph-user"></i>
                                <span class="text">Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="#notes">
                                <i class="icon ph-bold ph-note"></i>
                                <span class="text">Notes</span>
                            </a>
                        </li>
                    </ul>
               </div>
            </div>
            
            <div class="menu">
                <p class="title">Account</p>
                <ul>
                    <li>
                        <a href="#">
                            <i class="icon ph-bold ph-sign-out"></i>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="shared-style">Se déconnecter</button>
                            </form>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content">
            
            <div id="users" class="details">
                <div id="dashboard" class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Unapproved Users</h2>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>University</th>
                                    <th>Study Field</th>
                                    <th>Study Level</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Replace with dynamic PHP content -->
                                @foreach($unapprovedUsers as $user)
                                <tr>
                                    <td>{{ $user->first_name }} {{ $user->family_name }}</td>
                                    <td>{{ $user->university }}</td>
                                    <td>{{ $user->study_field }}</td>
                                    <td>{{ $user->study_level }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <form action="{{ route('admin.approve-user', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            
            
            <div id="notes" class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Unapproved Notes</h2>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Title</th>
                                <th>Topic</th>
                                <th>Picture</th>
                                <th>Description</th>
                                <th>Keywords</th>
                                <th>Published At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Replace with dynamic PHP content -->
                            @foreach($unapprovedNotes as $note)
                                @if ($note->user)
                                    <tr>
                                        <td>{{ $note->user->first_name }} {{ $note->user->family_name }}</td>
                                        <td>{{ $note->title }}</td>
                                        <td>{{ $note->topic->name }}</td>
                                        <td class="picture-cell">
                                            @if ($note->photo)
                                                <img src="{{ asset($note->photo) }}" alt="Photo de la note" style="width: 100%; height: 100%;">
                                            @endif
                                        </td>
                                        <td>{{ $note->description }}</td>
                                        <td>{{ $note->keywords }}</td>
                                        <td>{{ $note->created_at }}</td>
                                        <td>
                                            <form action="{{ route('admin.approve-note', $note->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.delete-note', $note->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
         $(document).ready(function() {
            $(".menu-btn").click(function(){
                $(".sidebar").toggleClass("active");
            });

            // Smooth scroll to section when sidebar link is clicked
            $(".sidebar a").on("click", function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function(){
                        window.location.hash = hash;
                    });
                } 
            });
        });
        $(document).ready(function() {
    var sidebar = $(".sidebar");
    var sidebarOffset = sidebar.offset().top;

    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();

        if (scrollTop > sidebarOffset) {
            sidebar.css({
                'transform': 'translateY(' + (scrollTop - sidebarOffset) + 'px)'
            });
        } else {
            sidebar.css({
                'transform': 'translateY(0)'
            });
        }
    });
});

    </script>
</body>
</html>
