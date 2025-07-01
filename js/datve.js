// Mở popup khi bấm nút "Thêm"
$('#btnOpenModal').on('click', function () {
  $('#popupModal').fadeIn();
  $('#modalContent').load('form_add_ticket.php');
});

// Đóng popup khi bấm nút "x"
$(document).on('click', '#btnCloseModal', function () {
  $('#popupModal').fadeOut();
});

// Xử lý gửi form thêm vé
$(document).on('submit', '#formAddTicket', function (e) {
  e.preventDefault();
  $.post('add_ticket_process.php', $(this).serialize(), function (res) {
    alert(res);
    $('#popupModal').fadeOut();
    location.reload(); // làm mới lại bảng
  });
});
