$(document).ready(function () {
// Hàm cập nhật tính tổng
  function updateTotal(){
    let total = 0;
    $('.combo-item').each(function () {
    const priceText = $(this).find('.price').text().replace(/[^\d]/g, '');
    const price = parseInt(priceText) || 0; // nếu không phải số thì gán 0
    const quantity = parseInt($(this).find('input[type="number"]').val());
    // Kiểm tra tính hợp lệ
    if (!isNaN(quantity) && quantity >= 0) {
    total += price * quantity;
    }
    });
    $('#total-price').text(total.toLocaleString('vi-VN') + 'đ');
  }

  // Nếu người dùng nhập số trực tiếp
  $('input[type="number"]').on('input', function () {
  updateTotal();
  });

  $(document).ready(function () {
    // Xử lý nút tăng
    $('.plus').click(function () {
      const input = $(this).siblings('input');
      let currentValue = parseInt(input.val());
      if (currentValue >= 0) {
        input.val(currentValue + 1);
        updateTotal();
      }
    });

    // Xử lý nút giảm: không giảm dưới 0
    $('.minus').click(function () {
      const input = $(this).siblings('input');
      let currentValue = parseInt(input.val());
      if (currentValue > 0) {
        input.val(currentValue - 1);
        updateTotal();
      }
    });
  })

  // Khi click vào nút "Thay đổi" của nước lẻ
  $('.select').click(function() {
    const buttonId = $(this).attr('id');
    
  // Nếu là nút của nước lẻ (ví dụ: changN04)
  if (buttonId === 'changN04') {
    $('#popup-nuoc').fadeIn();
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
    updateTotal();
    }
  // Ẩn popup
  $('#popup-nuoc').fadeOut();
  });
});

