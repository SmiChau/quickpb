document.addEventListener('DOMContentLoaded', () => {
    const addEducationBtn = document.querySelector('.add-education-btn');
    const educationSection = document.getElementById('education-section');
    const educationList = document.getElementById('education-list');

    // First Entry Inputs & Previews (Uses IDs)
    const degreeInput = document.getElementById('degree');
    const schoolInput = document.getElementById('school');
    const educationCityInput = document.getElementById('education-city-input');
    const startDateInput = document.getElementById('start-date');
    const graduationDateInput = document.getElementById('graduation-date');
    const descriptionInput = document.getElementById('description');

    const degreePreview = document.getElementById('degree-preview');
    const schoolPreview = document.getElementById('school-preview');
    const educationCityPreview = document.getElementById('education-city-preview');
    const educationDatesPreview = document.getElementById('education-dates-preview');
    const educationDescriptionPreview = document.getElementById('education-description-preview');

    // Function to Update Preview
    function updatePreview(input, preview) {
        input.addEventListener('input', () => {
            preview.textContent = input.value;
        });
    }

    // Attach Event Listeners for First Entry
    updatePreview(degreeInput, degreePreview);
    updatePreview(schoolInput, schoolPreview);
    updatePreview(educationCityInput, educationCityPreview);
    updatePreview(descriptionInput, educationDescriptionPreview);

    const updateFirstEntryDates = () => {
        const startDate = startDateInput.value;
        const graduationDate = graduationDateInput.value;
        educationDatesPreview.textContent =
            startDate || graduationDate ? `(${startDate} - ${graduationDate})` : 'Start Date - Graduation Date';
    };

    startDateInput.addEventListener('input', updateFirstEntryDates);
    graduationDateInput.addEventListener('input', updateFirstEntryDates);

    // Function to Attach Event Listeners for New Entries
    function attachPreviewListeners(entry) {
        const degreeInput = entry.querySelector('.degree');
        const schoolInput = entry.querySelector('.school');
        const cityInput = entry.querySelector('.city');
        const startDateInput = entry.querySelector('.start-date');
        const graduationDateInput = entry.querySelector('.graduation-date');
        const descriptionInput = entry.querySelector('.description');
        const deleteButton = entry.querySelector('.delete-education-btn');

        // Create a corresponding preview
        const preview = document.createElement('div');
        preview.classList.add('education-entry-preview');
        preview.innerHTML = `
            <div class="degree-preview"></div>
            <div class="school-preview"></div>
            <div class="city-preview"></div>
            <div class="dates-preview"></div>
            <div class="description-preview"></div>
        `;

        educationList.appendChild(preview);

        updatePreview(degreeInput, preview.querySelector('.degree-preview'));
        updatePreview(schoolInput, preview.querySelector('.school-preview'));
        updatePreview(cityInput, preview.querySelector('.city-preview'));
        updatePreview(descriptionInput, preview.querySelector('.description-preview'));

        const updateDates = () => {
            const startDate = startDateInput.value;
            const graduationDate = graduationDateInput.value;
            preview.querySelector('.dates-preview').textContent =
                startDate || graduationDate ? `(${startDate} - ${graduationDate})` : 'Start Date - Graduation Date';
        };

        startDateInput.addEventListener('input', updateDates);
        graduationDateInput.addEventListener('input', updateDates);

        // Handle delete
        deleteButton.addEventListener('click', () => {
            entry.remove();
            preview.remove();
        });
    }

    // Add New Education Entry
    addEducationBtn.addEventListener('click', () => {
        const newEntry = document.createElement('div');
        newEntry.classList.add('education-entry');

        newEntry.innerHTML = `
            <label>Degree</label>
            <input type="text" class="degree" placeholder="Enter your degree">
            <label>School/Institution</label>
            <input type="text" class="school" placeholder="Enter school name">
            <label>City</label>
            <input type="text" class="city" placeholder="Enter city name">
            <label>Start Date</label>
            <input type="date" class="start-date">
            <label>Graduation Date</label>
            <input type="date" class="graduation-date">
            <label>Description</label>
            <textarea class="description" placeholder="Talk about your course of study"></textarea>
            <button type="button" class="delete-education-btn">Delete</button>
        `;

        // Insert the new entry before the Add Education button
        educationSection.insertBefore(newEntry, addEducationBtn);

        // Attach dynamic preview logic to the new entry
        attachPreviewListeners(newEntry);
    });
});