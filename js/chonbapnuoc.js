$(document).ready(function () {
  // Hàm định dạng tiền VNĐ
  function formatCurrency(amount) {
    return amount.toLocaleString('vi-VN') + 'đ';
  }

  // Cập nhật tổng tiền
  function updateTotal() {
    let total = 0;

    $('.combo-item').each(function () {
      const $item = $(this);
      const quantity = parseInt($item.find('.quantity-display').text());
      const priceText = $item.find('.combo-price').text().replace(/[^\d]/g, '');
      const price = parseInt(priceText);

      if (quantity > 0) {
        total += quantity * price;

        const $options = $item.next('.flavor-options');

        const sizeLon = $options.find('input[type="checkbox"][value="lon"]:checked');
        if (sizeLon.length) {
          const extra = parseInt(sizeLon.data('price')) || 0;
          total += extra * quantity;
        }

        const sizeNho = $options.find('input[type="checkbox"][value="nho"]:checked');
        if (sizeNho.length) {
          const name = $item.find('h3').text().trim();
          if (name === "Coca Cola") {
            const minus = parseInt(sizeNho.data('price')) || 0;
            total -= minus * quantity;
          }
        }
      }
    });

    $('#total-price').text(formatCurrency(total));
  }

  // Nút +
  $('.plus').click(function () {
    const $display = $(this).siblings('.quantity-display');
    const $minusBtn = $(this).siblings('.minus');

    let quantity = parseInt($display.text());
    quantity++;
    $display.text(quantity);

    if (quantity > 0) {
      $minusBtn.prop('disabled', false);
    }

    updateTotal();
  });

  // Nút -
  $('.minus').click(function () {
    const $display = $(this).siblings('.quantity-display');
    const $minusBtn = $(this);

    let quantity = parseInt($display.text());
    if (quantity > 0) {
      quantity--;
      $display.text(quantity);
    }

    if (quantity === 0) {
      $minusBtn.prop('disabled', true);
    }

    updateTotal();
  });

  // Thay đổi checkbox
  $('input[type="checkbox"][name="size_flavor"]').change(function () {
    updateTotal();
  });

  // Lần đầu
  updateTotal();

  // Nút quay lại
  $('#back').click(function () {
    window.location.href = 'Home.php';
  });

  // Nút tiếp tục
 // Nút tiếp tục
$('#continue').click(function (e) {
  e.preventDefault();

  // Thu thập dữ liệu món đã chọn
  let foods = [];
  $('.combo-item').each(function () {
    const $item = $(this);
    const qty = parseInt($item.find('.quantity-display').text());
    if (qty > 0) {
      let name = $item.find('h3').text().trim();
      let price = $item.find('.combo-price').text().replace(/[^\d]/g, '');
      let type = $item.attr('id');
      let flavor = '';
      let size = [];

      // Bắp: lấy hương vị
      if (type === 'bap') {
        flavor = $item.next('.flavor-options').find('input[name="bap_flavor"]:checked').val() || '';
      }
      // Nước: lấy size
      if (type === 'nuoc') {
        $item.next('.flavor-options').find('input[name="size_flavor"]:checked').each(function () {
          size.push($(this).val());
        });
      }

      foods.push({
        type: type,
        name: name,
        qty: qty,
        price: price,
        flavor: flavor,
        size: size
      });
    }
  });

  // Gửi qua form ẩn
  const form = $('<form>', {
    method: 'POST',
    action: 'thanhtoan.php'
  });

  $('<input>').attr({
    type: 'hidden',
    name: 'foods',
    value: JSON.stringify(foods)
  }).appendTo(form);

  // Gửi thêm dữ liệu ghế và suất chiếu
  $('<input>').attr({
    type: 'hidden',
    name: 'seats',
    value: typeof SEATS !== 'undefined' ? SEATS : ''
  }).appendTo(form);

  $('<input>').attr({
    type: 'hidden',
    name: 'showtime_id',
    value: typeof SHOWTIME_ID !== 'undefined' ? SHOWTIME_ID : ''
  }).appendTo(form);
  
  
  $('<input>').attr({
  type: 'hidden',
  name: 'ticket_price',
  value: typeof SEAT_PRICE !== 'undefined' ? SEAT_PRICE : ''// biến này lấy từ server hoặc giữ lại từ bước trước
}).appendTo(form);

  form.appendTo('body').submit();
});

});
