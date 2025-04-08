document.addEventListener('DOMContentLoaded', () => {
    // Function to add a new reference row
    function addReferenceRow() {
        const referenceContainer = document.getElementById("reference-container");
        const newRow = document.createElement("div");
        newRow.classList.add("reference-row");

        newRow.innerHTML = `
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" class="first-name" placeholder="Enter First Name">
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" class="last-name" placeholder="Enter Last Name">
            </div>
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" class="company" placeholder="Enter Company">
            </div>
            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" class="designation" placeholder="Enter Designation">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="phone" placeholder="Enter Phone Number">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="email" placeholder="Enter Email">
            </div>
            <button type="button" class="delete-reference-btn">Delete</button>
        `;

        referenceContainer.appendChild(newRow);
        attachEventListeners(newRow); // Attach event listeners for the new row
    }

    // Function to remove a reference row
    function removeReferenceRow(button) {
        button.parentNode.remove();
        updateReferencePreview();
    }

    // Function to update the reference preview in Sidebar Three
    function updateReferencePreview() {
        const previewContainer = document.getElementById("references-preview");
        previewContainer.innerHTML = ""; // Clear existing preview content

        const referenceRows = document.querySelectorAll("#reference-container .reference-row");

        referenceRows.forEach((row) => {
            const firstName = row.querySelector(".first-name").value.trim();
            const lastName = row.querySelector(".last-name").value.trim();
            const company = row.querySelector(".company").value.trim();
            const designation = row.querySelector(".designation").value.trim();
            const phone = row.querySelector(".phone").value.trim();
            const email = row.querySelector(".email").value.trim();

            // Skip empty references
            if (!firstName && !lastName && !company && !designation && !phone && !email) {
                return;
            }

            // Create and append the preview element
            const referencePreview = document.createElement("div");
            referencePreview.classList.add("reference-entry-preview");
            referencePreview.innerHTML = `
                <div><strong>${firstName} ${lastName}</strong></div>
                <div>${company} / ${designation}</div>
                <div>${phone}<br>${email}</div>
            `;
            previewContainer.appendChild(referencePreview);
        });
    }

    // Attach event listeners to dynamic elements
    function attachEventListeners(row) {
        const inputs = row.querySelectorAll("input");
        inputs.forEach((input) => {
            input.addEventListener("input", updateReferencePreview);
        });

        const deleteBtn = row.querySelector(".delete-reference-btn");
        deleteBtn.addEventListener("click", () => removeReferenceRow(deleteBtn));
    }

    // Event listener for adding a new reference row
    document.getElementById("add-reference-btn").addEventListener("click", addReferenceRow);

    // Attach listeners to existing rows if any (e.g., preloaded data)
    document.querySelectorAll("#reference-container .reference-row").forEach(attachEventListeners);
});