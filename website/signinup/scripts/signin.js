
document.getElementById("signinForm").addEventListener('submit', function (event) {
    let isValid = true;


    // Get form inputs
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    // Regular expressions
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Reset previous error messages and styles
    resetErrors([email, password]);

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