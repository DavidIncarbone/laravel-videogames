// TOGGLE SIDEBAR'S ICONS

document.addEventListener("DOMContentLoaded", function () {
    const collapseElements = document.querySelectorAll(".collapse");
    console.log(collapseElements);
    collapseElements.forEach((collapse) => {
        const icons = collapse.previousElementSibling.querySelectorAll("i.bi");
        const toggleIcon = icons[icons.length - 1];

        if (!toggleIcon) return;

        collapse.addEventListener("show.bs.collapse", function () {
            toggleIcon.classList.remove("bi-caret-right-fill");
            toggleIcon.classList.add("bi-caret-down-fill");
        });

        collapse.addEventListener("hide.bs.collapse", function () {
            toggleIcon.classList.remove("bi-caret-down-fill");
            toggleIcon.classList.add("bi-caret-right-fill");
        });

        if (collapse.classList.contains("show")) {
            toggleIcon.classList.remove("bi-caret-right-fill");
            toggleIcon.classList.add("bi-caret-down-fill");
        }
    });

    // MOBILE HAM MENU

    const toggleBtn = document.getElementById("mobileSidebarToggle");
    const mobileMenu = document.getElementById("mobileSidebarMenu");

    toggleBtn.addEventListener("click", function () {
        mobileMenu.classList.toggle("d-none");
    });
});
