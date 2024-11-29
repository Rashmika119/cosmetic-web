const rangeInput = document.getElementById('priceRange');
const rangeValue = document.getElementById('rangeValue');

rangeInput.addEventListener('input', function() {
    rangeValue.textContent = rangeInput.value;
});
