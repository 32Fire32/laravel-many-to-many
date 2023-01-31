const inputCheckbox = document.getElementById("no_image");
const inputFile = document.getElementById("project_logo_img");
inputCheckbox.addEventListener("change", function () {
    if (inputCheckbox.checked) {
        inputFile.disabled = true;
    } else {
        inputFile.disabled = false;
    }
});
