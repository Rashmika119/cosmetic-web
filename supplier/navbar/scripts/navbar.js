
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    
    // Toggle sidebar
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        sidebarToggle.classList.toggle('active');
    });

    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickInsideToggle = sidebarToggle.contains(event.target);
        
        if (!isClickInsideSidebar && !isClickInsideToggle && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
            sidebarToggle.classList.remove('active');
        }
    });

    // Close sidebar when window is resized above 1000px
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1000) {
            sidebar.classList.remove('active');
            sidebarToggle.classList.remove('active');
        }
    });
