$(document).ready(function () {
  // Ẩn popup ban đầu
  $('#popup-nuoc, #popup-combo').hide();

  $(document).ready(function () {
    // Xử lý nút tăng: chỉ tăng tối đa 1
    $('.plus').click(function () {
      const input = $(this).siblings('input');
      let currentValue = parseInt(input.val());
      if (currentValue < 1) {
        input.val(currentValue + 1);
      }
      else{
        input.val(1);
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
  $('#chang2').click(function() {
    $('#popup-nuoc').fadeIn(); // Hiện form chọn nước
  });

  // Khi click nút "Xác nhận" trong form
  
  $('.close-popup').click(function() {
  // Lấy radio được chọn
    const selected = $('input[name="loai_nuoc"]:checked');
    if (selected.length > 0) {
    const name = selected.data('name');
    const price = selected.data('price');
    const img = selected.data('img');

  // Cập nhật thông tin trong phần nước lẻ
    const comboItem = $('#chang2').closest('.combo-item');
    comboItem.find('img').attr('src', img).attr('alt', name);
    comboItem.find('h3').text(name);
    comboItem.find('.price').text(price);
    }

  // Ẩn popup
  $('#popup-nuoc').fadeOut();

  });
});

