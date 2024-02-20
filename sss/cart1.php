<?php
session_start();
include 'condb1.php';
// $id = $_GET['id'];
// $sql = "SELECT * FROM product WHERE pro_id ='$id' ";
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include 'menu1.php'?>
    <br><br>
    <div class="container">
        <form id="form1" method="POST" action="insert_cart1.php">
            <div class="row">
            <div class="col-md-10">
                    <div class="alert alert-success h4" role="alert" >
                        การสั่งซื้อสินค้า
                    </div>
                    <table class="table table-hover">
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ราคารวม</th>
                            <th>เพิ่ม-ลด</th>
                            <th>ลบ</th>
                        </tr>
                        <?php
                        echo "Nongyao";
                        $Total = 0;
                        $sumPrice = 0;
                        $m = 1;
                        for ($i=0; $i <= (int)$_SESSION["intLine"]; $i++){
                            if(($_SESSION["strProductID"][$i]) !=""){
                                $sql="select * from product where pro_id ='" . $_SESSION["strProductID"][$i] . "' ";
                                $result=mysqli_query($conn, $sql);
                                $row_pro=mysqli_fetch_array($result);

                                $_SESSION["price"] = $row_pro['price'];
                                $Total = $_SESSION["strQty"][$i];
                                $sum = $Total * $row_pro['price'];
                                $sumPrice = $sumPrice + $sum;
                                $_SESSION["sum_price"] = $sumPrice;                            
                        ?>
                        <tr>
                            <td><?=$m?></td>
                            <td>
                                <img src="img/<?=$row_pro['image']?>" width="80" height="100" class="border">
                                <?=$row_pro['pro_name']?>
                            </td>
                            <td><?=$row_pro['price']?></td>
                            <td><?=$_SESSION["strQty"][$i]?></td>
                            <td><?= $sum?></td>
                            <td>
                                <a href="order1.php?id=<?=$row_pro['pro_id']?>" class="btn btn-outline-primary" >+</a>
                                <?php if($_SESSION["strQty"][$i] > 1){  ?>
                                <a href="order_del1.php?id=<?=$row_pro['pro_id']?>" class="btn btn-outline-primary" >-</a>
                                <?php } ?>

                            </td>
                            <td> <a href="pro_delete1.php?Line=<?=$i?>"><img src="img/123.jpg" width="30"></a> </td>
                        </tr>
                        <?php
                        $m=$m+1;
                        }
                        }
                        mysqli_close($conn);
                        ?>
                        <tr>
                            <td class="text-end" colspan="4">รวมเป็นเงิน</td>
                            <td class="text-center"><?=$sumPrice?></td>
                            <td>บาท</td>
                        </tr>


                    </table>
                    <div style="text-align:right">
                    <a href = "show1.php"><button type="button" class="btn btn-outline-secondary">เลือกสินค้า</button></a>
                    <button type="submit" class="btn btn-outline-primary">ยื่นยันการสั่งซื้อ</button>
                    </div>
                
            </div>
            <br><br>
            <div class="row"><br><br><br>
                <div class="col-md-6">
                <div class="alert alert-success" h4 role="alert">
                    ข้อมูลสำหรับจัดส่งสินค้า
                </div>
                ชื่อ-นามสกุล:
                <input type="text" name="cus_name" class="form-control" required placeholder="ชื่อ-นามสกุล ..." ><br>
                ที่จัดส่งสินค้า:
                <textarea class="form-control" required placeholder="ที่อยู่..." name="cus_add" rows="3"></textarea><br>
                เบอร์รถ:
                <input type="number" name="cus_tel" class="form-control" required placeholder="เบอร์รถ ..." >
                <br><br><br>
            </div>
            </div>
        </form>
    </div>
</body>
</html>