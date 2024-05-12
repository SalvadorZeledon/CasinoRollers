document.addEventListener("DOMContentLoaded", function() {
    var toggleButton = document.querySelector(".toggle");
    var menu = document.querySelector(".menu");

    toggleButton.addEventListener("click", function() {
        menu.classList.toggle("active");
    });
});

