document.getElementById("photoUpload").addEventListener("change", function (event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById("profilePhoto").src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});