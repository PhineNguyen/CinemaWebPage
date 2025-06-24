const days = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
const dateTabsContainer = document.getElementById("dateTabs");

let offset = 0; // ngày bắt đầu hiển thị
const NUM_DAYS = 7;

// tạo các tab ngày
function renderDateTabs(startOffset) {
  dateTabsContainer.style.transition = "none"; // reset animation
  dateTabsContainer.style.transform = "translateX(0)";
  dateTabsContainer.innerHTML = "";

  for (let i = 0; i < NUM_DAYS; i++) {
    const date = new Date();
    date.setDate(date.getDate() + startOffset + i);

    const isToday = (startOffset + i === 0);
    const thu = isToday ? "Hôm nay" : days[date.getDay()];
    const ngay = String(date.getDate()).padStart(2, '0') + '/' + String(date.getMonth() + 1).padStart(2, '0');

    const btn = document.createElement("button");
    btn.className = "date-tab" + (i >= 6 ? " hidden" : "");
    btn.innerHTML = `${thu}<br><span>${ngay}</span>`;
    
    if (isToday) btn.classList.add("active");
    // Xử lý sự kiện click
    btn.addEventListener("click", () => {
      // Xóa class active của tất cả các nút
      document.querySelectorAll(".date-tab").forEach(tab => tab.classList.remove("active"));
      // Gán active cho nút vừa click
      btn.classList.add("active");
    });
    dateTabsContainer.appendChild(btn);
  }
}


document.getElementById("nextBtn").addEventListener("click", () => {
  offset++;
  renderDateTabs(offset);
});

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

