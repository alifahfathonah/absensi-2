<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                <li class="active"><i class="material-icons">library_books</i> <?= $breadcumb ?></li>
            </ol>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= $breadcumb ?>
                        </h2>
                        <span data-toggle="modal" data-target="#modal_add">
                            <button onClick="addDataJabatan()" style="float: right; position:relative;bottom:25px;" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                                <i class="material-icons">add</i>
                            </button>
                        </span>

                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jabatan</th>
                                        <th>Gaji Pokok</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jabatan</th>
                                        <th>Gaji Pokok</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($data_jabatan as $row) {
                                        $i++; ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nama_jabatan'] ?></td>
                                            <td>Rp <?= number_format($row['gaji'], 0, ",", "."); ?></td>
                                            <td>
                                                <center>
                                                    <span data-target="#modal_add" data-toggle="modal">
                                                        <button onClick="updateDataJabatan('<?= $row['id_jabatan']; ?>','<?= $row['nama_jabatan']; ?>','<?= $row['gaji']; ?>')" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                    </span>
                                                    <span data-toggle="modal" data-target="#modal_delete">
                                                        <button onClick="deleteJabatan('<?= $row['id_jabatan']; ?>')" type="button" class="btn bg-default btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Delete Data">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

<div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_modal"></h4>
            </div>
            <hr>
            <div class="modal-body">
                <form id="form_action" action="<?= base_url('pegawai/verifikasi_data/') ?>" method="post">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="shift">Nama Jabatan</label>
                            <div class="form-line">
                                <input type="text" id="nama" name="nama" placeholder="Keterangan ..." class="form-control">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="shift">Nominal Gaji</label>
                        <div class="input-group date">
                            <span class="input-group-addon">
                                <i class="">Rp</i>
                            </span>
                            <div class="form-line">
                                <input type="text" id="gaji" name="gaji" class="form-control" placeholder="Nominal Gaji ...">
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="id_jabatan" id="id_jabatan">


            </div>
            <hr>
            <div class="modal-footer">
                <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete  -->
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Hapus Data Shift</h4>
            </div>
            <hr>
            <div class="modal-body">
                Anda Yakin ingin menghapus data shift tersebut ?
            </div>
            <hr>
            <div class="modal-footer">
                <a id="btn_delete" class="btn btn-link waves-effect">SAVE CHANGES</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </form>
            </div>
        </div>
    </div>
</div>