import './bootstrap';

import '~icons/bootstrap-icons.scss';

import * as bootstrap from 'bootstrap';


import.meta.glob([
    '../img/**'
]);
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

// Importa il plugin monthSelect correttamente
import monthSelectPlugin from "flatpickr/dist/plugins/monthSelect";
import "flatpickr/dist/plugins/monthSelect/style.css";

import { Italian } from "flatpickr/dist/l10n/it.js";
// Import base CSS di Flatpickr
import "flatpickr/dist/flatpickr.min.css";

// Import plugin monthSelect + suo stile
import "flatpickr/dist/plugins/monthSelect/style.css";


// Inizializzare il flatpickr
flatpickr("#year-picker", {
    dateFormat: "Y",
    altInput: true,
    altFormat: "Y",
});

// TOGGLE SIDEBAR'S ICONS

document.addEventListener('DOMContentLoaded', function () {
    const collapseElements = document.querySelectorAll('.collapse');
    collapseElements.forEach(collapse => {
        const icons = collapse.previousElementSibling.querySelectorAll('i.bi');
        const toggleIcon = icons[icons.length - 1];

        if (!toggleIcon) return;

        collapse.addEventListener('show.bs.collapse', function () {
            toggleIcon.classList.remove('bi-caret-right-fill');
            toggleIcon.classList.add('bi-caret-down-fill');
        });

        collapse.addEventListener('hide.bs.collapse', function () {
            toggleIcon.classList.remove('bi-caret-down-fill');
            toggleIcon.classList.add('bi-caret-right-fill');
        });

        if (collapse.classList.contains('show')) {
            toggleIcon.classList.remove('bi-caret-right-fill');
            toggleIcon.classList.add('bi-caret-down-fill');
        }
    });

    // MOBILE HAM MENU

    const toggleBtn = document.getElementById('mobileSidebarToggle');
    const mobileMenu = document.getElementById('mobileSidebarMenu');
    // console.log(mobileMenu);

    toggleBtn.addEventListener('click', function () {
        mobileMenu.classList.toggle('d-none');
    });
});


// ****************** FORMS ******************

// CLEAR VIDEOGAME FORM

window.clearVideogameForm = function () {
    const form = document.getElementById('videogameForm');

    form.querySelectorAll('input, textarea, select').forEach(field => {
        if (field.name === '_method' || field.name === '_token') return;
        if (field.type === 'checkbox' || field.type === 'radio') {
            field.checked = false;
        } else if (field.tagName.toLowerCase() === 'select') {
            field.selectedIndex = 0;
        } else if (field.type !== "submit") {
            field.value = '';
        }
    });
}

// CLEAR OTHER FORMS

window.clearForm = function (formId) {
    const form = document.getElementById(formId);
    form.querySelectorAll('input').forEach(field => {
        if (field.name === '_method' || field.name === '_token') return;
        else if (field.type !== "submit") {
            field.value = '';
        }
    });
}

// TOGGLE ICON FOR CLEAR

window.toggleClearButton = function (fieldId) {
    const input = document.getElementById(fieldId);
    const clearBtn = document.getElementById('clear-btn-' + fieldId);

    if (input && clearBtn) {
        if (input.value.length > 0) {
            clearBtn.style.display = 'block';
        } else {
            clearBtn.style.display = 'none';
        }
    }
}

// TOGGLE CLEAR ICON FOR EDIT


window.addEventListener('DOMContentLoaded', function () {
    const fields = document.querySelectorAll('input, textarea');
    fields.forEach(field => {
        window.toggleClearButton(field.id);
        field.addEventListener('input', function () {
            window.toggleClearButton(field.id);
        });
    })
});


// CLEAR SINGLE INPUT

document.getElementById("searchBtn");
window.clearInput = function (fieldId) {
    document.getElementById(fieldId).value = '';
    toggleClearButton(fieldId);

}




// FORM CHECKBOX

window.selectAll = function (checkboxName) {
    const allCheckbox = document.querySelectorAll(`[name=${checkboxName}]`);
    allCheckbox.forEach((checkbox) => {
        checkbox.checked = true;
    })
}

window.resetAll = function (checkboxName) {
    const allCheckbox = document.querySelectorAll(`[name=${checkboxName}]`);
    allCheckbox.forEach((checkbox) => {
        checkbox.checked = false;
    })
}

// TRIM FORM

window.onload = function () {
    const allForms = document.querySelectorAll("form");
    console.log(allForms);
    allForms.forEach((form) => {
        form.addEventListener('submit', function (e) {
            const formElements = e.target.elements;
            Array.from(formElements).forEach(function (element) {
                element.value = element.value.replace(/\s+/g, ' ').trim();
            });
        })
    });
}

// ****************** TABLE CHECKBOXES ******************

// GET ELEMENT


const selectAll = document.querySelector(".select-all");
const tableCheckboxes = document.querySelectorAll("input[type=checkbox]:not(.select-all)");

let selectedItems = [];
let modalList = document.getElementById("selected-items-list");

const selectedCount = document.getElementById("selected-count");
const selectedMenu = document.querySelector(".selected-menu");
const selectedInfo = document.getElementById("selected-info");
const cancelAll = document.getElementById("cancel-all");

// ADD EVENT LISTENER

selectAll && selectAll.addEventListener("change", selectAllCheckboxes);
cancelAll && cancelAll.addEventListener("click", cancelCheckboxes);


// FUNCTIONS

// SELECT ALL TABLE CHECKBOX

function selectAllCheckboxes() {

    tableCheckboxes.forEach((tableCheckbox) => {

        tableCheckbox.checked = selectAll.checked;
        const name = tableCheckbox.getAttribute('data-name');
        const id = tableCheckbox.getAttribute('data-id');

        if (selectAll.checked) {
            selectedMenu.classList.add("d-flex");
            selectedMenu.classList.remove("d-none");

            const itemExists = selectedItems.some((item) => item.id === id);

            if (!itemExists) {
                selectedItems.push({ id, name });
            }

            selectedItems.sort((a, b) => a.id - b.id);
            modalList.innerHTML = ``;
            selectedItems.forEach((selectedItem) => modalList.innerHTML += `<li>${selectedItem.name}</li>`);
            selectedCount.textContent = `${selectedItems.length}`;

        } else {
            selectedMenu.classList.add("d-none");
            selectedMenu.classList.remove("d-flex");
            selectedItems.splice(0, selectedItems.length);
            modalList.innerHTML = ``;
        }

        if (selectedItems.length > 1) {
            selectedInfo.textContent = "elementi selezionati";
        } else {
            selectedInfo.textContent = "elemento selezionato";
        }
    })
    console.log(selectedItems);
}

// SINGLE TABLE CHECKBOX

tableCheckboxes.forEach((tableCheckbox) => {
    tableCheckbox.addEventListener("change", function () {
        console.log(modalList);

        const name = tableCheckbox.getAttribute('data-name');
        const id = tableCheckbox.getAttribute('data-id');

        if (tableCheckbox.checked) {

            const itemExists = selectedItems.some((item) => item.id === id);

            if (!itemExists) {
                selectedItems.push({ id, name });
            }

            selectedItems.sort((a, b) => a.id - b.id);
            modalList.innerHTML = "";
            selectedCount.textContent = `${selectedItems.length}`;

            selectedItems.forEach((item) => {
                const li = document.createElement("li");
                modalList.appendChild(li);
                li.textContent = item.name;
            })

        } else {

            const index = selectedItems.findIndex((selectedItem) => selectedItem.id === id);
            selectedItems.splice(index, 1);
            selectedCount.textContent = `${selectedItems.length}`;
            modalList.innerHTML = "";
            selectedItems.sort((a, b) => a.id - b.id);
            selectedItems.forEach((item) => {
                const li = document.createElement("li");
                modalList.appendChild(li);
                li.textContent = item.name;
            })

        }

        if (selectedItems.length > 1) {
            selectedInfo.textContent = "elementi selezionati";
        } else {
            selectedInfo.textContent = "elemento selezionato";
        }

        if (Array.from(tableCheckboxes).every((checkbox) => checkbox.checked)) {
            selectAll.checked = true;
        } else {
            selectAll.checked = false;
        }

        if (Array.from(tableCheckboxes).some((checkbox) => checkbox.checked)) {
            selectedMenu.classList.add("d-flex");
            selectedMenu.classList.remove("d-none");
            // console.log(selectedItems);
        } else {
            selectedMenu.classList.add("d-none");
            selectedMenu.classList.remove("d-flex");

        }
    })
})

// CANCEL CHECKBOX

function cancelCheckboxes() {
    const checkboxes = document.querySelectorAll("input[type=checkbox]");

    console.log(modalList);
    checkboxes.forEach((checkbox) => {
        checkbox.checked = false;
        selectedItems.splice(0, selectedItems.length);
        modalList.innerHTML = "";
        selectedMenu.classList.remove("d-flex");
        selectedMenu.classList.add("d-none");

    });
}

// OVERLAY IMAGES


const images = document.querySelectorAll(".form-image");
console.log(images);
const overlay = document.getElementById("overlay");
// console.log(overlay);
const overlayImg = document.getElementById("overlay-img");
console.log(overlayImg);
images.forEach((image) => {
    image.addEventListener("click", function (e) {
        overlay.classList.toggle("d-none");
        const imgUrl = e.target.src;
        console.log(imgUrl);
        overlayImg.src = imgUrl;
    })
})
const overlayBtn = document.getElementById("overlay-btn");
console.log(overlayBtn);
overlayBtn.addEventListener("click", () => overlay.classList.toggle("d-none"));























