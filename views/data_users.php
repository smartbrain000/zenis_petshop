<div class="x_panel">
    <div class="x_title">
        <a class="btn btn-primary" href="?menu=register"><i class="fa fa-plus"></i> Input Users </a>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Title</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from users");
                            $no = 1;
                            while ($col = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $col['username'] ?></td>
                                    <td><?php echo $col['title'] ?></td>

                                    <td class="text-center">
                                        <a href="?menu=hapus_data_users&id=<?php echo $col['id'] ?>" class="btn btn-danger" title='Hapus Data ini' onclick="return confirm('Anda yakin ingin menghapus users ini?')">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>