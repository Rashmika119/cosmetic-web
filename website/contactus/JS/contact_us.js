// JavaScript to toggle the visibility of answers
document.querySelectorAll('.faq-question').forEach((item) => {
    item.addEventListener('click', () => {
        const answer = item.nextElementSibling; // Select the FAQ answer
        const arrow = item.querySelector('.faq-arrow'); // Select the arrow inside the question

        // Toggle answer visibility
        if (answer.style.display === 'block') {
            answer.style.display = 'none';  // Hide the answer
            arrow.classList.remove('active');  // Remove the active class from the arrow
        } else {
            answer.style.display = 'block';  // Show the answer
            arrow.classList.add('active');  // Add the active class to the arrow
        }
    });
});


// JavaScript to toggle the map visibility (Optional)
document.querySelector('.toggle-map').addEventListener('click', function () {
    const mapContainer = document.querySelector('.map-container');
    if (mapContainer.style.display === 'none') {
        mapContainer.style.display = 'block';
    } else {
        mapContainer.style.display = 'none';
    } 
});

