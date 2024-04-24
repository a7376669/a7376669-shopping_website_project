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
<style>
    html,
    body {
        margin: 0;
        padding: 0;
    }
</style>

<body style="background-image: url(img/index3-2.jpg);background-position: right bottom; background-size: cover; background-repeat: repeat; background-attachment: fixed;">
    <?php
    //判斷是否有登入
    if (!isset($_SESSION['account_temp']) | !isset($_SESSION['pwd_temp'])) {
        unset($_SESSION['mycar']);
        echo "<script>Swal.fire({
            position: 'inherit',
            icon: 'warning',
            title: '請先登入會員',
            showConfirmButton: false,
            timer: 1500,
           })</script>";
        header("Refresh:1.8;url=http://localhost:8081/New%20site/login.php");
    }
    @$arr = $_SESSION["mycar"];
    if (isset($_POST['del'])) {
        unset($_SESSION['mycar']);
    }
    if (isset($_POST['esc'])) {
        echo "<script>Swal.fire({
            position: 'inherit',
            icon: 'success',
            title: '結帳成功',
            showCancelButton: false,
            timer:1000})</script>";
        header("Refresh:1.5;url=http://localhost:8081/New%20site/inde.php");
    }
    if (isset($_POST['logout']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        unset($_SESSION['account_temp']);
        unset($_SESSION['pwd_temp']);
        echo "<script>Swal.fire({
            position: 'inherit',
            icon: 'warning',
            title: '登出成功',
            showCancelButton: false,
            timer:1000})</script>";
        header("Refresh:1.5;url=http://localhost:8081/New%20site/inde1.php");
    }
    ?>
    <form action="" method="POST">
        <div class="text-center text-md-right py-0" style="background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed; width:100%;overflow-x:hidden; ">
            <div class="row" style="margin: 50px auto;">
                <div class="col-md-4">
                    <a href="inde1.php">
                        <h1 class="display-4 text-warning" ;=""><span class="oi oi-home"></span> 首頁 </h1>
                    </a>
                    <div class="col-md-12">
                        <p style="font-size: 30px; color: GhostWhite;font-weight:bold;">購物車</p>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <ul class="nav nav-pills">
                        <li class="nav-item nav-link " style="background-color:transparent;font-size:20px;font-weight:bold;border-style:none;color:white"> 你好 <?php echo @$_SESSION['account_temp'] ?></li>
                        <li class="nav-item"> <button name="logout" style="background-color:transparent;font-size:20px;font-weight:bold;border-style:none;" class="nav-link text-warning">登出</button> </li>
                        <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" href="inde.php" class="nav-link text-warning">商品</a> </li>
                        <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" class="nav-link text-warning" href="index1.html">關於我們</a> </li>
                        <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" href="index2.html" class="nav-link text-warning">聯繫我們</a> </li>
                        <li><a href="index5.php" style="font-size:20px; font-weight:bold;" class="nav-link text-warning">購物車</a></li>
                        <a class="dropdown-toggle text-center" style="margin:auto 5px auto 5px;" data-toggle="dropdown" href="#">
                            <li class="oi oi-person display-5 text-warning">會員專區</li>
                        </a>
                        <ul class="dropdown-menu" style="background-color:#000000">
                            <li class="nav-item"> <a style="font-size: 20px; font-weight:bold" href="Upload.php" class="nav-link text-warning">上架商品</a> </li>
                            <li><a href="product.php" style="font-size:20px; font-weight:bold;" class="nav-link text-warning">管理商品</a></li>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center py-6 py-5" style="background-position: right bottom;background-size: cover;	background-repeat: repeat; background-attachment: fixed; width:100%;overflow-x:hidden;">
            <div class="row">
                <div class="col-md-8 text-center" style=" margin: 0 auto;">
                    <div class="row">
                        <div class="col-md-4 text-secondary">
                            <h3 class="text-white">商品</h3>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <h3 class="text-white">單價</h3>
                        </div>
                        <div class="col-md-2">
                            <h3 class="text-white">數量</h3>
                        </div>
                        <div class="col-md-2">
                            <h3 class="text-white">小計 </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 " style=" margin: 0 auto;">
                    <?php if (isset($_SESSION['mycar'])) { ?>
                        <?php foreach ($arr as $a) { ?>
                            <div class="row">
                                <div class="col-md-4 text-center" style=" margin: 0 auto;">
                                    <img class=" text-center img-fluid d-block" style=" margin: 0 auto;" src="<?php echo $a['pimg']  ?>" width="100" height="100">
                                    <h3 class="text-white"><?php echo $a['pname'] ?></h3>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2" style=" margin:auto;">
                                    <h3 class="text-white text-center"><?php echo $a['price'] ?></h3>
                                    <input type="hidden" name="price" value="<?php echo $a['price'] ?>">
                                </div>
                                <div class="col-md-2" style=" margin:auto;">
                                    <h3 class="text-white text-center" style=" margin:auto;">
                                        <select name="qty" id="<?php echo (($a['pid']) + 100); ?>" onchange="document.getElementById('<?php echo $a['pid']; ?>').innerHTML = document.getElementById('<?php echo (($a['pid']) + 100); ?>').value*<?php echo $a['price'] ?>">
                                            <script>
                                            </script>
                                            <?php for ($i = 0; $i < $a['pqty']; $i++) { ?>
                                                <option value="<?php echo ($i + 1) ?>"><?php echo ($i + 1) ?></option>
                                            <?php } ?>
                                        </select>
                                    </h3>
                                </div>
                                <div class="col-md-2 text-center" style=" margin: auto;">
                                    <h3 class="text-white" id="<?php echo $a['pid']; ?>"><?php echo 1 * $a['price'] ?></h3>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="text-center py-6 py-5" style="	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;width:100%;overflow-x:hidden;">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1">
                    <h3 class="text-white" id="4"></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 text-center" style=" margin: 0 auto;">
                <div class="row">
                    <div class="col-md-4 text-secondary">
                        <button type="submit" name="del" class="btn btn-primary" style="font-size:20px">清除購物車</button>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
        <div class="text-center py-6 py-5" style="	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;width:100%;overflow-x:hidden;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" name="esc" style="font-size:25px">結帳</button>
                </div>
            </div>
        </div>
        <div class="py-0" style="	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;width:100%;overflow-x:hidden;  ">
            <footer class="text-muted py-5">
                <div class="container">
                    <p class="float-right">
                        <a style="font-size: 20px; color: GhostWhite;" href="#">到最上面</a>
                    </p>
                    <p style="font-size: 20px; color: GhostWhite;font-weight:bold;">有甚麼問題請聯絡4A690022@stust.edu.tw&nbsp; <br>沒什麼問題 就不要來煩我 謝謝配合 &gt;_0 。</p>
                </div>
            </footer>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </div>
    </form>
</body>
<script>
</script>

</html>