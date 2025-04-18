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
        // console.log(toggleIcon);

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


// CLEAR VIDEOGAME FORM

window.clearVideogameForm = function () {
    const form = document.getElementById('videogameForm');

    // Svuota tutti i campi input/textarea/select
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

// CLEAR CONSOLE FORM

window.clearConsoleForm = function () {
    const form = document.getElementById('consoleForm');
    form.querySelectorAll('input').forEach(field => {
        if (field.name === '_method' || field.name === '_token') return;
        else if (field.type !== "submit") {
            field.value = '';
        }
    });
}













