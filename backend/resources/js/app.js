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

// ***** SIDEBAR *****

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

    window.clearScreenshots();
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
    window.clearCover();

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
    allForms.forEach((form) => {
        form.addEventListener('submit', function (e) {
            const formElements = Array.from(e.target.elements);
            const filteredFormElements = formElements.filter((element) => element.id !== 'cover')
            filteredFormElements.forEach(function (element) {
                element.value = element.value.replace(/\s+/g, ' ').trim();
            });
        })
    });
}

// ****************** TABLE CHECKBOXES ******************

// GET ELEMENT


const selectAll = document.querySelector(".select-all");
const tableCheckboxes = document.querySelectorAll("table input[type=checkbox]:not(.select-all)");

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
        const url = tableCheckbox.getAttribute('data-screenshot');

        if (selectAll.checked) {
            selectedMenu.classList.add("d-flex");
            selectedMenu.classList.remove("d-none");

            const itemExists = selectedItems.some((item) => item.id === id);

            if (!itemExists) {
                selectedItems.push({ id, name, url });
            }
            selectedItems.sort((a, b) => a.id - b.id);
            modalList.innerHTML = ``;
            selectedCount.textContent = `${selectedItems.length}`;

            selectedItems.forEach((item) => {
                const li = document.createElement("li");
                modalList.appendChild(li);

                if (item.name) {
                    li.textContent = item.name
                } else {
                    modalList.classList.remove("d-block");
                    modalList.classList.add("d-flex", "list-unstyled", "gap-3", "flex-wrap");

                    const img = document.createElement("img");
                    li.appendChild(img);
                    img.style = "width:124px; height:100px; object-fit:contain; cursor:zoom-in;";
                    img.classList.add("new-screenshot");
                    img.src = `/storage/${item.url}`;

                    overlayScreenshots(".new-screenshot", "new-screenshot-overlay", "new-screenshot-overlay-img", "arrow-left-new", "arrow-right-new", "index-new-screenshot");
                }

            })
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

}

// SINGLE TABLE CHECKBOX

tableCheckboxes && tableCheckboxes.forEach((tableCheckbox) => {
    tableCheckbox.addEventListener("change", function () {

        const name = tableCheckbox.getAttribute('data-name');
        const id = tableCheckbox.getAttribute('data-id');
        const url = tableCheckbox.getAttribute('data-screenshot');

        if (tableCheckbox.checked) {

            const itemExists = selectedItems.some((item) => item.id === id);

            if (!itemExists) {
                selectedItems.push({ id, name, url });
            }

            selectedItems.sort((a, b) => a.id - b.id);
            modalList.innerHTML = "";
            selectedCount.textContent = `${selectedItems.length}`;

            selectedItems.forEach((item) => {
                const li = document.createElement("li");
                modalList.appendChild(li);

                if (item.name) {
                    li.textContent = item.name
                } else {
                    modalList.classList.remove("d-block");
                    modalList.classList.add("d-flex", "list-unstyled", "gap-3", "flex-wrap");

                    const img = document.createElement("img");
                    li.appendChild(img);

                    img.style = "width:124px; height:100px; object-fit:contain; cursor:zoom-in;";
                    img.classList.add("new-screenshot");
                    img.src = `/storage/${item.url}`;
                    overlayScreenshots(".new-screenshot", "new-screenshot-overlay", "new-screenshot-overlay-img", "arrow-left-new", "arrow-right-new", "index-new-screenshot");
                }
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

        } else {
            selectedMenu.classList.add("d-none");
            selectedMenu.classList.remove("d-flex");

        }
    })
})

// CANCEL CHECKBOX

function cancelCheckboxes() {
    const checkboxes = document.querySelectorAll("input[type=checkbox]");


    checkboxes.forEach((checkbox) => {
        checkbox.checked = false;
        selectedItems.splice(0, selectedItems.length);
        modalList.innerHTML = "";
        selectedMenu.classList.remove("d-flex");
        selectedMenu.classList.add("d-none");

    });
}

// *****  PREVIEW IMAGES *****

// VARIABLES


const coverInput = document.getElementById('cover');
const previewCoverContainer = document.getElementById('preview-cover-container');
const newCover = document.getElementById('new-cover');
const input = document.getElementById('screenshots');
const previewContainer = document.getElementById('previewContainer');
const newScreenshots = document.getElementById("new-screenshots");
let previewArray = [];
let images = [];

// ** EVENT LISTENER **

// COVER


coverInput && coverInput.addEventListener('change', function () {
    const coverFile = coverInput.files[0];

    if (coverFile) {
        showCoverPreview(coverFile);
        updateCoverFile(coverFile);
    }
})

// SCREENSHOTS


input && input.addEventListener('change', async () => {
    const newFiles = Array.from(input.files);
    const loadPromises = [];

    newFiles.forEach((newFile) => {
        previewArray.push(newFile);

        const promise = showScreenshotsPreviewAsync(newFile);
        loadPromises.push(promise);
    });

    updateInputFiles();

    await Promise.all(loadPromises);

    overlayScreenshots(".new-screenshot", "new-screenshot-overlay", "new-screenshot-overlay-img", "arrow-left-new", "arrow-right-new", "index-new-screenshot");
});


// * FUNCTIONS *

// COVER

function showCoverPreview(file) {
    const reader = new FileReader();
    reader.onload = function (e) {

        file ? newCover.className = 'd-block fw-bold' : newCover.className = 'd-none';

        const preview = document.createElement('div');
        preview.id = 'new-cover-preview';
        preview.classList.add('preview');

        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'new-cover-img object-fit-contain';
        img.style = 'cursor:zoom-in;'

        const btn = document.createElement('button');
        btn.innerText = "×";
        btn.classList.add('remove-btn', 'd-flex', 'justify-content-center', 'align-items-center');

        btn.addEventListener('click', function () {
            preview.remove();
            coverInput.value = '';
            newCover.className = 'd-none';
            // updateCoverFile(file);

        });

        preview.appendChild(img);
        preview.appendChild(btn);
        previewCoverContainer.children[0] && previewCoverContainer.children[0].remove();
        previewCoverContainer.appendChild(preview);
        overlayScreenshots(".new-cover-img", "new-cover-overlay", "new-cover-overlay-img");

    }

    reader.readAsDataURL(file);
}

function updateCoverFile(file) {
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    coverInput.files = dataTransfer.files;

}

window.clearCover = function () {
    const preview = document.getElementById('new-cover-preview');
    preview.remove();
    newCover.className = 'd-none';
}

// SCREENSHOTS


function showScreenshotsPreviewAsync(file) {
    return new Promise((resolve) => {
        showLoader();
        const reader = new FileReader();
        reader.onload = function (e) {
            if (previewArray.length > 0) {
                newScreenshots.className = "d-block fw-bold";
            }

            const preview = document.createElement('div');
            preview.id = 'post-image';
            preview.classList.add('preview');

            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'new-screenshot object-fit-contain';

            const btn = document.createElement('button');
            btn.innerText = "×";
            btn.classList.add('remove-btn', 'd-flex', 'justify-content-center', 'align-items-center');

            btn.addEventListener("click", function () {
                const index = Array.from(previewContainer.children).indexOf(preview);
                previewArray.splice(index, 1);
                preview.remove();
                updateInputFiles();
                overlayScreenshots(".new-screenshot", "new-screenshot-overlay", "new-screenshot-overlay-img", "arrow-left-new", "arrow-right-new", "index-new-screenshot");
            });

            preview.appendChild(img);
            preview.appendChild(btn);
            previewContainer.appendChild(preview);

            resolve();
            hideLoader();
        };
        reader.readAsDataURL(file);
    });
}

function updateInputFiles() {
    const dataTransfer = new DataTransfer();
    previewArray.forEach(file => dataTransfer.items.add(file));
    input.files = dataTransfer.files;
}

// RESET

window.clearScreenshots = function () {

    previewArray.splice(0, previewArray.length);
    const previews = Array.from(previewContainer.children);
    previews.forEach((preview) => {
        preview.remove();
        newScreenshots.className = 'd-none';
    })
    updateInputFiles();
}

// ***** OVERLAY IMAGES *****


document.addEventListener('DOMContentLoaded', () => {
    overlayScreenshots(".current-screenshot", "current-screenshot-overlay", "current-screenshot-overlay-img", "arrow-left-current", "arrow-right-current", "index-current-screenshot");
    overlayCover(".current-cover", "current-cover-overlay", "current-cover-overlay-img");
});

function overlayCover(allImages, myOverlay, myOverlayImg) {

    images = Array.from(document.querySelectorAll(allImages));
    console.log(images)

    const overlay = document.getElementById(myOverlay);

    const overlayImg = document.getElementById(myOverlayImg);

    images.forEach((image) => {
        image.addEventListener("click", function (e) {
            overlay.classList.toggle("d-none");
            overlayImg.src = e.target.src;
        })
    })
    overlay && overlay.addEventListener("click", () => {
        if (!overlay.classList.contains("d-none")) {
            overlay.classList.add("d-none");
            images = [];
            images.push(...document.querySelectorAll(allImages));
        }
    })
};

function overlayScreenshots(allImages, myOverlay, myOverlayImg, arrowL, arrowR, myIndexScreenshot) {
    let images = Array.from(document.querySelectorAll(allImages));
    const overlay = document.getElementById(myOverlay);
    const overlayImg = document.getElementById(myOverlayImg);
    const arrowLeft = document.getElementById(arrowL);
    const arrowRight = document.getElementById(arrowR);
    const indexScreenshot = document.getElementById(myIndexScreenshot);



    let currentIndex = -1;

    function showOverlayAt(index) {
        if (images.length === 0) return;
        overlayImg.src = images[index].src;
        overlay.classList.remove("d-none");
        currentIndex = index;
        indexScreenshot ? indexScreenshot.textContent = `${currentIndex + 1} di ${images.length}` : "";
        images.length < 2 ? indexScreenshot.classList.add('d-none') : '';
    }

    function closeOverlay() {
        overlay.classList.add("d-none");
        currentIndex = -1;
    }

    // REMOVE PREVIOUSLY LISTENER


    images.forEach((image, index) => {
        const clone = image.cloneNode(true);
        image.parentNode.replaceChild(clone, image);
        clone.addEventListener("click", function () {
            showOverlayAt(index);
        });
    });

    if (overlay) {
        overlay.onclick = closeOverlay;
    }

    // ARROWS

    if (arrowLeft && arrowRight) {

        if (images.length < 2) {
            arrowLeft.classList.add("d-none");
            arrowRight.classList.add("d-none");
        } else {
            arrowLeft.classList.remove("d-none");
            arrowRight.classList.remove("d-none");
        }

        arrowLeft.onclick = function (e) {
            e.stopPropagation();
            if (images.length === 0) return;
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            overlayImg.src = images[currentIndex].src;
            indexScreenshot ? indexScreenshot.textContent = `${currentIndex + 1} di ${images.length}` : "";
        };

        arrowRight.onclick = function (e) {
            e.stopPropagation();
            if (images.length === 0) return;
            currentIndex = (currentIndex + 1) % images.length;
            overlayImg.src = images[currentIndex].src;
            indexScreenshot ? indexScreenshot.textContent = `${currentIndex + 1} di ${images.length}` : "";
        };
    }
}

// ***** LOADER *****

const loader = document.getElementById('loader-overlay');

function showLoader() {
    loader.className = 'd-flex';
}


function hideLoader() {
    loader.className = 'd-none';
}




























