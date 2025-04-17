import './bootstrap';
import '~resources/scss/app.scss';
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


// Inizializza il datepicker sull'input #year-picker
flatpickr("#year-picker", {
    locale: Italian,
    dateFormat: "Y",
    altInput: true,
    altFormat: "Y",
    plugins: [
        new monthSelectPlugin({
            shorthand: true,
            dateFormat: "Y",
            altFormat: "Y",
            theme: "light"
        })
    ]
});






