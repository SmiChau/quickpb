document.getElementById("save-skill-btn").addEventListener("click", function () {
    const skills = [];
    document.querySelectorAll("#skill-container .skill-row").forEach(row => {
        const skillName = row.querySelector(".skill-input").value.trim();
        const selectedLevels = row.querySelectorAll(".level.selected").length;

        if (skillName) {
            skills.push({ name: skillName, level: selectedLevels });
        }
    });

    if (skills.length > 0) {
        fetch("save_skill.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" }, // Fix content type
            body: JSON.stringify({ skills }) // Send correct JSON format
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                loadSkills(); // Refresh preview
            } else {
                console.error("Error saving skills:", data.message);
            }
        })
        .catch(error => console.error("Fetch error:", error));
    }
});

// Load skills immediately after saving
function loadSkills() {
    fetch("fetch_skill.php")
        .then(response => response.json())
        .then(skills => {
            const previewList = document.getElementById("skills-list");
            previewList.innerHTML = ""; // Clear previous preview

            skills.forEach(skill => {
                const previewEntry = document.createElement("div");
                previewEntry.classList.add("skill-entry-preview");

                const skillSpan = document.createElement("span");
                skillSpan.textContent = skill.skill_name;

                const levelSpan = document.createElement("span");
                levelSpan.innerHTML = "★".repeat(skill.skill_level);

                previewEntry.appendChild(skillSpan);
                previewEntry.appendChild(levelSpan);
                previewList.appendChild(previewEntry);
            });
        })
        .catch(error => console.error("Fetch error:", error));
}

// Automatically load skills on page load
document.addEventListener("DOMContentLoaded", loadSkills);
