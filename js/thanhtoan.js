$(document).ready(function(){
    $(document).ready(function () {
    // Xử lý nút tăng
    $('.plus').click(function () {
      const input = $(this).siblings('input');
      let currentValue = parseInt(input.val());
      if (currentValue >= 1) {
        input.val(currentValue + 1);
      }
    });

    // Xử lý nút giảm
    $('.minus').click(function () {
      const input = $(this).siblings('input');
      let currentValue = parseInt(input.val());
      if (currentValue > 1) {
        input.val(currentValue - 1);
      }
    });
  })
})