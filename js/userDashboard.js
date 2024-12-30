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


document.addEventListener("DOMContentLoaded", function() {
    var params = new URLSearchParams(window.location.search);
    var value = params.get('output');

    if (value == 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Joined Successfully!',
            html: '<div class="text-center">You have successfully joined the classroom.</div>',
        });
    } else if (value == 'invalid') {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Class Code',
            html: '<div class="text-center">The class code you entered is invalid. Please try again.</div>',
        });
    } else if (value == 'error') {
        Swal.fire({
            icon: 'error',
            title: 'Something Went Wrong',
            html: '<div class="text-center">An error occurred while processing your request. Please try again later.</div>',
        });
    } else if (value == 'welcome') {
        // Onboarding welcome message
        Swal.fire({
            icon: 'info',
            title: 'Welcome Onboard!',
            html: `
                <div class="text-center">
                    Welcome to the Gradify platform! Here's what you can do:
                    <ul style="text-align: left; margin: 10px 0;">
                        <li>Join classrooms using a valid class code.</li>
                        <li>Calculate your GPA.</li>
                        <li>Check your rank in your classroom.</li>
                        <li>Share it to social meedia.</li>
                    </ul>
                    Let's get started on your gradify journey!
                </div>
            `,
            confirmButtonText: 'Let\'s Go!',
        });
    }
});
