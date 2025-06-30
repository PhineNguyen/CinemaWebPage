$(document).ready(function () {
  const $slider = $('.slides');
  const $slideItems = $('.slide-item');
  const totalSlides = $slideItems.length;
  let currentSlide = 0;
  let slideInterval;

  function updateSliderPosition() {
    const slideWidth = $('.banner-slider').width();
    const newTransform = -currentSlide * slideWidth;
    $slider.css({
      'transform': `translateX(${newTransform}px)`,
      'transition': 'transform 0.6s ease'
    });
  }

  // Chuyển slide
  window.prevSlide = function () {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    updateSliderPosition();
  };

  window.nextSlide = function () {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateSliderPosition();
  };

  function startAutoSlide() {
    slideInterval = setInterval(() => {
      currentSlide = (currentSlide + 1) % totalSlides;
      updateSliderPosition();
    }, 3000);
  }

  function stopAutoSlide() {
    clearInterval(slideInterval);
  }

  // Dừng khi hover và khởi động lại khi rời chuột
  $('.banner-slider').hover(stopAutoSlide, startAutoSlide);

  // Cập nhật lại khi resize
  $(window).on('resize', updateSliderPosition);

  // Khởi tạo
  updateSliderPosition();
  startAutoSlide();
});
