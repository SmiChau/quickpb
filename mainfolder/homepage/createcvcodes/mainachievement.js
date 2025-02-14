document.addEventListener('DOMContentLoaded', () => {
    // Selectors for inputs and preview containers
    const achievementTitleInput = document.getElementById('achievement-title');
    const achievementDescriptionInput = document.getElementById('achievement-description');
    const achievementTitlePreview = document.getElementById('achievement-title-preview');
    const achievementDescriptionPreview = document.getElementById('achievement-description-preview');

    const addAchievementBtn = document.getElementById('add-achievement-btn');
    const achievementsContainer = document.getElementById('achievements-container');
    const achievementsList = document.getElementById('achievements-list');

    // Update preview for the first static achievement input
    achievementTitleInput.addEventListener('input', () => {
        achievementTitlePreview.textContent = achievementTitleInput.value;
    });

    achievementDescriptionInput.addEventListener('input', () => {
        achievementDescriptionPreview.textContent = achievementDescriptionInput.value;
    });

    // Add new achievement
    addAchievementBtn.addEventListener('click', () => {
        const newEntry = document.createElement('div');
        newEntry.classList.add('achievement-entry');

        newEntry.innerHTML = `
            <label>Title</label>
            <input type="text" class="achievement-title" placeholder="Enter achievement title">
            <label>Description</label>
            <textarea class="achievement-description" placeholder="Describe the achievement"></textarea>
            <button type="button" class="delete-achievement-btn">Delete</button>
        `;

        achievementsContainer.appendChild(newEntry);

        // Create corresponding preview for Sidebar Three
        const newPreview = document.createElement('div');
        newPreview.classList.add('achievement-entry-preview');

        newPreview.innerHTML = `
            <div class="achievement-title-preview"></div>
            <div class="achievement-description-preview"></div>
        `;

        achievementsList.appendChild(newPreview);

        // Attach dynamic updates
        const titleInput = newEntry.querySelector('.achievement-title');
        const descriptionInput = newEntry.querySelector('.achievement-description');

        titleInput.addEventListener('input', () => {
            newPreview.querySelector('.achievement-title-preview').textContent = titleInput.value;
        });

        descriptionInput.addEventListener('input', () => {
            newPreview.querySelector('.achievement-description-preview').textContent = descriptionInput.value;
        });

        // Handle deletion
        const deleteButton = newEntry.querySelector('.delete-achievement-btn');
        deleteButton.addEventListener('click', () => {
            newEntry.remove(); // Remove input fields
            newPreview.remove(); // Remove preview
        });
    });
});