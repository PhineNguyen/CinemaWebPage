// click button chuyển màu 
$(document).ready(function(){
    $(".actions button").hover(
        function() {
            $(this).addClass("button-hover");
        },
        function() {
            $(this).removeClass("button-hover");
        }
    );
});
//Mở form addfilm
function openAddForm() {
  document.body.style.overflow = 'hidden';        // Chặn scroll nền
  document.getElementById("addFormModal").style.display = "flex";  // Hiện form với flex
}

function closeAddForm() {
  document.body.style.overflow = 'auto';          // Bật lại scroll nền
  document.getElementById("addFormModal").style.display = "none";  // Ẩn form
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

// sửa film
function openEditForm() {
    const checkboxes = document.querySelectorAll(".movie-checkbox:checked");

    if (checkboxes.length === 0) {
        alert("Vui lòng chọn 1 phim để sửa.");
        return;
    }

    if (checkboxes.length > 1) {
        alert("Chỉ được chọn 1 phim để sửa.");
        return;
    }

    const row = checkboxes[0].closest("tr");
    const cells = row.querySelectorAll("td");

    // Gán dữ liệu vào form
    document.getElementById("edit-title").value = cells[1].textContent.trim();
    document.getElementById("edit-image").value = cells[2].querySelector("img").src;

    // Chuyển đổi ngày phát hành từ dd-mm-yyyy → yyyy-mm-dd
    const rawDate = cells[3].textContent.trim(); // ví dụ: "15-06-2023"
    const parts = rawDate.split("-");
    if (parts.length === 3) {
        const formattedDate = `${parts[2]}-${parts[1]}-${parts[0]}`; // yyyy-mm-dd
        document.getElementById("edit-release").value = formattedDate;
    } else {
        document.getElementById("edit-release").value = ""; // fallback
    }

    document.getElementById("edit-genre").value = cells[4].textContent.trim();
    document.getElementById("edit-director").value = cells[5].textContent.trim();
    document.getElementById("edit-actor").value = cells[6].textContent.trim();
    document.getElementById("edit-age").value = cells[7].textContent.trim();
    document.getElementById("edit-status").value = cells[8].textContent.trim();

    // Nếu hàng có attribute data-id thì lấy luôn id (nếu bạn đã thêm trong PHP)
    const movieId = row.getAttribute("data-id");
    if (movieId) {
        document.getElementById("edit-id").value = movieId;
    }

    document.getElementById("editFormModal").style.display = 'flex';
}
function closeEditForm() {
    document.getElementById('editFormModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('editFormModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}


// tìm film

$(document).ready(function () {
    $('.search-box').on('keyup', function () {
        clearTimeout($.data(this, 'timer'));
        const wait = setTimeout(() => {
            $('.search-form').submit();
        }, 500); // Đợi 500ms sau khi gõ mới gửi
        $(this).data('timer', wait);
    });
});


