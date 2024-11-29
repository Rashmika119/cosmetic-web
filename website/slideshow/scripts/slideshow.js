let slidingText = document.getElementById('main-group');

// Clone the sliding text for continuous effect
slidingText.innerHTML += slidingText.innerHTML; 

// Set the width of the sliding-text dynamically based on its contents
let textWidth = slidingText.scrollWidth; // Get the total width of the items
slidingText.style.width = `${textWidth}px`; // Set the sliding-text width

// Start the animation
function slideText() {
    slidingText.style.animation = `slide ${textWidth / 160}s linear infinite`;
}

slideText();