$(document).ready(function () {
  const seatPrice = 50000;
  const vipPrice = 70000;
  const specialPrice = 100000;
  let selectedSeats = [];

  $('.seat-available').on('click', function () {
    const $seat = $(this);
    const seatCode = $seat.text().trim();
    const isSelected = $seat.hasClass('seat-selected');

    if (isSelected) {
      $seat.removeClass('seat-selected');
      selectedSeats = selectedSeats.filter(s => s !== seatCode);
    } else {
      $seat.addClass('seat-selected');
      selectedSeats.push(seatCode);
    }

    updateSummary();
  });

  function updateSummary() {
    let total = 0;
    selectedSeats.forEach(seat => {
      const $btn = $(`button:contains(${seat})`);
      const className = $btn.attr('class');

      if (className.includes('special')) total += specialPrice;
      else if (className.includes('vip')) total += vipPrice;
      else total += seatPrice;
    });

    // Cộng thêm giá combo từ localStorage nếu có
    let comboData = localStorage.getItem('comboData');
    let comboTotal = 0;
    if (comboData) {
      try {
        comboTotal = JSON.parse(comboData).total || 0;
      } catch (e) {}
    }

    $('#ticket-price').text(formatMoney(total) + ' đ');
    $('#ticket-total').text(formatMoney(total + comboTotal) + ' đ');
    $('#selected-seats-list').text(selectedSeats.length > 0 ? selectedSeats.join(', ') : 'Không có');
  }

  function formatMoney(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  $('.button-continute').on('click', function () {
    if (selectedSeats.length === 0) {
      alert("Vui lòng chọn ít nhất một ghế.");
      return;
    }

    const form = $('<form>', {
      method: 'POST',
      action: 'chonbapnuoc.php'
    });

    $('<input>').attr({
      type: 'hidden',
      name: 'seats',
      value: selectedSeats.join(',')
    }).appendTo(form);

    $('<input>').attr({
      type: 'hidden',
      name: 'showtime_id',
      value: SHOWTIME_ID, // Gán từ PHP sang JS
    }).appendTo(form);

    form.appendTo('body').submit();
  });
});
