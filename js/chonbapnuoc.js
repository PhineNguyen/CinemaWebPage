$(document).ready(function () {
  // Ẩn popup ban đầu
  $('#popup-nuoc, #popup-bap, #popup-combo').hide();

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


// sự kiện cho combo
$(document).ready(function () {
  // Tăng giảm số lượng combo
  $('.plus').click(function () {
    let input = $(this).siblings('input[type="number"]');
    let current = parseInt(input.val()) || 0;
    input.val(current + 1);
  });

  $('.minus').click(function () {
    let input = $(this).siblings('input[type="number"]');
    let current = parseInt(input.val()) || 0;
    if (current > 0) input.val(current - 1);
  });

  // Mở popup khi click "Thay đổi"
  $('.select').click(function () {
    const comboItem = $(this).closest('.combo-item');
    const comboType = parseInt(comboItem.data('combo')); // 1 hoặc 2 người
    const quantity = parseInt(comboItem.find('input[type="number"]').val()) || 0;

    if (quantity === 0) {
      alert("Vui lòng chọn số lượng combo trước.");
      return;
    }

    const requiredBap = quantity; // luôn bằng số combo
    const requiredNuoc = comboType === 1 ? quantity : quantity * 2;

    // Reset popup
    $('#popup-combo input[name="vi_bap"]').prop('checked', false);
    $('#popup-combo input[name="nuoc"]').prop('checked', false).prop('disabled', false);

    // Lưu số lượng cần chọn vào data attribute
    $('#popup-combo').data('requiredBap', requiredBap);
    $('#popup-combo').data('requiredNuoc', requiredNuoc);

    // Hiện popup
    $('#popup-combo').show();
  });

  // Giới hạn checkbox nước được chọn
  $('#popup-combo input[name="nuoc"]').change(function () {
    const max = $('#popup-combo').data('requiredNuoc') || 1;
    const checked = $('#popup-combo input[name="nuoc"]:checked').length;

    if (checked >= max) {
      $('#popup-combo input[name="nuoc"]').not(':checked').prop('disabled', true);
    } else {
      $('#popup-combo input[name="nuoc"]').prop('disabled', false);
    }
  });

  // Xác nhận popup
  $('.close-popup').click(function () {
    const bapSelected = $('#popup-combo input[name="vi_bap"]:checked').length;
    const nuocSelected = $('#popup-combo input[name="nuoc"]:checked').length;

    const bapNeed = $('#popup-combo').data('requiredBap');
    const nuocNeed = $('#popup-combo').data('requiredNuoc');

    if (bapSelected !== 1) {
      alert("Vui lòng chọn 1 vị bắp (áp dụng cho tất cả combo).");
      return;
    }

    if (nuocSelected !== nuocNeed) {
      alert("Cần chọn đúng " + nuocNeed + " loại nước.");
      return;
    }

    alert("Đã chọn thành công!\n- " + bapNeed + " bắp\n- " + nuocNeed + " nước");
    $('#popup-combo').hide();
  });
});




