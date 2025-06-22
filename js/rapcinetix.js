const cinemaDetails = {
  "Hồ Chí Minh": ["CINETIX GO! Quận 1", "CINETIX VINCOM Thủ Đức"],
  "Hà Nội": ["CINETIX GO! Hoàn Kiếm", "CINETIX VINCOM Long Biên"],
  "Đà Nẵng": ["CINETIX GO! Hải Châu"],
  "Cần Thơ": ["CINETIX GO! Ninh Kiều"],
  "Đồng Nai": ["CINETIX VINCOM Biên Hòa"],
  "Tiền Giang": ["CINETIX GO! Mỹ Tho", "CINETIX VINCOM Mỹ Tho"],
  "Bình Dương": ["CINETIX GO! Thủ Dầu Một"],
  "Vũng Tàu": ["CINETIX GO! Vũng Tàu"],
  "Bạc Liêu": ["CINETIX GO! Bạc Liêu"],
  "Nghệ An": ["CINETIX GO! Vinh"]
};

const cinemaItems = document.querySelectorAll('.cinema-item');
const detailContainer = document.getElementById('cinema-detail-container');

cinemaItems.forEach(item => {
  item.addEventListener('click', function() {
    cinemaItems.forEach(i => i.classList.remove('selected'));
    this.classList.add('selected');
    const province = this.textContent.trim();
    showCinemaDetails(province);
  });
});

function showCinemaDetails(province) {
  detailContainer.innerHTML = '';
  if (cinemaDetails[province]) {
    const detailDiv = document.createElement('div');
    detailDiv.className = 'cinema-detail';
    cinemaDetails[province].forEach(name => {
      const detailItem = document.createElement('div');
      detailItem.className = 'detail-item';
      detailItem.textContent = name;
      detailItem.onclick = function() {
        detailDiv.querySelectorAll('.detail-item').forEach(i => i.classList.remove('selected'));
        this.classList.add('selected');
        showCinemaInfo(this.textContent.trim());
      };
      detailDiv.appendChild(detailItem);
    });
    detailContainer.appendChild(detailDiv);
  }
}

function showCinemaInfo(cinemaName) {
  // Xóa phần info cũ nếu có
  let oldInfo = document.getElementById('cinema-info-section');
  if (oldInfo) oldInfo.remove();

  // Gọi AJAX lấy danh sách phim từ PHP
  fetch('rapCinetixMovies.php?cinema=' + encodeURIComponent(cinemaName))
    .then(res => res.json())
    .then(data => {
      const infoDiv = document.createElement('div');
      infoDiv.id = 'cinema-info-section';
      infoDiv.className = 'cinema-info-section';
      if (data && data.cinema) {
        infoDiv.innerHTML = `
          <div class="cinema-slider">
            <div class="slider-img">
              <img src="${data.cinema.image}" alt="${cinemaName}" />
            </div>
            <div class="slider-info">
              <p><b>${data.cinema.address}</b></p>
              <p>Fax: ${data.cinema.fax || ''}</p>
              <p>Hotline: ${data.cinema.hotline || ''}</p>
              <button class="btn-red">XEM BẢN ĐỒ</button>
              <button class="btn-red">LIÊN HỆ CINETIX</button>
            </div>
          </div>
          <div class="now-showing-title">ĐANG CHIẾU TẠI RẠP</div>
          <div class="movie-slider-container">
            <button class="movie-arrow movie-arrow-left" onclick="scrollMovies('left')">&#10094;</button>
            <button class="movie-arrow movie-arrow-right" onclick="scrollMovies('right')">&#10095;</button>
            <div class="now-showing-list" id="movie-list">
              ${data.movies.map(movie => `
                <div class='movie-card'>
                  <img src='${movie.image_url}' alt='${movie.title}' />
                  <div class='movie-btns'>
                    <button class='btn-yellow' onclick='window.open("${movie.trailer_url || '#'}", "_blank")'>TRAILER</button>
                    <button class='btn-yellow' onclick='location.href="chonlichchieu.php?id=${movie.id || ''}"'>ĐẶT VÉ</button>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>
        `;
      } else {
        infoDiv.innerHTML = `<div style='color:#fff; text-align:center; margin:30px 0;'>Thông tin rạp đang được cập nhật...</div>`;
      }
      detailContainer.appendChild(infoDiv);
    });
}

// Hàm cuộn ngang danh sách phim
function scrollMovies(direction) {
  const movieList = document.getElementById('movie-list');
  if (!movieList) return;
  
  const scrollAmount = 220 * 2; // Cuộn 2 phim mỗi lần
  const currentScroll = movieList.scrollLeft;
  
  if (direction === 'left') {
    movieList.scrollTo({
      left: currentScroll - scrollAmount,
      behavior: 'smooth'
    });
  } else {
    movieList.scrollTo({
      left: currentScroll + scrollAmount,
      behavior: 'smooth'
    });
  }
}
