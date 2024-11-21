// Select the form and error message elements
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const errorMessage = document.getElementById('error');
const body = document.body;

// body.classList.add('lightMode');
body.classList.add('darkMode');

if (loginForm) {
  // Add event listener for form submission
  loginForm.addEventListener('submit', function (event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Get the username and password values
    const username = document.getElementById('name');
    const password = document.getElementById('pass');

    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();

    // Define validation rules
    const minUsernameLength = 5;
    const minPasswordLength = 10;
    const lowerCase = /[a-z]/;
    const upperCase = /[A-Z]/;

    // Check username
    if (usernameValue.length < minUsernameLength) {
      username.classList.add('invalid');
      errorMessage.textContent = 'Username must be at least 5 characters long.';
      return;
    }

    // Check if the username contains at least one uppercase and lowercase character
    if (!(lowerCase.test(usernameValue) && upperCase.test(usernameValue))) {
      username.classList.add('invalid');
      errorMessage.textContent =
        'Username does not include any upper or lower case characters.';
      return;
    }
    username.classList.remove('invalid');
    username.classList.add('valid');

    if (passwordValue.length < minPasswordLength) {
      password.classList.add('invalid');
      errorMessage.textContent =
        'Password must be at least 10 characters long.';
      return;
    }

    errorMessage.textContent = '';
    password.classList.remove('invalid');
    password.classList.add('valid');
    // loginForm.submit();
  });
}

if (registerForm) {
  registerForm.addEventListener('submit', function (event) {
    event.preventDefault();

    // Get the username and password values
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmpassword');

    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();
    const confPasswordValue = confirmPassword.value.trim();

    // Define validation rules
    const minUsernameLength = 5;
    const minPasswordLength = 10;
    const lowerCase = /[a-z]/;
    const upperCase = /[A-Z]/;

    // Check username
    if (usernameValue.length < minUsernameLength) {
      username.classList.add('invalid');
      errorMessage.textContent = 'Username must be at least 5 characters long.';
      return;
    }

    // Check if the password contains at least one of the characters
    if (!(lowerCase.test(usernameValue) && upperCase.test(usernameValue))) {
      username.classList.add('invalid');
      errorMessage.textContent =
        'Username does not include any upper or lower case characters.';
      return;
    }
    username.classList.remove('invalid');
    username.classList.add('valid');

    if (passwordValue.length < minPasswordLength) {
      password.classList.add('invalid');
      errorMessage.textContent =
        'Password must be at least 10 characters long.';
      return;
    }

    password.classList.remove('invalid');
    password.classList.add('valid');

    if (confPasswordValue !== passwordValue) {
      confirmPassword.classList.add('invalid');
      errorMessage.textContent = 'Passwords must match';
      return;
    }
    confirmPassword.classList.remove('invalid');
    confirmPassword.classList.add('valid');
    errorMessage.textContent = '';
    // registerForm.submit();
  });
}
