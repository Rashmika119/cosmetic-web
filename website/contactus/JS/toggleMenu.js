// Toggle menu open/close functionality
document.querySelector('.togglebutton').addEventListener('click', function() {
    document.querySelector('.togglemenu').classList.add('active');
});

document.querySelector('.toggleCloseButton').addEventListener('click', function() {
    document.querySelector('.togglemenu').classList.remove('active');
});

// Search overlay open/close functionality for all search icons
const searchIcons = document.querySelectorAll('.searchIcon'); // Select all search icons
searchIcons.forEach(function(icon) {
    icon.addEventListener('click', function() {
        document.querySelector('.searchOverlay').classList.add('active');
    });
});

document.querySelector('.searchOverlayClose').addEventListener('click', function() {
    document.querySelector('.searchOverlay').classList.remove('active');
});
