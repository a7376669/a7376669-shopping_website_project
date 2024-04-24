<?php
include "single\connect.php";
?>
<!DOCTYPE html>
<html>

<head>
<title>註冊</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
    <link href="./open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.1.0/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.1.0/dist/sweetalert2.css">
</head>




<body style="overflow:hidden;background-image: url(img/background.jpg);">
<?php
@$uid = $_POST["uid"];
@$pwd = $_POST["pwd"];
if (isset($_POST['reg']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($uid != "" && $pwd != "" && isset($pwd) && isset($uid)) {
        $sql = "select * from user where name ='$uid'";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $pdo->query($sql);
        $attr = $sth->fetch();
        if ($uid == @$attr[1] && !empty($attr)) {
            echo "<script>Swal.fire({ㄑ
                position:'inherit',
                icon:'warning',
                title:'此帳號已被使用',
                showConfirmButton: false,
                timer: 1500,
            })</script>";
        } else {
            $sql = "insert into user(pwd,name) values('$pwd','$uid')";
            $res = $pdo->query($sql);
            echo "<script>Swal.fire({
                position: 'inherit',
                icon: 'success',
                title: '已成功註冊',
                text:'跳轉至登入頁面',
                showCancelButton: false,
                timer:1000})</script>";
            header("Refresh:1.1;url=http://localhost:8081/New%20site/login.php");
        }
    }
}
?>
    <form action="reg.php" method="post" onsubmit="return checkinput()">
        <div class="py-5 text-center text-md-right" style="background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed; width:100%; overflow:hidden;">
            <div class="row">
                <div class="col-md-3">
                    <a href="inde1.php">
                        <h1 class="display-4 text-warning" ;=""><span class="oi oi-home"></span> 回首頁 </h1>
                    </a>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-4">
                    <ul class="nav nav-pills">
                        <li class="nav-item"> <a style="font-size: 20px; font-weight:bold" href="login.php" class="nav-link text-warning">登入</a> </li>
                        <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" href="inde.php" class="nav-link text-warning">商品</a> </li>
                        <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" class="nav-link text-warning" href="index1.html">關於我們</a> </li>
                        <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" href="index2.html" class="nav-link text-warning">聯繫我們</a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="py-5 text-center" style="background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-6 col-10  p-5" style="background-color:rgb(192, 192, 192,0.7);border-radius:20px">
                        <h1 class="mb-4">建立你的帳號</h1>
                        <form>
                            <div class="form-group"> <input name="uid" type="email" class="form-control" placeholder="電子郵件" id="uid">
                                <small class="form-text text-muted text-left" name="small">您可以使用英文字母、數字</small></div>
                            <div class="form-group mb-3"> <input name="pwd" type="password" class="form-control" placeholder="密碼" id="pwd">
                                <small class="form-text text-muted text-left">請使用5個字元以上的英文、數字</small></div>
                            <button type="submit" class="btn btn-primary" name="reg" style="font-size:25px">註冊</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div style="background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
            <footer style="padding-top: 4.5rem;padding-bottom: 4.5rem">
            </footer>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" style=""></script>
        </div>
        <!-- <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 20px;right:20px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:220px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo Free&nbsp;&nbsp;<img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16"></pingendo> -->
        <script>
            // function ontext() {
            // Swal.fire({
            //     position: 'inherit',
            //     icon: 'success',
            //     title: '成功提交',
            //     showConfirmButton: false,
            //     timer: 3000,

            //})
            // }

            function checkinput() {
                // 檢查登入帳號是否有特殊字元
                var re = /[^a-zA-Z0-9.-_]/;
                var okname = re.exec(document.getElementById("uid").value);
                if (okname) {
                    Swal.fire({
                        position: 'inherit',
                        icon: 'warning',
                        title: '帳號只允許英文、數字、底線',
                        showConfirmButton: false,
                        timer: 5000
                    })
                    // window.alert ( "只允許英文、數字、底線" );
                    document.getElementById("uid").focus();
                    return false;
                }
                var okname1 = re.exec(document.getElementById("pwd").value);
                if (okname1) {
                    Swal.fire({
                        position: 'inherit',
                        icon: 'warning',
                        title: '密碼只允許英文、數字、底線',
                        showConfirmButton: false,
                        timer: 5000
                    })
                    // window.alert ( "只允許英文、數字、底線" );
                    document.getElementById("pwd").focus();
                    return false;
                }
                // 開始檢查密碼長度是否正確？
                var pw1 = document.getElementById("pwd");
                var pw2 = document.getElementById("uid");
                if (pw2.value.length < 5 | pw2.value.length > 20) {
                    Swal.fire({
                        position: 'inherit',
                        icon: 'warning',
                        title: '帳號長度必須介於5~20字',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    // window.alert("密碼長度必須介於5~20字");
                    // document.getElementById("pwd").focus();
                    return false;
                }
                if (pw1.value.length < 5 | pw1.value.length > 20) {
                    Swal.fire({
                        position: 'inherit',
                        icon: 'warning',
                        title: '密碼長度必須介於5~20字',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    // window.alert("密碼長度必須介於5~20字");
                    // document.getElementById("pwd").focus();
                    return false;
                }
                // else {
                //     Swal.fire({
                //         position: 'inherit',
                //         icon: 'success',
                //         title: '成功提交',
                //         showConfirmButton: false,
                //         timer: 3000
                //     })
                // }
            }
        </script>
    </form>
</body>

</html>
