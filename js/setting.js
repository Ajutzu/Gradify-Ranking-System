document.addEventListener('DOMContentLoaded', function() {
    const profileInput = document.getElementById('profilePicture');
    // Update selector to specifically target the main profile image
    const profileImage = document.querySelector('.col-md-4 .profile-img-2');

    profileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Check if file is an image
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                return;
            }
            
            // Check file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size should be less than 5MB');
                return;
            }

            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Update only the main profile image
                profileImage.src = e.target.result;
            }
            
            reader.readAsDataURL(file);
        }
    });
});

function previewCoverPhoto(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('coverPhotoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

