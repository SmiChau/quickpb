document.addEventListener("DOMContentLoaded", function () {
    fetchReference(); // Fetch saved data when page loads

    // Add event listeners to update preview in real-time
    document.querySelectorAll("#reference-section input").forEach(input => {
        input.addEventListener("input", () => {
            updateReferencePreview();
        });
    });
});

function fetchReference() {
    fetch("fetch_reference.php")
        .then(response => response.json())
        .then(data => {
            if (data.status === "success" && data.data) {
                document.getElementById("first-name").value = data.data.first_name || "";
                document.getElementById("last-name").value = data.data.last_name || "";
                document.getElementById("company").value = data.data.company || "";
                document.getElementById("designation").value = data.data.designation || "";
                document.getElementById("phone").value = data.data.phone || "";
                document.getElementById("email").value = data.data.email || "";

                // Update preview with fetched data
                updateReferencePreview();

                // Show header if there is data
                document.getElementById("references-header").style.display = "block";
            } else {
                // Hide reference header if no data exists
                document.getElementById("references-header").style.display = "none";
            }
        })
        .catch(error => console.error("Error fetching reference:", error));
}

function updateReferencePreview() {
    const firstName = document.getElementById("first-name").value.trim();
    const lastName = document.getElementById("last-name").value.trim();
    const company = document.getElementById("company").value.trim();
    const designation = document.getElementById("designation").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const email = document.getElementById("email").value.trim();

    // Dynamically update the preview
    document.getElementById("references-preview").innerHTML = `
        <div class="reference-field">${firstName} ${lastName}</div>
        <div class="reference-field">${company}</div>
        <div class="reference-field">${designation}</div>
        <div class="reference-field">${phone}</div>
        <div class="reference-field">${email}</div>
    `;
}
