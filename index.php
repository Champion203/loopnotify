<!doctype html>
<html lang="en">
  <head>
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
    <h1 class="text-center" >ภาพรวมระบบร้องเรียน-ร้องทุกข์</h1> </div><hr>
<div class="container-fluid">
<div class="row">
<form action="loop2.php" class="form-group" method="POST">
<div class="col-12 col-sm-12 mb-3">
        <label for="">ค้นหาข้อมูล</label>
        <select name="kong"  required> 
        <option value="">--เลือก--</option>
                    <option value="สำนักช่าง">สำนักช่าง</option>
                    <option value="สำนักปลัด">สำนักปลัด</option>
                    <option value="กองสาธารณะสุข">กองสาธารณสุข</option>
                    <option value="งานป้องกัน">งานป้องกัน</option>
                    <option value="สำนักคลัง">สำนักคลัง</option>
                    <option value="กองยุทธศาสตร์">กองยุทธศาสตร์</option>
                    <option value="กองสวัสดิการสังคม">กองสวัสดิการสังคม</option>
                    <option value="อื่นๆ">อื่นๆ</option>
                </select>
        <input type="submit" value="Search" class="btn btn-info "> 
        <hr> </div>
  <div class="container-fluid">
<div class="row">
<div class="col-md-12">
<?php
require('connectdatabase.php'); 
$sql = "SELECT * FROM `e-notify`";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numall=mysqli_num_rows($result);?>
<h4 class="text-center" >จำนวนเรื่องร้องเรียน-ร้องทุกข์ ทั้งหมด <?php echo $numall ;?> เรื่อง</h4><hr>
      <div class="card">
        <div class="card-body">
          <canvas id="chartBar1"></canvas>
        </div>
      </div>
      </div><hr>
  <div class="container-fluid">
  <div class="row">
  <div class="col-md-6">
  <h4 class="text-center" >จำนวนงานของแต่ละกอง</h4><hr>
  <div class="card">
    <div class="card-body">
      <canvas id="chartBar"></canvas>
    </div>
  </div>
</div>
    <div class="col-md-6">
    <h4 class="text-center" >สถานะการดำเนินการ</h4><hr>
      <div class="card">
        <div class="card-body">
          <canvas id="chartpie"></canvas>
        </div>
      </div>
    </div>
  </div>
</div><hr>
  </div>
  </body>
</html>
<!-- --------------------------------------------------------------------------->


<?php
header('Content-Type: text/html; charset=utf-8');
require('connectdatabase.php'); 

//------------------------สถานะ------------------------------------// 

$sql = "SELECT * FROM `e-notify` WHERE status LIKE 'E'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numE=mysqli_num_rows($result); 

$sql = "SELECT * FROM `e-notify` WHERE status LIKE 'O'";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$numO=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE status LIKE 'I'";
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
$sql = "SELECT * FROM `e-notify` WHERE type LIKE 1 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num1=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 2 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num2=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 3 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num3=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 4 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num4=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 5 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num5=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 6 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num6=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 7 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num7=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 8 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num8=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 9 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num9=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 10 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num10=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 18 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num11=mysqli_num_rows($result);

$sql = "SELECT * FROM `e-notify` WHERE type LIKE 11 or type LIKE 16 or type LIKE 17 or type LIKE 19 or type LIKE 20 ";
$result = $conn->query($sql);

$result = mysqli_query($conn, $sql) or die(mysqli_error());
$num12=mysqli_num_rows($result);
?>

<script>

    var chartBar_Data = {
    labels: ['สำนักช่าง', 'สำนักปลัด', 'กองสาธารณสุข', 'งานป้องกัน', 'สำนักคลัง', 'กองยุทธศาสตร์', 'กองสวัสดิการสังคม', 'อื่นๆ'],
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
    labels: ['ถนน/ทางเท้า', 'ไฟฟ้า/แสงสว่าง', 'ประปา', 'สิ่งปฎิกูล', 'น้ำเสีย', 'กลิ่น', 'อาคาร', 'เสียง', 'สัตว์' , 'ตัดต้นไม้' , 'ท่อระบายน้ำชำรุด','อื่นๆ'],
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