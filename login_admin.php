<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="CSS/login_admin.css">
</head>
<body>
    <div class="khunglogin">
         <!--Khung tiêu đề-->
            <div class="ktieude">
                <div>LOGIN</div>
            </div>
        <form>
            <!--Khung nhập-->
            <div class="knhap">
                <div>
                    <input type="text" placeholder="Username"><br/>
                </div>
                <div>
                    <input type="password" placeholder="Password">
                </div>
            </div>
            <!--Khung chức năng-->
            <div class="kchucnang">
                <div>
                    <input type="checkbox"> Remember Me 
                </div>
                <div>
                    <a href="#">Forgot Password?</a>
                </div>
            </div>
            <!--Khung ngang submit-->
            <div class="ksubmit">
                <div>
                    <button type="button" onclick="signin()">Sign In</button>
                </div>
            </div>
            
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/login_admin"></script>
</body>
</html>