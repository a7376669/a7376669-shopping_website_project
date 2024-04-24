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

<body style="overflow:hidden">
    <?php
    include "single\connect.php";
    @$qty = $_POST['qty'];
    @$productname = $_POST['productname'];
    @$productprice = $_POST['productprice'];
    @$description = $_POST['description'];
    $uid = $_SESSION['account_temp'];
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
        if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($qty) && isset($productname) && isset($productprice) && !empty($productname) && !empty($productprice) && !empty($qty)) {
                if ((($_FILES["file"]["type"] == "image/gif")
                        || ($_FILES["file"]["type"] == "image/jpeg")
                        || ($_FILES["file"]["type"] == "image/jpg")
                        || ($_FILES["file"]["type"] == "image/png"))
                    && ($_FILES["file"]["size"] < 1000000)
                ) {
                    if ($_FILES['file']['error'] > 0) {
                        $error = $_FILES['file']['error'];
                        echo "<script>Swal.fire({
                        position: 'middle-end',
                        icon: 'warning',
                        title: '錯誤',
                        text:錯誤代碼:$error,
                        showConfirmButton: false,
                        timer: 2000})</script>";
                    } else {
                        if (file_exists("../upload/" . $_FILES['file']['name'])) {
                            echo "<script>Swal.fire({
                                position: 'middle-end',
                                icon: 'warning',
                                title: '已有同檔名的圖片',
                                showConfirmButton: false,
                                timer: 2000})</script>";
                        } else {
                            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES['file']['name']);
                            $productimages = '/upload/' . $_FILES['file']['name'];
                            $sql = "insert into product(qty,productname,productprice,productimages,description) values ('$qty','$productname','$productprice','$productimages','$description')";
                            $sql1 = "insert into userproduct(uid,proname,qty,price,proimg,description) values ('$uid','$productname','$qty','$productprice','$productimages','$description')";
                            $sth = $pdo->prepare($sql);
                            $sth1 = $pdo->prepare($sql1);
                            $sth->execute();
                            $sth1->execute();
                            echo "<script>Swal.fire({
                            position: 'middle-end',
                            icon: 'success',
                            title: '上傳成功',
                            showConfirmButton: false,
                            timer: 2000})</script>";
                            header("refresh:3;url=inde.php");
                        }
                    }
                } else {
                    echo "<script>Swal.fire({
                        position: 'middle-end',
                        icon: 'warning',
                        title: '檔案格式不正確',
                        showConfirmButton: false,
                        timer: 2000})</script>";
                }
            } else {
                echo "<script> Swal.fire({
                position: 'middle-end',
                icon: 'warning',
                title: '有欄位空白',
                showConfirmButton: false,
                timer: 2000
                })</script>";
            }
        }
    }
    ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="text-center text-md-right py-0" style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed; width:100%;overflow-x:hidden;">
            <div class="row" style="margin: 50px auto;">
                <div class="col-md-4">
                    <a href="inde.php">
                        <h1 class="display-4 text-warning" ;=""><span class="oi oi-home"></span> 首頁 </h1>
                    </a>
                    <div class="col-md-12">
                        <p style="font-size: 30px; color: GhostWhite;font-weight:bold;">上架商品</p>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <ul class="nav nav-pills">
                        <li class="nav-item nav-link " style="color:white;background-color:transparent;font-size:20px;font-weight:bold;border-style:none;"> 你好 <?php echo @$_SESSION['account_temp'] ?></li>
                        <li class="nav-item"> <button name="logout" style="background-color:transparent;font-size:20px;font-weight:bold;border-style:none;" class="nav-link text-warning">登出</button> </li>
                        <li class="nav-item"> <a style="font-size: 20px;font-weight:bold;" href="inde.html" class="nav-link text-warning">商品</a> </li>
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
        <div class="py-3" style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
            <div class="col-5 text-center" style="margin: 0 auto;">
                <div class="row">
                    <div class="col-md-5 text-secondary">
                        <h3 class="text-white">商品</h3>
                    </div>
                    <div class="col-md-7">
                        <h3 class="text-white">商品資料</h3>
                    </div>
                </div>
            </div>
        </div>
        <div style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
            <div class="col-6 text-center" style="margin: 0 auto;">
                <div class="row">
                    <div style="color:#FFFFFF;font-size:25px" class="col-md-6">
                        <img id="demo" style="width: 300px;height: 300px;overflow: hidden;">
                    </div>
                    <div class="col-md-4 text-center" style="padding:auto;float:left;">
                        <p class="text-white" style="margin:auto auto 30 auto ;">種類:
                            <select name="productname">
                                <option value="">請輸入想要上架的商品</option>
                                <option value="家具 桌子">家具 桌子</option>
                                <option value="家具 椅子">家具 椅子</option>
                                <option value="家具 櫃子">家具 櫃子</option>
                                <option value="課本、書籍">課本、書籍</option>
                            </select></p>
                        <p class="text-white" style="margin:auto auto 30 auto ;">價格:<input type="number" name="productprice" value="0" onchange="addkk({$row.id})" id="num{$row.id}" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"></p>
                        <p class="text-white">數量:
                            <select name="qty">
                                <option value="">請輸入想要上架的數量</option>
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
                            <p class="text-white" style="vertical-align: top;">備註:<textarea name="description" rows="4" cols="23"></textarea></p>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center py-5 " style="margin: 0 auto; background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
                <div class="row">
                    <div class="col-md-8" style="color:#FFFFFF;font-size:25px" class="col-md-2">
                        <input id="file" type="file" name="file">
                    </div>
                    <button type="submit" name="submit" value="上傳檔案" class="btn btn-primary">上傳</button>
                </div>
            </div>
        </div>
        <div class="py-3" style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
            <footer class="text-muted py-5">
                <div class="container">
                    <p class="float-right">
                        <a style="font-size: 20px; color: GhostWhite;" href="#">到最上面</a>
                    </p>
                    <p style="font-size: 20px; color: GhostWhite;font-weight:bold;">有甚麼問題請聯絡4A690022@stust.edu.tw&nbsp;</p>
                </div>
            </footer>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </div>
    </form>
    <script>
        $('#file').change(function() {
            var file = $('#file')[0].files[0];
            var reader = new FileReader;
            reader.onload = function(e) {
                $('#demo').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>