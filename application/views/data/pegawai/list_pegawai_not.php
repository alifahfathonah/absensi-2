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
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Device ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Device ID</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($data_karyawan as $row) {
                                        $i++; ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nama_lengkap'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= sprintf(
                                                    "%s-%s-%s",
                                                    substr($row['no_telp'], 0, 4),
                                                    substr($row['no_telp'], 4, 4),
                                                    substr($row['no_telp'], 8)
                                                ); ?></td>
                                            <td><?= strtoupper($row['device_id']); ?></td>
                                            <td>
                                                <center>
                                                    <span data-toggle="modal" onClick="verifData('<?= $row['id_users']; ?>')" data-target="#modal_verif">
                                                        <button id="btn_verif" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Verifikasi Data">
                                                            <i class="material-icons">check_circle</i>
                                                        </button>
                                                    </span>
                                                    <span data-toggle="modal" data-target="#modal_delete">
                                                        <button type="button" onClick="deleteData('<?= $row['id_users']; ?>')" class="btn bg-default btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Delete Data">
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
                    </div>s
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

<!-- Modal  -->
<!-- Button trigger modal -->
<?php if ($this->session->flashdata('text')) { ?>
    <p style="display: none;" id="icon"><?= $this->session->flashdata('icon'); ?></p>
    <p style="display: none;" id="title"><?= $this->session->flashdata('title'); ?></p>
    <p style="display: none;" id="text"><?= $this->session->flashdata('text'); ?></p>
<?php } ?>

<!-- Large Size -->
<div class="modal fade" id="modal_verif" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Verifikasi Data Pegawai</h4>
            </div>
            <hr>
            <div class="modal-body">
                <form action="<?= base_url('pegawai/verifikasi_data/') ?>" method="post">
                    <div class="col-sm-12">
                    <label for="shift">Jabatan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select id="shift" name="jabatan" class="form-control">
                                    <option value="">-- Pilih Jabatan --</option>
                                    <?php foreach ($data_jabatan as $row) { ?>
                                        <option value="<?= $row['id_jabatan'];  ?>"><?= $row['nama_jabatan'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="shift">Shift</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select id="shift" name="shift" class="form-control">
                                    <option value="">-- Pilih Shift --</option>
                                    <?php foreach ($data_shift as $row) { ?>
                                        <option value="<?= $row['id_shift'];  ?>"><?= $row['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id_user" id="id_user">


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
                <h4 class="modal-title" id="largeModalLabel">Hapus Data Pegawai</h4>
            </div>
            <hr>
            <div class="modal-body">
                Anda Yakin ingin menghapus data pegawai tersebut ?
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