<!DOCTYPE html>
<html>
<title>租屋資訊上傳</title>
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
    @$address = $_POST['address'];
	@$address2 = $_POST['address2'];
    @$money = $_POST['money'];
    @$room = $_POST['room'];
    @$phone = $_POST['phone'];
    if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($room) && isset($address) && isset($money) && !empty($address) && !empty($money) && !empty($room)) {
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
                        $sql = "insert into house(room,address,address2,money,productimages,phone) values ('$room','$address','$address2','$money','$productimages','$phone')";
                        $sth = $pdo->prepare($sql);
                        $sth->execute();
                        echo "<script>Swal.fire({
                        position: 'middle-end',
                        icon: 'success',
                        title: '上傳成功',
                        showConfirmButton: false,
                        timer: 2000})</script>";
                        header("refresh:3;url=indexhouse.php");
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
    ?>
    <form action="uploadHouse.php" method="post" enctype="multipart/form-data">
        <div class="text-center text-md-right py-0" style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed; width:100%;overflow-x:hidden;">
            <div class="row">
                <div class="col-md-3">
                    <a href="inde.php">
                        <h1 class="display-4 text-warning" ;=""><span class="oi oi-home"></span> 首頁 </h1>
                    </a>
                    <div class="col-md-12">
                        <p style="font-size: 30px; color: GhostWhite;font-weight:bold;">上傳租屋資訊</p>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-5">
                    <ul class="nav nav-pills">
                        <li class="nav-item"> <button name="logout" style="background-color:transparent;font-size:30px;font-weight:bold;border-style:none;" class="nav-link text-warning">登出</button> </li>
                        <li class="nav-item"> <a style="font-size: 30px;font-weight:bold;" href="inde.php" class="nav-link text-warning">商品</a> </li>
                        <li class="nav-item"> <a style="font-size: 30px;font-weight:bold;" class="nav-link text-warning" href="index1.php">關於我們</a> </li>
						<li class="nav-item"> <a style="font-size:30px;font-weight:bold;" class="nav-link text-warning" href="index5.php">購物車</a> </li>
						<a class="dropdown-toggle text-center" style="margin:auto;" data-toggle="dropdown" href="#">
                            <li class="oi oi-person display-5 text-warning"><span style="font-size:30px;">會員專區</span></li>
							
                        </a>
                        <ul class="dropdown-menu" style="background-color:#000000">
                            
                            <li class="nav-item"> <a style="font-size: 20px; font-weight:bold" href="Upload.php" class="nav-link text-warning">上傳商品</a> </li>
							   <li class="nav-item"> <a style="font-size: 20px; font-weight:bold" href="UploadHouse.php" class="nav-link text-warning">租屋上傳</a> </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
        <div class="py-3" style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
            <div class="col-5 text-center" style="margin: 0 auto;">
                <div class="row">
                    <div class="col-md-5 text-secondary">
                        <h3 class="text-white" ><span style="font-size:40px;"></span></h3>
                    </div>
                    <div class="col-md-7">
                        <h3 class="text-white" ><span style="font-size:40px;">租屋資料</span></h3>
                    </div>
                </div>
            </div>
        </div>
        <div  style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
            <div class="col-6 text-center" style="margin: 0 auto;">
                <div class="row">
                    <div style="color:#FFFFFF;font-size:25px" class="col-md-6">
                        <img id="demo" style="width: 300px;height: 300px;overflow: hidden;">
                    </div>
                    <div class="col-md-4 text-center" style="padding:auto;float:left;">
                        <p class="text-white" style="margin:auto auto 30 auto ;"><span style="font-size:20px;">地區:</span></br>
                            <select name="address">
                                <option value="">請選擇地區</option>
                                <option value="北">北</option>
                                <option value="中">中</option>
                                <option value="南">南</option>
                               
                            </select></p>
							<p class="text-white"><span style="font-size:20px;">地址:</span><input type="text" name="address2"></p>
                        <p class="text-white" style="margin:auto auto 30 auto ;"><span style="font-size:20px;">月租:</span><input type="number" name="money" value="0" onchange="addkk({$row.id})" id="num{$row.id}" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();"></p>
                        <p class="text-white"style="margin:auto auto 30 auto;"><span style="font-size:20px;">房型:</span>
                            <select name="room">
                                <option value="">請選擇想要刊登的的房型</option>
                                <option value="整層住家">整層住家</option>
                                <option value="獨立套房">獨立套房</option>
                                <option value="分租套房">分租套房</option>
                                <option value="雅房">雅房</option>
                                <option value="其他">其他</option>
                             
                            </select>
							</p>
                            <p class="text-white"><span style="font-size:20px;">電話:</span><input type="text" name="phone"></p>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center py-5 " style="margin: 0 auto; background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
                <div class="row" >
                    <div class="col-md-8" style="color:#FFFFFF;font-size:25px" class="col-md-2">
                        <input id="file" type="file" name="file">
                    </div>
                    <button  type="submit" name="submit" value="上傳檔案" class="btn btn-primary">上傳</button>
                </div>
            </div>
        </div>
        <div class="py-3" style="background-image: url(img/index3-2.jpg);	background-position: right bottom;	background-size: cover;	background-repeat: repeat; background-attachment: fixed;">
            <footer class="text-muted py-5">
                <div class="container">
                    <p class="float-right">
                        <a style="font-size: 20px; color: GhostWhite;" href="#">到最上面</a>
                    </p>
                    
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
