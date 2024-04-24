<?php
include "single\connect.php";
?>
<!DOCTYPE html>
<html>

<head>
<title>登入</title>
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
  $sql = "select * from user where name ='$uid'";
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sth = $pdo->query($sql);
  $attr = $sth->fetch();
    if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($uid != "" && $pwd != ""&& isset($_POST['uid']) && isset($_POST['pwd'])){
        if ($attr && $uid == $attr[1] && $pwd == $attr[2]) {
          echo "<script>Swal.fire({
          position: 'inherit',
          icon: 'success',
          title: '你好，$uid',
          showConfirmButton: false,
          timer: 2000,
         })</script>";
          $_SESSION['account_temp'] = $uid;
          $_SESSION['pwd_temp'] = $pwd;
          header("Refresh:2.1;url=http://localhost:8081/New%20site/inde.php");
        } else {
          echo "<script>Swal.fire({
          position: 'inherit',
          icon: 'warning',
          title: '帳號或密碼錯誤',
          showConfirmButton: false,
          timer: 1500,
         })</script>";
        }
      } else {
        $_POST[]=array();
        echo "<script>Swal.fire({
        position: 'inherit',
        icon: 'warning',
        title: '請填入帳號或密碼',
        showConfirmButton: false,
        timer: 1500,
       })</script>";
      }
    }
  ?>
  <form action="" method="post">
    <div class="py-5 text-center text-md-right" style="	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed; width:100%;overflow-x:hidden; ">
      <div class="row">
        <div class="col-md-3">
          <a href="inde1.php">
            <h1 class="display-4 text-warning" ;=""><span class="oi oi-home"></span> 回首頁 </h1>
          </a>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-4">
          <ul class="nav nav-pills">
            <li class="nav-item"> <a style="font-size: 20px; font-weight:bold" href="reg.php" class="nav-link text-warning">註冊</a> </li>
            <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" href="inde.php" class="nav-link text-warning">商品</a> </li>
            <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" class="nav-link text-warning" href="index1.html">關於我們</a> </li>
            <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" href="index2.html" class="nav-link text-warning">聯繫我們</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="py-5 text-center" style="	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
      <div class="container">
        <div class="row">
          <div class="mx-auto col-md-6 col-10 p-5" style="background-color:rgb(192, 192, 192,0.7);border-radius:20px">
            <h1 class="mb-4">登入</h1>
            <form>
              <div class="form-group"> <input name="uid" type="email" class="form-control" placeholder="電子郵件" id="form9"> </div>
              <div class="form-group mb-3"> <input name="pwd" type="password" class="form-control" placeholder="密碼" id="form10"> <small class="form-text text-muted text-right">
                </small> </div> <button type="submit" name="login" class="btn btn-primary" style="font-size:25px">登入</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div style="	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
      <footer style="padding-top: 6rem;padding-bottom: 5.9rem">
      </footer>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" style=""></script>
    </div>
    <!-- <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 20px;right:20px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:220px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo Free&nbsp;&nbsp;<img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16"></pingendo> -->
    <script>
      function ontext() {
        Swal.fire({
          position: 'inherit',
          icon: 'success',
          title: '成功提交',
          showConfirmButton: false,
          timer: 5000
        })
      }
    </script>
</body>
</form>

</html>
