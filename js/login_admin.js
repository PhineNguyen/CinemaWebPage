
    //khi đăng nhập chuyển sang page_admin
    function signin(){
        window.location.href = "admin.php";
    }
    //Di chuyển chuột vào sign_in
    $(document).ready(function(){
        $("button").mouseover(function(){ 
            $("button").css({"background-color":"lightgrey"})
        });
        $("button").mouseleave(function(){ 
            $("button").css({"color":"black", "background-color":"white"})
        });
    });
