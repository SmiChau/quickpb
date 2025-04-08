document.addEventListener('DOMContentLoaded', () => {
    fetchEducationData();

    // Add Education Button
    document.querySelector('.add-education-btn').addEventListener('click', addEducationEntry);
});

// Fetch education data from the backend
function fetchEducationData() {
    fetch('fetch_education.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                console.error(data.message);
                return;
            }

            const educationEntriesContainer = document.getElementById('education-entries-container');
            const educationList = document.getElementById('education-list');
            const educationHeader = document.getElementById('education-header');

            // Clear existing entries (except the first one)
            while (educationEntriesContainer.children.length > 1) {
                educationEntriesContainer.removeChild(educationEntriesContainer.lastChild);
            }

            // Clear existing preview entries
            educationList.innerHTML = '';

            if (data.data.length > 0) {
                // Show the "Education" header if there is data
                educationHeader.style.display = 'block';

                // Populate first entry (Main preview fields)
                const firstEntry = data.data[0];
                populateFirstEntry(firstEntry, educationList);

                // Add additional entries (if any)
                data.data.slice(1).forEach((entry) => {
                    const newEntry = createEducationEntry(entry);
                    educationEntriesContainer.appendChild(newEntry);

                    // Create a preview for the additional entry
                    attachPreviewListeners(newEntry, educationList);
                });
            } else {
                // Hide the "Education" header if no data is present
                educationHeader.style.display = 'none';
            }
        })
        .catch(error => console.error('Error:', error));
}

// Populate the first education entry
function populateFirstEntry(entry, previewContainer) {
    const degreeInput = document.getElementById('degree');
    const schoolInput = document.getElementById('school');
    const cityInput = document.getElementById('education-city-input');
    const startDateInput = document.getElementById('start-date');
    const graduationDateInput = document.getElementById('graduation-date');
    const descriptionInput = document.getElementById('description');

    // Set input values
    degreeInput.value = entry.degree || '';
    schoolInput.value = entry.school || '';
    cityInput.value = entry.city || '';
    startDateInput.value = entry.start_date || '';
    graduationDateInput.value = entry.graduation_date || '';
    descriptionInput.value = entry.description || '';

    // Update Preview for the first entry
    updatePreview(entry, previewContainer, true);

    // Attach event listeners to update the preview dynamically
    const inputs = [degreeInput, schoolInput, cityInput, startDateInput, graduationDateInput, descriptionInput];
    inputs.forEach(input => {
        input.addEventListener('input', () => updatePreviewFromInput(inputs, previewContainer, true));
    });
}

// Create a new education entry
function createEducationEntry(entry) {
    const newEntry = document.createElement('div');
    newEntry.classList.add('education-entry');

    newEntry.innerHTML = `
        <label>Degree</label>
        <input type="text" class="degree" value="${entry.degree || ''}">
        <label>School/Institution</label>
        <input type="text" class="school" value="${entry.school || ''}">
        <label>City</label>
        <input type="text" class="city" value="${entry.city || ''}">
        <div class="date-group">
            <div>
                <label>Start Date</label>
                <input type="date" class="start-date" value="${entry.start_date || ''}">
            </div>
            <div>
                <label>Graduation Date</label>
                <input type="date" class="graduation-date" value="${entry.graduation_date || ''}">
            </div>
        </div>
        <label>Description</label>
        <textarea class="description">${entry.description || ''}</textarea>
        <button type="button" class="delete-education-btn">Delete</button>
    `;

    return newEntry;
}

// Update the preview
function updatePreview(entry, previewContainer, isFirstEntry) {
    const previewEntry = document.createElement('div');
    previewEntry.classList.add('education-entry-preview');

    if (isFirstEntry) {
        previewEntry.classList.add('first-entry-preview');
        previewEntry.innerHTML = `
            <div class="education-field" id="degree-preview">${entry.degree || ''}</div>
            <div class="education-field" id="school-preview">${entry.school || ''}</div>
            <div class="education-field" id="education-city-preview">${entry.city || ''}</div>
            <div class="education-field" id="education-dates-preview">
                ${entry.start_date && entry.graduation_date
                    ? `(${entry.start_date} - ${entry.graduation_date})`
                    : 'Start Date - Graduation Date'}
            </div>
            <div class="education-field" id="education-description-preview">${entry.description || ''}</div>
        `;
    } else {
        previewEntry.classList.add('additional-entry-preview');
        previewEntry.innerHTML = `
            <div class="education-field degree-preview">${entry.degree || ''}</div>
            <div class="education-field school-preview">${entry.school || ''}</div>
            <div class="education-field city-preview">${entry.city || ''}</div>
            <div class="education-field dates-preview">
                ${entry.start_date && entry.graduation_date
                    ? `(${entry.start_date} - ${entry.graduation_date})`
                    : 'Start Date - Graduation Date'}
            </div>
            <div class="education-field description-preview">${entry.description || ''}</div>
        `;
    }

    previewContainer.appendChild(previewEntry);
}

// Update the preview dynamically from the input fields
function updatePreviewFromInput(inputs, previewContainer, isFirstEntry) {
    const [degreeInput, schoolInput, cityInput, startDateInput, graduationDateInput, descriptionInput] = inputs;

    const entryData = {
        degree: degreeInput.value,
        school: schoolInput.value,
        city: cityInput.value,
        start_date: startDateInput.value,
        graduation_date: graduationDateInput.value,
        description: descriptionInput.value,
    };

    // Update the preview dynamically for the first entry
    const firstEntryPreview = previewContainer.querySelector('.first-entry-preview');
    if (firstEntryPreview) {
        firstEntryPreview.innerHTML = `
            <div class="education-field" id="degree-preview">${entryData.degree || ''}</div>
            <div class="education-field" id="school-preview">${entryData.school || ''}</div>
            <div class="education-field" id="education-city-preview">${entryData.city || ''}</div>
            <div class="education-field" id="education-dates-preview">
                ${entryData.start_date && entryData.graduation_date
                    ? `(${entryData.start_date} - ${entryData.graduation_date})`
                    : 'Start Date - Graduation Date'}
            </div>
            <div class="education-field" id="education-description-preview">${entryData.description || ''}</div>
        `;
    }
}

// Attach preview updates dynamically
function attachPreviewListeners(entry, previewContainer) {
    const degreeInput = entry.querySelector('.degree');
    const schoolInput = entry.querySelector('.school');
    const cityInput = entry.querySelector('.city');
    const startDateInput = entry.querySelector('.start-date');
    const graduationDateInput = entry.querySelector('.graduation-date');
    const descriptionInput = entry.querySelector('.description');

    // Create a preview entry for this input
    const previewEntry = document.createElement('div');
    previewEntry.classList.add('education-entry-preview');
    previewContainer.appendChild(previewEntry);

    const updatePreviewFromEntry = () => {
        const entryData = {
            degree: degreeInput.value,
            school: schoolInput.value,
            city: cityInput.value,
            start_date: startDateInput.value,
            graduation_date: graduationDateInput.value,
            description: descriptionInput.value,
        };

        // Update the preview entry in place
        previewEntry.innerHTML = `
            <div class="education-field degree-preview">${entryData.degree || ''}</div>
            <div class="education-field school-preview">${entryData.school || ''}</div>
            <div class="education-field city-preview">${entryData.city || ''}</div>
            <div class="education-field dates-preview">
                ${entryData.start_date && entryData.graduation_date
                    ? `(${entryData.start_date} - ${entryData.graduation_date})`
                    : ''}
            </div>
            <div class="education-field description-preview">${entryData.description || ''}</div>
        `;
    };

    // Attach event listeners to update the preview dynamically
    degreeInput.addEventListener('input', updatePreviewFromEntry);
    schoolInput.addEventListener('input', updatePreviewFromEntry);
    cityInput.addEventListener('input', updatePreviewFromEntry);
    startDateInput.addEventListener('input', updatePreviewFromEntry);
    graduationDateInput.addEventListener('input', updatePreviewFromEntry);
    descriptionInput.addEventListener('input', updatePreviewFromEntry);

    // Initialize the preview with the current values
    updatePreviewFromEntry();
}

