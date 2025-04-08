document.addEventListener('DOMContentLoaded', () => {
    // Function to add a new language row
    function addLanguage() {
        const container = document.getElementById("language-container");
        const newRow = document.createElement("div");
        newRow.classList.add("language-row");

        newRow.innerHTML = `
            <div class="form-group">
                <label for="language-input"></label>
                <input type="text" class="language-input" placeholder="Enter language">
            </div>
            <div class="form-group">
                <label>Level</label>
                <div class="language-level">
                    <span class="level" data-level="1"></span>
                    <span class="level" data-level="2"></span>
                    <span class="level" data-level="3"></span>
                    <span class="level" data-level="4"></span>
                    <span class="level" data-level="5"></span>
                </div>
            </div>
            <button type="button" class="delete-language-btn">Delete</button>
        `;

        container.appendChild(newRow);
        attachEventListeners(newRow); // Attach event listeners for the new row
    }

    // Function to remove a language row
    function removeLanguage(button) {
        button.parentNode.remove();
        updateLanguagePreview();
    }

    // Function to update the preview in Sidebar Three
    function updateLanguagePreview() {
        const previewList = document.getElementById("languages-list");
        previewList.innerHTML = ""; // Clear the preview
        const languageRows = document.querySelectorAll("#language-container .language-row");

        languageRows.forEach((row) => {
            const language = row.querySelector(".language-input").value.trim(); // Trim whitespace
            if (!language) return; // Skip empty inputs

            const selectedLevels = row.querySelectorAll(".level.selected");
            const levelCount = selectedLevels.length;

            const previewEntry = document.createElement("div");
            previewEntry.classList.add("language-entry-preview");

            // Create language name span
            const languageSpan = document.createElement("span");
            languageSpan.classList.add("language-name-preview");
            languageSpan.textContent = language;

            // Create level indicator span
            const levelSpan = document.createElement("span");
            levelSpan.classList.add("language-level-preview");

            // Generate level indicators
            for (let i = 1; i <= 5; i++) {
                const levelDot = document.createElement("span");
                levelDot.classList.add("level");
                if (i <= levelCount) {
                    levelDot.classList.add("selected"); // Highlight selected levels
                }
                levelSpan.appendChild(levelDot);
            }

            previewEntry.appendChild(languageSpan);
            previewEntry.appendChild(levelSpan);

            // Add the entry to the preview list
            previewList.appendChild(previewEntry);
        });
    }

    // Function to handle level selection
    function selectLevel(element) {
        const parent = element.parentNode;
        const levels = parent.querySelectorAll(".level");
        const selectedLevel = parseInt(element.dataset.level);

        // Highlight all levels up to the selected level
        levels.forEach((lvl) => {
            const levelValue = parseInt(lvl.dataset.level);
            if (levelValue <= selectedLevel) {
                lvl.classList.add("selected");
            } else {
                lvl.classList.remove("selected");
            }
        });
        updateLanguagePreview();
    }

    // Attach event listeners to dynamic elements
    function attachEventListeners(row) {
        const input = row.querySelector(".language-input");
        input.addEventListener("input", updateLanguagePreview);

        const levels = row.querySelectorAll(".level");
        levels.forEach((level) =>
            level.addEventListener("click", () => selectLevel(level))
        );

        const deleteBtn = row.querySelector(".delete-language-btn");
        deleteBtn.addEventListener("click", () => removeLanguage(deleteBtn));
    }

    // Event listener for adding a new language row
    document.getElementById("add-language-btn").addEventListener("click", addLanguage);

    // Attach listeners to existing rows if any (e.g., preloaded data)
    document.querySelectorAll("#language-container .language-row").forEach(attachEventListeners);
});