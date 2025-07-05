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

  // Chuyển hướng đến trang add/edit
  function bindRedirect(selector, baseUrl) {
  $(document).on('click', selector, function () {
    const id = $(this).data('id'); // Lấy id từ thuộc tính data-id
    if (id !== undefined) {
      window.location.href = baseUrl + '?id=' + id;
    } else {
      window.location.href = baseUrl;
    }
  });
}

  // Gọi hàm tái sử dụng
  bindRedirect('#btn', 'form_add_user.php');
  bindRedirect('#btn2', 'form_add_hr.php');
  bindRedirect('#btn3', 'form_add_film.php');
  bindRedirect('.btn-add-cinema', 'form_add_cinema.php');
  bindRedirect('.btn-add-room', 'form_add_room.php');
  bindRedirect('.btn-edit', 'form_edit_user.php');
  bindRedirect('#edit2', 'form_edit_film.php');
  bindRedirect('#edit3', 'form_edit_cinema.php');
});
