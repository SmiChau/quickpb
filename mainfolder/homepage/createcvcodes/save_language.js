document.getElementById("save-language-btn").addEventListener("click", function () {
    const languages = [];
    document.querySelectorAll("#language-container .language-row").forEach(row => {
        const languageName = row.querySelector(".language-input").value.trim();
        const selectedLevels = row.querySelectorAll(".level.selected").length;

        if (languageName) {
            languages.push({ name: languageName, level: selectedLevels });
        }
    });

    if (languages.length > 0) {
        fetch("save_language.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `languages=${JSON.stringify(languages)}`
        }).then(response => response.json())
          .then(() => {
              loadLanguages(); // Refresh preview
          });
    }
});
