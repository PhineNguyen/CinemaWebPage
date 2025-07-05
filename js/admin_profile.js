$(document).ready(function () {
  // Lấy vai trò từ data-role
  const userRole = $('.admin-profile').data('role');

  $('.menu-item').each(function () {
    const allowedRole = $(this).data('allow');
    if (allowedRole && allowedRole !== userRole) {
      $(this).hide();
    }
  });

  // Mở / tắt dropdown khi click vào .admin-profile
  $('.admin-profile').click(function (e) {
    e.stopPropagation();
    $(this).toggleClass('active');
  });

  // Click ngoài thì đóng dropdown
  $(document).click(function () {
    $('.admin-profile').removeClass('active');
  });

  // Click trong dropdown thì không đóng
  $('.mucluc').click(function (e) {
    e.stopPropagation();
  });
});
