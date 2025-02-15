// Download as PDF
document.getElementById('download-pdf').addEventListener('click', () => {
    const contentToDownload = document.getElementById('template-preview'); // Container for image and content
    const options = {
      margin: 0,
      filename: 'cv.pdf', // Set the filename of the PDF
      image: { type: 'jpeg', quality: 2.0 }, // Set the image quality for the PDF
      html2canvas: { 
        scale: 3, // Increase canvas scale for better resolution
        useCORS: true, // Allow cross-origin images
        logging: true, // Enable logging for debugging
        allowTaint: true, // Allow tainted images
      },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' } // Set A4 paper size
    };
  
    // Use html2canvas to capture the combined image and content
    html2canvas(contentToDownload, options.html2canvas)
      .then((canvas) => {
        // Convert the canvas to an image
        const imgData = canvas.toDataURL('image/jpeg', 1.0);
  
        // Create a new PDF
        const pdf = new jsPDF(options.jsPDF);
  
        // Add the image to the PDF
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
        pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
  
        // Save the PDF
        pdf.save(options.filename);
      })
      .catch((error) => {
        console.error('Error generating PDF:', error); // Log any errors
      });
  });