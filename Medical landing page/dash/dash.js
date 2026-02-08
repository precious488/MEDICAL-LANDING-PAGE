
document.addEventListener("DOMContentLoaded", function() {
    const imageInput = document.getElementById("imageInput");
    const imagePreview = document.getElementById("imagePreview");
    const plusIcon = document.querySelector(".plus-icon");

    const storedImage = localStorage.getItem("profilePicture");
    if (storedImage) {
        imagePreview.src = storedImage;
        imagePreview.style.display = "block";
    }

    imageInput.addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                localStorage.setItem("profilePicture", e.target.result);
                imagePreview.src = e.target.result;
                imagePreview.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    });
});


