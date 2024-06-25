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
        <h1>Note</h1>
            <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title">Title : </label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    <div id="titleError" class="error-message"></div>
                </div>
                <div>
                    <label for="topic">Topic : </label>
                    <input type="text" class="form-control" id="topic" name="topic" required>
                    <div id="moduleError" class="error-message"></div>
                </div>
                <div>
                    <label for="keywords">Keywords : </label>
                    <input type="text" class="form-control" id="keywords" name="keywords" required>
                    <div id="keywordsError" class="error-message"></div>
                </div>
                <div>
                    <label for="description">Description : </label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                    <div id="descriptionError" class="error-message"></div>
                </div>
                <div>
                    <label for="discipline_id">Discipline :</label>
                    <select class="form-control" id="discipline_id" name="discipline_id" required>
                        @foreach($disciplines as $discipline)
                            <option value="{{ $discipline->id }}">{{ $discipline->discipline }}</option>
                        @endforeach
                    </select>
                </div>                
                <div>
                    <label for="photo">Picture : </label>
                    <input type="file" class="form-control" accept=".jpg,.jpeg,.png,.svg,.webp,.tiff" id="photo" name="photo" required>
                </div>
                <button type="submit" >Add Note</button>
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
 --}}


 {{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Note</h1>
        <form id="notes-form" action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Title : </label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div id="titleError" class="error-message"></div>
            </div>
            <div>
                <label for="topic">Topic : </label>
                <input type="text" class="form-control" id="topic" name="topic" required>
                <div id="topicError" class="error-message"></div>
            </div>
            <div>
                <label for="keywords">Keywords : </label>
                <input type="text" class="form-control" id="keywords" name="keywords" required>
                <div id="keywordsError" class="error-message"></div>
            </div>
            <div>
                <label for="description">Description : </label>
                <textarea class="form-control" id="description" name="description" required></textarea>
                <div id="descriptionError" class="error-message"></div>
            </div>
            <div>
                <label for="discipline_id">Discipline :</label>
                <select class="form-control" id="discipline_id" name="discipline_id" required>
                    @foreach($disciplines as $discipline)
                        <option value="{{ $discipline->id }}">{{ $discipline->discipline }}</option>
                    @endforeach
                </select>
                <div id="disciplineError" class="error-message"></div>
            </div>                
            <div>
                <label for="photo">Picture : </label>
                <input type="file" class="form-control" accept=".jpg,.jpeg,.png,.svg,.webp,.tiff" id="photo" name="photo" required>
                <div id="photoError" class="error-message"></div>
            </div>
            <button type="submit">Add Note</button>
        </form>
        <div id="notes-list"></div>
    </div>
  
    <script>
        $(document).ready(function () {
            $("#title").on("blur", function () {
                validateTitle();
            });

            $("#topic").on("blur", function () {
                validateTopic();
            });

            $("#keywords").on("blur", function () {
                validateKeywords();
            });

            $("#description").on("blur", function () {
                validateDescription();
            });

            $("#notes-form").on("submit", function (event) {
                event.preventDefault();
                if(validateForm()) {
                    var title = $("#title").val();
                    var description = $("#description").val();
                    var discipline = $("#discipline_id").val();
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

                if (!validateTitle()) isValid = false;
                if (!validateTopic()) isValid = false;
                if (!validateKeywords()) isValid = false;
                if (!validateDescription()) isValid = false;

                return isValid;
            }

            function validateTitle() {
                var title = $("#title").val();
                if (title == "") {
                    $("#titleError").text("Please enter a title");
                    return false;
                } else if (!isValidString(title)) {
                    $("#titleError").text("Please enter a valid title");
                    return false;
                } else {
                    $("#titleError").text("");
                    return true;
                }
            }

            function validateTopic() {
                var topic = $("#topic").val();
                if (topic == "") {
                    $("#topicError").text("Please enter a topic");
                    return false;
                } else if (!isValidString(topic)) {
                    $("#topicError").text("Please enter a valid topic");
                    return false;
                } else {
                    $("#topicError").text("");
                    return true;
                }
            }

            function validateKeywords() {
                var keywords = $("#keywords").val();
                if (keywords == "") {
                    $("#keywordsError").text("Please enter keywords");
                    return false;
                } else if (!isValidKeywords(keywords)) {
                    $("#keywordsError").text("Keywords must start with #");
                    return false;
                } else {
                    $("#keywordsError").text("");
                    return true;
                }
            }

            function validateDescription() {
                var description = $("#description").val();
                if (description == "") {
                    $("#descriptionError").text("Please enter a description");
                    return false;
                } else if (!isValidString(description)) {
                    $("#descriptionError").text("Please enter a valid description");
                    return false;
                } else {
                    $("#descriptionError").text("");
                    return true;
                }
            }


            function isValidString(str) {
    // Split the input string by spaces into fields
    let fields = str.split(/\s+/);
    
    // Regular expression to validate each field
    let regex = /^[a-zA-Z0-9]+(?: [a-zA-Z0-9\s]+)*$/;
    
    // Check each field against the regular expression
    for (let field of fields) {
        if (!regex.test(field)) {
            return false; // Return false if any field does not match
        }
    }
    
    return true; // Return true if all fields match
}





            function isValidKeywords(keywords) {
                // Ensure each keyword starts with #
                return keywords.split(';').every(kw => kw.trim().startsWith('#'));
            }
        });
    </script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Note</h1>
        <form id="notes-form" action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Title : </label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div id="titleError" class="error-message"></div>
            </div>
            <div>
                <label for="topic">Topic : </label>
                <input type="text" class="form-control" id="topic" name="topic" required>
                <div id="topicError" class="error-message"></div>
            </div>
            <div>
                <label for="keywords">Keywords : </label>
                <input type="text" class="form-control" id="keywords" name="keywords" required>
                <div id="keywordsError" class="error-message"></div>
            </div>
            <div>
                <label for="description">Description : </label>
                <textarea class="form-control" id="description" name="description" required></textarea>
                <div id="descriptionError" class="error-message"></div>
            </div>
            <div>
                <label for="discipline_id">Discipline :</label>
                <select class="form-control" id="discipline_id" name="discipline_id" required>
                    <option value="">Select Discipline</option>
                    @foreach($disciplines as $discipline)
                        <option value="{{ $discipline->id }}">{{ $discipline->discipline }}</option>
                    @endforeach
                </select>
                <div id="disciplineError" class="error-message"></div>
            </div>                
            <div>
                <label for="photo">Picture : </label>
                <input type="file" class="form-control" accept=".jpg,.jpeg,.png,.svg,.webp,.tiff" id="photo" name="photo" required>
                <div id="photoError" class="error-message"></div>
            </div>
            <div class="add-note-btnn">
                <button type="submit" id="add-note-btn">Add Note</button>
            </div>
            
        </form>
        <div id="notes-list"></div>
    </div>
    <div id="submit-warning" style="display: none;" class="error-message">Note is currently being reviewed by admin.</div>
    <script>
         $(document).ready(function () {
            // Submit form via AJAX
            $("#notes-form").on("submit", function (event) {
                // Perform client-side validation before submitting the form
                if (!validateForm()) {
                    event.preventDefault(); // Prevent form submission if validation fails
                } else {
                    // If validation passes, proceed with AJAX submission
                    var title = $("#title").val();
                    var description = $("#description").val();
                    var discipline = $("#discipline_id").val();
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

            // Validation functions
            $("#title").on("blur", validateTitle);
            $("#topic").on("blur", validateTopic);
            $("#keywords").on("blur", validateKeywords);
            $("#description").on("blur", validateDescription);
            $("#discipline_id").on("change", validateDiscipline);
            $("#photo").on("change", validatePhoto);

            function validateForm() {
                var isValid = true;
                $(".error-message").text(""); // Clear previous error messages

                if (!validateTitle()) isValid = false;
                if (!validateTopic()) isValid = false;
                if (!validateKeywords()) isValid = false;
                if (!validateDescription()) isValid = false;
                if (!validateDiscipline()) isValid = false;
                if (!validatePhoto()) isValid = false;

                return isValid;
            }

            function validateTitle() {
                var title = $("#title").val();
                if (title.trim() === "") {
                    $("#titleError").text("Please enter a title");
                    return false;
                } else if (!isValidString(title)) {
                    $("#titleError").text("Please enter a valid title");
                    return false;
                } else {
                    $("#titleError").text("");
                    return true;
                }
            }

            function validateTopic() {
                var topic = $("#topic").val();
                if (topic.trim() === "") {
                    $("#topicError").text("Please enter a topic");
                    return false;
                } else if (!isValidString(topic)) {
                    $("#topicError").text("Please enter a valid topic");
                    return false;
                } else {
                    $("#topicError").text("");
                    return true;
                }
            }

            function validateKeywords() {
                var keywords = $("#keywords").val();
                if (keywords.trim() === "") {
                    $("#keywordsError").text("Please enter keywords");
                    return false;
                } else if (!isValidKeywords(keywords)) {
                    $("#keywordsError").text("Keywords must start with #");
                    return false;
                } else {
                    $("#keywordsError").text("");
                    return true;
                }
            }

            function validateDescription() {
                var description = $("#description").val();
                if (description.trim() === "") {
                    $("#descriptionError").text("Please enter a description");
                    return false;
                } else if (!isValidString(description)) {
                    $("#descriptionError").text("Please enter a valid description");
                    return false;
                } else {
                    $("#descriptionError").text("");
                    return true;
                }
            }

            function isValidString(str) {
                // Split the input string by spaces into fields
                let fields = str.split(/\s+/);
                
                // Regular expression to validate each field
                let regex = /^[a-zA-Z][a-zA-Z0-9\s]*$/;
                
                // Check each field against the regular expression
                for (let field of fields) {
                    if (!regex.test(field)) {
                        return false; // Return false if any field does not match
                    }
                }
                
                return true; // Return true if all fields match
            }

            function isValidKeywords(keywords) {
                return keywords.split(';').every(kw => kw.trim().startsWith('#'));
            }
            function validateDiscipline() {
        var discipline = $("#discipline_id").val();
        if (discipline === "") {
            $("#disciplineError").text("Please select a discipline");
            return false;
        } else {
            $("#disciplineError").text("");
            return true;
        }
    }

    function validatePhoto() {
        var fileInput = $("#photo");
        if (fileInput.get(0).files.length === 0) {
            $("#photoError").text("Please upload a photo");
            return false;
        } else {
            $("#photoError").text("");
            return true;
        }
    }

    function validateDiscipline() {
        var discipline = $("#discipline_id").val();
        if (discipline === "") {
            $("#disciplineError").text("Please select a discipline");
            return false;
        } else {
            $("#disciplineError").text("");
            return true;
        }
    }

    function validatePhoto() {
        var fileInput = $("#photo");
        if (fileInput.get(0).files.length === 0) {
            $("#photoError").text("Please upload a photo");
            return false;
        } else {
            $("#photoError").text("");
            return true;
        }
    }
});
    </script>
</body>
</html>
