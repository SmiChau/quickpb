document.querySelectorAll('.nav-link').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1); // Get the target section ID
        const targetElement = document.getElementById(targetId);
        
        // Scroll to the section with an offset for the header height
        window.scrollTo({
            top: targetElement.offsetTop - 80, // Adjust 80px to your header height
            behavior: 'smooth'
        });
    });
});

//Show active menu when scrolling
const highlightMenu = () => {
    const sections = document.querySelectorAll('section'); // All sections
    const navLinks = document.querySelectorAll('.nav-link'); // Menu links

    let scrollPos = window.scrollY + window.innerHeight / 2; // Midpoint of the viewport

    // Loop through sections to check which one is active
    sections.forEach((section, index) => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;

        if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
            navLinks.forEach(link => link.classList.remove('highlight')); // Remove from all
            navLinks[index].classList.add('highlight'); // Add to active link
        }
    });
};

// Attach the function to scroll and click events
window.addEventListener('scroll', highlightMenu);
window.addEventListener('click', highlightMenu);

//setting cookie
function setCookie(name, value) {
    document.cookie = name + "=" + value + ";path=/"; // Set the cookie
}

//getting cookie
function getCookie(name) {
    const cookies = document.cookie.split('; '); // Split cookies into an array
    for (let cookie of cookies) {
        const [key, value] = cookie.split('='); // Split each cookie into key and value
        if (key === name) {
            return value; // Return the value if the key matches
        }
    }
    return null; // Return null if the cookie is not found
}

function logout(){
    setCookie('activeStatus','off');
    alert("Loggedout sucessfully");
    window.location.href = 'http://localhost/quickpb/mainfolder/homepage/homepage.php';
}