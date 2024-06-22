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
                </div>
                <div>
                  <label for="">Last Name</label>
                  <input type="text" name="family_name" placeholder="e.g mimouni"id="family_name">
                </div>
                <div class="birth">
                  <label>University</label>
                  <input type="text" name="university" placeholder="Your university"id="university">
                </div>
                <div class="birth">
                  <label for="study_field">Study Field</label>
                  <input type="text" class="form-control" id="study_field" name="study_field" required>
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
                </div> 
                </div>
            <div class="form-two form-step">
              <div class="bg-svg"></div>
                <h2>Contact</h2>
                <div>
                    <label>Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone" required>
                </div>
            </div>
            <div class="form-three form-step">
              <div class="bg-svg"></div>
              <h2>Security</h2>
              <div>
                <label>Email</label>
                <input type="email" name="email" placeholder="your email address"id="email"autocomplete="username">
              </div>
              <div>
    <label>Password</label>
    <input type="password" name="password" placeholder="password" id="password" autocomplete="new-password">
    </div>
   <div>
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
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
      const nextButton = document.querySelector('.btn-next');
      const prevButton = document.querySelector('.btn-prev');
      const submitButton = document.querySelector('.btn-submit'); // Select the submit button
      const steps = document.querySelectorAll('.step');
      const formSteps = document.querySelectorAll('.form-step');
      let active = 1;

      nextButton.addEventListener('click', () => {
        active++;
        if (active > steps.length) {
          active = steps.length;
        }
        updateProgress();
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
          submitButton.style.display = 'block'; // Display the submit button when on the last step
        } else {
          prevButton.disabled = false;
          nextButton.disabled = false;
          submitButton.style.display = 'none'; // Hide the submit button when not on the last step
        }
      };
    </script>
   


    
  </body>
</html>