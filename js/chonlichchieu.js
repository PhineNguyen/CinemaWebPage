$(document).ready(function () {
  const days = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
  const $dateTabsContainer = $("#dateTabs");

  let offset = 0;
  const NUM_DAYS = 7;

  function renderDateTabs(startOffset) {
    $dateTabsContainer.css({
      transition: "none",
      transform: "translateX(0)"
    }).empty();

    for (let i = 0; i < NUM_DAYS; i++) {
      const date = new Date();
      date.setDate(date.getDate() + startOffset + i);

      const isToday = (startOffset + i === 0);
      const thu = isToday ? "Hôm nay" : days[date.getDay()];
      const ngay = String(date.getDate()).padStart(2, '0') + '/' + String(date.getMonth() + 1).padStart(2, '0');

      const $btn = $("<button>")
        .addClass("date-tab" + (i >= 6 ? " hidden" : ""))
        .html(`${thu}<br><span>${ngay}</span>`);

      if (isToday) $btn.addClass("active");

      $btn.on("click", function () {
        $(".date-tab").removeClass("active");
        $(this).addClass("active");
      });

      $dateTabsContainer.append($btn);
    }
  }

  function animateSlide(direction) {
    const distance = 100;
    const initial = direction === "next" ? distance : -distance;

    $dateTabsContainer
      .css({
        transition: "none",
        transform: `translateX(${initial}px)`
      })[0].offsetWidth; // trigger reflow

    $dateTabsContainer
      .css({
        transition: "transform 0.3s ease",
        transform: "translateX(0)"
      });
  }

  $("#nextBtn").on("click", function () {
    offset++;
    animateSlide("next");
    setTimeout(() => renderDateTabs(offset), 300);
  });

  $("#prevBtn").on("click", function () {
    if (offset > 0) {
      offset--;
      animateSlide("prev");
      setTimeout(() => renderDateTabs(offset), 300);
    }
  });

  renderDateTabs(offset);
});
<<<<<<< HEAD

document.getElementById("prevBtn").addEventListener("click", () => {
  if (offset > 0) {
    offset--;
    renderDateTabs(offset);
  }
});


function animateSlide(direction) {
  // Slide effect
  const distance = 100; // pixel
  const initial = direction === "next" ? distance : -distance;
  dateTabsContainer.style.transition = "none";
  dateTabsContainer.style.transform = `translateX(${initial}px)`;

  // Trigger reflow to restart animation
  void dateTabsContainer.offsetWidth;

  dateTabsContainer.style.transition = "transform 0.3s ease";
  dateTabsContainer.style.transform = "translateX(0)";
}

// Next
document.getElementById("nextBtn").addEventListener("click", () => {
  offset++;
  animateSlide("next");
  setTimeout(() => renderDateTabs(offset), 300); // wait for animation
});

// Prev
document.getElementById("prevBtn").addEventListener("click", () => {
  if (offset > 0) {
    offset--;
    animateSlide("prev");
    setTimeout(() => renderDateTabs(offset), 300); // wait for animation
  }
});
// khởi tạo
renderDateTabs(offset);

// --- LỌC RẠP THEO THÀNH PHỐ ---
document.addEventListener("DOMContentLoaded", function () {
  const citySelect = document.getElementById("citySelect");
  const cinemaSelect = document.getElementById("cinemaSelect");

  if (citySelect && cinemaSelect) {
    const allCinemas = Array.from(cinemaSelect.options).filter(opt => opt.value !== "");

    citySelect.addEventListener("change", function () {
      const selectedCity = citySelect.value;
      cinemaSelect.innerHTML = '';

      const defaultOption = document.createElement('option');
      defaultOption.text = 'Tất cả rạp';
      defaultOption.value = '';
      cinemaSelect.add(defaultOption);

      allCinemas.forEach(option => {
        const city = option.getAttribute("data-city");
        if (selectedCity === "" || city === selectedCity) {
          cinemaSelect.add(option.cloneNode(true));
        }
      });
    });
  }
});

=======
>>>>>>> fdea11551a9e46503bc5e03d31af2a3d4d9a820f
