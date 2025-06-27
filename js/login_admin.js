$(document).ready(function () {
    // Nổi bật viền khi nhập
    $('input').on('focus', function () {
        $(this).css('border-color', '#007BFF');
    });

    $('input').on('blur', function () {
        $(this).css('border-color', '#ccc');
    });

    // Kiểm tra form khi submit
    $('form').on('submit', function (e) {
        const email = $('input[name="email"]').val().trim();
        const password = $('input[name="password"]').val().trim();

        // Kiểm tra rỗng
        if (email === '' || password === '') {
            alert("Vui lòng nhập đầy đủ Email và Mật khẩu.");
            e.preventDefault();
            return;
        }

        // Kiểm tra định dạng email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Email không hợp lệ.");
            e.preventDefault();
        }
    });

    // (Tuỳ chọn) Thêm ẩn/hiện mật khẩu nếu có icon
    const toggleBtn = $('#toggle-password');
    if (toggleBtn.length > 0) {
        toggleBtn.on('click', function () {
            const passInput = $('input[name="password"]');
            const type = passInput.attr('type') === 'password' ? 'text' : 'password';
            passInput.attr('type', type);

            // Đổi icon (nếu dùng FontAwesome)
            $(this).toggleClass('fa-eye fa-eye-slash');
        });
    }
});
