$(document).ready(function () {
    let seconds = 5;

    const countdown = setInterval(function () {
      seconds--;

      if (seconds <= 0) {
        clearInterval(countdown);
        window.location.href = "Home.php"; // Chuyển về trang chủ
      }
    }, 1000);
  });