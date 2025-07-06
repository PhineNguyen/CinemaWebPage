$(document).ready(function () {
  let selectedSeats = [];

  // Tính tổng tiền
  function calculateTotal() {
    let total = 0;
    selectedSeats.forEach(s => {
      total += BASE_TICKET_PRICE + s.extra;
    });
    return total;
  }

  // Xử lý chọn / bỏ chọn ghế
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

    $('#selected-seats-list').text(
      selectedSeats.length > 0 ? selectedSeats.map(s => s.code).join(', ') : 'Không có'
    );

    const total = calculateTotal();
    $('#ticket-total').text(total.toLocaleString('vi-VN') + ' đ');
  });

  // Bấm nút "Tiếp tục"
  $('.button-continute').on('click', function () {
    if (selectedSeats.length === 0) {
      alert("Vui lòng chọn ít nhất một ghế.");
      return;
    }

    const $button = $(this);
    $button.prop('disabled', true).text('Đang xử lý...');

    const seatDataForAjax = selectedSeats.map(codeObj => {
      const code = codeObj.code;
      return {
        row: code.match(/[A-Z]/i)[0],
        number: parseInt(code.match(/\d+/)[0])
      };
    });

    const formData = new FormData();
    formData.append('action', 'book_seats');
    formData.append('showtime_id', SHOWTIME_ID);
    formData.append('seats', JSON.stringify(seatDataForAjax));

    // Gửi yêu cầu đặt ghế
    fetch(window.location.href, {
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(msg => {
      console.log(msg);

      // ✅ Hiệu ứng khóa ghế
      selectedSeats.forEach(s => {
        $(`.seat:contains(${s.code})`)
          .removeClass('seat-selected seat-available')
          .addClass('seat-booked')
          .prop('disabled', true);
      });

      alert("Đặt ghế thành công!");

      // ✅ Gửi sang chonbapnuoc.php
      const total = calculateTotal();

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
        name: 'total_price',
        value: total
      }).appendTo(form);

      form.appendTo('body').submit();
    })
    .catch(err => {
      alert('Lỗi đặt ghế!');
      console.error(err);
      $button.prop('disabled', false).text('Tiếp tục');
    });
  });
});
