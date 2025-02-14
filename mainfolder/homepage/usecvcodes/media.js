document.addEventListener("DOMContentLoaded", () => {
    const menuOpen = document.querySelector("#menu-open");
    const menuClose = document.querySelector("#menu-close");

    menuOpen.addEventListener("click", () => {
        // Toggle mobile menu visibility
        document.body.classList.toggle("show-mobile-menu");
    });

    menuClose.addEventListener("click", () => menuOpen.click());
});
