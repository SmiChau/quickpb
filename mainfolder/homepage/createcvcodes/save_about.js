document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("save-form").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission
        
        let formData = new FormData(this);

        fetch("save_about.php", {
            method: "POST",
            body: formData
        }).then(response => {
            console.log("Data saved successfully!");
        }).catch(error => {
            console.error("Error saving data:", error);
        });
    });
});
