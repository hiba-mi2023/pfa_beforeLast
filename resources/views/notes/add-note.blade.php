<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
    <div class="form-container">
        <h1>Notes List</h1>
            <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title">Titre : </label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    <div id="titleError" class="error-message"></div>
                </div>
                <div>
                    <label for="topic">Module : </label>
                    <input type="text" class="form-control" id="topic" name="topic" required>
                    <div id="moduleError" class="error-message"></div>
                </div>
                <div>
                    <label for="keywords">Mot Clé : </label>
                    <input type="text" class="form-control" id="keywords" name="keywords" required>
                    <div id="keywordsError" class="error-message"></div>
                </div>
                <div>
                    <label for="description">Description : </label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                    <div id="descriptionError" class="error-message"></div>
                </div>
                <div>
                    <label for="discipline_id">Discipline</label>
                    <select class="form-control" id="discipline_id" name="discipline_id" required>
                        @foreach($disciplines as $discipline)
                            <option value="{{ $discipline->id }}">{{ $discipline->discipline }}</option>
                        @endforeach
                    </select>
                </div>                
                <div>
                    <label for="photo">Photo : </label>
                    <input type="file" class="form-control" accept=".jpg,.jpeg,.png,.svg,.webp,.tiff" id="photo" name="photo" required>
                </div>
                <button type="submit" >Ajouter Note</button>
            </form>
        <div id="notes-list">
        </div>
    </div>
  
    <script>
        $(document).ready(function () {
            $("#notes-form").on("submit", function (event) {
                event.preventDefault();
                var title = $("#title").val();
                var description = $("#description").val();
                var discipline = $("#discipline").val();
                $.ajax({
                    url: "/submit",
                    method: "POST",
                    data: {
                        title: title,
                        description: description,
                        discipline: discipline
                    },
                    success: function (note) {
                        $("#notes-list").append(`
                            <div class="note" id="note-${note.id}">
                                <h2>${note.title}</h2>
                                <p>${note.description}</p>
                                <p>Discipline: ${note.discipline}</p>
                            </div>
                        `);
                        $("#notes-form")[0].reset();
                    }
                });
            });
        });
    </script>
   
</body>
</html>  




 {{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
    <div class="form-container">
        <h1>Notes List</h1>
            <form id="notes-form" action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title">Titre : </label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    <div id="titleError" class="error-message"></div>
                </div>
                <div>
                    <label for="topic">Module : </label>
                    <input type="text" class="form-control" id="topic" name="topic" required>
                    <div id="moduleError" class="error-message"></div>
                </div>
                <div>
                    <label for="keywords">Mot Clé : </label>
                    <input type="text" class="form-control" id="keywords" name="keywords" required>
                    <div id="keywordsError" class="error-message"></div>
                </div>
                <div>
                    <label for="description">Description : </label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                    <div id="descriptionError" class="error-message"></div>
                </div>
                <div>
                    <label for="discipline_id">Discipline</label>
                    <select class="form-control" id="discipline_id" name="discipline_id" required>
                        @foreach($disciplines as $discipline)
                            <option value="{{ $discipline->id }}">{{ $discipline->discipline }}</option>
                        @endforeach
                    </select>
                    <div id="disciplineError" class="error-message"></div>
                </div>                
                <div>
                    <label for="photo">Photo : </label>
                    <input type="file" class="form-control" accept=".jpg,.jpeg,.png,.svg,.webp,.tiff" id="photo" name="photo" required>
                    <div id="photoError" class="error-message"></div>
                </div>
                <button type="submit">Ajouter Note</button>
            </form>
        <div id="notes-list">
        </div>
    </div>
  
    <script>
        $(document).ready(function () {
            $("#notes-form").on("submit", function (event) {
                event.preventDefault();
                if(validateForm()) {
                    var title = $("#title").val();
                    var description = $("#description").val();
                    var discipline = $("#discipline_id").val();
                    // Proceed with AJAX request
                    $.ajax({
                        url: "/submit",
                        method: "POST",
                        data: {
                            title: title,
                            description: description,
                            discipline: discipline
                        },
                        success: function (note) {
                            $("#notes-list").append(`
                                <div class="note" id="note-${note.id}">
                                    <h2>${note.title}</h2>
                                    <p>${note.description}</p>
                                    <p>Discipline: ${note.discipline}</p>
                                </div>
                            `);
                            $("#notes-form")[0].reset();
                        }
                    });
                }
            });

            function validateForm() {
                var isValid = true;
                $(".error-message").text(""); // Clear previous error messages

                // Validate each field
                if ($("#title").val() == "") {
                    $("#titleError").text("Please enter a title");
                    isValid = false;
                } else if (!isValidString($("#title").val())) {
                    $("#titleError").text("Please enter a valid title");
                    isValid = false;
                }
                if ($("#topic").val() == "") {
                    $("#moduleError").text("Please enter a module");
                    isValid = false;
                } else if (!isValidString($("#topic").val())) {
                    $("#moduleError").text("Please enter a valid module");
                    isValid = false;
                }
                if ($("#keywords").val() == "") {
                    $("#keywordsError").text("Please enter keywords");
                    isValid = false;
                } else if (!isValidKeywords($("#keywords").val())) {
                    $("#keywordsError").text("Please enter keywords separated by ;");
                    isValid = false;
                }
                if ($("#description").val() == "") {
                    $("#descriptionError").text("Please enter a description");
                    isValid = false;
                } 
                if ($("#discipline_id").val() == "") {
                    $("#disciplineError").text("Please select a discipline");
                    isValid = false;
                }
                if ($("#photo").val() == "") {
                    $("#photoError").text("Please select a photo");
                    isValid = false;
                }

                return isValid;
            }

            function isValidString(str) {
                // Check if the string contains only letters and spaces
                return /^[a-zA-Z\s]+$/.test(str);
            }

            function isValidKeywords(keywords) {
                // Check if the keywords are separated by ;
                return /^[a-zA-Z]+\s*(;\s*[a-zA-Z]+\s*)*$/.test(keywords);
            }
        });
    </script>
   
</body>
</html> --}}