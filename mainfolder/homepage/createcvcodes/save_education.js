document.addEventListener('DOMContentLoaded', () => {
    const saveEducationBtn = document.querySelector('.save-education-btn');

    saveEducationBtn.addEventListener('click', () => {
        const educationEntries = document.querySelectorAll('.education-entry');
        const formData = new FormData();

        if (educationEntries.length === 0) {
            console.error("No education entries found.");
            return;
        }

        educationEntries.forEach((entry, index) => {
            const degreeField = entry.querySelector('.degree, #degree');
            const schoolField = entry.querySelector('.school, #school');
            const cityField = entry.querySelector('.city, #education-city-input');
            const startDateField = entry.querySelector('.start-date, #start-date');
            const graduationDateField = entry.querySelector('.graduation-date, #graduation-date');
            const descriptionField = entry.querySelector('.description, #description');

            if (!degreeField || !schoolField || !cityField || !startDateField || !graduationDateField || !descriptionField) {
                console.error(`Missing fields in entry ${index}`);
                return;
            }

            formData.append(`education[${index}][degree]`, degreeField.value || '');
            formData.append(`education[${index}][school]`, schoolField.value || '');
            formData.append(`education[${index}][city]`, cityField.value || '');
            formData.append(`education[${index}][start_date]`, startDateField.value || '');
            formData.append(`education[${index}][graduation_date]`, graduationDateField.value || '');
            formData.append(`education[${index}][description]`, descriptionField.value || '');
        });

        // Debugging: Log form data before sending
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        fetch('save_education.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response from server:", data);
            if (data.status === 'success') {
                console.log('Education data saved successfully!');
                // Optionally, reload or update the UI
            } else {
                console.error('Error saving education data:', data.message);
            }
        })
        .catch(error => console.error('Fetch Error:', error));
    });
});