<?php
if ($_GET["id"]) {
    $query1 = mysqli_query($koneksi, "DELETE FROM users WHERE id='" . $_GET["id"] . "'");
    if ($query1) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=data_users'>";
    }
}
