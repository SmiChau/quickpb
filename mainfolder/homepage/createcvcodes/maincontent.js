// Get references to key elements
const templatesLink = document.getElementById('template-link'); // Updated to match your HTML
const sidebarTwo = document.querySelector('.sidebartwo');
const templates = document.querySelectorAll('.template');
const mainPreview = document.getElementById('main-preview');

// Show Sidebar Two when "Templates" link is clicked
templatesLink.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent anchor default behavior
    sidebarTwo.style.display = 'block'; // Show Sidebar Two
});

// Add click event listeners to all template images
templates.forEach((template) => {
    template.addEventListener('click', () => {
        const templateImage = template.getAttribute('data-template');
        mainPreview.src = templateImage; // Update the main preview
    });
});


//to make the edit fot the specific template
const templatePreview = document.getElementById('template-preview'); // The main preview container

templates.forEach((template) => {
    template.addEventListener('click', () => {
        // Remove any existing template-specific classes (e.g., template1, template2)
        templatePreview.classList.remove('template1', 'template2', 'template3', 'template4', 'template5', 'template6');
        
        // Add the selected template's class
        const templateId = template.getAttribute('data-template-id'); // Get template ID (e.g., template1)
        templatePreview.classList.add(templateId);
    });
});

function displayC(){
    document.getElementById("contactDisplay").style.display = "block";
    document.getElementById("icon1").style.display = "block";
}
function displayicon2(){
    document.getElementById("icon2").style.display = "block";
}
function displayicon3(){
    document.getElementById("icon3").style.display = "block";
}
function displayeducation(){
    document.getElementById("education-header").style.display = "block";
}
function displayexperience(){
    document.getElementById("experience-header").style.display = "block";
}
function displayachievement(){
    document.getElementById("achievement-header").style.display = "block";
}
function displayskills(){
    document.getElementById("skills-header").style.display = "block";
}
function displaylanguage(){
    document.getElementById("languages-header").style.display = "block";
}
function displayreferences(){
    document.getElementById("references-header").style.display = "block";
}
function displayaboutme(){
    document.getElementById("aboutme").style.display = "block";
}