document.addEventListener('DOMContentLoaded', () => {
    // Function to add a new skill row
    function addSkill() {
        const container = document.getElementById("skill-container");
        const newRow = document.createElement("div");
        newRow.classList.add("skill-row");

        newRow.innerHTML = `
            <div class="form-group">
                <label for="skill-input"></label>
                <input type="text" class="skill-input" placeholder="Enter skill">
            </div>
            <div class="form-group">
                <label>Level</label>
                <div class="skill-level">
                    <span class="level" data-level="1"></span>
                    <span class="level" data-level="2"></span>
                    <span class="level" data-level="3"></span>
                    <span class="level" data-level="4"></span>
                    <span class="level" data-level="5"></span>
                </div>
            </div>
            <button type="button" class="delete-skill-btn">Delete</button>
        `;

        container.appendChild(newRow);
    }

    // Function to remove a skill row
    function removeSkill(button) {
        button.parentNode.remove();
        updateSkillPreview();
    }

    // Function to update the preview
    function updateSkillPreview() {
        const previewList = document.getElementById("skills-list");
        previewList.innerHTML = ""; // Clear the preview
        const skillRows = document.querySelectorAll("#skill-container .skill-row");

        skillRows.forEach((row) => {
            const skill = row.querySelector(".skill-input").value.trim(); // Trim whitespace
            if (!skill) return; // Skip empty inputs

            const selectedLevels = row.querySelectorAll(".level.selected");
            const levelCount = selectedLevels.length;

            const previewEntry = document.createElement("div");
            previewEntry.classList.add("skill-entry-preview");

            // Skill name
            const skillSpan = document.createElement("span");
            skillSpan.classList.add("skill-name-preview");
            skillSpan.textContent = skill;

            // Level indicators
            const levelSpan = document.createElement("span");
            levelSpan.classList.add("skill-level-preview");
            for (let i = 1; i <= 5; i++) {
                const levelDot = document.createElement("span");
                levelDot.classList.add("level");
                if (i <= levelCount) {
                    levelDot.classList.add("selected");
                }
                levelSpan.appendChild(levelDot);
            }

            previewEntry.appendChild(skillSpan);
            previewEntry.appendChild(levelSpan);
            previewList.appendChild(previewEntry);
        });
    }

    // Function to handle level selection
    function selectLevel(element) {
        const parent = element.parentNode;
        const levels = parent.querySelectorAll(".level");
        const selectedLevel = parseInt(element.dataset.level);

        levels.forEach((lvl) => {
            const levelValue = parseInt(lvl.dataset.level);
            if (levelValue <= selectedLevel) {
                lvl.classList.add("selected");
            } else {
                lvl.classList.remove("selected");
            }
        });
        updateSkillPreview();
    }

    // Event delegation for dynamic elements
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('level')) {
            selectLevel(e.target);
        }
        if (e.target.classList.contains('delete-skill-btn')) {
            removeSkill(e.target);
        }
    });

    document.addEventListener('input', (e) => {
        if (e.target.classList.contains('skill-input')) {
            updateSkillPreview();
        }
    });

    document.getElementById("add-skill-btn").addEventListener("click", addSkill);
});