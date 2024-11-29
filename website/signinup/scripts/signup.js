

document.getElementById('signupForm').addEventListener('submit', function (event) {
    let isValid = true;

    // Get form inputs
    const fname = document.getElementById('fname');
    const lname = document.getElementById('lname');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const phone = document.getElementById('phone');

    // Regular expressions
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^[0-9]{10}$/; // Example: 10-digit phone number validation

    // Reset previous error messages and styles
    resetErrors([fname, lname, email, password, confirmPassword, phone]);

    // Validate first name
    if (fname.value.trim() === '') {
        showError(fname, 'First name is required');
        isValid = false;
    }

    // Validate last name
    if (lname.value.trim() === '') {
        showError(lname, 'Last name is required');
        isValid = false;
    }

    // Validate email
    if (email.value.trim() === '' || !emailPattern.test(email.value)) {
        showError(email, 'Please enter a valid email');
        isValid = false;
    }

    // Validate password
    if (password.value.trim() === '') {
        showError(password, 'Password is required');
        isValid = false;
    }

    // Validate confirm password
    if (confirmPassword.value.trim() === '') {
        showError(confirmPassword, 'Confirm password is required');
        isValid = false;
    } else if (password.value !== confirmPassword.value) {
        showError(confirmPassword, 'Passwords do not match');
        isValid = false;
    }

    // Validate phone number (10 digits in this example)
    if (phone.value.trim() === '' || !phonePattern.test(phone.value)) {
        showError(phone, 'Please enter a valid 10-digit phone number');
        isValid = false;
    }

    // Prevent form submission if validation fails
    if (!isValid) {
        event.preventDefault();
    }
});



function showError(input, message) {
    const errorElement = input.nextElementSibling;
    input.style.borderColor = 'red';
    errorElement.innerText = message;
    errorElement.style.color = 'red';
}

function resetErrors(inputs) {
    inputs.forEach(input => {
        input.style.borderColor = '';
        input.nextElementSibling.innerText = '';
    });
}