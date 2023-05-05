<title> Logout</title>
<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['pass']);
echo "<script>window.alert('Anda Berhasil Keluar!!!')
        window.location=('login.php')</script>";
