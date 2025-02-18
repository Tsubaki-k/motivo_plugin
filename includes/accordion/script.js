function initializeMotivoAccordion($scope = document) {
    // console.log("Motivo Accordion Initialized"); // Debugging

    var containers = $scope.querySelectorAll(".motivo-accordion-container");

    containers.forEach(container => {
        var acc = container.querySelectorAll(".accordion-button");

        // Check if any accordion is already open
        var allClosed = true;
        acc.forEach(button => {
            var panel = button.nextElementSibling;
            if (panel.style.maxHeight) {
                allClosed = false;
            }
        });

        // If all are closed, set the first one as active
        if (allClosed && acc.length > 0) {
            var firstButton = acc[0];
            var firstPanel = firstButton.nextElementSibling;
            var firstImage = firstButton.previousElementSibling?.querySelector("img");

            firstButton.classList.add("active");
            firstPanel.style.maxHeight = firstPanel.scrollHeight + "px";

            if (firstImage) {
                var firstImageSrc = firstImage.src;
                var showImageContainer = container.querySelector(".show-image");
                if (showImageContainer) {
                    showImageContainer.innerHTML = `<img src="${firstImageSrc}" alt="Accordion Image"/>`;
                }
            }
        }

        // Remove previous event listeners to avoid duplication
        container.removeEventListener("click", handleAccordionClick);
        container.addEventListener("click", handleAccordionClick);
    });
}

function handleAccordionClick(event) {
    var button = event.target.closest(".accordion-button");
    if (!button) return;

    var panel = button.nextElementSibling;
    var imageContainer = button.previousElementSibling?.querySelector("img");

    if (imageContainer) {
        var imageSrc = imageContainer.src;
        var showImageContainer = button.closest(".motivo-accordion-container").querySelector(".show-image");
        if (showImageContainer) {
            showImageContainer.innerHTML = `<img src="${imageSrc}" alt="Accordion Image"/>`;
        }
    }

    var isOpen = panel.style.maxHeight;
    var container = button.closest(".motivo-accordion-container");
    var allPanels = container.querySelectorAll(".panel");
    var allButtons = container.querySelectorAll(".accordion-button");

    // Close all panels
    allPanels.forEach(p => (p.style.maxHeight = null));
    allButtons.forEach(b => b.classList.remove("active"));

    // Toggle current panel
    if (!isOpen) {
        panel.style.maxHeight = panel.scrollHeight + "px";
        button.classList.add("active");
    }
}

// ✅ Ensure it runs on normal page load
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOMContentLoaded fired");
    initializeMotivoAccordion();
});

// ✅ Ensure it runs inside Elementor’s frontend
jQuery(window).on("elementor/frontend/init", function () {
    console.log("Elementor Frontend Init Fired");

    elementorFrontend.hooks.addAction("frontend/element_ready/global", function ($scope) {
        initializeMotivoAccordion($scope[0]);
    });

    if (window.elementorFrontend.isEditMode()) {
        console.log("Elementor Editor Mode Detected");
        initializeMotivoAccordion(document);

        elementor.channels.editor.on("change", function () {
            console.log("Elementor Change Event Fired");
            setTimeout(() => initializeMotivoAccordion(document), 200);
        });

        elementor.channels.editor.on("widget:added", function () {
            console.log("Elementor Widget Added Event Fired");
            setTimeout(() => initializeMotivoAccordion(document), 200);
        });

        elementor.hooks.addAction("panel/open_editor", function () {
            console.log("Elementor Panel Opened Event Fired");
            setTimeout(() => initializeMotivoAccordion(document), 200);
        });

        elementorFrontend.hooks.addAction("frontend/element_ready/widget", function () {
            console.log("Elementor Frontend Ready Event Fired");
            setTimeout(() => initializeMotivoAccordion(document), 200);
        });
    }
});
