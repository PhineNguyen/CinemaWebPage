$(document).ready(function () {
  let totalSeconds = 5;

  const countdown = setInterval(function () {
    let minutes = Math.floor(totalSeconds / 60);
    let seconds = totalSeconds % 60;
    let formattedTime = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    $('.timer').text(formattedTime);

    totalSeconds--;

    if (totalSeconds < 0) {
      clearInterval(countdown);

      // ✅ Giả sử bạn có biến toàn cục SEATS và SHOWTIME_ID hoặc lấy từ DOM
      const seats = typeof SEATS !== 'undefined' ? SEATS : $('#seats-data').val() || '';
      const showtime_id = typeof SHOWTIME_ID !== 'undefined' ? SHOWTIME_ID : $('#showtime-id').val() || '';
      const total_price = $('#total-amount').text().replace(/[^\d]/g, '') || 0;

      // ✅ Lấy danh sách foods từ DOM (nếu có combo)
      const foods = [];
      $('.combo-box').each(function () {
        const name = $(this).data('name') || '';
        const qty = parseInt($(this).data('qty')) || 0;
        const flavor = $(this).data('flavor') || '';
        const size = $(this).data('size') ? $(this).data('size').split(',') : [];

        if (qty > 0) {
          foods.push({ name, qty, flavor, size });
        }
      });

      // ✅ Đổi ảnh QR thành ảnh thành công
      $('img').attr('src', 'pic/qrcode-success.png');
      alert('Thanh toán thành công!');

      // ✅ Gửi form ẩn
      const $form = $('<form>', {
        method: 'POST',
        action: 'thongTinVe.php'
      });

      $form.append($('<input>', { type: 'hidden', name: 'seats', value: seats }));
      $form.append($('<input>', { type: 'hidden', name: 'showtime_id', value: showtime_id }));
      $form.append($('<input>', { type: 'hidden', name: 'total_price', value: total_price }));
      $form.append($('<input>', { type: 'hidden', name: 'foods', value: JSON.stringify(foods) }));

      $('body').append($form);
      $form.submit();
    }
  }, 1000);
});
