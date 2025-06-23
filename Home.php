<?php
    session_start();
    include("connect.php");
    include("header.php");
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>

  <!-- CSS -->
  <link rel="stylesheet" href="CSS/Home.css" />
  <link rel="stylesheet" href="CSS/rapcinetix.css" />
</head>

<body>
 

  <!-- Menu điều hướng -->
  <nav class="nav-item">
    <a href="#" class="active">PHIM</a>
    <a href="#" id="rap-cinetix-tab">RẠP CINETIX</a>
    <a href="#" id="gia-ve-tab">GIÁ VÉ</a>
    <a href="#" id="lien-he-tab">LIÊN HỆ</a>
  </nav>

  <div id="main-content">
    <?php
    $sql = "SELECT title, image_URL, banner_url FROM movies";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

      // Banner Slider
      echo '<section class="banner-slider">';
      echo '<div class="slides">';
      foreach ($movies as $movie) {
        $banner = htmlspecialchars($movie['banner_url']);
        echo "
            <div class='slide-item'>
            <img src='$banner' alt='Banner phim'>
            </div>
        ";
      }
      echo '</div>';
      echo '
        <button class="muitentrai" onclick="prevSlide()">&#10094;</button>
        <button class="muitenphai" onclick="nextSlide()">&#10095;</button>
      ';
      echo '</section>';

      // Movie Poster
      echo '<div class="double-line-heading"><span>MOVIE SELECTION</span></div>';
      echo '<div class="movie">';
      foreach ($movies as $movie) {
        $title = htmlspecialchars($movie['title']);
        $image = htmlspecialchars($movie['image_URL']);
        echo <<<HTML
        <div class="movie-item">
          <div class="poster-img">
            <img src="$image" alt="Poster phim $title" />
          </div>
          <div class="button">
            <div><a href="#">XEM CHI TIẾT</a></div>
            <div><a href="#">ĐẶT VÉ</a></div>
          </div>
        </div>
        HTML;
      }
      echo '</div>';
    } else {
      echo "<p style='text-align:center; color:white;'>Không có phim nào để hiển thị.</p>";
    }
    ?>
  </div>

  <div id="rap-cinetix-content" style="display:none;"></div>
  <div id="gia-ve-content" style="display:none;"></div>
  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="js/Home.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const navTabs = document.querySelectorAll('.nav-item a');
      const tabRap = document.getElementById('rap-cinetix-tab');
      const tabGiaVe = document.getElementById('gia-ve-tab');
      const mainContent = document.getElementById('main-content');
      const rapContent = document.getElementById('rap-cinetix-content');
      const giaVeContent = document.getElementById('gia-ve-content');
      
      // Khi click vào tab RẠP CINETIX
      tabRap.addEventListener('click', function(e) {
        e.preventDefault();
        navTabs.forEach(t => t.classList.remove('active'));
        tabRap.classList.add('active');
        mainContent.style.display = 'none';
        giaVeContent.style.display = 'none';
        fetch('rapCinetix.php')
          .then(res => res.text())
          .then(html => {            rapContent.innerHTML = html;
            rapContent.style.display = 'block';
            // Load JS for dynamic effect
            initializeRapCinetixScript();
          });
      });
      
      // Khi click vào tab GIÁ VÉ
      tabGiaVe.addEventListener('click', function(e) {
        e.preventDefault();
        navTabs.forEach(t => t.classList.remove('active'));
        tabGiaVe.classList.add('active');
        mainContent.style.display = 'none';
        rapContent.style.display = 'none';
        fetch('giave.php')
          .then(res => res.text())
          .then(html => {
            giaVeContent.innerHTML = html;
            giaVeContent.style.display = 'block';
          });
      });
      
      // Khi click vào tab PHIM thì trở lại giao diện chính
      navTabs[0].addEventListener('click', function(e) {
        e.preventDefault();
        navTabs.forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        rapContent.style.display = 'none';
        giaVeContent.style.display = 'none';        mainContent.style.display = 'block';
      });
      
      // Function to initialize the rapcinetix.js functionality
      function initializeRapCinetixScript() {
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

        if (cinemaItems && detailContainer) {
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

          // Trigger click on first city by default
          if (cinemaItems.length > 0) {
            cinemaItems[0].click();
          }
        }
      }
      
      // Define scrollMovies function globally
      window.scrollMovies = function(direction) {
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
      };
    });
  </script>
</body>

</html>
  <?php include("footer.php"); ?>