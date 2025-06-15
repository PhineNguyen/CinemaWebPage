// Click chuột vô admin, menu xuất hiện
    $(document).ready(function(){
        $(".mucluc").hide(); 
        $(".admin-profile").click(function(){ 
            $(".mucluc").slideToggle(300); 
        });
    });
    //Di chuyển chuột vô admin, chữ đổi màu
    $(document).ready(function(){
        $(".admin-profile").mouseover(function(){ 
            $(".admin-profile").css({"color":"#ffc107"})
        });
        $(".admin-profile").mouseleave(function(){ 
            $(".admin-profile").css({"color":"white"})
        });
    });
    