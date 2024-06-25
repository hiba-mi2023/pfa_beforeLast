<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Registration</title>
    <link rel="stylesheet" href="{{ asset('css/app2.css') }}"/>  
  </head>
  <body>
    <div id="page" class="site">
      <div class="container">
        <div class="form-box">
          <div class="progress">
            <ul class="progress-steps">
              <li class="step active">
                 <span>1</span>
                 <p>Personal<br><span>25 secs to complete</span></p>
              </li>
              <li class="step">
                <span>2</span>
                <p>Contact<br><span>60 secs to complete</span></p>
              </li>
              <li class="step">
                <span>3</span>
                <p>Security<br><span>30 secs to complete</span></p>
              </li>
            </ul>
          </div>
          <form action="{{ route('notes.register') }}" method="post">

            @csrf
            <div class="form-one form-step active">
                <div class="bg-svg"></div>
                <h2>Personal Information</h2>
              @if (session('error'))
  <div class="alert alert-success">
      {{ session('error') }}
  </div>
@endif
                <p>Enter your personal information correctly</p>
                <div>
                  <label for="">First Name</label>
                  <input type="text" name="first_name" placeholder="e.g hiba" id="first_name">
                  <div id="firstNameError" class="error-message"></div>
                </div>
                <div>
                  <label for="">Last Name</label>
                  <input type="text" name="family_name" placeholder="e.g mimouni"id="family_name">
                  <div id="lastNameError" class="error-message"></div>
                </div>
                <div class="birth">
                  <label>University</label>
                  <input type="text" name="university" placeholder="Your university"id="university">
                  <div id="universityError" class="error-message"></div>
                </div>
                <div class="birth">
                  <label for="study_field">Study Field</label>
                  <input type="text" class="form-control" id="study_field" placeholder="Your study Field" name="study_field" required>
                  <div id="studyFieldError" class="error-message"></div>
                </div>
                <div class="birth">
                  <label for="study_level">Study Level</label>
                  <select name="study_level" id="study_level" class="form-control" required>
                      <option value="">Select study level</option>
                      <option value="Undergraduate">Undergraduate</option>
                      <option value="Graduate">Graduate</option>
                      <option value="Postgraduate">Postgraduate</option>
                      <option value="PhD">PhD</option>
                  </select>
                  <div id="studyLevelError" class="error-message"></div>
                </div> 
                </div>
            <div class="form-two form-step">
              <div class="bg-svg"></div>
                <h2>Contact</h2>
                <div>
                    <label>Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone" required>
                    <div id="phoneError" class="error-message"></div>
                </div>
            </div>
            <div class="form-three form-step">
              <div class="bg-svg"></div>
              <h2>Security</h2>
              <div>
                <label>Email</label>
                <input type="email" name="email" placeholder="your email address"id="email"autocomplete="username">
                <div id="emailError" class="error-message"></div>
              </div>
              <div>
              <label>Password</label>
              <input type="password" name="password" placeholder="password" id="password" autocomplete="new-password">
              <div id="passwordError" class="error-message"></div>
              </div>
            <div>
              <label>Confirm Password</label>
              <input type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
              <div id="confirmPasswordError" class="error-message"></div>
            </div>

            </div>
            

            <div class="btn-group">
              <button type="button" class="btn-prev" disabled>Back</button>
              <button type="button" class="btn-next" >Next Step</button>
              <button type="submit" class="btn-submit">Submit</button>

            </div>
          </form>
        </div>
      </div>
    </div>
    


    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const nextButton = document.querySelector('.btn-next');
        const prevButton = document.querySelector('.btn-prev');
        const submitButton = document.querySelector('.btn-submit');
        const steps = document.querySelectorAll('.step');
        const formSteps = document.querySelectorAll('.form-step');
        let active = 1;
    
        nextButton.addEventListener('click', () => {
          if (validateFormStep(active)) {
            active++;
            if (active > steps.length) {
              active = steps.length;
            }
            updateProgress();
          }
        });
    
        prevButton.addEventListener('click', () => {
          active--;
          if (active < 1) {
            active = 1;
          }
          updateProgress();
        });
    
        const updateProgress = () => {
          steps.forEach((step, i) => {
            if (i === active - 1) {
              step.classList.add('active');
              formSteps[i].classList.add('active');
            } else {
              step.classList.remove('active');
              formSteps[i].classList.remove('active');
            }
          });
          if (active === 1) {
            prevButton.disabled = true;
          } else if (active === steps.length) {
            nextButton.disabled = true;
            submitButton.style.display = 'block';
          } else {
            prevButton.disabled = false;
            nextButton.disabled = false;
            submitButton.style.display = 'none';
          }
        };
    
        const validateFormStep = (stepNumber) => {
          let isValid = true;
          if (stepNumber === 1) {
            if (!validateFirstName()) isValid = false;
            if (!validateLastName()) isValid = false;
            if (!validateUniversity()) isValid = false;
            if (!validateStudyField()) isValid = false;
            if (!validateStudyLevel()) isValid = false;
          } else if (stepNumber === 2) {
            if (!validatePhone()) isValid = false;
          } else if (stepNumber === 3) {
            if (!validateEmail()) isValid = false;
            if (!validatePassword()) isValid = false;
            if (!validateConfirmPassword()) isValid = false;
          }
          return isValid;
        };
    
        const validateFirstName = () => {
          const firstName = document.getElementById('first_name').value.trim();
          const errorDiv = document.getElementById('firstNameError');
          if (firstName === "") {
            errorDiv.textContent = "Please enter your first name";
            return false;
          } else if (!isValidString(firstName)) {
            errorDiv.textContent = "First name must be a valid string";
            return false;
          } else {
            errorDiv.textContent = "";
            return true;
          }
        };
    
        const validateLastName = () => {
          const lastName = document.getElementById('family_name').value.trim();
          const errorDiv = document.getElementById('lastNameError');
          if (lastName === "") {
            errorDiv.textContent = "Please enter your last name";
            return false;
          } else if (!isValidString(lastName)) {
            errorDiv.textContent = "Last name must be a valid string";
            return false;
          } else {
            errorDiv.textContent = "";
            return true;
          }
        };
    
        const validateUniversity = () => {
          const university = document.getElementById('university').value.trim();
          const errorDiv = document.getElementById('universityError');
          if (university === "") {
            errorDiv.textContent = "Please enter your university";
            return false;
          } else if (!isValidString(university)) {
            errorDiv.textContent = "University must be a valid string";
            return false;
          } else {
            errorDiv.textContent = "";
            return true;
          }
        };
    
        const validateStudyField = () => {
          const studyField = document.getElementById('study_field').value.trim();
          const errorDiv = document.getElementById('studyFieldError');
          if (studyField === "") {
            errorDiv.textContent = "Please enter your study field";
            return false;
          } else if (!isValidString(studyField)) {
            errorDiv.textContent = "Study field must be a valid string";
            return false;
          } else {
            errorDiv.textContent = "";
            return true;
          }
        };
    
        const validateStudyLevel = () => {
          const studyLevel = document.getElementById('study_level').value.trim();
          const errorDiv = document.getElementById('studyLevelError');
          if (studyLevel === "") {
            errorDiv.textContent = "Please select your study level";
            return false;
          } else {
            errorDiv.textContent = "";
            return true;
          }
        };
    
        const validatePhone = () => {
  const phone = document.getElementById('phone').value.trim();
  const errorDiv = document.getElementById('phoneError');
  const phoneRegex = /^[0-9]+$/; // Regular expression to match digits only

  if (phone === "") {
    errorDiv.textContent = "Please enter your phone number";
    return false;
  } else if (!phoneRegex.test(phone)) {
    errorDiv.textContent = "Phone number must contain only digits";
    return false;
  } else {
    errorDiv.textContent = "";
    return true;
  }
};

    
const validateEmail = () => {
  const email = document.getElementById('email').value.trim();
  const errorDiv = document.getElementById('emailError');
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regular expression for email format

  if (email === "") {
    errorDiv.textContent = "Please enter your email";
    return false;
  } else if (!emailRegex.test(email)) {
    errorDiv.textContent = "Please enter a valid email address";
    return false;
  } else {
    errorDiv.textContent = "";
    return true;
  }
};

const validatePassword = () => {
  const password = document.getElementById('password').value.trim();
  const errorDiv = document.getElementById('passwordError');

  // Regular expressions for password requirements
  const uppercaseRegex = /[A-Z]/;
  const lowercaseRegex = /[a-z]/;
  const numberRegex = /[0-9]/;
  const specialCharRegex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/;
  
  if (password === "") {
    errorDiv.textContent = "Please enter a password";
    return false;
  } else if (password.length < 8) {
    errorDiv.textContent = "Password must be at least 8 characters long";
    return false;
  } else if (!uppercaseRegex.test(password)) {
    errorDiv.textContent = "Password must include at least one uppercase letter";
    return false;
  } else if (!lowercaseRegex.test(password)) {
    errorDiv.textContent = "Password must include at least one lowercase letter";
    return false;
  } else if (!numberRegex.test(password)) {
    errorDiv.textContent = "Password must include at least one number";
    return false;
  } else if (!specialCharRegex.test(password)) {
    errorDiv.textContent = "Password must include at least one special character";
    return false;
  } else {
    errorDiv.textContent = "";
    return true;
  }
};

    
        const validateConfirmPassword = () => {
          const password = document.getElementById('password').value.trim();
          const confirmPassword = document.getElementById('password_confirmation').value.trim();
          const errorDiv = document.getElementById('confirmPasswordError');
          if (confirmPassword === "") {
            errorDiv.textContent = "Please confirm your password";
            return false;
          } else if (password !== confirmPassword) {
            errorDiv.textContent = "Passwords do not match";
            return false;
          } else {
            errorDiv.textContent = "";
            return true;
          }
        };
    
        const isValidString = (str) => {
          return /^[A-Za-z\s]+$/.test(str);
        };
    
        // Blur event listeners for validation
        document.getElementById('first_name').addEventListener('blur', validateFirstName);
        document.getElementById('family_name').addEventListener('blur', validateLastName);
        document.getElementById('university').addEventListener('blur', validateUniversity);
        document.getElementById('study_field').addEventListener('blur', validateStudyField);
        document.getElementById('study_level').addEventListener('blur', validateStudyLevel);
        document.getElementById('phone').addEventListener('blur', validatePhone);
        document.getElementById('email').addEventListener('blur', validateEmail);
        document.getElementById('password').addEventListener('blur', validatePassword);
        document.getElementById('password_confirmation').addEventListener('blur', validateConfirmPassword);
      });
    </script>
    
    
  </body>
</html>
