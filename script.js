// Select the form and error message elements
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const errorMessage = document.getElementById('error');
const body = document.body;
const theme = document.getElementById('theme-checkbox');
const couchesList = document.getElementById('couchesList');
const wardrobeList = document.getElementById('wardrobeList');
const bedsList = document.getElementById('bedsList');
const devicesList = document.getElementById('devicesList');
const collectionList = document.getElementById('collectionList');
const tax = 1.19

function applySavedTheme() {
  const storedTheme = localStorage.getItem('theme');
  if (storedTheme === 'dark') {
    body.classList.add('darkMode');
    body.classList.remove('lightMode');
    if (theme) theme.checked = true; // synchronise checkbox
  } else {
    body.classList.add('lightMode');
    body.classList.remove('darkMode');
    if (theme) theme.checked = false; // synchronise checkbox
  }
}

function setTheme(event) {
  if (theme) {
    if (event.target.checked) {
      body.classList.remove('lightMode');
      body.classList.add('darkMode');
      localStorage.setItem('theme', 'dark');
    } else {
      body.classList.remove('darkMode');
      body.classList.add('lightMode');
      localStorage.setItem('theme', 'light');
    }
  }
}
applySavedTheme();

function setItemCount(action, itemId) {
  const price = Number(
    document.getElementById(itemId + '-price').innerText.split('€')[0]
  );
  const name = document.getElementById(itemId + '-name').innerText;
  const description = document.getElementById(
    itemId + '-description'
  ).innerText;
  const countElement = document.getElementById(itemId);
  const sumElement = document.getElementById('sum');
  let sum = Number(sumElement.innerText);
  let itemCount = Number(countElement.innerText);

  if (action === 'add') {
    itemCount += 1;
    collectionList.insertAdjacentHTML(
      'afterbegin',
      `<div id="${itemId}-${itemCount}" class="collectionItem" data-price="${price}">
        <h5>${name}</h5>
        <span>${description}</span>
        <span>${price}.00€</span>
      </div>`
    );
    sum += price;
  }
  if (action === 'sub' && itemCount > 0) {
    document.getElementById(`${itemId}-${itemCount}`).remove();
    itemCount -= 1;
    sum -= price;
  }

  sumElement.innerText = sum;
  countElement.innerText = itemCount;
  getTotalPrice(sum);
}

function getTotalPrice(priceWOTax) {
  const element = document.getElementById('priceWTaxes');
  const priceWithTaxes = (tax * priceWOTax).toFixed(2);
  element.innerText = priceWithTaxes;
}

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
