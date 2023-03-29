<?php
header('Content-Type: text/html; charset=utf-8');
require('connectdatabase.php'); 
$idQ = $_GET['idQ'];
$sql = "SELECT * FROM `e-notify` WHERE id LIKE $idQ";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
?>

<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  </head>
  <body>
  <nav class="navbar navbar-light bg-light shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="https://www.e-service.rangsit.org/e-notify/img/rangsit.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
      เทศบาลนครรังสิต
    </a>
  </div>
</nav> <hr>
<div class="alert alert-info" role="alert">
    <h1 class="text-center" >รายละเอียดเพิ่มเติม</h1> </div><hr>
    <div class="container-fluid text-center">    

<div class="col-sm-12 text-left"> 
<h3><?php echo "ID : ", $row[0];?></h3> </br>
  <h3><?php echo "ชื่อ : ", $row[1]," ",$row[2]," ",$row[3];?></h3> </br>
  <h3><?php echo "ประเภท : ";?>
                    <?php if ($row[7] == '1') { 
                      echo "ถนน/ทางเท้า";
                     }elseif ($row[7] == '2') { 
                      echo "ไฟฟ้า/แสงสว่าง";
                     }elseif ($row[7] == '3') { 
                      echo "ประปา";
                     }elseif ($row[7] == '4') { 
                      echo "สิ่งปฏิกูล";
                     }elseif ($row[7] == '5') { 
                      echo "น้ำเสีย";
                     }elseif ($row[7] == '6') { 
                      echo "กลิ่น";
                     }elseif ($row[7] == '7') { 
                      echo "อาคาร";
                     }elseif ($row[7] == '8') { 
                      echo "เสียง";
                     }elseif ($row[7] == '9') { 
                      echo "สัตว์";
                     }elseif ($row[7] == '10') { 
                      echo "ตัดต้นไม้";
                     }elseif ($row[7] == '16') { 
                      echo "ทะเบียนราษฎร,บัตร";
                     }elseif ($row[7] == '17') { 
                      echo "ภาษี/ค่าธรรมเนียมต่างๆ";
                     }elseif ($row[7] == '18') { 
                      echo "ท่อระบายน้ำ/ฝาท่อชำรุด";
                     }elseif ($row[7] == '19') { 
                      echo "เสียงตามสาย/เสียงไร้สาย";
                     }elseif ($row[7] == '20') { 
                      echo "เบี้ยยังชีพ";
                    }else { 
                      echo "อื่นๆ";
                     };?> 
  <?php echo "สถานะ : ";?> <?php if ($row[12] == 'I') { ?>
                    <span class="badge bg-secondary">รอรับเรื่อง</span>                     
                  <?php }elseif ($row[12] == 'O') { ?>
                    <span class="badge bg-info">กำลังดำเนินการ</span>
                  <?php } else { ?>
                    <span class="badge bg-success">เสร็จสิ้น</span>
                  <?php }
                  ?> </h3> </br>
  <h3><?php echo "เลขประจำตัวประชาชน : ", $row[5];?></h3> </br>
  <h3><?php echo "เบอร์โทร : ", $row[4];?></h3> </br>
  <h3><?php echo "ที่อยู่ : ", $row[6];?></h3> </br>
  <h3><?php echo "เรื่องร้องเรียน : ", $row[8];?></h3> </br>
  <h3><?php echo "การตอบกลับเจ้าหน้าที่ : ", $row[10];?></h3> <hr>
  <input type='button' value='ย้อนกลับ' onclick='javascript:window.history.back()' class="btn btn-danger" style="width: 100%;"><hr>
</div>
</div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>เทศบาลนครรังสิต | Rangsit City Municipality.</p>
</footer>

</body>
</html>