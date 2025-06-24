$(document).ready(function () {
  
  $(document).ready(function () {
    // Xử lý nút tăng
    $('.plus').click(function () {
      const input = $(this).siblings('input');
      let currentValue = parseInt(input.val());
      if (currentValue >= 0) {
        input.val(currentValue + 1);
      }
    });

    // Xử lý nút giảm: không giảm dưới 0
    $('.minus').click(function () {
      const input = $(this).siblings('input');
      let currentValue = parseInt(input.val());
      if (currentValue > 0) {
        input.val(currentValue - 1);
      }
    });
  })

  // Khi click vào nút "Thay đổi" của nước lẻ
  $('.select').click(function() {
    const buttonId = $(this).attr('id');
    
  // Nếu là nút của nước lẻ (ví dụ: changN04)
  if (buttonId === 'changN04') {
    $('#popup-nuoc').fadeIn();
  } else if(buttonId === 'changB03') {
    $('#popup-bap').fadeIn();
  } else if(buttonId === 'changCB01' || buttonId === 'changCB02'){
    currentComboButton = buttonId; // lưu lại nút đang chọn
    $('#popup-bap2').fadeIn();
  }
  });

  // Khi click nút "Xác nhận" trong form
  $('#b1').click(function() {
  // Lấy radio được chọn
    const selected = $('input[name="loai_nuoc"]:checked');
    if (selected.length > 0) {
    const name = selected.data('name');
    const price = selected.data('price');
    const img = selected.data('img');

  // Cập nhật thông tin trong phần nước lẻ
    const comboItem = $('#changN04').closest('.combo-item');
    comboItem.find('img').attr('src', img).attr('alt', name);
    comboItem.find('h3').text(name);
    comboItem.find('.price').text(price);
    }

  // Ẩn popup
  $('#popup-nuoc').fadeOut();

  });

  $('#b2').click(function() {
  // Lấy radio được chọn
    const selected = $('input[name="vi_bap"]:checked');
    if (selected.length > 0) {
    const name = selected.data('name');
    const price = selected.data('price');

  // Cập nhật thông tin trong phần bắp lẻ
    const comboItem = $('#changB03').closest('.combo-item');
    comboItem.find('h3').text(name);
    comboItem.find('.price').text(price);
    }

  // Ẩn popup
  $('#popup-bap').fadeOut();

  });

  $('#b3').click(function() {
  // Lấy radio được chọn
    const selected = $('input[name="vi_bap"]:checked');
    if (selected.length > 0 && currentComboButton !== null) {
    const name = selected.data('name');
  // Tìm phần combo tương ứng với nút được click trước đó
    const comboItem = $('#' + currentComboButton).closest('.combo-item');
    comboItem.find('.vibap').text(name);
    }
  // Ẩn popup
  $('#popup-bap2').fadeOut();

  });
  
});

