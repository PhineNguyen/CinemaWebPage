$(document).ready(function () {
    // Hover đổi màu
    $(".actions button").hover(
        function () {
            $(this).addClass("button-hover");
        },
        function () {
            $(this).removeClass("button-hover");
        }
    );

    // Mở form thêm phim
    window.openAddForm = function () {
        $("body").css("overflow", "hidden");
        $("#addFormModal").css("display", "flex");
    };

    // Đóng form thêm phim
    window.closeAddForm = function () {
        $("body").css("overflow", "auto");
        $("#addFormModal").hide();
    };

    // Đóng form khi click ra ngoài modal
    $(window).on("click", function (e) {
        if ($(e.target).is("#addFormModal")) {
            $("#addFormModal").hide();
        }
        if ($(e.target).is("#editFormModal")) {
            $("#editFormModal").hide();
        }
    });

    // Chọn tất cả checkbox
    $('button[name="chontatca"]').on("click", function () {
        const checkboxes = $(".movie-checkbox");
        const allChecked = checkboxes.length === checkboxes.filter(":checked").length;
        checkboxes.prop("checked", !allChecked);
    });

    $("#selectAllCheckbox").on("change", function () {
        $(".movie-checkbox").prop("checked", this.checked);
    });

    // Xóa phim
    

    // Sửa phim
    window.openEditForm = function () {
        const $checked = $(".movie-checkbox:checked");

        if ($checked.length === 0) {
            alert("Vui lòng chọn 1 phim để sửa.");
            return;
        }

        if ($checked.length > 1) {
            alert("Chỉ được chọn 1 phim để sửa.");
            return;
        }

        const $row = $checked.closest("tr");
        const $cells = $row.find("td");

        $("#edit-title").val($cells.eq(1).text().trim());
        $("#edit-image").val($cells.eq(2).find("img").attr("src"));

        const rawDate = $cells.eq(3).text().trim();
        const parts = rawDate.split("-");
        const formattedDate = parts.length === 3 ? `${parts[2]}-${parts[1]}-${parts[0]}` : "";
        $("#edit-release").val(formattedDate);

        $("#edit-genre").val($cells.eq(4).text().trim());
        $("#edit-director").val($cells.eq(5).text().trim());
        $("#edit-actor").val($cells.eq(6).text().trim());
        $("#edit-age").val($cells.eq(7).text().trim());
        $("#edit-status").val($cells.eq(8).text().trim());

        const movieId = $row.data("id");
        if (movieId) {
            $("#edit-id").val(movieId);
        }

        $("#editFormModal").css("display", "flex");
    };

    window.closeEditForm = function () {
        $("#editFormModal").hide();
    };

    // Tìm kiếm phim
    const $searchBox = $(".search-box");
    const $searchForm = $(".search-form");

    if ($searchBox.length && $searchForm.length) {
        let typingTimer;
        $searchBox.on("keyup", function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function () {
                $searchForm.submit();
            }, 500);
        });
    }
});
