// GET ELEMENTS

let images = [];

// ADD EVENT LISTENERS

document.addEventListener("DOMContentLoaded", () => {
    overlayScreenshots(
        ".current-screenshot",
        "current-screenshot-overlay",
        "current-screenshot-overlay-img",
        "arrow-left-current",
        "arrow-right-current",
        "index-current-screenshot",
    );
    overlayCover(
        ".current-cover",
        "current-cover-overlay",
        "current-cover-overlay-img",
    );
});

// FUNCTIONS

// overlayCover = all overlays who has a single image

function overlayCover(allImages, myOverlay, myOverlayImg) {
    images = Array.from(document.querySelectorAll(allImages));
    const overlay = document.getElementById(myOverlay);
    const overlayImg = document.getElementById(myOverlayImg);
    images.forEach((image) => {
        image.addEventListener("click", function (e) {
            overlay.classList.toggle("d-none");
            overlayImg.src = e.target.src;
        });
    });
    overlay &&
        overlay.addEventListener("click", () => {
            if (!overlay.classList.contains("d-none")) {
                overlay.classList.add("d-none");
                images = [];
                images.push(...document.querySelectorAll(allImages));
            }
        });
}

window.overlayScreenshots = function (
    allImages,
    myOverlay,
    myOverlayImg,
    arrowL,
    arrowR,
    myIndexScreenshot,
) {
    let images = Array.from(document.querySelectorAll(allImages));
    const overlay = document.getElementById(myOverlay);
    const overlayImg = document.getElementById(myOverlayImg);
    const arrowLeft = document.getElementById(arrowL);
    const arrowRight = document.getElementById(arrowR);
    const indexScreenshot = document.getElementById(myIndexScreenshot);
    let currentIndex = -1;

    function showOverlayAt(index) {
        if (images.length === 0) return;
        overlay.classList.remove("d-none");
        overlayImg.src = images[index].src;
        currentIndex = index;

        if (indexScreenshot) {
            indexScreenshot.textContent = `${currentIndex + 1} di ${
                images.length
            }`;

            images.length < 2
                ? indexScreenshot.classList.add("d-none")
                : indexScreenshot.classList.remove("d-none");
        }
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
            indexScreenshot
                ? (indexScreenshot.textContent = `${currentIndex + 1} di ${
                      images.length
                  }`)
                : "";
        };

        arrowRight.onclick = function (e) {
            e.stopPropagation();
            if (images.length === 0) return;
            currentIndex = (currentIndex + 1) % images.length;
            overlayImg.src = images[currentIndex].src;
            indexScreenshot
                ? (indexScreenshot.textContent = `${currentIndex + 1} di ${
                      images.length
                  }`)
                : "";
        };
    }
};
