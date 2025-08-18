document.addEventListener("DOMContentLoaded", function() {
    const driverSelect = document.getElementById("id_driver");
    const typeInput = document.getElementById("type_carrier");
    const plateInput = document.getElementById("plate_number");

    driverSelect.addEventListener("change", function() {
        let selected = this.options[this.selectedIndex];
        typeInput.value = selected.getAttribute("data-type_carrier") || "";
        plateInput.value = selected.getAttribute("data-plate_number") || "";
    });

    // Auto-set ketika edit (sudah ada supir terpilih)
    if (driverSelect.value) {
        let selected = driverSelect.options[driverSelect.selectedIndex];
        typeInput.value = selected.getAttribute("data-type_carrier") || "";
        plateInput.value = selected.getAttribute("data-plate_number") || "";
    }
});