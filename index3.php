<?php
    include "single\connect.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
  <link href="./open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.1.0/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.1.0/dist/sweetalert2.css">
</head>

<body>
  <div class="py-5 text-center text-md-right" style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed; overflow:hidden">
    <div class="row">
      <div class="col-md-3">
        <a href="index.html">
          <h1 class="display-4 text-warning" ;=""><span class="oi oi-home"></span> 首頁 </h1>
        </a>
        <div class="col-md-12">
          <p style="font-size: 30px; color: GhostWhite;font-weight:bold;">登入</p>
        </div>
      </div>
      <div class="col-md-5"></div>
      <div class="col-md-4">
        <ul class="nav nav-pills">
          <li class="nav-item"> <a style="font-size: 20px; font-weight:bold" href="index3.html" class="nav-link text-warning">登入</a> </li>
          <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" href="index.html" class="nav-link text-warning">商品</a> </li>
          <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" class="nav-link text-warning" href="index1.html">關於我們</a> </li>
          <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" href="index2.html" class="nav-link text-warning">聯繫我們</a> </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="py-5 text-center" style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
    <div class="container">
      <div class="row">
        <div class="mx-auto col-md-6 col-10 bg-white p-5">
          <h1 class="mb-4" >登入</h1>
          <form>
            <div class="form-group"> <input type="email" class="form-control" placeholder="電話號碼/使用者名稱/Email" id="form9">
            <div class="form-group mb-3"> <input type="password" class="form-control" placeholder="密碼" id="form10"> <small class="form-text text-muted text-right">
              </small> <button onclick="ontext()" type="submit" class="btn btn-primary" style="font-size:20px">登入</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5" style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
    <footer class="text-muted py-5" style="">
      <div class="container">
        <p class="float-right">
          <a style="font-size: 20px; color: GhostWhite;" href="#">到最上面</a>
        </p>
        <p style="font-size: 20px; color: GhostWhite;font-weight:bold;">有甚麼問題請聯絡4A690022@stust.edu.tw&nbsp; <br>沒什麼問題 就不要來煩我 謝謝配合 &gt;_0 。</p>
      </div>
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

</html>
