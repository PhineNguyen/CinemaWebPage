$(document).ready(function () {
  const days = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
  const $dateTabsContainer = $("#dateTabs");
  const $prevBtn = $("#prevBtn");
  const $nextBtn = $("#nextBtn");
  const NUM_DAYS = 7;
  let offset = 0;

  function renderDateTabs(startOffset) {
    $dateTabsContainer.css({ transition: "none", transform: "translateX(0)" }).empty();

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
      .css({ transition: "none", transform: `translateX(${initial}px)` })[0].offsetWidth;

    $dateTabsContainer
      .css({ transition: "transform 0.3s ease", transform: "translateX(0)" });
  }

  $nextBtn.on("click", function () {
    offset++;
    animateSlide("next");
    setTimeout(() => renderDateTabs(offset), 300);
  });

  $prevBtn.on("click", function () {
    if (offset > 0) {
      offset--;
      animateSlide("prev");
      setTimeout(() => renderDateTabs(offset), 300);
    }
  });

  // Lọc rạp theo thành phố
  const $citySelect = $("#citySelect");
  const $cinemaSelect = $("#cinemaSelect");

  if ($citySelect.length && $cinemaSelect.length) {
    const allCinemas = $cinemaSelect.find("option").filter(function () {
      return $(this).val() !== "";
    });

    $citySelect.on("change", function () {
      const selectedCity = $(this).val();
      $cinemaSelect.empty();

      $cinemaSelect.append($("<option>", {
        text: "Tất cả rạp",
        value: ""
      }));

      allCinemas.each(function () {
        const $option = $(this);
        if (selectedCity === "" || $option.data("city") === selectedCity) {
          $cinemaSelect.append($option.clone());
        }
      });
    });
  }

  renderDateTabs(offset);
});
