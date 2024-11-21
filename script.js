// Select the form and error message elements
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');

// Add event listener for form submission
loginForm.addEventListener('submit', function (event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Get the username and password values
    const username = document.getElementById('name').value.trim();
    const password = document.getElementById('pass').value.trim();

    // Define validation rules
    const minUsernameLength = 5;
    const minPasswordLength = 10;
    const usernamePattern = /[a-zA-Z]/;

    // Check username
    if (username.length < minUsernameLength) {
        errorMessage.textContent = 'Username must be at least 5 characters long.';
        return;
    }
    const specialCharacters = /[!@#$%^&*()_+={}\[\]:;'"<>,.?]/;

    // Check if the password contains at least one of the characters
    if (!usernamePattern.test(username)) {
        console.log("Username does not include any upper or lower case characters.");
    }

    if (password.length < minPasswordLength) {
        errorMessage.textContent = 'Password must be at least 10 characters long.';
        return;
    }

    loginForm.submit();
});

registerForm.addEventListener('submit', function (event) {
    
    event.preventDefault();

    // Get the username and password values
    const username = document.getElementById('name').value.trim();
    const password = document.getElementById('pass').value.trim();

    // Define validation rules
    const minUsernameLength = 5;
    const minPasswordLength = 10;
    const usernamePattern = /[a-zA-Z]/;

    // Check username
    if (username.length < minUsernameLength) {
        errorMessage.textContent = 'Username must be at least 5 characters long.';
        return;
    }
    const specialCharacters = /[!@#$%^&*()_+={}\[\]:;'"<>,.?]/;

    // Check if the password contains at least one of the characters
    if (!usernamePattern.test(username)) {
        console.log("Username does not include any upper or lower case characters.");
    }

    if (password.length < minPasswordLength) {
        errorMessage.textContent = 'Password must be at least 10 characters long.';
        return;
    }
});




