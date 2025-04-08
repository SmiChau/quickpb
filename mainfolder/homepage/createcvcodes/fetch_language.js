document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_language.php")
        .then(response => response.json())
        .then(languages => {
            const container = document.getElementById("language-container");
            const previewList = document.getElementById("languages-list");
            const languagesHeader = document.getElementById("languages-header"); // Header for languages

            container.innerHTML = "";  // Clear existing fields
            previewList.innerHTML = "";  

            if (languages.length > 0) {
                languagesHeader.style.display = "block";  // Show header if data exists
            } else {
                languagesHeader.style.display = "none";  // Hide header if no data
            }

            languages.forEach(language => {
                const newRow = document.createElement("div");
                newRow.classList.add("language-row");

                newRow.innerHTML = `
                    <div class="form-group">
                        <input type="text" class="language-input" value="${language.language_name}">
                    </div>
                    <div class="form-group">
                        <div class="language-level">
                            ${[1, 2, 3, 4, 5].map(level =>
                                `<span class="level ${level <= language.language_level ? "selected" : ""}" 
                                data-level="${level}" onclick="selectLevel(this)"></span>`
                            ).join("")}
                        </div>
                    </div>
                    <button type="button" class="delete-language-btn" onclick="removeLanguage(this)">Delete</button>
                `;
                container.appendChild(newRow);

                // Add to preview
                const previewEntry = document.createElement("div");
                previewEntry.classList.add("language-entry-preview");

                const languageSpan = document.createElement("span");
                languageSpan.classList.add("language-name-preview");
                languageSpan.textContent = language.language_name;

                const levelSpan = document.createElement("span");
                levelSpan.classList.add("language-level-preview");

                // Display colored stars or dots for levels
                for (let i = 1; i <= 5; i++) {
                    const levelDot = document.createElement("span");
                    levelDot.classList.add("level-dot");
                    if (i <= language.language_level) {
                        levelDot.classList.add("filled"); // Apply color
                    }
                    levelSpan.appendChild(levelDot);
                }

                previewEntry.appendChild(languageSpan);
                previewEntry.appendChild(levelSpan);
                previewList.appendChild(previewEntry);
            });
        });
});
