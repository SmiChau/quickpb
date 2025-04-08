document.addEventListener("DOMContentLoaded", function () {
    fetchAchievements();
});

function fetchAchievements() {
    fetch("fetch_achievement.php")
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Achievements:", data);

            if (Object.keys(data).length > 0) {
                document.getElementById("achievement-title").value = data.title || "";
                document.getElementById("achievement-description").value = data.description || "";

                // Update the preview section
                document.getElementById("achievement-title-preview").textContent = data.title || "";
                document.getElementById("achievement-description-preview").textContent = data.description || "";

                // Show achievement header if there is data
                document.getElementById("achievement-header").style.display = "block";
            } else {
                // Hide achievement section if there's no data
                document.getElementById("achievement-header").style.display = "none";
            }
        })
        .catch(error => console.error("Error:", error));
}
