const topNewSlider = document.getElementById('top-news-slider');
const testominalSlider = document.getElementById('testominal');
const productCategorySlider = document.getElementById('product-category');
const ProfessionalSlider = document.getElementById('home-professional');

if (ProfessionalSlider) {
    var slider = tns({
        container: '.professional-slider',
        items: 3,
        // gutter: 20,
        // edgePadding: 30,
        mouseDrag: true,
        autoplay: true,
        controls: false,
        controlsText: ['<i class="fas">&#xf104;</i>', '<i class="fas">&#xf105;</i>'],
        nav: false,
        navPosition: "bottom",
        arrowKeys: true,
        autoplayButtonOutput: false,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            320: {
                items: 2
            },

            500: {
                items: 3
            },
            730: {
                items: 4
            },
            900: {
                items: 5
            },
            1350: {
                items: 6
            },
        }
    });
}


if (productCategorySlider) {
    var slider = tns({
        container: '.product-category-slider',
        items: 3,
        // gutter: 20,
        // edgePadding: 30,
        mouseDrag: true,
        autoplay: true,
        controls: false,
        controlsText: ['<i class="fas">&#xf104;</i>', '<i class="fas">&#xf105;</i>'],
        nav: false,
        navPosition: "bottom",
        arrowKeys: true,
        autoplayButtonOutput: false,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            320: {
                items: 3
            },

            500: {
                items: 3
            },
            730: {
                items: 4
            },
            900: {
                items: 5
            },
            1350: {
                items: 6
            },
        }
    });
}


if (topNewSlider) {
    var slider = tns({
        container: '.top-news-slider',
        items: 3,
        gutter: 0, // Added some spacing for better appearance
        edgePadding: 20, // Added padding for a polished look
        autoplay: true,
        autoplayTimeout: 8000, // Set autoplay interval to 5 seconds
        mouseDrag: true,
        controls: false,
        controlsText: ['<i class="fas">&#xf104;</i>', '<i class="fas">&#xf105;</i>'],
        nav: false,
        autoplayButtonOutput: false,
        speed: 400, // Reduced speed for smooth transitions
        autoplayHoverPause: true, // Pause autoplay on hover
        responsive: {
            0: {
                items: 1
            },
            500: {
                items: 2
            },
            1250: {
                items: 3
            },
            1700: {
                items: 4
            },
        }
    });

    // Adjust autoplay behavior to stop immediately on hover
    const sliderContainer = document.querySelector('.top-news-slider');
    sliderContainer.addEventListener('mouseover', () => {
        slider.pause(); // Pause autoplay instantly on hover
    });

    sliderContainer.addEventListener('mouseout', () => {
        slider.play(); // Resume autoplay when hover ends
    });
}



if (testominalSlider) {
    var slider = tns({
        container: '.testominal-slider',
        items: 3,
        // gutter: 20,
        // edgePadding: 30,
        mouseDrag: true,
        autoplay: true,
        controls: false,
        controlsText: ['<i class="fas">&#xf104;</i>', '<i class="fas">&#xf105;</i>'],
        nav: true,
        navPosition: "bottom",
        arrowKeys: true,
        autoplayButtonOutput: false,
        autoplayTimeout: 4100,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },

            500: {
                items: 2
            },
            900: {
                items: 3
            },
        }
    });
}




