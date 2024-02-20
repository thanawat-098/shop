<?php 
            require_once("../connection1.php");
            session_start();

            if (!isset($_SESSION['user_login'])) {
                header("location: ../index1.php");
            }

            $id = $_SESSION['user_login'];

            $select_stmt = $db->prepare("SELECT * FROM tbl_user WHERE id = :uid");
            $select_stmt->execute(array(':uid' => $id));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if (isset($_SESSION['user_login'])) 
        ?>


<?php include 'condb1.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>


</head>
<body>
  <?php include 'menu1.php'; ?>
    
<div class="container">
  <br><br>

  <div class="row">
  <?php
  $sql = "SELECT * FROM product ORDER BY pro_id";
  $result = mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($result)){

  
  ?>
    <div class="col-sm-3">
      <div class="text-center">
      <img src="img/<?=$row['image']?>" width="200px" height="250" class="mt-5 p-2 my-2 border"> <br>
      ID: <?=$row['pro_id']?> <br>
      <h5 class="text-success"> <?=$row['pro_name']?> </h5>
      ราคา <b class="text-danger"> <?=$row['price']?> </b> บาท <br>
      <a class="btn btn-outline-success mt-3" href="sh_product_detail1.php?id=<?=$row['pro_id']?>">รานละเอียด</a>
      </div>
      <br>
    </div>
  <?php
  }
  mysqli_close($conn);
  ?>  
</body>
</html>