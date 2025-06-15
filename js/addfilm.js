
//Mở form addfilm
function openAddForm() {
  document.body.style.overflow = 'hidden'; // Chặn scroll nền
  document.getElementById("addFormModal").style.display = "block";
}

function closeAddForm() {
  document.body.style.overflow = 'auto'; // Cho phép scroll lại
  document.getElementById("addFormModal").style.display = "none";
}

// Đóng form khi click ra ngoài
window.onclick = function(event) {
  const modal = document.getElementById("addFormModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// click all checkbox 
document.addEventListener('DOMContentLoaded', function () {
  // Nút chọn tất cả bên dưới form
  const selectAllButton = document.querySelector('button[name="chontatca"]');
  const checkboxes = () => document.querySelectorAll('.movie-checkbox');

  if (selectAllButton) {
    selectAllButton.addEventListener('click', () => {
      const allBoxes = checkboxes();
      const allChecked = [...allBoxes].every(cb => cb.checked);
      allBoxes.forEach(cb => cb.checked = !allChecked);
    });
  }

  // Checkbox ở thead (trong bảng)
  const masterCheckbox = document.getElementById('selectAllCheckbox');
  if (masterCheckbox) {
    masterCheckbox.addEventListener('change', function () {
      checkboxes().forEach(cb => cb.checked = this.checked);
    });
  }
});

// xóa
let selectedToDelete = [];

function openDeleteModal() {
  $("#deleteConfirmModal").show();
}

function closeDeleteModal() {
  $("#deleteConfirmModal").hide();
}

$(document).ready(function () {
  $("button[name='xoa']").on("click", function () {
    selectedToDelete = [];
    $(".movie-checkbox:checked").each(function () {
      selectedToDelete.push($(this).data("title"));
    });

    if (selectedToDelete.length === 0) {
      $(".modal-content p").text("Vui lòng chọn ít nhất một phim để xóa.");
      $("#confirmDeleteBtn").hide(); // Ẩn nút "Xóa" nếu không có phim
      $(".btn-cancel").hide();
    } else {
      $(".modal-content p").text("Bạn có chắc chắn muốn xóa các phim đã chọn không?");
      $("#confirmDeleteBtn").show();
      $(".btn-cancel").show();
    }

    openDeleteModal();
  });

  $("#confirmDeleteBtn").on("click", function () {
    $.ajax({
      url: "xoaphim.php",
      type: "POST",
      data: { ids: selectedToDelete },
      success: function (response) {
        if (response.trim() === "success") {
          location.reload();
        } else {
          alert("Lỗi xóa: " + response);
        }
      },
      error: function () {
        alert("Lỗi khi gửi yêu cầu xóa.");
      }
    });
    closeDeleteModal();
  });

  $("#selectAllCheckbox").on("change", function () {
    $(".movie-checkbox").prop("checked", $(this).prop("checked"));
  });
});


