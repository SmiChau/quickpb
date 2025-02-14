document.addEventListener('DOMContentLoaded', () => {
    // Input references for the experience section
    const jobTitleInput = document.getElementById('job-title');
    const employerInput = document.getElementById('employer');
    const locationInput = document.getElementById('location');
    const startDateInput = document.getElementById('started-date');
    const endDateInput = document.getElementById('end-date');
    const descriptionInput = document.getElementById('descriptions');

    // Preview placeholders for the experience section
    const jobTitlePreview = document.getElementById('job-title-preview');
    const employerPreview = document.getElementById('company-preview');
    const locationPreview = document.getElementById('experience-city-preview');
    const experienceDatesPreview = document.getElementById('experience-dates-preview');
    const experienceDescriptionPreview = document.getElementById('experience-description-preview');

    const addExperienceBtn = document.querySelector('.add-experience-btn');
    const experienceSection = document.getElementById('experience-section');
    const experienceList = document.getElementById('experience-list');

    // Update initial preview dynamically
    jobTitleInput.addEventListener('input', () => {
        jobTitlePreview.textContent = jobTitleInput.value;
    });

    employerInput.addEventListener('input', () => {
        employerPreview.textContent = employerInput.value;
    });

    locationInput.addEventListener('input', () => {
        locationPreview.textContent = locationInput.value;
    });

    const updateDates = () => {
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;
        experienceDatesPreview.textContent =
            startDate || endDate ? `(${startDate} - ${endDate})` : 'Start Date - End Date';
    };

    startDateInput.addEventListener('input', updateDates);
    endDateInput.addEventListener('input', updateDates);

    descriptionInput.addEventListener('input', () => {
        experienceDescriptionPreview.textContent = descriptionInput.value;
    });

    // Add new work experience entry
    addExperienceBtn.addEventListener('click', () => {
        const newEntry = document.createElement('div');
        newEntry.classList.add('experience-entry');

        newEntry.innerHTML = `
            <div class="form-group">
                <label>Job Title</label>
                <input type="text" class="job-title" placeholder="Enter your job title">
            </div>
            <div class="form-group">
                <label>Employer/Organization</label>
                <input type="text" class="employer" placeholder="Enter employer name">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" class="location" placeholder="Enter location">
            </div>
            <div class="date-group">
                <label>Start Date</label>
                <input type="date" class="start-date">
                <label>End Date</label>
                <input type="date" class="end-date">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="description" placeholder="Mention your responsibilities"></textarea>
            </div>
            <button type="button" class="delete-experience-btn">Delete</button>
        `;

        // Insert the new entry before the Add Experience button
        experienceSection.insertBefore(newEntry, addExperienceBtn);

        // Attach dynamic preview logic to the new entry
        attachExperiencePreviewListeners(newEntry);
    });

    // Attach preview logic for each new entry
    function attachExperiencePreviewListeners(entry) {
        const jobTitleInput = entry.querySelector('.job-title');
        const employerInput = entry.querySelector('.employer');
        const locationInput = entry.querySelector('.location');
        const startDateInput = entry.querySelector('.start-date');
        const endDateInput = entry.querySelector('.end-date');
        const descriptionInput = entry.querySelector('.description');
        const deleteButton = entry.querySelector('.delete-experience-btn');

        const preview = document.createElement('div');
        preview.classList.add('experience-entry-preview');
        preview.innerHTML = `
            <div class="job-title-previews experience-field"></div>
            <div class="company-previews experience-field"></div>
            <div class="city-previews experience-field"></div>
            <div class="dates-previews experience-field"></div>
            <div class="description-previews experience-field"></div>
        `;

        experienceList.appendChild(preview);

        // Update preview fields dynamically
        jobTitleInput.addEventListener('input', () => {
            preview.querySelector('.job-title-previews').textContent = jobTitleInput.value;
        });

        employerInput.addEventListener('input', () => {
            preview.querySelector('.company-previews').textContent = employerInput.value;
        });

        locationInput.addEventListener('input', () => {
            preview.querySelector('.city-previews').textContent = locationInput.value;
        });

        const updateDates = () => {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;
            preview.querySelector('.dates-previews').textContent =
                startDate || endDate ? `(${startDate} - ${endDate})` : 'Start Date - End Date';
        };

        startDateInput.addEventListener('input', updateDates);
        endDateInput.addEventListener('input', updateDates);

        descriptionInput.addEventListener('input', () => {
            preview.querySelector('.description-previews').textContent = descriptionInput.value;
        });

        // Handle deletion of experience entry
        deleteButton.addEventListener('click', () => {
            entry.remove();
            preview.remove();
        });
    }

    // Attach listeners to existing entries
    const initialEntries = document.querySelectorAll('.experience-entry');
    initialEntries.forEach((entry) => attachExperiencePreviewListeners(entry));
});