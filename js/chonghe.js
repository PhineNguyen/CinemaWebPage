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

    // ✅ Chuẩn bị dữ liệu đặt ghế
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

    // ✅ Gửi yêu cầu đặt ghế
    fetch(window.location.href, {
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(msg => {
      console.log(msg); // Thông báo đặt ghế thành công

      // ✅ Sau khi đặt ghế thành công → Gửi form sang chonbapnuoc.php
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
    });
  });
});
