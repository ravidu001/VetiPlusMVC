document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".service-name-btn");
    const rows = document.querySelectorAll(".offer-row");

    buttons.forEach(button => {
        button.addEventListener("click", function() {
            // Remove active class from all buttons
            buttons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");

            // Get selected service name
            let selectedService = this.getAttribute("data-service");

            // Show only relevant rows
            rows.forEach(row => {
                row.style.display = row.getAttribute("data-service") === selectedService ? "table-row" : "none";
            });
        });
    });
});
