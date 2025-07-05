$(document).ready(function () {
  const $navTabs = $('.nav-item a');
  const $tabHome = $('.nav-item a[href=""]');
  const $tabRap = $('#rap-cinetix-tab');
  const $tabGiaVe = $('#gia-ve-tab');
  const $tabLienhe = $('#lien-he-tab');

  const $mainContent = $('#main-content');
  const $rapContent = $('#rap-cinetix-content');
  const $giaVeContent = $('#gia-ve-content');
  const $lienHeContent = $('#lien-he-content');

  // PHIM (Trang chủ)
  $tabHome.on('click', function (e) {
    e.preventDefault();
    $navTabs.removeClass('active');
    $(this).addClass('active');

    $rapContent.hide();
    $giaVeContent.hide();
    $lienHeContent.hide();
    $mainContent.show();
  });

  // RẠP CINETIX
  $tabRap.on('click', function (e) {
    e.preventDefault();
    $navTabs.removeClass('active');
    $(this).addClass('active');

    $mainContent.hide();
    $giaVeContent.hide();
    $lienHeContent.hide();

    $rapContent.html('<div class="loading">Đang tải...</div>').show();
    $.get('rapCinetix.php', function (html) {
      $rapContent.html(html);
      initializeRapCinetixScript();
    });
  });

  // GIÁ VÉ
  $tabGiaVe.on('click', function (e) {
    e.preventDefault();
    $navTabs.removeClass('active');
    $(this).addClass('active');

    $mainContent.hide();
    $rapContent.hide();
    $lienHeContent.hide();

    $giaVeContent.html('<div class="loading">Đang tải...</div>').show();
    $.get('giave.php', function (html) {
      $giaVeContent.html(html);
    });
  });

  // Khởi tạo chi tiết rạp
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

    const $cinemaItems = $('.cinema-item');
    const $detailContainer = $('#cinema-detail-container');

    if ($cinemaItems.length && $detailContainer.length) {
      $cinemaItems.on('click', function () {
        $cinemaItems.removeClass('selected');
        $(this).addClass('selected');
        const province = $(this).text().trim();
        showCinemaDetails(province);
      });

      function showCinemaDetails(province) {
        $detailContainer.empty();
        if (cinemaDetails[province]) {
          const $detailDiv = $('<div>').addClass('cinema-detail');
          cinemaDetails[province].forEach(name => {
            const $detailItem = $('<div>')
              .addClass('detail-item')
              .text(name)
              .on('click', function () {
                $detailDiv.find('.detail-item').removeClass('selected');
                $(this).addClass('selected');
                showCinemaInfo($(this).text().trim());
              });
            $detailDiv.append($detailItem);
          });
          $detailContainer.append($detailDiv);
        }
      }

      function showCinemaInfo(cinemaName) {
        $('#cinema-info-section').remove();
        $.getJSON('rapCinetixMovies.php', { cinema: cinemaName }, function (data) {
          const $infoDiv = $('<div>').attr('id', 'cinema-info-section').addClass('cinema-info-section');

          if (data && data.cinema) {
            const cinema = data.cinema;
            const moviesHTML = data.movies.map(movie => `
              <div class='movie-card'>
                <img src='${movie.image_url}' alt='${movie.title}' />
                <div class='movie-btns'>
                  <button class='btn-yellow' onclick='window.open("${movie.trailer_url || "#"}", "_blank")'>TRAILER</button>
                  <button class='btn-yellow' onclick='location.href="chonlichchieu.php?id=${movie.id || ""}"'>ĐẶT VÉ</button>
                </div>
              </div>
            `).join('');

            $infoDiv.html(`
              <div class="cinema-slider">
                <div class="slider-img">
                  <img src="${cinema.image}" alt="${cinemaName}" />
                </div>
                <div class="slider-info">
                  <p><b>${cinema.address}</b></p>
                  <p>Fax: ${cinema.fax || ''}</p>
                  <p>Hotline: ${cinema.hotline || ''}</p>
                  <button class="btn-red">XEM BẢN ĐỒ</button>
                  <button class="btn-red">LIÊN HỆ CINETIX</button>
                </div>
              </div>
              <div class="now-showing-title">ĐANG CHIẾU TẠI RẠP</div>
              <div class="movie-slider-container">
                <button class="movie-arrow movie-arrow-left" onclick="scrollMovies('left')">&#10094;</button>
                <button class="movie-arrow movie-arrow-right" onclick="scrollMovies('right')">&#10095;</button>
                <div class="now-showing-list" id="movie-list">${moviesHTML}</div>
              </div>
            `);
          } else {
            $infoDiv.html(`<div style='color:#fff; text-align:center; margin:30px 0;'>Thông tin rạp đang được cập nhật...</div>`);
          }

          $detailContainer.append($infoDiv);
        });
      }

      // Tự động click tỉnh đầu tiên
      $cinemaItems.eq(0).click();
    }
  }

  // Cuộn danh sách phim
  window.scrollMovies = function (direction) {
    const $movieList = $('#movie-list');
    if (!$movieList.length) return;
    const scrollAmount = 440;
    const currentScroll = $movieList.scrollLeft();
    $movieList.animate({
      scrollLeft: direction === 'left' ? currentScroll - scrollAmount : currentScroll + scrollAmount
    }, 400);
  };
});
