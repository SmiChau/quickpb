document.getElementById('photoUpload').addEventListener('change', function(event) {
    const file = event.target.files[0]; 
    const profilePhoto = document.getElementById('profile-photo');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            profilePhoto.src = e.target.result; 
        };
        reader.readAsDataURL(file); 
    } else {
        
        profilePhoto.src = "photo.jpg";
    }
});


