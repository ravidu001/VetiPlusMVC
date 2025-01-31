document.addEventListener("DOMContentLoaded", function () {
    let serviceIDToDelete;

    // Function to show confirmation popup before deleting
    function confirmDelete(serviceID) {
        serviceIDToDelete = serviceID;
        document.getElementById("deleteModal").style.display = "block";
    }

    // Function to close confirmation popup
    function closeModal() {
        document.getElementById("deleteModal").style.display = "none";
    }

    // Function to show success/error popup
    function showPopup(message, isSuccess) {
        const popup = document.createElement("div");
        const overlay = document.createElement("div");

        popup.className = `popup ${isSuccess ? "success" : "error"}`;
        overlay.className = "overlay";

        popup.innerHTML = `
            <p>${message}</p>
            <button id="closePopup">${isSuccess ? "OK" : "Try Again"}</button>
        `;

        document.body.appendChild(overlay);
        document.body.appendChild(popup);

        setTimeout(() => {
            overlay.classList.add("show");
            popup.classList.add("show");
        }, 10);

        // Close popup when button or overlay is clicked
        document.getElementById("closePopup").addEventListener("click", closePopup);
        overlay.addEventListener("click", closePopup);
    }

    function closePopup() {
        const popup = document.querySelector(".popup");
        const overlay = document.querySelector(".overlay");

        if (popup && overlay) {
            popup.classList.remove("show");
            overlay.classList.remove("show");

            setTimeout(() => {
                popup.remove();
                overlay.remove();
                window.history.replaceState({}, document.title, window.location.pathname);
            }, 300);
        }
    }

    // Delete service when confirmed
    document.getElementById("confirmDeleteBtn").onclick = function () {
        if (serviceIDToDelete) {
            fetch(`<?= ROOT ?>/SalonService/delete/${serviceIDToDelete}`, {
                method: "POST",
            })
                .then((response) => response.json())
                .then((data) => {
                    showPopup(data.message, data.success);
                    if (data.success) {
                        document
                            .querySelector(`button[onclick="confirmDelete(${serviceIDToDelete})"]`)
                            .closest("tr")
                            .remove();
                    }
                })
                .catch(() => {
                    showPopup("An error occurred while deleting the service.", false);
                });

            closeModal();
        }
    };

    // Check for existing messages from URL
    const params = new URLSearchParams(window.location.search);
    const status = params.get("status");

    if (status === "success") {
        showPopup("Service deleted successfully!", true);
    } else if (status === "error") {
        showPopup("Failed to delete the service. Try again!", false);
    }
});
