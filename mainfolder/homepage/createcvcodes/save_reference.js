document.getElementById("save-reference").addEventListener("click", function () {
    const formData = new FormData(document.getElementById("reference-form"));

    fetch("save_reference.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert("Reference saved successfully!");
        } else {
            console.error("Error:", data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});
