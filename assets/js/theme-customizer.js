document.addEventListener("DOMContentLoaded", function () {

    const primaryInput = document.getElementById("primaryColorPicker");
    const secondaryInput = document.getElementById("secondaryColorPicker");
    const saveBtn = document.getElementById("saveThemeColors");
    const offcanvasEl    = document.getElementById("themeCustomizerPopup");

    if (!offcanvasEl) return;
    const offcanvasInstance = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);

    function hexToRgb(hex) {
        hex = hex.replace("#", "");

        if (hex.length === 3) {
            hex = hex.split("").map(c => c + c).join("");
        }

        const bigint = parseInt(hex, 16);
        const r = (bigint >> 16) & 255;
        const g = (bigint >> 8) & 255;
        const b = bigint & 255;

        return { r, g, b };
    }

    function applyColors(primaryHex, secondaryHex) {

        const primaryRgb = hexToRgb(primaryHex);
        const secondaryRgb = hexToRgb(secondaryHex);

        // Primary
        document.documentElement.style.setProperty(
            "--primary",
            `rgb(${primaryRgb.r}, ${primaryRgb.g}, ${primaryRgb.b})`
        );

        document.documentElement.style.setProperty(
            "--bs-primary-rgb",
            `${primaryRgb.r}, ${primaryRgb.g}, ${primaryRgb.b}`
        );

        // Secondary (example for dark)
        document.documentElement.style.setProperty(
            "--dark",
            `rgb(${secondaryRgb.r}, ${secondaryRgb.g}, ${secondaryRgb.b})`
        );

        document.documentElement.style.setProperty(
            "--bs-dark-rgb",
            `${secondaryRgb.r}, ${secondaryRgb.g}, ${secondaryRgb.b}`
        );
    }
    // Load saved colors
    const savedPrimary = localStorage.getItem("primaryColor");
    const savedSecondary = localStorage.getItem("secondaryColor");

    if (savedPrimary && savedSecondary) {
        applyColors(savedPrimary, savedSecondary);
        primaryInput.value = savedPrimary;
        secondaryInput.value = savedSecondary;
    }

    // Save button click
    saveBtn.addEventListener("click", function () {

        const primary = primaryInput.value;
        const secondary = secondaryInput.value;

        applyColors(primary, secondary);

        localStorage.setItem("primaryColor", primary);
        localStorage.setItem("secondaryColor", secondary);

        offcanvasInstance.hide();
    });
    const resetBtn = document.getElementById("resetThemeColors");

    if (resetBtn) {
    resetBtn.addEventListener("click", function () {
        // Remove only the inline CSS variables (so styles fallback to CSS defaults)
        document.documentElement.style.removeProperty("--primary");
        document.documentElement.style.removeProperty("--bs-primary-rgb");
        document.documentElement.style.removeProperty("--dark");
        document.documentElement.style.removeProperty("--bs-dark-rgb");

        // Optional: reset color pickers UI to empty or keep current values
        // primaryInput.value = ""; 
        // secondaryInput.value = "";

        // Close offcanvas if desired
        offcanvasInstance.hide();
    });
    }

});