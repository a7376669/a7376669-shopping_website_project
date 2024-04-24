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
    $o=$_SESSION['account_temp'];
    $sqlq = "select count(*) from userproduct where uid='$o'";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sthq = $pdo->query($sqlq);
    $attrq = $sthq->fetch(PDO::FETCH_NUM);
    $rowq = $attrq[0]; //27~31 取出有幾筆資料

    //判斷是否有登入
    if (!isset($_SESSION['account_temp']) | !isset($_SESSION['pwd_temp'])) {
        echo "<script>Swal.fire({
            position: 'inherit',
            icon: 'warning',
            title: '請先登入會員',
            showConfirmButton: false,
            timer: 1500,
           })</script>";
        header("Refresh:1.8;url=http://localhost:8081/New%20site/login.php");
    } else {
        $uid = $_SESSION['account_temp'];
        $sql = "select * from userproduct where uid ='$uid'";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $pdo->query($sql);
        $attr = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    if (isset($_POST['esc']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        for ($j = 0; $j < $rowq; $j++) {
            $a = $_POST["qty$j"];
            $b = $_POST["productprice$j"];
            $c = $_POST["description$j"];
            $d = $_POST["id$j"];
            @$e = $_POST["ckb$j"];
            if (isset($e)) {
                $sqld = "delete from userproduct where id=$d"; //58~59 個別帳號刪除 
                $sthd = $pdo->query($sqld);
                $sqldI = "delete from product where productid=$d"; //60~61 個別帳號刪除 
                $sthdI = $pdo->query($sqldI);
            }
            $sqlu = "update userproduct set qty='$a',price='$b',description='$c' where id=$d"; //63~64個別帳號更新
            $sthu = $pdo->query($sqlu);
            $sqluI = "update product set qty='$a',productprice='$b',description='$c' where productid=$d"; //65~66個別帳號更新
            $sthuI = $pdo->query($sqluI);
        }
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
                    <a href="inde.php">
                        <h1 class="display-4 text-warning" ;=""><span class="oi oi-home"></span> 首頁 </h1>
                    </a>
                    <div class="col-md-12">
                        <p style="font-size: 30px; color: GhostWhite;font-weight:bold;">商品管理</p>
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
                        <div class="col-md-2">
                            <h3 class="text-white">數量</h3>
                        </div>
                        <div class="col-md-2">
                            <h3 class="text-white">單價</h3>
                        </div>
                        <div class="col-md-2">
                            <h3 class="text-white">備註</h3>
                        </div>
                        <div class="col-md-2">
                            <h3 class="text-white">刪除</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 " style=" margin: 0 auto;">
                    <?php for ($i = 0; $i < $rowq; $i++) { ?>
                        <div class="row">
                            <div class="col-md-4 text-center" style=" margin: 0 auto;">
                                <img class=" text-center img-fluid d-block" style=" margin: 0 auto;" src="<?php echo "http://localhost:8081/New%20site" . $attr[$i]["proimg"]  ?>" width="100" height="100">
                                <h3 class="text-white"><?php echo $attr[$i]['proname'] ?></h3>
                            </div>
                            <div class="col-md-2" style=" margin:auto;">
                                <h3 class="text-white text-center" style=" margin:auto;">
                                    <select name="qty<?php echo $i ?>" id="<?php echo $attr[$i]['id'] ?>">
                                        <option value="<?php echo $attr[$i]['qty'] ?>">原本:<?php echo $attr[$i]['qty'] ?></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </h3>
                            </div>
                            <div class="col-md-2" style=" margin:auto;">
                                <input type="number" min="1" max="9999" value="<?php echo $attr[$i]['price'] ?>" name="productprice<?php echo $i ?>" onchange="addkk({$row.id})" id="num{$row.id}" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"></p>
                            </div>
                            <div class="col-md-2 text-center" style=" margin: auto;">
                                <textarea name="description<?php echo $i ?>" rows="4" cols="23"><?php echo $attr[$i]['description'] ?></textarea>
                            </div>
                            <div class="col-md-2 text-center" style=" margin: auto;">
                                <input type="checkbox"  name="ckb<?php echo $i ?>" value="<?php echo $i ?>">
                            </div>
                        </div>
                        <input type="hidden" name="id<?php echo $i ?>" value="<?php echo $attr[$i]['id'] ?>">
                    <?php } ?>
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
                    <button type="submit" class="btn btn-primary" name="esc" style="font-size:25px">修改</button>
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