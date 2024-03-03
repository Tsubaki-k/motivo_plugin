document.addEventListener("DOMContentLoaded", function() {
    var containers = document.getElementsByClassName("motivo-accordion-container");

    // Iterate over each accordion container
    for (var c = 0; c < containers.length; c++) {
        var acc = containers[c].getElementsByClassName("accordion-button");
        var allClosed = true; // Variable to track if all accordions are closed

        // Check if any accordion in this container is initially open
        for (var i = 0; i < acc.length; i++) {
            var panel = acc[i].nextElementSibling;
            if (panel.style.maxHeight) {
                allClosed = false; // At least one accordion in this container is open
                break;
            }
        }

        // If all accordions in this container are closed, show the image of the first accordion
        if (allClosed) {
            var firstImageSrc = containers[c].querySelector('.accordion-item .image-container img').src;
            var showImageContainer = containers[c].querySelector('.show-image');
            showImageContainer.innerHTML = '<img src="' + firstImageSrc + '" alt="Accordion Image"/>';
        }

        // Add click event listeners to accordion buttons in this container
        for (var i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                // Find the panel and image associated with the clicked button
                var panel = this.nextElementSibling;
                var imageSrc = this.previousElementSibling.querySelector('img').src;

                // Update the .show-image container's content
                var showImageContainer = this.closest('.motivo-accordion-container').querySelector('.show-image');
                showImageContainer.innerHTML = '<img src="' + imageSrc + '" alt="Accordion Image"/>';

                var isOpen = panel.style.maxHeight;

                // Close all panels in this accordion container
                var container = this.closest('.motivo-accordion-container');
                var allPanels = container.querySelectorAll('.panel');
                for (var j = 0; j < allPanels.length; j++) {
                    allPanels[j].style.maxHeight = null;
                }

                // Open this panel if it was previously closed
                if (!isOpen) {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }

                // Remove "active" class from all buttons
                var allButtons = container.querySelectorAll('.accordion-button');
                for (var k = 0; k < allButtons.length; k++) {
                    allButtons[k].classList.remove('active');
                }

                // Add "active" class to the clicked button
                this.classList.add('active');

                // Check if all panels are closed and remove "active" class if they are
                var allClosed = true;
                for (var j = 0; j < allPanels.length; j++) {
                    if (allPanels[j].style.maxHeight) {
                        allClosed = false;
                        break;
                    }
                }
                if (allClosed) {
                    for (var k = 0; k < allButtons.length; k++) {
                        allButtons[k].classList.remove('active');
                    }
                }
            });
        }
    }
});
