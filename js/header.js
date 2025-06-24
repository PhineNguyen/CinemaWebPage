$(document).ready(function () {
  const $profile = $('.admin-profile');
  const $logoutBtn = $('.logout-btn');
  const $authButtons = $('.auth-buttons');

  $profile.on('click', function (e) {
    e.stopPropagation();
    $(this).toggleClass('active');
  });

  $(document).on('click', function () {
    $profile.removeClass('active');
  });

  $logoutBtn.on('click', function (e) {
    e.preventDefault(); // ngăn chuyển trang nếu là thẻ <a>
    $profile.hide();    // ẩn khối admin
    $authButtons.css('display', 'flex'); // hiện các nút đăng nhập/đăng ký
  });
});
