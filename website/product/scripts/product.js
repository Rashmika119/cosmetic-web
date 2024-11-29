// Get the elements
const plusBtn = document.getElementById('plus');
const minusBtn = document.getElementById('minus');
const amountInput = document.getElementById('amount');

// Increment the value when the plus button is clicked
plusBtn.addEventListener('click', () => {
    amountInput.value = parseInt(amountInput.value) + 1;
});

// Decrement the value when the minus button is clicked, but not below 1
minusBtn.addEventListener('click', () => {
    if (parseInt(amountInput.value) > 1) {
        amountInput.value = parseInt(amountInput.value) - 1;
    }
});

