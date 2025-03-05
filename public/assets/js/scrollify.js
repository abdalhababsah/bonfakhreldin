
$(function() {
    // Initialize Scrollify
    $.scrollify({
        section: ".section-unique",
        scrollSpeed: 1100,
        before: function(index, sections) {
            // Remove animation classes before the section becomes active
            $('.animate__animated').removeClass(
                'animate__fadeIn animate__fadeInUp animate__fadeInLeft animate__fadeInRight animate__zoomIn'
            );
        },
        after: function(index, sections) {
            // Add animation classes after the section becomes active
            const currentSection = sections[index];
            $(currentSection).find('.animate__animated').addClass('animate__fadeIn');

            // Handle Floating Image Positioning
            const productImage = $('#floatingProductImage');

            if (index === 0) {
                // Hero Section: Position image at the boundary
                productImage.css({
                    top: '50%',
                    left: '70%',
                    transform: 'translate(-50%, -50%)'
                });
            } else if (index === 1) {
                // Middle Section: Image stays centered on the boundary
                productImage.css({
                    top: '50%',
                    left: '70%',
                    transform: 'translate(-50%, -50%)'
                });
                productImage.addClass('animate__fadeInUp');
            } else if (index === 2) {
                // Slider Section: Move image to the left side or hide
                productImage.css({
                    top: '80%',
                    left: '30%',
                    transform: 'translate(-50%, -50%)'
                });
                productImage.addClass('animate__fadeInLeft');
            }
        },
        afterResize: function() {
            $.scrollify.update();
        },
        offset: 0,
        interstitialSection: "",
        easing: "easeOutExpo",
        setHeights: true,
        overflowScroll: true,
        updateHash: true,
        touchScroll: true,
        before: function() {}
    });
});
