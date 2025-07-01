$(document).ready(function(){
    function updateTotal(){
        
    }

    // Xử lý nút tăng giảm
    $('.plus').click(function() {
      let display = $(this).siblings('.quantity-display');
      let value = parseInt(display.text());
      display.text(value + 1);
    });

    $('.minus').click(function() {
      let display = $(this).siblings('.quantity-display');
      let value = parseInt(display.text());
      if (value > 1) {
        display.text(value - 1);
      }
    });

    // Nút quay lại
  $('.back-btn').click(function(){
    window.location.href = 'chonbapnuoc.php';
  })

  // Nút tiếp tục
  $('.confirm-btn').click(function(){
    window.location.href = 'maQRthanhtoan.php';
  })
})