document.addEventListener("DOMContentLoaded", function () {
    fetchAchievements(); // Fetch achievements on page load

    document.getElementById("save-achievement").addEventListener("click", function () {
        const title = document.getElementById("achievement-title").value.trim();
        const description = document.getElementById("achievement-description").value.trim();

        if (title === "" || description === "") {
            return; // Do nothing if fields are empty
        }

        fetch("save_achievement.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `title=${encodeURIComponent(title)}&description=${encodeURIComponent(description)}`
        })
        .then(() => fetchAchievements()); // Refresh achievements after saving
    });
});
