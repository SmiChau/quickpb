const trainingsContainer = document.getElementById('trainings-container');
const addTrainingBtn = document.getElementById('add-training-btn');

// Function to create a new training row
function createTrainingRow() {
    const trainingRow = document.createElement('div');
    trainingRow.className = 'training-row';

    // Training Title
    const titleLabel = document.createElement('label');
    titleLabel.textContent = 'Training/Certification Title';
    const titleInput = document.createElement('input');
    titleInput.type = 'text';
    titleInput.className = 'training-title';
    titleInput.placeholder = 'Enter training/certification title';

    // Institution/Organization
    const institutionLabel = document.createElement('label');
    institutionLabel.textContent = 'Institution/Organization';
    const institutionInput = document.createElement('input');
    institutionInput.type = 'text';
    institutionInput.className = 'training-institution';
    institutionInput.placeholder = 'Enter institution/organization name';

    // Completion Date
    const dateLabel = document.createElement('label');
    dateLabel.textContent = 'Completion Date';
    const dateInput = document.createElement('input');
    dateInput.type = 'month';
    dateInput.className = 'training-date';

    // Description
    const descriptionLabel = document.createElement('label');
    descriptionLabel.textContent = 'Description';
    const descriptionInput = document.createElement('textarea');
    descriptionInput.className = 'training-description';
    descriptionInput.placeholder =
        'Mention briefly what sorts of noteworthy tasks you performed during this training/certification.';

    // Delete Button
    const deleteBtn = document.createElement('button');
    deleteBtn.type = 'button';
    deleteBtn.className = 'delete-training-btn';
    deleteBtn.textContent = 'Delete';
    deleteBtn.addEventListener('click', () => {
        trainingsContainer.removeChild(trainingRow);
    });

    // Append elements to training row
    trainingRow.appendChild(titleLabel);
    trainingRow.appendChild(titleInput);
    trainingRow.appendChild(institutionLabel);
    trainingRow.appendChild(institutionInput);
    trainingRow.appendChild(dateLabel);
    trainingRow.appendChild(dateInput);
    trainingRow.appendChild(descriptionLabel);
    trainingRow.appendChild(descriptionInput);
    trainingRow.appendChild(deleteBtn);

    return trainingRow;
}

// Event listener for adding new training rows
addTrainingBtn.addEventListener('click', () => {
    const newTrainingRow = createTrainingRow();
    trainingsContainer.insertBefore(
        newTrainingRow,
        addTrainingBtn // Add before the +Add button
    );
});
