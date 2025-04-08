document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_skill.php")
        .then(response => response.json())
        .then(skills => {
            const container = document.getElementById("skill-container");
            const previewList = document.getElementById("skills-list");
            const skillsHeader = document.getElementById("skills-header"); // The header

            container.innerHTML = "";  // Clear existing fields
            previewList.innerHTML = "";  

            if (skills.length > 0) {
                skillsHeader.style.display = "block";  // Show header if there are skills
            } else {
                skillsHeader.style.display = "none";  // Hide header if no skills
            }

            skills.forEach(skill => {
                const newRow = document.createElement("div");
                newRow.classList.add("skill-row");

                newRow.innerHTML = `
                    <div class="form-group">
                        <input type="text" class="skill-input" value="${skill.skill_name}">
                    </div>
                    <div class="form-group">
                        <div class="skill-level">
                            ${[1, 2, 3, 4, 5].map(level =>
                                `<span class="level ${level <= skill.skill_level ? "selected" : ""}" 
                                data-level="${level}" onclick="selectLevel(this)"></span>`
                            ).join("")}
                        </div>
                    </div>
                    <button type="button" class="delete-skill-btn" onclick="removeSkill(this)">Delete</button>
                `;
                container.appendChild(newRow);

                // Add to preview
                const previewEntry = document.createElement("div");
                previewEntry.classList.add("skill-entry-preview");

                const skillSpan = document.createElement("span");
                skillSpan.classList.add("skill-name-preview");
                skillSpan.textContent = skill.skill_name;

                const levelSpan = document.createElement("span");
                levelSpan.classList.add("skill-level-preview");

                // Display colored stars or dots for levels
                for (let i = 1; i <= 5; i++) {
                    const levelDot = document.createElement("span");
                    levelDot.classList.add("level-dot");
                    if (i <= skill.skill_level) {
                        levelDot.classList.add("filled"); // Apply color
                    }
                    levelSpan.appendChild(levelDot);
                }

                previewEntry.appendChild(skillSpan);
                previewEntry.appendChild(levelSpan);
                previewList.appendChild(previewEntry);
            });
        });
});
