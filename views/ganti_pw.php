<?php
if (isset($_POST['simpan'])) {
    extract($_POST);

    // PASSWORD DI HASH
    // $password_lama = md5($password_lama);
    // $password_baru = md5($password_baru);

    $query1 = mysqli_query($koneksi, "SELECT * FROM users WHERE username='" . $_SESSION['user'] . "' AND password='" . $password_lama . "'");
    //CEK PASSWORD LAMA
    if ($query1->num_rows > 0) {

        //UBAH PASSWORD
        $query2 = mysqli_query($koneksi, "UPDATE users SET password='" . $password_baru . "' WHERE username='" . $_SESSION['user'] . "'");

        if ($query2) {
            echo "<h2 class='text-center text-success'>PASSWORD BERHASIL DIUBAH</h2>";
        } else {
            echo "Maaf, Terjadi kesalahan saat mencoba untuk mengedit password.";
        }
    } else {
        echo "<h2 class='text-center text-danger'>Password Lama Salah !!!.</h2>";
    }
}
?>

<div class="x_panel col-md-6">
    <div class="x_title">
        <h2>Ganti Password</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br />
        <form id="demo-form2" class="form-horizontal form-label-left" action="" method="post">
            <div class="item form-group">
                <label for="pw_lama" class="col-form-label col-md-3 col-sm-3 label-align">Password Lama</label>
                <div class="col-md-6 col-sm-6 ">
                    <input id="pw_lama" class="form-control" type="password" name="password_lama">
                </div>
            </div>
            <div class="item form-group">
                <label for="pw_baru" class="col-form-label col-md-3 col-sm-3 label-align">Password Baru</label>
                <div class="col-md-6 col-sm-6 ">
                    <input id="pw_baru" class="form-control" type="password" name="password_baru">
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>