$(document).ready(function () {
  const $navTabs = $('.nav-item a');
  const $tabHome = $('#tab-home');
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
  // LIÊN HỆ
  $tabLienhe.on('click', function (e) {
    e.preventDefault();
    $navTabs.removeClass('active');
    $(this).addClass('active');

    $mainContent.hide();
    $rapContent.hide();
    $giaVeContent.hide();

    $lienHeContent.html('<div class="loading">Đang tải...</div>').show();
    $.get('lienhe.php', function (html) {
      $lienHeContent.html(html);
    });
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

  // Khởi tạo chi tiết rạp động từ database (AJAX lấy data động)
  function initializeRapCinetixScript() {
    const $cinemaItems = $('.cinema-item');
    const $detailContainer = $('#cinema-detail-container');

    // Lấy danh sách rạp theo tỉnh/thành từ API
    $.getJSON('rapCinetixMovies.php', function(data) {
      const allCinemas = data.cinemaByCity || {};
      if ($cinemaItems.length && $detailContainer.length) {
        $cinemaItems.off('click').on('click', function () {
          $cinemaItems.removeClass('selected');
          $(this).addClass('active selected');
          const province = $(this).text().trim();
          showCinemaDetails(province);
        });

        function showCinemaDetails(province) {
          $detailContainer.empty();
          if (allCinemas[province] && allCinemas[province].length > 0) {
            const $detailDiv = $('<div>').addClass('cinema-detail');
            allCinemas[province].forEach((cinemaObj, idx) => {
              const $detailItem = $('<div>')
                .addClass('detail-item')
                .text(cinemaObj.ci_name)
                .data('ci_code', cinemaObj.ci_code)
                .on('click', function () {
                  $detailDiv.find('.detail-item').removeClass('selected');
                  $(this).addClass('selected');
                  showCinemaInfo(cinemaObj.ci_code, cinemaObj.ci_name);
                });
              $detailDiv.append($detailItem);
              // Tự động chọn rạp đầu tiên khi chọn tỉnh
              if (idx === 0) setTimeout(() => $detailItem.click(), 0);
            });
            $detailContainer.append($detailDiv);
          } else {
            $detailContainer.html('<div style="color:#fff; margin:20px 0;">Không có rạp nào ở khu vực này.</div>');
          }
        }

        // Lấy chi tiết rạp qua API
        function showCinemaInfo(ci_code, ci_name) {
          $('#cinema-info-section').remove();
          // Nếu ci_code null hoặc rỗng, fallback sang truy vấn theo tên rạp
          let code = (ci_code || '').toString().trim().toUpperCase();
          let name = (ci_name || '').toString().trim();
          let params = {};
          if (code && code !== 'NULL') {
            params.cinema = code;
            console.log('Requesting info for ci_code:', code);
          } else {
            params.cinema = name;
            console.log('Requesting info for ci_name:', name);
          }
          $.getJSON('rapCinetixMovies.php', params, function(data) {
            console.log('API response:', data);
            const info = data.cinema;
            const $infoDiv = $('<div>').attr('id', 'cinema-info-section').addClass('cinema-info-section');
            if (info) {
              $infoDiv.html(`
                <div class="cinema-info-block" style="display:flex;align-items:flex-start;gap:32px;flex-wrap:wrap;">
                  <img src="${info.image}" alt="${info.ci_name}" style="width:340px;max-width:100%;border-radius:10px;object-fit:cover;flex-shrink:0;box-shadow:0 2px 16px #0002;" />
                  <div style="flex:1;min-width:220px;">
                    <h3 style="color:#e50914; margin-bottom:10px;">${info.ci_name || ci_name}</h3>
                    <p><b>Địa chỉ:</b> ${info.address || ''}</p>
                    <p><b>Hotline:</b> ${info.hotline || ''}</p>
                    <p><b>Email:</b> ${info.email_ci || ''}</p>
                  </div>
                </div>
                <div class="now-showing-title" style="margin:32px 0 12px 0;font-size:20px;font-weight:bold;color:#fff;">ĐANG CHIẾU TẠI RẠP</div>
                <div style="position:relative;max-width:100vw;overflow:hidden;padding:0 32px;box-sizing:border-box;">
                  <button class="movie-scroll-btn left" style="position:absolute;left:0;top:50%;transform:translateY(-50%);z-index:2;background:#ffc107;border:none;border-radius:50%;width:44px;height:44px;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px #0004;transition:background 0.2s;outline:none;">
                    <span style="font-size:28px;color:#fff;">&#8592;</span>
                  </button>
                  <div id="movie-list" class="movie-list" style="display:flex;gap:24px;overflow-x:auto;scroll-behavior:smooth;padding-bottom:8px;scrollbar-width:thin;max-width:100%;">
                    ${(data.movies||[]).map(movie => `
                      <div class="movie-card" style="background:#222;padding:12px 8px;border-radius:10px;width:180px;min-width:180px;box-shadow:0 2px 8px #0002;display:flex;flex-direction:column;align-items:center;flex-shrink:0;">
                        <img src="${movie.image_url}" alt="${movie.title}" style="width:100%;height:240px;object-fit:cover;border-radius:8px;" />
                        <button class="btn-yellow" style="margin:4px 0 0 0;padding:4px 12px;border:none;border-radius:6px;background:#ffc107;color:#222;cursor:pointer;font-weight:bold;" onclick="location.href='chitietphim.php?id=${movie.id}'">XEM CHI TIẾT</button>
                      </div>
                    `).join('')}
                  </div>
                  <button class="movie-scroll-btn right" style="position:absolute;right:0;top:50%;transform:translateY(-50%);z-index:2;background:#ffc107;border:none;border-radius:50%;width:44px;height:44px;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px #0004;transition:background 0.2s;outline:none;">
                    <span style="font-size:28px;color:#fff;">&#8594;</span>
                  </button>
                </div>
                <script>
                  // Gán lại sự kiện cho nút cuộn sau khi render
                  document.querySelector('#cinema-info-section .movie-scroll-btn.left').onclick = function(e){ window.scrollMovies('left'); };
                  document.querySelector('#cinema-info-section .movie-scroll-btn.right').onclick = function(e){ window.scrollMovies('right'); };
                </script>
              `);
            } else {
              $infoDiv.html(`<div style='color:#fff; text-align:center; margin:30px 0;'>Thông tin rạp đang được cập nhật...</div>`);
            }
            $detailContainer.append($infoDiv);
          });
        }

        // Tự động click tỉnh đầu tiên khi load tab
        if ($cinemaItems.length) $cinemaItems.first().click();
      }
    });
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
