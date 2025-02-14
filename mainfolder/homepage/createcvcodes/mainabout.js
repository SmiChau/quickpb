// About section code

document.addEventListener('DOMContentLoaded', () => {
    // References to input fields and placeholders
    const fileInput = document.getElementById('file-input');
    const uploadBtn = document.getElementById('upload-btn');
    const deleteBtn = document.getElementById('delete-btn');
    const profileImg = document.getElementById('profile-img');
    const photoPreview = document.getElementById('photo-preview');

    const nameInput = document.getElementById('first-name');
    const lastNameInput = document.getElementById('last-name');
    const fullNameInput = document.getElementById('full-name');
    const designationInput = document.getElementById('designation');
    const addressInput = document.getElementById('address');
    const cityInput = document.getElementById('city');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const summaryInput = document.getElementById('summary');

    const namePreview = document.getElementById('name-preview');
    const lastnamePreview = document.getElementById('lastname-preview');
    const fullnamePreview = document.getElementById('fullname-preview');
    const designationPreview = document.getElementById('designation-preview');
    const addressPreview = document.getElementById('address-preview');
    const cityPreview = document.getElementById('city-preview');
    const emailPreview = document.getElementById('email-preview');
    const phonePreview = document.getElementById('phone-preview');
    const summaryPreview = document.getElementById('summary-preview');
   
    // Profile Photo Upload
    uploadBtn.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                profileImg.src = e.target.result;
                photoPreview.src = e.target.result; // Update the preview
            };
            reader.readAsDataURL(file);
        }
    });

    deleteBtn.addEventListener('click', () => {
        profileImg.src = 'default-profile.png';
        photoPreview.src = 'default-profile.png'; // Reset to default
    });

    // Update Placeholders on Input
    nameInput.addEventListener('input', () => {
        namePreview.textContent = nameInput.value;
    });

    lastNameInput.addEventListener('input', () => {
        lastnamePreview.textContent = lastNameInput.value;
    });
    fullNameInput.addEventListener('input', () => {
        fullnamePreview.textContent = `${nameInput.value} ${lastNameInput.value}`;
    });

    designationInput.addEventListener('input', () => {
        designationPreview.textContent = designationInput.value;
    });

    addressInput.addEventListener('input', () => {
        addressPreview.textContent = `${addressInput.value}${addressInput.value && cityInput.value ? ', ' : ''}${cityInput.value}`;
    });
    
    cityInput.addEventListener('input', () => {
        addressPreview.textContent = `${addressInput.value}${addressInput.value && cityInput.value ? ', ' : ''}${cityInput.value}`;
    })

    emailInput.addEventListener('input', () => {
        emailPreview.textContent = emailInput.value;
    });

    phoneInput.addEventListener('input', () => {
        phonePreview.textContent = phoneInput.value;
    });

    summaryInput.addEventListener('input', () => {
        summaryPreview.textContent = summaryInput.value;
    }); 
});
