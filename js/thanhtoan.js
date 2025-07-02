$(document).ready(function () {
  function updateTotal() {
    let baseTicketPrice = parseInt($('.summary').data('ticket-price')) || 0;
    let totalCombo = 0;

    $('.combo-box').each(function () {
      let comboPrice = parseInt($(this).data('price')) || 0;
      let quantity = parseInt($(this).find('.quantity-display').text()) || 0;
      totalCombo += comboPrice * quantity;

      // vô hiệu hóa nút trừ 
      $(this).find('.minus').prop('disabled', quantity == 1);
    });

    let total = baseTicketPrice + totalCombo;
    $('#total-amount').text(total.toLocaleString('vi-VN') + 'đ');
  }

  $('.plus').click(function () {
    let display = $(this).siblings('.quantity-display');
    let value = parseInt(display.text());
    display.text(value + 1);
    updateTotal();
  });

  $('.minus').click(function () {
    let display = $(this).siblings('.quantity-display');
    let value = parseInt(display.text());
    if (value > 1) {
      display.text(value - 1);
      updateTotal();
    }
  });
  // Xử lý checkbox
  $('#agreeTerms').change(function () {
    $('#confirmBtn').prop('disabled', !this.checked);
  });

  $('.back-btn').click(function () {
    window.location.href = 'chonbapnuoc.php';
  });

  $('#confirmBtn').click(function () {
    window.location.href = 'maQRthanhtoan.php';
  });

  updateTotal();
});