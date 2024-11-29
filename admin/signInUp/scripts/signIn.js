
document.getElementById("signinForm").addEventListener('submit', function (event) {
    let isValid = true;


    const email = document.getElementById('email');
    const password = document.getElementById('password');

    
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


    resetErrors([email, password]);

    
    if (email.value.trim() === '' || !emailPattern.test(email.value)) {
        showError(email, 'Please enter a valid email');
        isValid = false;
    }

    
    if (password.value.trim() === '') {
        showError(password, 'Password is required');
        isValid = false;
    }

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