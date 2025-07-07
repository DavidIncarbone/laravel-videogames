// import "./bootstrap";
// import "~icons/bootstrap-icons.scss";
import * as bootstrap from "bootstrap";

window.bootstrap = bootstrap; // rende disponibile globalmente

import.meta.glob(["../img/**"]);

// Importo i miei file js

import "./scripts/forms";
import "./scripts/sidebar";
import "./scripts/table";
import "./scripts/imgPreview";
import "./scripts/overlays";
