<?php
if (isset($_POST['simpan'])) {
    extract($_POST);
    //PASSWORD DI HASH
    // $password = md5($password);
    //SIMPAN DATA USERS
    $sql = mysqli_query($koneksi, "INSERT INTO users (username,password,title,img) VALUES('" . $username . "','" . md5($password) . "','" . $title . "','user.png');");
    if ($sql) {
        echo "<center><div class='alert alert-success alert-dismissable'>
            <h2 class='text-center bg=success'>DATA BERHASIL DISIMPAN</h2>
            </div></center>";
    } else {
        echo "<center><div class='alert alert-danger alert-dismissable'>Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.</div><center";
    }
}
?>

<div class="x_panel col-md-6">
    <div class="x_title">
        <h2>Buat Akun</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form id="demo-form2" class="form-horizontal form-label-left" action="" method="post">
            <div class="item form-group">
                <label class="col-form-label col-md-4 col-sm-3 label-align" for="title">Nama</label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="title" name="title" required="required" class="form-control">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-4 col-sm-3 label-align" for="username">Username</label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="username" name="username" required="required" class="form-control">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-4 col-sm-3 label-align" for="password">Password</label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="password" id="password" name="password" required="required" class="form-control">
                </div>
            </div>

            <div class=" ln_solid">
            </div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>