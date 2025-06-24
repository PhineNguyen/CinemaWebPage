$(document).ready(function () {
  let currentIndex = 0;
  const $slides = $('.slides');
  const totalSlides = $('.slides img').length;

  function showSlide(index) {
    if (index >= totalSlides) currentIndex = 0;
    else if (index < 0) currentIndex = totalSlides - 1;
    else currentIndex = index;

    $slides.css('transform', `translateX(-${currentIndex * 900}px)`);
  }

  function nextSlide() {
    showSlide(currentIndex + 1);
  }

  function prevSlide() {
    showSlide(currentIndex - 1);
  }

  setInterval(nextSlide, 5000);
});
