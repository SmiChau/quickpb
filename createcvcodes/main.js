// Select all sidebar links and the respective sections
const links = document.querySelectorAll('.nav-menu .nav-item a'); // All sidebar links
const sections = document.querySelectorAll('section'); // All sections

// Function to handle section visibility
function showSection(linkId) {
    sections.forEach((section) => {
        // Show the section corresponding to the clicked link, hide others
        if (section.id === linkId.replace('-link', '-section')) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
}

// Add click event listeners to all sidebar links
links.forEach((link) => {
    link.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default anchor behavior
        showSection(link.id); // Call the function with the clicked link's ID
    });
});

// Initialize by showing the first section (optional)
showSection('template-link'); // Default to "Templates" on page load

