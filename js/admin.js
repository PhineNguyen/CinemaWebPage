$(document).ready(function() {
    // Ẩn menu mục lục khi load
    $(".mucluc").hide();

    // Click vào admin-profile thì hiện/tắt menu
    $(".admin-profile").on("click", function(e) {
        e.stopPropagation();
        $(".mucluc").slideToggle(200);
    });
    // Click ra ngoài thì ẩn menu
    $(document).on("click", function() {
        $(".mucluc").slideUp(200);
    });
    // Hover đổi màu chữ admin
    $(".admin-profile").hover(
        function() { $(this).css({"color":"#ffc107"}); },
        function() { $(this).css({"color":"white"}); }
    );
});
