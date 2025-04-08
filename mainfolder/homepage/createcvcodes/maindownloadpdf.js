// Ripple effect for download button
let buttons = document.querySelectorAll(".button"); // Modify selector if needed
for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", (e) => {
        e.preventDefault();  // Prevent default behavior

        let overlay = document.createElement('span');  // Create overlay span for ripple effect
        overlay.classList.add("overlay");

        // Position the overlay based on the click coordinates
        let x = e.clientX - e.target.offsetLeft;
        let y = e.clientY - e.target.offsetTop;

        overlay.style.left = x + "px";
        overlay.style.top = y + "px"; // Corrected the second line to set the y-coordinate

        e.target.appendChild(overlay);  // Append overlay to the clicked button

        setTimeout(() => {
            overlay.remove();  // Remove the overlay after 500ms
        }, 500);        
        console.log(e);
    });
}

// Download sidebar-three as PDF
document.getElementById('download-pdf').addEventListener('click', () => {
    
    const sidebar = document.querySelector('.sidebar-three');  // Select sidebar-three to download
    const options = {
        margin: 0,
        filename: 'cv.pdf',  // Set the filename of the PDF
        image: { type: 'jpeg', quality: 2.0 },  // Set the image quality for the PDF
        html2canvas: { scale: 3 },  // Increase canvas scale for better resolution
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }  // Set A4 paper size
    };

    html2pdf()
        .set(options)
        .from(sidebar)  // Generate PDF from sidebar-three
        .save()  // Save the PDF
        .then(() => {
            // Once the download is complete, show the photo upload sections again
            photoUpload.style.display = 'block';
            photoUploadlabel.style.display = 'block';
        })
        .catch((error) => {
            console.error('Error generating PDF:', error);  // Log any errors
        });
});