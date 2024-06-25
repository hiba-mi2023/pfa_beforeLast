{{-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Display Notes</title>
        <link rel="stylesheet" href="{{ asset('css/app3.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <form method="POST" action="{{ route('notes.login') }}">
            @csrf
            <div class="form-container">
                <h2>Login</h2>
                
                <div>
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" required>
                </div>
            
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                
                <div class="remember-forgot-container">
                    <div class="remember-container">
                       
                    </div>
                    {{-- {{ route(' password.request') }} --}}
                    {{-- <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                </div>

                <div>
                    <button type="submit">Sign In</button>
                </div>

                <div class="register-link">
                    <p>Not registered yet? <a href="{{ route('notes.register') }}">Register for free.</a></p>
                </div>
            </div>
    </form> --}}






    {{-- <div class="message">
        @if(session('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif
    </div>
    
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </body>
</html> --}} 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app3.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            form.addEventListener('submit', function(event) {
                if (!validateEmail()) {
                    event.preventDefault();
                    return;
                }
                if (!validatePassword()) {
                    event.preventDefault();
                    return;
                }
            });

            const validateEmail = () => {
                const email = emailInput.value.trim();
                const errorDiv = document.getElementById('emailError');
                if (email === "") {
                    errorDiv.textContent = "Please enter your email";
                    return false;
                } else if (!isValidEmail(email)) {
                    errorDiv.textContent = "Please enter a valid email address";
                    return false;
                } else {
                    errorDiv.textContent = "";
                    return true;
                }
            };

            const validatePassword = () => {
                const password = passwordInput.value.trim();
                const errorDiv = document.getElementById('passwordError');
                if (password === "") {
                    errorDiv.textContent = "Please enter your password";
                    return false;
                } else {
                    errorDiv.textContent = "";
                    return true;
                }
            };

            const isValidEmail = (email) => {
                // Basic email validation regex
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            };

            emailInput.addEventListener('blur', validateEmail);
            passwordInput.addEventListener('blur', validatePassword);
        });
    </script>
</head>
<body>
    <form method="POST" action="{{ route('notes.login') }}">
        @csrf
        <div class="form-container">
            <h2>Login</h2>
            
            <div>
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required>
                <div id="emailError" class="error-message"></div>
            </div>
        
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <div id="passwordError" class="error-message"></div>
            </div>
            
            <div class="remember-forgot-container">
                <div class="remember-container">
                   
                </div>
                <a href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>

            <div>
                <button type="submit">Sign In</button>
            </div>

            <div class="register-link">
                <p>Not registered yet? <a href="{{ route('notes.register') }}">Register for free.</a></p>
            </div>
        </div>
    </form>

    <div class="message">
        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif
    </div>
    
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
