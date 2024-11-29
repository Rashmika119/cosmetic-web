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


const header = document.getElementById('headSection');
const firstNav = document.getElementById('firstNavBar');
const secondNav = document.getElementById('secondNavBar');

window.addEventListener('scroll', () => {
    
  const headerHeight = header.offsetHeight;
  if (window.scrollY > headerHeight) {
    firstNav.style.transform = 'translateY(-100%)'; 
    secondNav.style.position = 'fixed';
    secondNav.style.zIndex = '1000';
    secondNav.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
  } else {
    secondNav.style.position = 'relative';
    firstNav.style.transform = 'translateY(0)';
  }
});




