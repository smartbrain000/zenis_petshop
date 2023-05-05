<?php
session_start();
if (isset($_SESSION['user'])) {
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gentelella Alela! | </title>

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <?php
    if (isset($_POST["login"])) {
      $user = htmlspecialchars($_POST["username"], true);
      $pass = htmlspecialchars(md5($_POST["password"]), true);
      $koneksi = mysqli_connect("127.0.0.1", "root", "", "stok");
      $qry = mysqli_query($koneksi, "SELECT * FROM users WHERE username='" . $user . "'");
      $data = mysqli_fetch_array($qry);
      if ($data) {
        if ($pass == $data['password']) {
          $_SESSION["user"] = $data["username"];
          $_SESSION["pass"] = $data["password"];
          echo "<meta http-equiv='refresh' content='0; url=index.php'>";
        } else {
          echo "<center><div class='alert alert-danger alert-dismissable'>
                         <b>Password Salah " . $data['password'] . " dan " . $pass . " !!</b>
                          </div><center>";
        }
      } else {
        echo "<center><div class='alert alert-danger alert-dismissable'>
                         <b>Username Tidak Terdaftar!!</b>
                          </div><center>";
      }
    }
    ?>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper">

      <div class="animate form login_form">
        <section class="login_content">
          <form action="" method="post">
            <h1>Login</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" required="" name="username" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" name="password" />
            </div>
            <div>
              <button class="btn btn-default btn-primary submit" type="submit" name="login">Log in</a>
            </div>
          </form>
          <div class="clearfix"></div>
          <div class="separator">
            <div class="clearfix"></div>
            <br />
            <div>
              <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
              <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

</html>