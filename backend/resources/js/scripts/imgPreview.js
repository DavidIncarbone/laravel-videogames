// GET ELEMENTS

const coverInput = document.getElementById("cover");
const previewCoverContainer = document.getElementById(
    "preview-cover-container",
);
const newCover = document.getElementById("new-cover");
const input = document.getElementById("screenshots");
const previewContainer = document.getElementById("previewContainer");
const newScreenshots = document.getElementById("new-screenshots");
let previewArray = [];
let images = [];

// ** EVENT LISTENER **

// COVER

coverInput &&
    coverInput.addEventListener("change", function () {
        const coverFile = coverInput.files[0];

        if (coverFile) {
            showCoverPreview(coverFile);
            updateCoverFile(coverFile);
        }
    });

// SCREENSHOTS

input &&
    input.addEventListener("change", async () => {
        const newFiles = Array.from(input.files);
        const loadPromises = [];

        newFiles.forEach((newFile) => {
            previewArray.push(newFile);

            const promise = showScreenshotsPreviewAsync(newFile);
            loadPromises.push(promise);
        });

        updateInputFiles();

        await Promise.all(loadPromises);

        overlayScreenshots(
            ".new-screenshot",
            "new-screenshot-overlay",
            "new-screenshot-overlay-img",
            "arrow-left-new",
            "arrow-right-new",
            "index-new-screenshot",
        );
    });

// * FUNCTIONS *

// COVER

function showCoverPreview(file) {
    const reader = new FileReader();
    reader.onload = function (e) {
        file
            ? (newCover.className = "d-block fw-bold")
            : (newCover.className = "d-none");

        const preview = document.createElement("div");
        preview.id = "new-cover-preview";
        preview.classList.add("preview");

        const img = document.createElement("img");
        img.src = e.target.result;
        img.className = "new-cover-img object-fit-contain";
        img.style = "cursor:zoom-in;";

        const btn = document.createElement("button");
        btn.innerText = "×";
        btn.classList.add(
            "remove-btn",
            "d-flex",
            "justify-content-center",
            "align-items-center",
        );

        btn.addEventListener("click", function () {
            preview.remove();
            coverInput.value = "";
            newCover.className = "d-none";
            // updateCoverFile(file);
        });

        preview.appendChild(img);
        preview.appendChild(btn);
        previewCoverContainer.children[0] &&
            previewCoverContainer.children[0].remove();
        previewCoverContainer.appendChild(preview);
        overlayScreenshots(
            ".new-cover-img",
            "new-cover-overlay",
            "new-cover-overlay-img",
        );
    };

    reader.readAsDataURL(file);
}

function updateCoverFile(file) {
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    coverInput.files = dataTransfer.files;
}

window.clearCover = function () {
    const preview = document.getElementById("new-cover-preview");
    preview && preview.remove();
    newCover.className = "d-none";
};

// SCREENSHOTS

function showScreenshotsPreviewAsync(file) {
    return new Promise((resolve) => {
        showLoader();
        const reader = new FileReader();
        reader.onload = function (e) {
            if (previewArray.length > 0) {
                newScreenshots.className = "d-block fw-bold";
            }

            const preview = document.createElement("div");
            preview.id = "post-image";
            preview.classList.add("preview");

            const img = document.createElement("img");
            img.src = e.target.result;
            img.className = "new-screenshot object-fit-cover";
            img.style = "width:124px; height:62px;";

            const btn = document.createElement("button");
            btn.innerText = "×";
            btn.classList.add(
                "remove-btn",
                "d-flex",
                "justify-content-center",
                "align-items-center",
            );

            btn.addEventListener("click", function () {
                const index = Array.from(previewContainer.children).indexOf(
                    preview,
                );
                previewArray.splice(index, 1);
                preview.remove();
                updateInputFiles();
                overlayScreenshots(
                    ".new-screenshot",
                    "new-screenshot-overlay",
                    "new-screenshot-overlay-img",
                    "arrow-left-new",
                    "arrow-right-new",
                    "index-new-screenshot",
                );
                previewArray.length < 1
                    ? (newScreenshots.className = "d-none")
                    : "";
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
    previewArray.forEach((file) => dataTransfer.items.add(file));
    input.files = dataTransfer.files;
}

// RESET

window.clearScreenshots = function () {
    previewArray.splice(0, previewArray.length);
    const previews = Array.from(previewContainer.children);
    previews.forEach((preview) => {
        preview.remove();
        newScreenshots.className = "d-none";
    });
    updateInputFiles();
};
