

document.getElementById('signupForm').addEventListener('submit', function (event) {
    let isValid = true;

    const name = document.getElementById('name');

    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const phone = document.getElementById('phone');

   
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^[0-9]{10}$/; 

 
    resetErrors([name, email, password, confirmPassword, phone]);

 
    if (name.value.trim() === '') {
        showError(name, 'name is required');
        isValid = false;
    }


    if (email.value.trim() === '' || !emailPattern.test(email.value)) {
        showError(email, 'Please enter a valid email');
        isValid = false;
    }


    if (password.value.trim() === '') {
        showError(password, 'Password is required');
        isValid = false;
    }

  
    if (confirmPassword.value.trim() === '') {
        showError(confirmPassword, 'Confirm password is required');
        isValid = false;
    } else if (password.value !== confirmPassword.value) {
        showError(confirmPassword, 'Passwords do not match');
        isValid = false;
    }

 
    if (phone.value.trim() === '' || !phonePattern.test(phone.value)) {
        showError(phone, 'Please enter a valid 10-digit phone number');
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