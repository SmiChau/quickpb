document.addEventListener('DOMContentLoaded', () => {
    const addExperienceBtn = document.querySelector('.add-experience-btn');
    const experienceSection = document.getElementById('experience-section');
    const experienceList = document.getElementById('experience-list');

    // First Entry Inputs & Previews (Uses IDs)
    const jobTitleInput = document.getElementById('job-title');
    const employerInput = document.getElementById('employer');
    const experienceCityInput = document.getElementById('experience-city-input');
    const startDateInput = document.getElementById('start-date');
    const endDateInput = document.getElementById('end-date');
    const descriptionInput = document.getElementById('experience-description');

    const jobTitlePreview = document.getElementById('job-title-preview');
    const employerPreview = document.getElementById('company-preview');
    const experienceCityPreview = document.getElementById('experience-city-preview');
    const experienceDatesPreview = document.getElementById('experience-dates-preview');
    const experienceDescriptionPreview = document.getElementById('experience-description-preview');

    // Function to Update Preview
    function updatePreview(input, preview) {
        input.addEventListener('input', () => {
            preview.textContent = input.value;
        });
    }

    // Attach Event Listeners for First Entry
    updatePreview(jobTitleInput, jobTitlePreview);
    updatePreview(employerInput, employerPreview);
    updatePreview(experienceCityInput, experienceCityPreview);
    updatePreview(descriptionInput, experienceDescriptionPreview);

    const updateFirstEntryDates = () => {
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;
        experienceDatesPreview.textContent =
            startDate || endDate ? `(${startDate} - ${endDate})` : '';
    };

    startDateInput.addEventListener('input', updateFirstEntryDates);
    endDateInput.addEventListener('input', updateFirstEntryDates);

    // Function to Attach Event Listeners for New Entries
    function attachPreviewListeners(entry) {
        const jobTitleInput = entry.querySelector('.job-title');
        const employerInput = entry.querySelector('.employer');
        const cityInput = entry.querySelector('.city');
        const startDateInput = entry.querySelector('.start-date');
        const endDateInput = entry.querySelector('.end-date');
        const descriptionInput = entry.querySelector('.description');
        const deleteButton = entry.querySelector('.delete-experience-btn');

        // Create a corresponding preview
        const preview = document.createElement('div');
        preview.classList.add('experience-entry-preview');
        preview.innerHTML = `
            <div class="job-title-preview experience-field"></div>
            <div class="company-preview experience-field"></div>
            <div class="city-preview experience-field"></div>
            <div class="dates-preview experience-field"></div>
            <div class="description-preview experience-field"></div>
        `;

        experienceList.appendChild(preview);

        updatePreview(jobTitleInput, preview.querySelector('.job-title-preview'));
        updatePreview(employerInput, preview.querySelector('.employer-preview'));
        updatePreview(cityInput, preview.querySelector('.city-preview'));
        updatePreview(descriptionInput, preview.querySelector('.description-preview'));

        const updateDates = () => {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;
            preview.querySelector('.dates-preview').textContent =
                startDate || endDate ? `(${startDate} - ${endDate})` : '';
        };

        startDateInput.addEventListener('input', updateDates);
        endDateInput.addEventListener('input', updateDates);

        // Handle delete
        deleteButton.addEventListener('click', () => {
            entry.remove();
            preview.remove();
        });
    }

    // Add New Experience Entry
    addExperienceBtn.addEventListener('click', () => {
        const newEntry = document.createElement('div');
        newEntry.classList.add('experience-entry');

        newEntry.innerHTML = `
            <label>Job Title</label>
            <input type="text" class="job-title" placeholder="Enter your job title">
            <label>Employer/Organization</label>
            <input type="text" class="employer" placeholder="Enter employer name">
            <label>City</label>
            <input type="text" class="city" placeholder="Enter city name">
            <label>Start Date</label>
            <input type="date" class="start-date">
            <label>End Date</label>
            <input type="date" class="end-date">
            <label>Description</label>
            <textarea class="description" placeholder="Mention key tasks and achievements"></textarea>
            <button type="button" class="delete-experience-btn">Delete</button>
        `;

        // Insert the new entry before the Add Experience button
        experienceSection.insertBefore(newEntry, addExperienceBtn);

        // Attach dynamic preview logic to the new entry
        attachPreviewListeners(newEntry);
    });
});
