document.addEventListener('DOMContentLoaded', function() {
  // ...existing code tab...
  // Bật box lịch sử giao dịch khi click vào avatar hoặc mục trong dropdown
  document.body.addEventListener('click', function(e) {
    const lichsuDropdown = e.target.closest('#lichsu-dropdown');
    if (lichsuDropdown) {
      e.preventDefault(); // Ngăn reload trang khi click vào Lịch sử
      fetch('lichsu.php')
        .then(res => res.text())
        .then(html => {
          document.getElementById('lichsu-modal-container').innerHTML = html;
          // Debug log
          console.log('Đã fetch lichsu.php, nội dung:', html);
          // Hiển thị popup nếu có trong nội dung trả về
          const modalBg = document.getElementById('history-modal-bg');
          if (modalBg) {
            modalBg.style.display = 'flex';
            console.log('Đã bật popup lịch sử');
          } else {
            console.warn('Không tìm thấy #history-modal-bg trong nội dung trả về');
          }
        })
        .catch(err => {
          console.error('Lỗi fetch lichsu.php:', err);
        });
      return;
    }
    // Chỉ bật khi click vào icon avatar, không phải toàn bộ admin-profile
    const adminIcon = e.target.closest('.admin-icon');
    if (adminIcon) {
      fetch('lichsu.php')
        .then(res => res.text())
        .then(html => {
          document.getElementById('lichsu-modal-container').innerHTML = html;
          const modalBg = document.getElementById('history-modal-bg');
          if (modalBg) modalBg.style.display = 'flex';
        });
    }
  });
});
// ...existing code...
