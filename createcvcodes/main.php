<?php
include('connect.php'); // Include database connection
session_start();
if(!isset($_SESSION['loggedin'])){
    header("Location: http://localhost/quickpb/mainfolder/homepage/login.php");
}

// Fetch templates from the database
$query = "SELECT * FROM templates";
$result = $conn->query($query);

// Fetch the first template to set as default
$first_template = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="maintemplate1.css">
    <link rel="stylesheet" href="maintemplate2.css">
    <link rel="stylesheet" href="maintemplate3.css">
    <link rel="stylesheet" href="maintemplate4.css">
    <link rel="stylesheet" href="maintemplate5.css">
    <link rel="stylesheet" href="maintemplate6.css">
</head>
<body>
    <header>
        <nav>
        <img src="logo.png" alt="">
    </nav>
    </header>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><i class='bx bx-layer'></i><a href="#template-section" id="template-link">Templates</a></li>
                    <li class="nav-item"><i class='bx bx-user' ></i><a href="#about-section" id="about-link">About</a></li>
                    <li class="nav-item"><i class='bx bxs-graduation'></i><a href="#education-section" id="education-link">Education</a></li>
                    <li class="nav-item"><i class='bx bx-briefcase'></i><a href="#experience-section" id="experience-link">Experience</a></li>
                    <li class="nav-item"><i class='bx bx-trophy' ></i><a href="#achievements-section" id="achievements-link">Achievements</a></li>
                    
                    <li class="nav-item"><i class='bx bx-bulb' ></i><a href="#skills-section" id="skills-link">Skills</a></li>
                    
                    <li class="nav-item"><i class="fa-solid fa-language"></i><a href="#language-section" id="language-link">Language</a></li>
                    <li class="nav-item"><i class='bx bx-user-check' ></i><a href="#reference-section" id="reference-link">Reference</a></li>
                    <li class="nav-item"><i class='bx bx-download'></i><a href="#download-section" id="download-link">Download</a></li>
                </ul>
            </nav>
        </div>
         
        
        <div class="sidebartwo">
    <!-- Template section -->
    <section id="template-section">
    <h1>Select Template</h1>
    <div class="template-gallery">
        <?php
        $result->data_seek(0); // Reset result pointer for loop
        $templateCounter = 1; // Initialize a counter for template numbering
        while ($row = $result->fetch_assoc()) {
            $previewPath = "uploads/previews/" . $row['preview'];
            $thumbnailPath = "uploads/thumbnails/" . $row['thumbnail'];
            $templateName = htmlspecialchars($row['name']);
        ?>
            <div class="template-card template<?php echo $templateCounter; ?>" 
                 data-preview="<?php echo file_exists($previewPath) ? $previewPath : 'uploads/previews/default-template.png'; ?>"
                 data-template-class="template<?php echo $templateCounter; ?>"> <!-- Use the counter for template class -->
                <img src="<?php echo file_exists($thumbnailPath) ? $thumbnailPath : 'uploads/thumbnails/default-thumbnail.png'; ?>" 
                     alt="<?php echo $templateName; ?>">
                <p><?php echo $templateName; ?></p>
            </div>
        <?php
            $templateCounter++; // Increment the counter for the next template
        } ?>
    </div>
</section>
            
 <!-- About Section -->
  <section id="about-section">
 <form action="save_about.php" method="POST" enctype="multipart/form-data" id="save-form">
    <!-- Profile Photo -->
    <div class="profile-photo">
        <img src="default-profile.png" alt="Profile Photo" id="profile-img">
        <div class="photo-actions">
            <input type="file" id="file-input" name="profile_photo" accept="image/*" style="display: none;">
            <button type="button" id="upload-btn">Update Photo</button>
            <button type="button" id="delete-btn">Delete</button>
        </div>
    </div>

    <!-- Primary Info -->
    <div id="full-name">
        <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="first_name" placeholder="Enter first name">
        </div>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="last_name" placeholder="Enter last name">
        </div>
    </div>
    <div class="form-group">
        <label for="designation">Designation</label>
        <input type="text" id="designation" name="designation" placeholder="Enter designation">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter phone number" oninput="displayC()">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter email"  oninput="displayicon2()">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" placeholder="Enter address"  oninput="displayicon3()">
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" name="city" placeholder="Enter city">
    </div>
    <div class="form-group">
        <label for="summary">Summary</label>
        <textarea id="summary" name="summary" placeholder="How would you describe yourself?" oninput="displayaboutme()" rows="5"></textarea>
    </div>
    <button type="submit" id="save-btn">Save</button>
</form>
</section>
        <!-- education-section -->
        <section id="education-section">
            <h3>Education</h3>
            <div id="education-entries-container">
            <div class="education-entry">
                <label for="degree">Degree</label>
                <input type="text" id="degree" placeholder="Enter your degree" oninput="displayeducation()">
        
                <label for="school">School/Institution</label>
                <input type="text" id="school" placeholder="Enter school name">
        
                <label for="city">City</label>
                <input type="text" id="education-city-input" placeholder="Enter city name">

        
                <div class="date-group">
                    <div>
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date">
                    </div>
                    <div>
                        <label for="graduation-date">Graduation Date</label>
                        <input type="date" id="graduation-date">
                    </div>
                </div>
        
                <label for="description">Description</label>
                <textarea id="description" placeholder="Talk a little bit about your course of study."></textarea>
                <button class="delete-education-btn" style="display:none;">Delete</button>
            </div>
        </div>
            <button type="button" class="add-education-btn">+ Add Education</button>
        </section>
        
             <!-- Work Experience Section -->
             <section id="experience-section">
                <h3>Work Experience</h3>
                <div class="experience-entry">
                    <div class="form-group">
                        <label for="job-title">Job Title</label>
                        <input type="text" id="job-title" placeholder="Enter your job title" oninput="displayexperience()">
                    </div>
                    <div class="experience-row">
                    <div class="form-group">
                        
                        <label for="employer">Employer/Organization</label>
                        <input type="text" id="employer" placeholder="Enter the organization name">
                    </div>
            
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" placeholder="Enter the location">
                    </div>
            
                    <div class="date-group">
                        <div>
                            <label for="start-date">Start Date</label>
                            <input type="date" id="started-date" >
                        </div>
                        <div>
                            <label for="end-date">End Date</label>
                            <input type="date" id="end-date">
                        </div>
                    </div>
                    </div>
            
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="descriptions" placeholder="Mention briefly what sorts of noteworthy tasks you performed at this workplace. Feel free to add your major highlights/achievements as well."></textarea>
                    </div>
                    <button class="delete-experience-btn" style="display:none;">Delete</button>
                </div>
                <button type="button" class="add-experience-btn">+ Add Work Experience</button>
            </section>
            
     
   <!-- Achievements Section in Sidebar Two -->
<section id="achievements-section">
    <h3>Achievements</h3>
    <div id="achievements-container">
        <div class="achievement-row">
            <label for="achievement-title" class="achievement-label">Title</label>
            <input type="text" class="achievement-title" id="achievement-title" placeholder="Include key achievements like awards, recognitions, or milestones." oninput="displayachievement()">
            <label for="achievement-description" class="achievement-label">Description</label>
            <textarea class="achievement-description" id="achievement-description" placeholder="Give a brief insight into how you achieved your milestone." rows="4"></textarea>
        </div>
        <button class="delete-achievement-btn" style="display:none;">Delete</button>
    </div>
    <button type="button" id="add-achievement-btn">+ Add Achievement</button>
</section>

    <!-- Skill section -->
<section id="skills-section">
    <h3>Skills</h3>
    <form>
        <div id="skill-container">
            <!-- Initial Skill Row -->
            <div class="skill-row">
                <div class="form-group">
                    <label for="skill-input">Skill</label>
                    <input type="text" id="skill-input" class="skill-input" placeholder="Enter skill" oninput="displayskills()" oninput="updateSkillPreview()">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <div class="skill-level">
                        <!-- Skill Level Selector -->
                        <span class="level" data-level="1" onclick="selectLevel(this)"></span>
                        <span class="level" data-level="2" onclick="selectLevel(this)"></span>
                        <span class="level" data-level="3" onclick="selectLevel(this)"></span>
                        <span class="level" data-level="4" onclick="selectLevel(this)"></span>
                        <span class="level" data-level="5" onclick="selectLevel(this)"></span>
                    </div>
                </div>
                <button type="button" class="delete-skill-btn" onclick="removeSkill(this)" style="display:none;">Delete</button>
            </div>
        </div>
        <button type="button" id="add-skill-btn" onclick="addSkill()">+ Add Skill</button>
    </form>
</section>

    
   
<!-- Language section -->
<section id="language-section">
    <h3>Languages</h3>
    <form>
        <div id="language-container">
            <!-- Initial Language Row -->
            <div class="language-row">
                <div class="form-group">
                    <label for="language-input">Language</label>
                    <input type="text" id="language-input" class="language-input" placeholder="Enter language" oninput="displaylanguage()" oninput="updateLanguagePreview()">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <div class="language-level">
                        <!-- Language Level Selector -->
                        <span class="level" data-level="1" onclick="selectLevel(this)"></span>
                        <span class="level" data-level="2" onclick="selectLevel(this)"></span>
                        <span class="level" data-level="3" onclick="selectLevel(this)"></span>
                        <span class="level" data-level="4" onclick="selectLevel(this)"></span>
                        <span class="level" data-level="5" onclick="selectLevel(this)"></span>
                    </div>
                </div>
                <button type="button" class="delete-language-btn" onclick="removeLanguage(this)" style="display:none;">Delete</button>
            </div>
        </div>
        <button type="button" id="add-language-btn" onclick="addLanguage()">+ Add Language</button>
    </form>
</section>
<!-- reference section -->

<section id="reference-section">
    <h3>Reference</h3>
    <form>
        <div id="reference-container">
            <!-- Initial Reference Row -->
            <div class="reference-row">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" class="first-name" placeholder="Enter First Name" oninput="displayreferences()">
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" class="last-name" placeholder="Enter Last Name" oninput="updateReferencePreview()">
                </div>
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" id="company" class="company" placeholder="Enter Company" oninput="updateReferencePreview()">
                </div>
                <div class="form-group">
                    <label for="designation">Designation</label>
                    <input type="text" id="designation" class="designation" placeholder="Enter Designation" oninput="updateReferencePreview()">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" class="phone" placeholder="Enter Phone Number" oninput="updateReferencePreview()">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="email" placeholder="Enter Email" oninput="updateReferencePreview()">
                </div>
            </div>
        </div>
        <button type="button" id="add-reference-btn" onclick="addReferenceRow()">+ Add References</button>
    </form>
</section>

<section id="download-section">
    <h3>Download</h3>
    
    
    <button id="download-pdf">Download as PDF</button>
</section>


    </div>
    
    <!-- Sidebar Three -->
    
        
    <div class="sidebar-three">
    <div id="template-preview" class="template1"> <!-- Default class is template1 -->
        <div id="template-background"></div>
        <?php if ($first_template) { ?>
            <img id="main-preview" src="uploads/previews/<?php echo $first_template['preview']; ?>" 
                 alt="Default Template">
        <?php } else { ?>
            <p>No templates available.</p>
        <?php } ?>
        <!-- Content Overlay -->
        <div id="template-content">
            <!-- About section -->
            <!-- Dynamic Placeholders for -->
            <!-- About section -->
<img id="photo-preview" class="template-data" src="default-profile.png" alt="">
<div id="name-preview" class="template-data"></div>
<div id="lastname-preview" class="template-data"></div>
<div id="fullname-preview" class="template-data"></div>

<div id="designation-preview" class="template-data"></div>

<!-- Contact Section -->
<label for="contacts" id="contactDisplay">Contact</label>
<div id="icon1"><i class="fa-solid fa-phone"></i></div>
<div id="phone-preview" class="template-data"></div>
<div id="icon2"><i class="fa-solid fa-envelope"></i></div>
<div id="email-preview" class="template-data"></div>
<div id="icon3"><i class="fa-solid fa-location-dot"></i></div>
<div id="address-preview" class="template-data"></div>


<!-- Summary Section -->
<label for="About me" id="aboutme">About Me</label>
<div id="summary-preview" class="template-data"></div>
            <!-- education section -->
            <!-- Dynamic Placeholders -->
    <label id="education-header">Education</label>
    <div id="education-list">
        <div class="education-entry-preview template-data">
            <div id="degree-preview" class="education-field"></div>
            <div id="school-preview" class="education-field"></div> 
            <div id="education-city-preview" class="education-field"></div>
            <div id="education-dates-preview" class="education-field"></div>
            <div id="education-description-preview" class="education-field"></div>
        </div>
    </div>
    <!-- work experience section -->
     <!-- Experience Section -->
<label id="experience-header">Experience</label>


<!-- Dynamic Preview for Experience -->
<div id="experience-list">
    <div class="experience-entry-preview template-data">
        <div id="job-title-preview" class="experience-field"></div>
        <div id="company-preview" class="experience-field"></div>
        <div id="experience-city-preview" class="experience-field"></div>
        <div id="experience-dates-preview" class="experience-field"></div>
        <div id="experience-description-preview" class="experience-field"></div>
    </div>
</div>
<!-- Achievements Section in Sidebar Three -->
<label id="achievement-header">Achievements</label>
<div id="achievements-list">
    <!-- Initial achievement preview -->
    <div class="achievement-entry-preview template-data">
        <div id="achievement-title-preview" class="achievement-field"></div>
        <div id="achievement-description-preview" class="achievement-field"></div>
    </div>
</div>

<!-- Skills Section -->
<!-- Skill section -->
    <!-- Sidebar Three: Skill Section -->

    <label id="skills-header">Skills</label>
    <div id="skills-list">
        <!-- Preview for added skills -->
    </div>
   
<!-- Language section -->
    <!-- Sidebar Three: Language Section -->

    <label id="languages-header">Languages</label>
    <div id="languages-list">
        <!-- Preview for added languages -->
    </div>
    <!-- Reference section -->
    <label id="references-header">References</label>
    <div id="references-preview">
        <!-- Dynamically updated reference entries will appear here -->
    </div>
    <div id="download-list">
        
    </div>
    
        </div>
    </div>
    </div>
    </div>
    

       

    <script>
    document.addEventListener("DOMContentLoaded", () => {
    const previewContainer = document.getElementById("template-preview");
    const mainPreviewImage = document.getElementById("main-preview");

    // Set the default template on load (template1)
    const defaultTemplateCard = document.querySelector(".template-card.template1");
    if (defaultTemplateCard) {
        const defaultPreviewPath = defaultTemplateCard.getAttribute("data-preview");
        const defaultTemplateClass = defaultTemplateCard.getAttribute("data-template-class");

        // Update the preview image and class
        if (mainPreviewImage) {
            mainPreviewImage.src = defaultPreviewPath;
        }
        previewContainer.className = defaultTemplateClass; // Set default class
        defaultTemplateCard.classList.add("selected"); // Mark default template as selected
    }

    // Remove existing 'selected' styles for all cards
    const removeSelection = () => {
        document.querySelectorAll(".template-card").forEach(card => {
            card.classList.remove("selected");
        });
    };

    // Handle template selection
    document.querySelectorAll(".template-card").forEach((card) => {
        card.addEventListener("click", () => {
            const previewPath = card.getAttribute("data-preview"); // Get the preview image path
            const templateClass = card.getAttribute("data-template-class"); // Get the template class

            // Debug: Log the selected template class and preview path
            console.log("Selected Template Class:", templateClass);
            console.log("Selected Preview Path:", previewPath);

            // Remove selection from other cards and add to the clicked card
            removeSelection();
            card.classList.add("selected");

            // Update the preview image
            if (mainPreviewImage) {
                mainPreviewImage.src = previewPath;
            } else {
                // If the main preview image element doesn't exist, create it
                const img = document.createElement("img");
                img.id = "main-preview";
                img.src = previewPath;
                img.alt = "Selected Template";
                previewContainer.innerHTML = ""; // Clear previous content
                previewContainer.appendChild(img);
            }

            // Update the class of the preview container
            previewContainer.className = ""; // Clear existing classes
            previewContainer.classList.add(templateClass); // Add the correct template class

            // Debug: Log the updated class of the preview container
            console.log("Preview Container Class:", previewContainer.className);
        });
    });
});

</script>

    <script src="main.js"></script>
    <script src="mainabout.js"></script>
    <script src="save_about.js"></script>
    <script src="fetch_about.js"></script>
    <script src="maineducation.js"></script>
    <script src="mainexperience.js"></script>
   
    <script src="mainskill.js"></script>
    <script src="mainachievement.js"></script>
    
    <script src="mainlanguage.js"></script>
    <script src="mainreference.js"></script>
    <script src="maincontent.js"></script>
    <script src="maintemplate.js"></script>
    <script src="template1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    
    <script src="maindownloadpdf.js"></script>


</body>
</html>
