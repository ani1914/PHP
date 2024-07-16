document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.news-carousel');
    const prevButton = document.querySelector('.carousel-control-left');
    const nextButton = document.querySelector('.carousel-control-right');
    const newsItems = document.querySelectorAll('.news-item');
    const itemCount = newsItems.length;
    let currentPosition = 0;

    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentPosition * 100 / 3}%)`;
    }

    function nextSlide() {
        if (currentPosition < itemCount - 3) {
            currentPosition++;
            updateCarousel();
        }
    }

    function prevSlide() {
        if (currentPosition > 0) {
            currentPosition--;
            updateCarousel();
        }
    }

    prevButton.addEventListener('click', prevSlide);
    nextButton.addEventListener('click', nextSlide);
});

