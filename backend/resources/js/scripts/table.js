// GET ELEMENT

const selectAll = document.querySelector(".select-all");
const tableCheckboxes = document.querySelectorAll(
    "table input[type=checkbox]:not(.select-all)",
);

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
        const name = tableCheckbox.getAttribute("data-name");
        const id = tableCheckbox.getAttribute("data-id");
        const url = tableCheckbox.getAttribute("data-screenshot");

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
                    li.textContent = item.name;
                } else {
                    modalList.classList.remove("d-block");
                    modalList.classList.add(
                        "d-flex",
                        "list-unstyled",
                        "gap-3",
                        "flex-wrap",
                    );

                    const img = document.createElement("img");
                    li.appendChild(img);
                    img.style =
                        "width:124px; height:62px; object-fit:contain; cursor:zoom-in;";
                    img.classList.add("new-screenshot");
                    img.src = `/storage/${item.url}`;

                    overlayScreenshots(
                        ".new-screenshot",
                        "new-screenshot-overlay",
                        "new-screenshot-overlay-img",
                        "arrow-left-new",
                        "arrow-right-new",
                        "index-new-screenshot",
                    );
                }
            });
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
    });
}

// SINGLE TABLE CHECKBOX

tableCheckboxes &&
    tableCheckboxes.forEach((tableCheckbox) => {
        tableCheckbox.addEventListener("change", function () {
            const name = tableCheckbox.getAttribute("data-name");
            const id = tableCheckbox.getAttribute("data-id");
            const url = tableCheckbox.getAttribute("data-screenshot");

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
                        li.textContent = item.name;
                    } else {
                        modalList.classList.remove("d-block");
                        modalList.classList.add(
                            "d-flex",
                            "list-unstyled",
                            "gap-3",
                            "flex-wrap",
                        );

                        const img = document.createElement("img");
                        li.appendChild(img);

                        img.style =
                            "width:124px; height:62px; object-fit:contain; cursor:zoom-in;";
                        img.classList.add("new-screenshot");
                        img.src = `/storage/${item.url}`;
                        overlayScreenshots(
                            ".new-screenshot",
                            "new-screenshot-overlay",
                            "new-screenshot-overlay-img",
                            "arrow-left-new",
                            "arrow-right-new",
                            "index-new-screenshot",
                        );
                    }
                });
            } else {
                const index = selectedItems.findIndex(
                    (selectedItem) => selectedItem.id === id,
                );
                selectedItems.splice(index, 1);
                selectedCount.textContent = `${selectedItems.length}`;
                modalList.innerHTML = "";
                selectedItems.sort((a, b) => a.id - b.id);
                selectedItems.forEach((item) => {
                    const li = document.createElement("li");
                    modalList.appendChild(li);
                    li.textContent = item.name;
                });
            }

            if (selectedItems.length > 1) {
                selectedInfo.textContent = "elementi selezionati";
            } else {
                selectedInfo.textContent = "elemento selezionato";
            }

            if (
                Array.from(tableCheckboxes).every(
                    (checkbox) => checkbox.checked,
                )
            ) {
                selectAll.checked = true;
            } else {
                selectAll.checked = false;
            }

            if (
                Array.from(tableCheckboxes).some((checkbox) => checkbox.checked)
            ) {
                selectedMenu.classList.add("d-flex");
                selectedMenu.classList.remove("d-none");
            } else {
                selectedMenu.classList.add("d-none");
                selectedMenu.classList.remove("d-flex");
            }
        });
    });

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
