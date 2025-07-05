$(document).ready(function () {
  function updateTotal() {
    let baseTicketPrice = parseInt($('.summary').data('ticket-price')) || 0;
    let totalCombo = 0;

    $('.combo-box').each(function () {
      let comboPrice = parseInt($(this).data('price')) || 0;
      let quantity = parseInt($(this).find('.quantity-display').text()) || 0;
      totalCombo += comboPrice * quantity;

      $(this).find('.minus').prop('disabled', quantity == 1);
    });

    let total = baseTicketPrice + totalCombo;
    $('#total-amount').text(total.toLocaleString('vi-VN') + 'đ');
  }

  $('#agreeTerms').change(function () {
    $('#confirmBtn').prop('disabled', !this.checked);
  });

  $('.back-btn').click(function () {
    window.location.href = 'chonbapnuoc.php';
  });

  $('#confirmBtn').click(function () {
    // Giả sử các biến này được khai báo toàn cục hoặc lấy từ DOM
    const seats = $('#seats-data').val(); // hoặc dữ liệu từ sessionStorage/localStorage
    const showtime_id = $('#showtime-id').val();
    const total_price = $('#total-amount').text().replace(/[^\d]/g, ''); // loại bỏ 'đ'
    const foods = [];

    $('.combo-box').each(function () {
      let id = $(this).data('id');
      let quantity = parseInt($(this).find('.quantity-display').text()) || 0;
      if (quantity > 0) {
        foods.push({ id, quantity });
      }
    });

    const $form = $('<form>', {
      method: 'POST',
      action: 'maQRthanhtoan.php'
    });

    $form.append($('<input>', { type: 'hidden', name: 'seats', value: SEATS }));
    $form.append($('<input>', { type: 'hidden', name: 'showtime_id',  value: typeof SHOWTIME_ID !== 'undefined' ? SHOWTIME_ID : '' }));
    $form.append($('<input>', { type: 'hidden', name: 'total_price', value: total_price }));
    $form.append($('<input>', { type: 'hidden', name: 'foods', value: JSON.stringify(foods) }));

    $('body').append($form);
    $form.submit();
  });

  updateTotal();
});
