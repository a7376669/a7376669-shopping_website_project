<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>首頁</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
    <meta name="description" content="Wireframe design of an album page by Pingendo">
    <meta name="keywords" content="Pingendo bootstrap example template wireframe album ">
    <meta name="author" content="Pingendo">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="wireframe.css">
    <link rel="stylesheet" href="./open-iconic/font/css/open-iconic-bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.1.0/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
    include "single\connect.php";
    $sql = "select * from product";
    $sql1 = "select count(*) from product";
    $sth = $pdo->query($sql); //搜尋全部產品
    $sth1 = $pdo->query($sql1); //總共有幾比資料
    $attr = $sth->fetchAll(PDO::FETCH_NUM);
    $attr1 = $sth1->fetch(PDO::FETCH_NUM);
    $rowc = $attr1[0]; //比數放入陣列
    @$sv = $_POST["shoppingcar"]; //第幾筆被加入購物車
    @$pid = ($_POST["proid"][$sv]);
    @$price = ($_POST["proprice"][$sv]);
    @$pname = ($_POST["proname"][$sv]);
    @$pqty = ($_POST["selectqty"][$sv]);
    @$pimg = ($_POST["proimg"][$sv]);
    @$test = ($_POST["dbqty"][$sv]);
    ob_start();
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
    }
    //購物車
    if (isset($_POST["shoppingcar"]) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST["shoppingcar"] | $_POST["shoppingcar"] == 0)) {
            $arr = $_SESSION["mycar"];
            if (is_array($arr)) {
                if (array_key_exists($pid, $arr)) {
                    $uu = $arr[$pid];
                    if (($uu["pqty"]) < $test) {
                        $uu["pqty"] = $uu["pqty"] + 1;
                        $arr[$pid] = $uu;
                    } else {
                        echo "<script>Swal.fire({
                                position:'inherit',
                                icon:'warning',
                                title:'123',
                                showConfirmButton: false,
                                timer: 1500,
                            })</script>";
                    }
                } else {
                    $arr[$pid] = array("pid" => $pid, "pname" => $pname, "pqty" => $pqty, "pimg" => $pimg, "price" => $price);
                }
            } else {
                $arr[$pid] = array("pid" => $pid, "pname" => $pname, "pqty" => $pqty, "pimg" => $pimg, "price" => $price);
            }
            $_SESSION["mycar"] = $arr;
            ob_clean();
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
    <form action="" method="post">
        <div class="text-center text-white" style="padding-bottom:250px;position: relative; overflow: hidden;">
            <video autoplay="" loop="" muted="" plays-inline="" style="position: absolute; right: 0; top: 0; min-width:100%; z-index: -100;">
                <source src="video/pexels-polina-kovaleva-5644274.mp4" type="video/mp4">
            </video>
            <div class="row" style="margin: 50px auto;">
                <div class="col-md-4">
                    <a href="inde1.php">
                        <h4 style="font-size: 35px;" class="display-4 text-warning">
                            <span class="oi oi-home"></span> 租屋回收箱 </h4>
                    </a>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-6" style="padding:auto 0px ;">
                    <ul class="nav nav-pills" style="margin:0px 0px auto">
                        <li class="nav-item nav-link " style="background-color:transparent;font-size:20px;font-weight:bold;border-style:none;"> 你好 <?php echo @$_SESSION['account_temp'] ?></li>
                        <li class="nav-item"> <button name="logout" style="background-color:transparent;font-size:20px;font-weight:bold;border-style:none;" class="nav-link text-warning">登出</button> </li>
                        <li class="nav-item"> <a href=#first style="font-size:20px; font-weight:bold;" class="nav-link text-warning">商品</a> </li>
                        <li class="nav-item"> <a style="font-size:20px;font-weight:bold;" class="nav-link text-warning" href="index1.html">關於我們</a> </li>
                        <li class="nav-item"> <a href="index2.html" style="font-size:20px;font-weight:bold;" class="nav-link text-warning">聯繫我們</a> </li>
                        <li><a href="index5.php" style="font-size:20px; font-weight:bold;" class="nav-link text-warning">購物車</a></li>
                        <a class="dropdown-toggle text-center" style="margin:auto 5px auto 5px;" data-toggle="dropdown" href="#">
                            <li class="oi oi-person display-5 text-warning">會員專區</li>
                        </a>
                        <ul class="dropdown-menu" style="background-color:#000000">
                            <li class="nav-item"> <a style="font-size: 20px; font-weight:bold" href="Upload.php" class="nav-link text-warning">上傳商品</a> </li>
                            <li><a href="product.php" style="font-size:20px; font-weight:bold;" class="nav-link text-warning">管理商品</a></li>
                        </ul>
                    </ul>
                </div>
            </div>
            <div class="container py-5">
                <div class="row"></div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto" style="color:#45c447">
                    <p style="font-size:33px; font-weight:bold;margin:100px auto;" class="lead mb-5"> 構建這個平台讓有多出貨是用不到家具的人放上這個平台，讓租屋族可以考慮添購。 <br> 我們希望藉由此平台來，活絡整個租屋市場，讓以後租屋不是只是單一的選擇。 </p>
                    <a class="btn text-white btn-lg" href="#first" style="background: rgb(9, 118, 180);" target="_parent"><span class="oi oi-arrow-circle-bottom"></span>&nbsp;更多</a>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div id="first" class="col-md-12">
                        <h1>全部商品</h1>
                        <ul class="nav nav-pills">
                            <li class="nav-item"> <a href="#" class="active nav-link">商品</a> </li>
                            <li class="nav-item"> <a href="indexhouse.php" class="active nav-link">租屋</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="row" style="display:flex ;flex-direction: row;">
                    <?php
                    for ($j = 0; $j < $rowc; $j++) { ?>
                        <div class="col-md-4 col-lg-3 p-4"> <img class="img-fluid d-block" src="<?php echo "http://localhost:8081/New%20site" . $attr[$j][4] ?>" width="1500">
                            <h4 class="my-3"> <b><?php echo $attr[$j][2] ?>&nbsp;</b> </h4>
                            <p>價格:<?php echo $attr[$j][3] ?></p></b>
                            <p>數量:<?php echo $attr[$j][1] ?></p></b>
                            <p><?php echo $attr[$j][5] ?></p></b>
                            <button type="submit" name="shoppingcar" value="<?php echo $j ?>" class="btn btn-primary" style="font-size:20px">加入購物車</button></b>
                            <select name="selectqty[]">
                                <?php
                                $selectqty = $attr[$j][1];
                                for ($i = 0; $i < $selectqty; $i++) { ?>
                                    <option value="<?php echo $i + 1 ?>"><?php echo $i + 1 ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="proid[]" value="<?php echo $attr[$j][0] ?>">
                            <input type="hidden" name="proname[]" value="<?php echo $attr[$j][2] ?>">
                            <input type="hidden" name="proimg[]" value="<?php echo "http://localhost:8081/New%20site" . $attr[$j][4] ?>">
                            <input type="hidden" name="proprice[]" value="<?php echo $attr[$j][3] ?>">
                            <input type="hidden" name="dbqty[]" value="<?php echo $attr[$j][1] ?>">
                        </div>
                    <?php } ?>
                </div>
            </div>
    </form>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-right">
                <a style="color: black;" href="#">到最上面</a>
            </p>
            <p>有甚麼問題請聯絡4A690022@stust.edu.tw&nbsp;</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 20px;right:20px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:220px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo Free&nbsp;&nbsp;<img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16"></pingendo> -->

</body>


</html>