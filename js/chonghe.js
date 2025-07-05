$(document).ready(function () {
  let selectedSeats = [];

  function calculateTotal() {
    let total = 0;
    selectedSeats.forEach(s => {
      total += BASE_TICKET_PRICE + s.extra;
    });
    return total;
  }

  $('.seat-available').on('click', function () {
    const $seat = $(this);
    const seatCode = $seat.text().trim();
    const isSelected = $seat.hasClass('seat-selected');
    const extraPrice = parseInt($seat.data('price')) || 0;

    if (isSelected) {
      $seat.removeClass('seat-selected');
      selectedSeats = selectedSeats.filter(s => s.code !== seatCode);
    } else {
      $seat.addClass('seat-selected');
      selectedSeats.push({ code: seatCode, extra: extraPrice });
    }

    // Cập nhật danh sách ghế hiển thị
    $('#selected-seats-list').text(
      selectedSeats.length > 0 ? selectedSeats.map(s => s.code).join(', ') : 'Không có'
    );

    // Cập nhật tổng tiền hiển thị
    const total = calculateTotal();
    $('#ticket-total').text(total.toLocaleString('vi-VN') + ' đ');
  });

  $('.button-continute').on('click', function () {
    if (selectedSeats.length === 0) {
      alert("Vui lòng chọn ít nhất một ghế.");
      return;
    }

    const total = calculateTotal(); // ✅ Lấy tổng tiền từ hàm

    const form = $('<form>', {
      method: 'POST',
      action: 'chonbapnuoc.php'
    });

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
      value: total
    }).appendTo(form);

    form.appendTo('body').submit();
  });
});
