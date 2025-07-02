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
    window.location.href = 'chonghe.php';
  });

  // Nút tiếp tục
  $('#continue').click(function () {
    window.location.href = 'thanhtoan.php';
  });
});
