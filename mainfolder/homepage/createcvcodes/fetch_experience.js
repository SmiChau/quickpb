document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_experience.php")
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Data:", data); // Log the entire data object

            // Check if there is experience data
            if (data.status !== "error") {
                // Populate form fields
                const jobTitleInput = document.getElementById("job-title");
                const employerInput = document.getElementById("employer");
                const locationInput = document.getElementById("location");
                const startDateInput = document.getElementById("started-date");
                const endDateInput = document.getElementById("end-date");
                const descriptionInput = document.getElementById("descriptions");

                jobTitleInput.value = data.job_title || "";
                employerInput.value = data.employer || "";
                locationInput.value = data.location || "";
                startDateInput.value = data.start_date || "";
                endDateInput.value = data.end_date || "";
                descriptionInput.value = data.description || "";

                // Update preview placeholders
                const jobTitlePreview = document.getElementById("job-title-preview");
                const companyPreview = document.getElementById("company-preview");
                const cityPreview = document.getElementById("experience-city-preview");
                const datesPreview = document.getElementById("experience-dates-preview");
                const descriptionPreview = document.getElementById("experience-description-preview");

                jobTitlePreview.textContent = data.job_title || "";
                companyPreview.textContent = data.employer || "";
                cityPreview.textContent = data.location || "";
                datesPreview.textContent = data.start_date && data.end_date 
                    ? `(${data.start_date} - ${data.end_date})` 
                    : 'Start Date - End Date';
                descriptionPreview.textContent = data.description || "";

                // Show Experience header if there is data
                const experienceHeader = document.getElementById("experience-header");
                if (data.job_title || data.employer || data.location || data.start_date || data.end_date || data.description) {
                    experienceHeader.style.display = "block";
                } else {
                    experienceHeader.style.display = "none";
                }
            } else {
                console.error("Error fetching data:", data.message);
            }
        })
        .catch(error => console.error("Error:", error));
});
