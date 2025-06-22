$(document).ready(function () {
  // Ẩn popup ban đầu
  $('#popup-nuoc, #popup-bap').hide();

  // Xử lý nút +
  $('.plus').click(function () {
    let input = $(this).siblings('input[type="number"]');
    let current = parseInt(input.val()) || 0;
    input.val(current + 1);
  });

  // Xử lý nút -
  $('.minus').click(function () {
    let input = $(this).siblings('input[type="number"]');
    let current = parseInt(input.val()) || 0;
    if (current > 0) input.val(current - 1);
  });

  // Xử lý khi click nút "Chọn loại nước" hoặc "Chọn vị bắp"
  $('.select').click(function () {
    const container = $(this).closest('.combo-item');
    const input = container.find('input[type="number"]');
    let value = parseInt(input.val()) || 0;

    // Nếu là 0 thì tự tăng lên 1
    if (value === 0) {
      input.val(1);
    }

    // Hiển thị popup phù hợp
    const buttonText = $(this).text().toLowerCase();
    if (buttonText.includes("loại nước")) {
      $('#popup-nuoc').css('display', 'flex');
    } else if (buttonText.includes("vị bắp")) {
      $('#popup-bap').css('display', 'flex');
    }
  });

   // Đóng popup khi nhấn "Xác nhận"
  // Khi người dùng chọn xong loại nước và nhấn xác nhận
$('.close-popup').click(function () {
  // Lấy radio được chọn
  const selected = $('input[name="loai_nuoc"]:checked');

  if (selected.length > 0) {
    const name = selected.data('name');
    const price = selected.data('price');
    const img = selected.data('img');

    // Tìm phần tử combo hiện tại (combo-item đang mở popup)
    const combo = $('#nuoc'); // Nếu nhiều combo, cần thêm cách xác định đúng cái đang mở

    combo.find('h3').text(name); // Cập nhật tên
    combo.find('.price').text(price); // Cập nhật giá
    combo.find('img').attr('src', img); // Cập nhật ảnh
    combo.find('img').attr('alt', name); // Thay alt ảnh (tùy chọn)
  }

  $(this).closest('.popup-form').fadeOut();
});

    // Có thể thêm xử lý vị bắp ở đây sau nếu cần
    $('.close-popup').click(function () {
  // Lấy radio được chọn
  const selected = $('input[name="vi_bap"]:checked');

  if (selected.length > 0) {
    const name = selected.data('name');
    const price = selected.data('price');

    // Tìm phần tử combo hiện tại (combo-item đang mở popup)
    const combo = $('#bap'); // Nếu nhiều combo, cần thêm cách xác định đúng cái đang mở

    combo.find('h3').text(name); // Cập nhật tên
    combo.find('.price').text(price); // Cập nhật giá
  }

  $(this).closest('.popup-form').fadeOut();
});

});
