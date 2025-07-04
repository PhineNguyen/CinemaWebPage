
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

    const form = $('<form>', {
      method: 'POST',
      action: 'thongTinVe.php'
    });
    $('<input>').attr({
    type: 'hidden',
    name: 'foods',
    value: JSON.stringify(foods)
    }).appendTo(form);

    $('<input>').attr({
      type: 'hidden',
      name: 'seats',
      value: selectedSeats.map(s => s.code).join(',')
    }).appendTo(form);

    $('<input>').attr({
      type: 'hidden',
      name: 'showtime_id',
      value: SHOWTIME_ID
    }).appendTo(form);

    $('<input>').attr({
      type: 'hidden',
      name: 'total_price', // nên dùng tên rõ ràng
      value: TOTAL
    }).appendTo(form);

    $('<input>').attr({
      type: 'hidden',
      name: 'ticket_info', 
      value: typeof TICKET_INFOR !== 'undefined' ? TICKET_INFOR : ''
    }).appendTo(form);

    form.appendTo('body').submit();
  });
  
});