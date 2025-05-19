// CLEAR VIDEOGAME FORM

const clearButtons = document.querySelectorAll('[id^="clear-btn-"]');

window.clearVideogameForm = function () {
    const form = document.getElementById("videogameForm");

    form.querySelectorAll("input, textarea, select").forEach((field) => {
        if (field.name === "_method" || field.name === "_token") return;
        if (field.type === "checkbox" || field.type === "radio") {
            field.checked = false;
        } else if (field.tagName.toLowerCase() === "select") {
            field.selectedIndex = 0;
        } else if (field.type !== "submit") {
            field.value = "";
        }
    });

    clearButtons.forEach((btn) => {
        btn.classList.remove("d-block");
        btn.classList.add("d-none");
    });
    console.log(clearButtons);

    window.clearScreenshots();
};

// CLEAR OTHER FORMS

window.clearForm = function (formId) {
    const form = document.getElementById(formId);

    form.querySelectorAll("input").forEach((field) => {
        if (field.name === "_method" || field.name === "_token") return;
        else if (field.type !== "submit") {
            field.value = "";
        }
        clearButtons.forEach((btn) => {
            btn.classList.remove("d-block");
            btn.classList.add("d-none");
        });
    });

    window.clearCover();
};

// TOGGLE ICON FOR CLEAR

window.toggleClearButton = function (fieldId) {
    const input = document.getElementById(fieldId);
    const clearBtn = document.getElementById("clear-btn-" + fieldId);

    if (input && clearBtn) {
        if (input.value.length > 0) {
            console.log(clearBtn);
            clearBtn.classList.remove("d-none");
            clearBtn.classList.add("d-block");
        } else {
            clearBtn.classList.remove("d-block");
            clearBtn.classList.add("d-none");
        }
    }
};

// TOGGLE CLEAR ICON FOR EDIT

window.addEventListener("DOMContentLoaded", function () {
    const fields = document.querySelectorAll("input, textarea");
    fields.forEach((field) => {
        window.toggleClearButton(field.id);
        field.addEventListener("input", function () {
            window.toggleClearButton(field.id);
        });
    });
});

// CLEAR SINGLE INPUT

document.getElementById("searchBtn");
window.clearInput = function (fieldId) {
    document.getElementById(fieldId).value = "";
    toggleClearButton(fieldId);
};

// FORM CHECKBOX

window.selectAll = function (checkboxName) {
    const allCheckbox = document.querySelectorAll(`[name=${checkboxName}]`);
    allCheckbox.forEach((checkbox) => {
        checkbox.checked = true;
    });
};

window.resetAll = function (checkboxName) {
    const allCheckbox = document.querySelectorAll(`[name=${checkboxName}]`);
    allCheckbox.forEach((checkbox) => {
        checkbox.checked = false;
    });
};

// TRIM FORM

window.onload = function () {
    const allForms = document.querySelectorAll("form");
    allForms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            const formElements = Array.from(e.target.elements);
            const filteredFormElements = formElements.filter(
                (element) => element.id !== "cover"
            );
            filteredFormElements.forEach(function (element) {
                element.value = element.value.replace(/\s+/g, " ").trim();
            });
        });
    });
};
