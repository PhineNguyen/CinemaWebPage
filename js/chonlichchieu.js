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
