document.getElementById('download').addEventListener('click', () => {
    const photoUpload = document.getElementById("photoUpload");
    const photoUploadlabel = document.getElementById('photoUploadlabel');

    // Hide unnecessary elements
    photoUpload.style.display = 'none';
    photoUploadlabel.style.display = 'none';

    const resume = document.querySelector('.resume-container');
    const options = {
        margin: [0, 0, 0, 0],
        filename: 'cv.pdf',
        image: { type: 'jpeg', quality: 1.0 },
        html2canvas: {
            scale: 2,
            scrollX: 0,
            scrollY: 0,
            windowWidth: document.documentElement.offsetWidth,
        },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf()
        .set(options)
        .from(resume)
        .save()
        .then(() => {
            // Restore hidden elements after saving
            photoUpload.style.display = 'block';
            photoUploadlabel.style.display = 'block';
        });
});
