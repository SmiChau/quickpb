// education section
document.addEventListener('DOMContentLoaded', () => {
    // Selectors for initial inputs and preview placeholders
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

    
    // Update initial preview dynamically
    degreeInput.addEventListener('input', () => {
        degreePreview.textContent = degreeInput.value;
    });

    schoolInput.addEventListener('input', () => {
        schoolPreview.textContent = schoolInput.value;
    });

    educationCityInput.addEventListener('input', () => {
        educationCityPreview.textContent = educationCityInput.value;
    });

    const updateDates = () => {
        const startDate = startDateInput.value;
        const graduationDate = graduationDateInput.value;
        educationDatesPreview.textContent =
            startDate || graduationDate ? `(${startDate} - ${graduationDate})` : 'Start Date - Graduation Date';
    };

    startDateInput.addEventListener('input', updateDates);
    graduationDateInput.addEventListener('input', updateDates);

    descriptionInput.addEventListener('input', () => {
        educationDescriptionPreview.textContent = descriptionInput.value;
    });

    document.addEventListener('DOMContentLoaded', () => {
        const addEducationBtn = document.querySelector('.add-education-btn');
        const educationSection = document.getElementById('education-section');
        const educationList = document.getElementById('education-list');
    
        // Add new education entry
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
    
        // Attach Preview Logic for a new Education Entry
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
    
            // Update preview dynamically
            degreeInput.addEventListener('input', () => {
                preview.querySelector('.degree-preview').textContent = degreeInput.value;
            });
    
            schoolInput.addEventListener('input', () => {
                preview.querySelector('.school-preview').textContent = schoolInput.value;
            });
    
            cityInput.addEventListener('input', () => {
                preview.querySelector('.city-preview').textContent = cityInput.value;
            });
    
            const updateDates = () => {
                const startDate = startDateInput.value;
                const graduationDate = graduationDateInput.value;
                preview.querySelector('.dates-preview').textContent =
                    startDate || graduationDate ? `(${startDate} - ${graduationDate})` : 'Start Date - Graduation Date';
            };
    
            startDateInput.addEventListener('input', updateDates);
            graduationDateInput.addEventListener('input', updateDates);
    
            descriptionInput.addEventListener('input', () => {
                preview.querySelector('.description-preview').textContent = descriptionInput.value;
            });
    
            // Handle deletion
            deleteButton.addEventListener('click', () => {
                entry.remove();
                preview.remove();
            });
        }
    });
    