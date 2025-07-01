
  $(document).ready(function () {
    let totalSeconds = 5; // 5s 

    const countdown = setInterval(function () {
      let minutes = Math.floor(totalSeconds / 60);
      let seconds = totalSeconds % 60;
      let formattedTime = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

      $('.timer').text(formattedTime);

      totalSeconds--;

      if (totalSeconds < 0) {
        clearInterval(countdown);
        window.location.href = 'thongTinVe.php';
      }
    }, 1000); //đơn vị ms

  });

function closeQR() {
    window.location.href = 'thanhtoan.php';
}