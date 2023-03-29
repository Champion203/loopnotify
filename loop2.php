<?php
header('Content-Type: text/html; charset=utf-8');
require('connectdatabase.php'); 
$kong = $_POST['kong'];
$sql = "SELECT * FROM `e-notify` WHERE recipient LIKE '%$kong%'";
$result0 = $conn->query($sql);

$result0 = mysqli_query($conn, $sql) or die(mysqli_error());
$numall=mysqli_num_rows($result0);
$order=1;
$sql = "SELECT * FROM `e-notify` WHERE (status LIKE 'E') AND (recipient LIKE '%$kong%')";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numE=mysqli_num_rows($result); 

$sql = "SELECT * FROM `e-notify` WHERE (status LIKE 'O') AND (recipient LIKE '%$kong%')";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numO=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE (status LIKE 'I') AND (recipient LIKE '%$kong%')";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numI=mysqli_num_rows($result);?>
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
    <h1 class="text-center" >ภาพรวมระบบร้องเรียน-ร้องทุกข์ <?php echo $kong; ?></h1> </div><hr>
<div class="container-fluid">
<div class="row">
<form action="loop2.php" class="form-group" method="POST">
<div class="col-12 col-sm-12 mb-3">
        <label for="">ค้นหาข้อมูล</label>
        <select name="kong"  required> 
        <option value="">--เลือก--</option>
                    <option value="สำนักช่าง">สำนักช่าง</option>
                    <option value="สำนักปลัด">สำนักปลัด</option>
                    <option value="กองสาธารณะสุข">กองสาธารณะสุข</option>
                    <option value="งานป้องกัน">งานป้องกัน</option>
                    <option value="กองคลัง">กองคลัง</option>
                    <option value="กองยุทธศาสตร์">กองยุทธศาสตร์</option>
                    <option value="กองสวัสดิการสังคม">กองสวัสดิการสังคม</option>
                    <option value="อื่นๆ">อื่นๆ</option>
                </select>
        <input type="submit" value="Search" class="btn btn-info ">
        <a href="index.php" class="btn btn-success" role="button">HOME</a>  
        <hr> </div>
  <div class="container-fluid">
<div class="row">
<div class="col-md-7">
<h4 class="text-center" >จำนวนเรื่องร้องเรียน-ร้องทุกข์ ทั้งหมด <?php echo $numall ;?> เรื่อง</h4><hr>
      <div class="card">
        <div class="card-body">
          <canvas id="chartBar1"></canvas>
        </div>
      </div>
      </div>
    <div class="col-md-5">
    <h4 class="text-center" >สถานะการดำเนินการ</h4><hr>
      <div class="card">
        <div class="card-body">
          <canvas id="chartpie"></canvas><hr>
          <h4 class="text-center" >กำลังดำเนินการ <?php echo $numO ;?></h4><hr>
          <h4 class="text-center" >ดำเนินการเสร็จสิ้น <?php echo $numE ;?></h4>
        </div>
      </div>
    </div>
  </div>
</div><hr>
<h1 class="text-center" >ข้อมูลการดำเนินงาน</h1><hr>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
                <th><center>ID</center></th>
                <th><center>ชื่อ-นามสกุล</center></th>
                <th><center>ประเภท</center></th>
                <th><center>สถานะ</center></th>
                <th><center>รายละเอียด</center></th>
                <th><center>เพิ่มเติม</center></th>


            </tr>
        </th>
        <tbody>
        <?php while($row = mysqli_fetch_row($result0)){ ?>
            <tr>
                <td><center><?php echo $row[0];?></td></center>
                <td><center><?php echo $row[2]," ",$row[3];?></td></center>
                <td align="center">
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
                     }
                     ?>
                  </td>
                  <td align="center">

                  <?php if ($row[12] == 'I') { ?>
                    <span class="badge bg-secondary">รอรับเรื่อง</span>                     
                  <?php }elseif ($row[12] == 'O') { ?>
                    <span class="badge bg-info">กำลังดำเนินการ</span>
                  <?php } else { ?>
                    <span class="badge bg-success">เสร็จสิ้น</span>
                  <?php }
                  ?>

                  </td>
                  <td align="left"><?php echo  mb_substr(strip_tags($row[8]), 0, 150, 'UTF-8') . ' ...'; ?>
                  <td>  <?PHP echo "<a href='seeuser.php?idQ= $row[0]' class='btn btn-success' role='button'>เพิ่มเติม</a>";?></td></center> </td>
                
            </tr>
            <?php $order++; }?> 
        </tbody>
        <tfoot>
            <tr>
            <th><center>ID</center></th>
                <th><center>ชื่อ-นามสกุล</center></th>
                <th><center>ประเภท</center></th>
                <th><center>สถานะ</center></th>
                <th><center>รายละเอียด</center></th>
                <th><center>เพิ่มเติม</center></th>
            </tr>
        </tfoot></div>
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });
</script>
</table>
    </div>
    </div>
    </div>
    <footer class="background-color: #4CAF50; text-center">
  <p>เทศบาลนครรังสิต | Rangsit City Municipality.</p>
</footer>
  </body>
</html>
<!-- --------------------------------------------------------------------------->


<?php
require('connectdatabase.php'); 
//------------------------สถานะ------------------------------------// 

$sql = "SELECT * FROM `e-notify` WHERE (status LIKE 'E') AND (recipient LIKE '%$kong%')";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numE=mysqli_num_rows($result); 

$sql = "SELECT * FROM `e-notify` WHERE (status LIKE 'O') AND (recipient LIKE '%$kong%')";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numO=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE (status LIKE 'I') AND (recipient LIKE '%$kong%')";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numI=mysqli_num_rows($result);
//--------------------------กองต่างๆ------------------------------//

$sql = "SELECT * FROM `e-notify` WHERE recipient LIKE 'สำนักช่าง' ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numchang=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE recipient LIKE 'สำนักปลัด' ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numpa=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE recipient LIKE 'กองสาธารณะสุข' ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numsa=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE recipient LIKE 'งานป้องกัน'  ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numpong=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE recipient LIKE 'กองคลัง'  ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numkong=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE recipient LIKE 'กองยุทธศาสตร์' ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numyud=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE recipient LIKE 'กองสวัสดิการสังคม' ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numbeay=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE recipient LIKE 'อื่นๆ' ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numAA=mysqli_num_rows($result);

//--------------------------ประเภท------------------------------//
$sql = "SELECT * FROM `e-notify` WHERE type LIKE 1 AND recipient LIKE '%$kong%' ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num1=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 2 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num2=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 3 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num3=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 4 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num4=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 5 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num5=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 6 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num6=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 7 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num7=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 8 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num8=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 9 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num9=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 10 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num10=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 18 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num11=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 11 or type LIKE 16 or type LIKE 17 or type LIKE 19 or type LIKE 20 AND recipient LIKE '%$kong%'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num12=mysqli_num_rows($result);
?>

<script>

    var chartBar_Data = {
    labels: ['กองช่าง', 'สำนักปลัด', 'สาธารณะสุข', 'งานป้องกัน', 'กองคลัง', 'กองยุทธศาสตร์', 'กองสวัสดิการสังคม'],
    datasets: [{
    label: 'Count of Votes',
    data: [<?php echo $numchang; ?>,<?php echo $numpa; ?>,<?php echo $numsa; ?>,<?php echo $numpong; ?>,<?php echo $numkong; ?>,<?php echo $numyud; ?>,<?php echo $numbeay; ?>, <?php echo $numAA; ?>],
    backgroundColor: ['red','blue','yellow','green','orange','purple','pink'],
    borderColor: 'black',
    borderWidth: 3
  }]
}
var chartBar = document.getElementById('chartBar').getContext('2d');
if (chartBar) {
  new Chart(chartBar, {
    type: 'bar',
    data: chartBar_Data,
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}
No
</script>

<script>

    var chartPie_Data = {
    labels: ['รอรับเรื่อง', 'กำลังดำเนินการ', 'เสร็จสิ้น'],
    datasets: [{
    label: 'Count of Votes',
    data: [<?php echo $numI; ?>,<?php echo $numO; ?>,<?php echo $numE; ?>],
    backgroundColor: ['blue','yellow','green'],
    borderColor: 'black',
    borderWidth: 3
  }]
}
var chartPie = document.getElementById('chartpie').getContext('2d');
if (chartPie) {
  new Chart(chartPie, {
    type: 'pie',
    data: chartPie_Data,
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}
No
</script>

<script>

    var chartBar_Data = {
    labels: ['ถนน/ทางเท้า', 'ไฟฟ้า/แสงสว่าง', 'ประปา', 'สิ่งปฎิกูล', 'น้ำเสีย', 'กลิ่น', 'อาคาร', 'เสียง', 'สัตว์' , 'ตัดต้นไม้' , 'ท่อระบายน้ำชำรุด'],
    datasets: [{
    label: 'Count of Votes',
    data: [<?php echo $num1; ?>,<?php echo $num2; ?>,<?php echo $num3; ?>,<?php echo $num4; ?>,<?php echo $num5; ?>,<?php echo $num6; ?>,<?php echo $num7; ?>,<?php echo $num8; ?>
    ,<?php echo $num9; ?>,<?php echo $num10; ?>,<?php echo $num11; ?>,<?php echo $num12; ?>],
    backgroundColor: ['red','blue','yellow','green','orange','purple','pink','blue','yellow','green','orange','purple','pink'],
    borderColor: 'black',
    borderWidth: 3
  }]
}
var chartBar = document.getElementById('chartBar1').getContext('2d');
if (chartBar) {
  new Chart(chartBar, {
    type: 'bar',
    data: chartBar_Data,
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}
No
</script>