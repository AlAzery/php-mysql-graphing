<?php
$conn = new mysqli("localhost", "root", "", "maringecoding");
$query = mysqli_query($conn, "SELECT * FROM graphing");
if (isset($_POST["submit"])) {
  $name = htmlspecialchars($_POST["name"]);
  $location = $_POST["location"];
  $address = $_POST["address"];
  $city = $_POST["city"];
  $zip = $_POST["zip"];
  $jurusan = $_POST["jurusan"];
  $kelamin = $_POST["kelamin"];

  if ($jurusan === "pilih jurusan") {
    $xalert = true;
  } else if ($kelamin === "pilih kelamin") {
    $yalert = true;
  } else {
    $sql = mysqli_query($conn, "INSERT INTO graphing VALUE('','$name','$location','$address','$city','$zip','$jurusan','$kelamin')");
    if ($sql) {
      header("location:index.php");
      $succes = true;
    } else {
      die("gagal di tambahkan".mysqli_error($conn));
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>GraphApp</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <style>
    * {
      box-sizing: border-box;
      padding: 0px;
    }
    body {
      padding: 20px;
    }
    .paragraf {
      font-size: 15px;
      font-family: Arial;
    }
  </style>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
  <main>
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">GraphApp</a>
          <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
              <a class="nav-link" href="#">Features</a>
              <a class="nav-link" href="#">Pricing</a>
              <a class="nav-link disabled">Disabled</a>
            </div>
          </div>
        </div>
      </nav>
      <hr />
      <div class="items2">
        <h2>Table</h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Location</th>
                <th scope="col">Address</th>
                <th scope="col">City</th>
                <th scope="col">Zip</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Male/Female</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($query as $items): ?>
              <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $items["name"]; ?></td>
                <td><?= $items["location"]; ?></td>
                <td><?= $items["address"]; ?></td>
                <td><?= $items["city"]; ?></td>
                <td><?= $items["zip"]; ?></td>
                <td><?= $items["jurusan"]; ?></td>
                <td><?= $items["kelamin"]; ?></td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="logo">
        <h2>statistik</h2>
      </div>
      <center>
        <div class="items">
          <canvas id="statistik" style="width:100%;max-width:380px"></canvas>
        </div>
      </center>
      <br>
      <div class="logo">
        <h2>Jurusan</h2>
      </div>
      <center>
        <div class="items">
          <canvas id="myChart" style="width:100%;max-width:380px"></canvas>
        </div>
      </center>
      <br>
      <div class="logo">
        <h2>l,p</h2>
      </div>
      <center>
        <div style="width: 100%;max-width:380px;">
          <canvas id="myChart1"></canvas>
        </div>
      </center>
      <br>
      <br>
      <br>
      <div class="items">
        <h1>New Pojector</h1>
        <?php if (isset($succes)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success</strong> You success add data in form.
        </div>
        <?php endif; ?>
        <?php if (isset($xalert)): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Gagal</strong> Select to jurusan.
        </div>
        <?php endif; ?>
        <?php if (isset($yalert)): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Gagal</strong> Select to kelamin you.
        </div>
        <?php endif; ?>
        <form action="" method="post" class="row g-3">
          <div class="col-md-6">
            <label for="inputText" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="inputText" required>
          </div>
          <div class="col-md-6">
            <label for="inputText1" class="form-label">Location</label>
            <input type="text" class="form-control" name="location" id="inputText1" required>
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="inputAddress" placeholder="you address" required>
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">City</label>
            <input type="text" class="form-control" name="city" id="inputCity" required>
          </div>
          <div class="col-md-2">
            <label for="inputZip" class="form-label">Zip</label>
            <input type="text" class="form-control" name="zip" id="inputZip" required>
          </div>
          <div class="col-md-5">
            <br>
            <label for="jurusan" class="form-label">Jurusan</label>
            <select class="form-select" id="jurusan" name="jurusan" required>
              <option>pilih jurusan</option>
              <option value="komputer">komputer</option>
              <option value="mesin">Mesin</option>
              <option value="kedokteran">Kedokteran</option>
              <option value="informatika">Informatika</option>
              <option value="lainnya">lainnya</option>
            </select>
          </div>
          <div class="col-md-5">
            <br>
            <label for="Kelamin" class="form-label">Kelamin</label>
            <select class="form-select" id="Kelamin" name="kelamin" required>
              <option>pilih kelamin</option>
              <option value="l">Laki-laki</option>
              <option value="p">perempuan</option>
            </select>
          </div>
          <div class="col-12">
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </main>
  <script>

    var ctx = document.getElementById("myChart1").getContext('2d');
    var xValues = ["komputer", "teknik mesin", "Informatika", "Kedokteran", "lainnya"];
    var yValues = [
      <?php
      $kom = mysqli_query($conn, "select * from graphing where jurusan='komputer'");
      echo mysqli_num_rows($kom);
      ?>,
      <?php
      $mesin = mysqli_query($conn, "select * from graphing where jurusan='teknik mesin'");
      echo mysqli_num_rows($mesin);
      ?>,
      <?php
      $infor = mysqli_query($conn, "select * from graphing where jurusan='informatika'");
      echo mysqli_num_rows($infor);
      ?>,
      <?php
      $kedok = mysqli_query($conn, "select * from graphing where jurusan='kedokteran'");
      echo mysqli_num_rows($kedok);
      ?>,
      <?php
      $lain = mysqli_query($conn, "select * from graphing where jurusan='lainnya'");
      echo mysqli_num_rows($lain);
      ?>
    ];

    var xyValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
    var yzValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

    new Chart("statistik", {
      type: "line",
      data: {
        labels: xyValues,
        datasets: [{
          fill: false,
          lineTension: 0,
          backgroundColor: "rgba(74,74,74,0.763)",
          borderColor: "rgba(75, 192, 192, 0.2)",
          data: yzValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            ticks: {
              min: 6, max: 16
            }}],
        }
      }
    });
    new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          fill: false,
          lineTension: 0,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            ticks: {
              min: 1, max: 30
            }}],
        }
      }
    });
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["Laki-laki", "Perempuan"],
        datasets: [{
          label: '',
          data: [
            <?php
            $l = mysqli_query($conn, "select * from graphing where kelamin='l'");
            echo mysqli_num_rows($l);
            ?>,
            <?php
            $p = mysqli_query($conn, "select * from graphing where kelamin='p'");
            echo mysqli_num_rows($p);
            ?>
          ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)'
          ],
          borderWidth: 1
        }]
      },
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

  </script>
  </body>
</html>