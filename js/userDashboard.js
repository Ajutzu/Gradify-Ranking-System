document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');
    const sidebarClose = document.querySelector('.sidebar-close');
    
    function toggleSidebar() {
        sidebar.classList.toggle('collapsed');
        sidebarOverlay.classList.toggle('active');
    }
    
    // Toggle button click
    sidebarToggle.addEventListener('click', toggleSidebar);
    
    // Close button click
    sidebarClose.addEventListener('click', toggleSidebar);
    
    // Overlay click
    sidebarOverlay.addEventListener('click', toggleSidebar);
    
    // Handle responsive behavior
    function checkWidth() {
        if (window.innerWidth <= 768) {
            sidebar.classList.add('collapsed');
            sidebarOverlay.classList.remove('active');
        } else {
            sidebar.classList.remove('collapsed');
            sidebarOverlay.classList.remove('active');
        }
    }
    
    // Check on load and resize
    window.addEventListener('resize', checkWidth);
    checkWidth();
});