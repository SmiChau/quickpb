document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_about.php")
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Data:", data); // Log the entire data object
            if (data.status !== "error") {
                // Populate form fields
                const firstNameInput = document.getElementById("first-name");
                const lastNameInput = document.getElementById("last-name");
                const designationInput = document.getElementById("designation");
                const phoneInput = document.getElementById("phone");
                const emailInput = document.getElementById("email");
                const addressInput = document.getElementById("address");
                const cityInput = document.getElementById("city");
                const summaryInput = document.getElementById("summary");

                firstNameInput.value = data.first_name || "";
                lastNameInput.value = data.last_name || "";
                designationInput.value = data.designation || "";
                phoneInput.value = data.phone || "";
                emailInput.value = data.email || "";
                addressInput.value = data.address || "";
                cityInput.value = data.city || "";
                summaryInput.value = data.summary || "";

                // Update preview placeholders
                const namePreview = document.getElementById("name-preview");
                const lastnamePreview = document.getElementById("lastname-preview");
                const fullnamePreview = document.getElementById("fullname-preview");
                const designationPreview = document.getElementById("designation-preview");
                const phonePreview = document.getElementById("phone-preview");
                const emailPreview = document.getElementById("email-preview");
                const addressPreview = document.getElementById("address-preview");
                const cityPreview = document.getElementById("city-preview");
                const summaryPreview = document.getElementById("summary-preview");

                namePreview.textContent = data.first_name || "";
                lastnamePreview.textContent = data.last_name || "";
                fullnamePreview.textContent = `${data.first_name} ${data.last_name}`.trim();
                designationPreview.textContent = data.designation || "";
                phonePreview.textContent = data.phone || "";
                emailPreview.textContent = data.email || "";
                summaryPreview.textContent = data.summary || "";

                // Combine address and city for the address-preview
                addressPreview.textContent = `${data.address || ""}${data.address && data.city ? ", " : ""}${data.city || ""}`;

                // Update profile photo if available
                if (data.profile_photo) {
                    document.getElementById("photo-preview").src = data.profile_photo;
                }

                // Show/hide "Contact" header and icons based on data
                const contactDisplay = document.getElementById("contactDisplay");
                const icon1 = document.getElementById("icon1");
                const icon2 = document.getElementById("icon2");
                const icon3 = document.getElementById("icon3");

                if (data.phone || data.email || data.address || data.city) {
                    contactDisplay.style.display = "block"; // Show "Contact" header
                } else {
                    contactDisplay.style.display = "none"; // Hide "Contact" header
                }

                if (data.phone) {
                    icon1.style.display = "inline-block"; // Show phone icon
                } else {
                    icon1.style.display = "none"; // Hide phone icon
                }

                if (data.email) {
                    icon2.style.display = "inline-block"; // Show email icon
                } else {
                    icon2.style.display = "none"; // Hide email icon
                }

                if (data.address || data.city) {
                    icon3.style.display = "inline-block"; // Show address icon
                } else {
                    icon3.style.display = "none"; // Hide address icon
                }
            } else {
                console.error("Error fetching data:", data.message);
            }
        })
        .catch(error => console.error("Error:", error));
});