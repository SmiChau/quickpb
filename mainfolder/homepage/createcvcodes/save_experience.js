document.addEventListener('DOMContentLoaded', () => {
    const saveExperienceBtn = document.createElement('button');
    saveExperienceBtn.textContent = 'Save Experience';
    saveExperienceBtn.classList.add('save-experience-btn');
    document.querySelector('#experience-section').appendChild(saveExperienceBtn);

    saveExperienceBtn.addEventListener('click', () => {
        const experienceEntries = document.querySelectorAll('.experience-entry');
        const formData = new FormData();

        if (experienceEntries.length === 0) {
            console.error("No experience entries found.");
            return;
        }

        experienceEntries.forEach((entry, index) => {
            const jobTitleField = entry.querySelector('#job-title');
            const employerField = entry.querySelector('#employer');
            const locationField = entry.querySelector('#location');
            const startDateField = entry.querySelector('#started-date');
            const endDateField = entry.querySelector('#end-date');
            const descriptionField = entry.querySelector('#descriptions');

            if (!jobTitleField || !employerField || !locationField || !startDateField || !endDateField || !descriptionField) {
                console.error(`Missing fields in entry ${index}`);
                return;
            }

            formData.append(`experience[${index}][job_title]`, jobTitleField.value || '');
            formData.append(`experience[${index}][employer]`, employerField.value || '');
            formData.append(`experience[${index}][location]`, locationField.value || '');
            formData.append(`experience[${index}][start_date]`, startDateField.value || '');
            formData.append(`experience[${index}][end_date]`, endDateField.value || '');
            formData.append(`experience[${index}][description]`, descriptionField.value || '');
        });

        // Debugging: Log form data before sending
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        fetch('save_experience.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response from server:", data);
            if (data.status === 'success') {
                console.log('Experience data saved successfully!');
                // Optionally, reload or update the UI
            } else {
                console.error('Error saving experience data:', data.message);
            }
        })
        .catch(error => console.error('Fetch Error:', error));
    });
});
